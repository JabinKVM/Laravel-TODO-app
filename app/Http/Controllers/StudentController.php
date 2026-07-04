<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display all students.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show registration form.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store new student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'student_id'    => 'required|unique:students',

            'name'          => 'required|string|max:255',

            'email'         => 'required|email|unique:students',

            'phone'         => 'required',

            'dob'           => 'required|date',

            'gender'        => 'required',

            'department'    => 'required',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'status'        => 'required'

        ]);

        if ($request->hasFile('profile_photo')) {

            $validated['profile_photo'] =
                $request->file('profile_photo')
                        ->store('students', 'public');
        }

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student registered successfully.');
    }

    /**
     * Show student details.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Edit student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update student.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([

            'student_id' => 'required|unique:students,student_id,' . $student->id,

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:students,email,' . $student->id,

            'phone' => 'required',

            'dob' => 'required|date',

            'gender' => 'required',

            'department' => 'required',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'status' => 'required'

        ]);

        if ($request->hasFile('profile_photo')) {

            $validated['profile_photo'] =
                $request->file('profile_photo')
                        ->store('students', 'public');
        }

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Delete student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}