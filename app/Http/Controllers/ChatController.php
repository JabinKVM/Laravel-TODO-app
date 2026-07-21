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
    /**
     * School - Contact List
     */
    public function schoolIndex()
    {
        $school = Auth::user()->school;

        $students = Student::where('school_id', $school->id)
            ->orderBy('name')
            ->get();

        return view('chat.index', [
            'contacts' => $students,
            'role' => 'school',
            'conversation' => null,
            'messages' => collect(),
        ]);
    }

    /**
     * Student - Contact List
     */
    public function studentIndex()
    {
        $student = Auth::user()->student;

        $school = School::findOrFail($student->school_id);

        return view('chat.index', [
            'contacts' => collect([$school]),
            'role' => 'student',
            'conversation' => null,
            'messages' => collect(),
        ]);
    }

    /**
     * Open Chat
     */
    public function open($id)
    {
        $user = Auth::user();

        if ($user->role == 'school') {

            $school = $user->school;

            $student = Student::where('school_id', $school->id)
                ->where('id', $id)
                ->firstOrFail();

            $conversation = Conversation::firstOrCreate(
                [
                    'school_user_id' => $user->id,
                    'student_user_id' => $student->user_id,
                ]
            );

            $contacts = Student::where('school_id', $school->id)
                ->orderBy('name')
                ->get();
        } else {

            $student = $user->student;

            $school = School::findOrFail($student->school_id);

            $conversation = Conversation::firstOrCreate(
                [
                    'school_user_id' => $school->user_id,
                    'student_user_id' => $user->id,
                ]
            );

            $contacts = collect([$school]);
        }

        $messages = $conversation->messages()
            ->with('sender')
            ->get();

        return view('chat.index', [
            'contacts' => $contacts,
            'conversation' => $conversation,
            'messages' => $messages,
            'role' => $user->role,
        ]);
    }

    /**
     * Send Message
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
        ]);

        $conversation->update([
            'last_message_at' => now(),
        ]);

        return redirect()->back();
    }
}