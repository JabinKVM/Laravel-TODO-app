<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SCHOOL CHAT HOME
    |--------------------------------------------------------------------------
    */

    public function schoolIndex(Request $request)
    {
        $school = Auth::user()->school;

        $contacts = Student::where('school_id', $school->id)
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Attach latest conversation to every contact
        |--------------------------------------------------------------------------
        */

        foreach ($contacts as $contact) {

            $conversation = Conversation::where(
                'school_user_id',
                Auth::id()
            )
            ->where(
                'student_user_id',
                $contact->user_id
            )
            ->with('latestMessage')
            ->first();

            $contact->conversation = $conversation;

            $contact->last_message = $conversation?->latestMessage?->message;

            $contact->last_message_time =
                $conversation?->latestMessage?->created_at;

            $contact->unread_count = $conversation
                ? Message::where('conversation_id', $conversation->id)
                    ->where('sender_id', '!=', Auth::id())
                    ->where('is_read', false)
                    ->count()
                : 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Sort by latest message
        |--------------------------------------------------------------------------
        */

        $contacts = $contacts->sortByDesc(function ($contact) {

            return optional(
                $contact->last_message_time
            )->timestamp ?? 0;

        });

        return view('chat.index', [

            'contacts'      => $contacts,

            'messages'      => collect(),

            'conversation'  => null,

            'chatUser'      => null,

            'activeChat'    => null,

            'role'          => 'school',

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT CHAT HOME
    |--------------------------------------------------------------------------
    */

    public function studentIndex(Request $request)
    {
        $student = Auth::user()->student;

        $contacts = School::where(
            'id',
            $student->school_id
        )->get();

        foreach ($contacts as $contact) {

            $conversation = Conversation::where(
                'school_user_id',
                $contact->user_id
            )
            ->where(
                'student_user_id',
                Auth::id()
            )
            ->with('latestMessage')
            ->first();

            $contact->conversation = $conversation;

            $contact->last_message =
                $conversation?->latestMessage?->message;

            $contact->last_message_time =
                $conversation?->latestMessage?->created_at;

            $contact->unread_count = $conversation
                ? Message::where('conversation_id', $conversation->id)
                    ->where('sender_id', '!=', Auth::id())
                    ->where('is_read', false)
                    ->count()
                : 0;
        }

        return view('chat.index', [

            'contacts'      => $contacts,

            'messages'      => collect(),

            'conversation'  => null,

            'chatUser'      => null,

            'activeChat'    => null,

            'role'          => 'student',

        ]);
    }
        /*
    |--------------------------------------------------------------------------
    | OPEN CHAT
    |--------------------------------------------------------------------------
    */

    public function open($id)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | SCHOOL
        |--------------------------------------------------------------------------
        */

        if ($user->role == 'school') {

            $school = $user->school;

            $chatUser = Student::with('user')
                 ->where('school_id', $school->id)
                ->findOrFail($id);

            $contacts = Student::with('user')
                ->where('school_id', $school->id)
                ->orderBy('name')
                ->get();

            foreach ($contacts as $contact) {

                $conv = Conversation::where('school_user_id', $user->id)
                    ->where('student_user_id', $contact->user_id)
                    ->with('latestMessage')
                    ->first();

                $contact->conversation = $conv;

                $contact->last_message = $conv?->latestMessage?->message;

                $contact->last_message_time =
                    $conv?->latestMessage?->created_at;

                $contact->unread_count = $conv
                    ? Message::where('conversation_id', $conv->id)
                        ->where('sender_id', '!=', Auth::id())
                        ->where('is_read', false)
                        ->count()
                    : 0;
            }

            $conversation = Conversation::firstOrCreate([

                'school_user_id' => $user->id,

                'student_user_id' => $chatUser->user_id,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        else {

            $student = $user->student;

            $chatUser = School::findOrFail($student->school_id);

            $contacts = School::where('id', $student->school_id)->get();

            foreach ($contacts as $contact) {

                $conv = Conversation::where('school_user_id', $contact->user_id)
                    ->where('student_user_id', Auth::id())
                    ->with('latestMessage')
                    ->first();

                $contact->conversation = $conv;

                $contact->last_message = $conv?->latestMessage?->message;

                $contact->last_message_time =
                    $conv?->latestMessage?->created_at;

                $contact->unread_count = $conv
                    ? Message::where('conversation_id', $conv->id)
                        ->where('sender_id', '!=', Auth::id())
                        ->where('is_read', false)
                        ->count()
                    : 0;
            }

            $conversation = Conversation::firstOrCreate([

                'school_user_id' => $chatUser->user_id,

                'student_user_id' => $user->id,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Mark as Read
        |--------------------------------------------------------------------------
        */

        Message::where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        /*
        |--------------------------------------------------------------------------
        | Load Messages
        |--------------------------------------------------------------------------
        */

        $messages = Message::where('conversation_id', $conversation->id)
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        return view('chat.index', [

            'contacts' => $contacts,

            'messages' => $messages,

            'conversation' => $conversation,

            'chatUser' => $chatUser,

            'activeChat' => $chatUser->id,

            'role' => $user->role,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    */

    public function send(Request $request, $conversationId)
    {
        $request->validate([

            'message' => 'required|string|max:5000',

        ]);

        $conversation = Conversation::findOrFail($conversationId);

        Message::create([

            'conversation_id' => $conversation->id,

            'sender_id' => Auth::id(),

            'message' => $request->message,

            'is_read' => false,

        ]);

        $conversation->update([

            'last_message_at' => now(),

        ]);

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE MESSAGE
    |--------------------------------------------------------------------------
    */

    public function destroy(Message $message)
    {
        if ($message->sender_id != Auth::id()) {

            abort(403);

        }

        $conversation = $message->conversation;

        $message->delete();

        $last = $conversation->messages()
            ->latest()
            ->first();

        $conversation->update([

            'last_message_at' => $last?->created_at,

        ]);

        return back()->with(

            'success',

            'Message deleted successfully.'

        );
    }

}