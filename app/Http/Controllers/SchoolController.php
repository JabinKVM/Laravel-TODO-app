<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

        $totalStudents = Student::where('school_id', $school->id)->count();

        $activeStudents = Student::where('school_id', $school->id)
                                    ->where('status', true)
                                    ->count();

        $blockedStudents = Student::where('school_id', $school->id)
                                    ->where('status', false)
                                    ->count();

        return view('schools.dashboard', compact(
            'school',
            'totalStudents',
            'activeStudents',
            'blockedStudents'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | View Students
    |--------------------------------------------------------------------------
    */

   public function students()
{
    $school = School::where('user_id', Auth::id())->firstOrFail();

    $students = Student::where('school_id', $school->id)
        ->with('user')
        ->latest()
        ->paginate(10);

    return view('students.index', compact('students'));
}
    /*
    |--------------------------------------------------------------------------
    | Register Student
    |--------------------------------------------------------------------------
    */

    public function createStudent()
    {
        return view('students.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Student
    |--------------------------------------------------------------------------
    */

    public function storeStudent(Request $request)
    {
        
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required|string|max:20',

            'address' => 'required|string',

            'password' => 'required|min:6|confirmed',

        ]);

        $school = School::where('user_id', Auth::id())->firstOrFail();

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Create Login
            |--------------------------------------------------------------------------
            */

            $user = User::create([

                'name' => $request->name,

                'email' => $request->email,

                'password' => Hash::make($request->password),

                'role' => 'student',

                'status' => true,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Student
            |--------------------------------------------------------------------------
            */

            Student::create([

                'school_id' => $school->id,

                'user_id' => $user->id,
                'student_id' => $school->id,

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'address' => $request->address,

                'status' => true,

            ]);

            DB::commit();

            return redirect()
                    ->route('school.students.index')
                    ->with('success', 'Student registered successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                    ->withInput()
                    ->with('error', $e->getMessage());

        }
    }
        /*
    |--------------------------------------------------------------------------
    | Student Details
    |--------------------------------------------------------------------------
    */

    public function studentDetails($id)
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

       $student = Student::where('school_id', $school->id)
    ->where('id', $id)
    ->firstOrFail();

        return view('students.show', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Student
    |--------------------------------------------------------------------------
    */

    public function editStudent($id)
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

      $student = Student::where('school_id', $school->id)
    ->where('id', $id)
    ->firstOrFail();

        return view('students.edit', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Student
    |--------------------------------------------------------------------------
    */

    public function updateStudent(Request $request, $id)
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

        $student = Student::where('school_id', $school->id)
    ->where('id', $id)
    ->firstOrFail();

        $user = User::findOrFail($student->user_id);

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone' => 'required|string|max:20',

            'address' => 'required|string',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Update User
            |--------------------------------------------------------------------------
            */

            $user->update([

                'name' => $request->name,

                'email' => $request->email,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Student
            |--------------------------------------------------------------------------
            */

            $student->update([

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'address' => $request->address,

            ]);

            DB::commit();

            return redirect()
                    ->route('school.students.index')
                    ->with('success', 'Student updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                    ->withInput()
                    ->with('error', $e->getMessage());

        }
    }
        /*
    |--------------------------------------------------------------------------
    | Block Student
    |--------------------------------------------------------------------------
    */

    public function blockStudent($id)
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

        $student = Student::where('school_id', $school->id)
    ->where('id', $id)
    ->firstOrFail();

        DB::beginTransaction();

        try {

            $student->update([
                'status' => false,
            ]);

            User::where('id', $student->user_id)->update([
                'status' => false,
            ]);

            DB::commit();

            return redirect()
                    ->route('school.students.index')
                    ->with('success', 'Student blocked successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Unblock Student
    |--------------------------------------------------------------------------
    */

    public function unblockStudent($id)
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

        $student = Student::where('school_id', $school->id)
    ->where('id', $id)
    ->firstOrFail();

        DB::beginTransaction();

        try {

            $student->update([
                'status' => true,
            ]);

            User::where('id', $student->user_id)->update([
                'status' => true,
            ]);

            DB::commit();

            return redirect()
                    ->route('school.students.index')
                    ->with('success', 'Student activated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Student
    |--------------------------------------------------------------------------
    */

    public function deleteStudent($id)
    {
        $school = School::where('user_id', Auth::id())->firstOrFail();

       $student = Student::where('school_id', $school->id)
    ->where('id', $id)
    ->firstOrFail();

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Delete Student Tasks
            |--------------------------------------------------------------------------
            */

            Task::where('student_id', $student->id)->delete();

            /*
            |--------------------------------------------------------------------------
            | Delete Login
            |--------------------------------------------------------------------------
            */

            User::where('id', $student->user_id)->delete();

            /*
            |--------------------------------------------------------------------------
            | Delete Student
            |--------------------------------------------------------------------------
            */

            $student->delete();

            DB::commit();

            return redirect()
                    ->route('school.students.index')
                    ->with('success', 'Student deleted successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

}