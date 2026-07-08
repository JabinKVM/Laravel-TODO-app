<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
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
        $school = Auth::user()->school;

        $totalStudents = Student::where('school_id', $school->id)->count();

        $activeStudents = Student::where('school_id', $school->id)
            ->where('status', true)
            ->count();

        $blockedStudents = Student::where('school_id', $school->id)
            ->where('status', false)
            ->count();
        $assignedTasks = Task::where('created_by', Auth::id())->count();
        $recentStudents = Student::where('school_id', $school->id)
            ->latest()
            ->take(5)
            ->get();

        return view('school.dashboard', compact(

            'totalStudents',

            'activeStudents',

            'blockedStudents',

            'assignedTasks',

            'recentStudents'

        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Student List
    |--------------------------------------------------------------------------
    */

    public function students()
    {
        $school = Auth::user()->school;

        $students = Student::where('school_id', $school->id)
            ->latest()
            ->paginate(10);

        return view(
            'school.students.index',
            compact('students')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Register Student
    |--------------------------------------------------------------------------
    */

    public function createStudent()
    {
        return view('school.students.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Student
    |--------------------------------------------------------------------------
    */

    public function storeStudent(Request $request)
    {

        $request->validate([

            'student_id' => 'required|unique:students',

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required',

            'gender' => 'required',

            'dob' => 'required|date',

            'department' => 'required',

            'address' => 'nullable',

            'password' => 'required|min:6|confirmed',

        ]);

        DB::beginTransaction();

        try {

            $school = Auth::user()->school;

            $user = User::create([

                'name' => $request->name,

                'email' => $request->email,

                'password' => Hash::make($request->password),

                'role' => 'student',

                'status' => true,

            ]);

            Student::create([

                'user_id' => $user->id,

                'school_id' => $school->id,

                'student_id' => $request->student_id,

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'gender' => $request->gender,

                'dob' => $request->dob,

                'department' => $request->department,

                'address' => $request->address,

                'status' => true,

            ]);

            DB::commit();

            return redirect()
                ->route('school.students')
                ->with(
                    'success',
                    'Student registered successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }
        /*
    |--------------------------------------------------------------------------
    | View Student
    |--------------------------------------------------------------------------
    */

    public function showStudent(Student $student)
    {
        $school = Auth::user()->school;

        if ($student->school_id != $school->id) {

            abort(403);

        }

        return view(
            'school.students.show',
            compact('student')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Student
    |--------------------------------------------------------------------------
    */

    public function editStudent(Student $student)
    {
        $school = Auth::user()->school;

        if ($student->school_id != $school->id) {

            abort(403);

        }

        return view(
            'school.students.edit',
            compact('student')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Student
    |--------------------------------------------------------------------------
    */

    public function updateStudent(Request $request, Student $student)
    {

        $school = Auth::user()->school;

        if ($student->school_id != $school->id) {

            abort(403);

        }

        $request->validate([

            'student_id' => 'required|unique:students,student_id,' . $student->id,

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email,' . $student->user_id,

            'phone' => 'required',

            'gender' => 'required',

            'dob' => 'required|date',

            'address' => 'nullable',

        ]);

        DB::beginTransaction();

        try {

            $student->update([

                'student_id' => $request->student_id,

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'gender' => $request->gender,

                'dob' => $request->dob,

                'address' => $request->address,

            ]);

            $student->user->update([

                'name' => $request->name,

                'email' => $request->email,

            ]);

            DB::commit();

            return redirect()
                ->route('school.students')
                ->with(
                    'success',
                    'Student updated successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }
        /*
    |--------------------------------------------------------------------------
    | Block / Unblock Student
    |--------------------------------------------------------------------------
    */

    public function toggleStudentStatus(Student $student)
    {

        $school = Auth::user()->school;

        if ($student->school_id != $school->id) {

            abort(403);

        }

        DB::beginTransaction();

        try {

            $student->status = !$student->status;

            $student->save();

            $student->user->status = $student->status;

            $student->user->save();

            DB::commit();

            return back()->with(
                'success',
                'Student status updated successfully.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Delete Student
    |--------------------------------------------------------------------------
    */

    public function destroyStudent(Student $student)
    {

        $school = Auth::user()->school;

        if ($student->school_id != $school->id) {

            abort(403);

        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Delete Login Account
            |--------------------------------------------------------------------------
            */

            if ($student->user) {

                $student->user->delete();

            }

            /*
            |--------------------------------------------------------------------------
            | Delete Student
            |--------------------------------------------------------------------------
            */

            $student->delete();

            DB::commit();

            return redirect()
                ->route('school.students')
                ->with(
                    'success',
                    'Student deleted successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }

    }
}