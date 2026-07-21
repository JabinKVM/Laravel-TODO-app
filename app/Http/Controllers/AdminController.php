<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalSchools = School::count();

        $activeSchools = School::where('status', true)->count();

        $blockedSchools = School::where('status', false)->count();

        return view('admin.dashboard', compact(
            'totalSchools',
            'activeSchools',
            'blockedSchools'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | View Schools
    |--------------------------------------------------------------------------
    */

    public function schools()
    {
        $schools = School::with('user')
            ->latest()
            ->paginate(10);

        return view('schools.index', compact('schools'));
    }

    /*
    |--------------------------------------------------------------------------
    | Register School
    |--------------------------------------------------------------------------
    */

    public function createSchool()
    {
        return view('schools.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store School
    |--------------------------------------------------------------------------
    */

    public function storeSchool(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required|string|max:20',

            'address' => 'required|string',

            'password' => 'required|min:6|confirmed',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Create Login Account
            |--------------------------------------------------------------------------
            */

            $user = User::create([

                'name' => $request->name,

                'email' => $request->email,

                'password' => Hash::make($request->password),

                'role' => 'school',

                'status' => true,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Create School
            |--------------------------------------------------------------------------
            */

            School::create([

                'user_id' => $user->id,

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'address' => $request->address,

                'status' => true,

            ]);

            DB::commit();

            return redirect()
                ->route('admin.schools.index')
                ->with('success', 'School registered successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());

        }
    }
        /*
    |--------------------------------------------------------------------------
    | School Details
    |--------------------------------------------------------------------------
    */

   public function schoolDetails($id)
{
    $school = School::with('user')->findOrFail($id);

    $totalStudents = Student::where('school_id', $school->id)->count();

    return view('schools.show', compact(
        'school',
        'totalStudents'
    ));
}

    /*
    |--------------------------------------------------------------------------
    | Edit School
    |--------------------------------------------------------------------------
    */

    public function editSchool($id)
    {
        $school = School::findOrFail($id);

        return view('schools.edit', compact('school'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update School
    |--------------------------------------------------------------------------
    */

    public function updateSchool(Request $request, $id)
    {
        $school = School::findOrFail($id);

        $user = User::findOrFail($school->user_id);

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone' => 'required|string|max:20',

            'address' => 'required|string',

        ]);

        DB::beginTransaction();

        try {

            $user->update([

                'name' => $request->name,

                'email' => $request->email,

            ]);

            $school->update([

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'address' => $request->address,

            ]);

            DB::commit();

            return redirect()
                    ->route('admin.schools.index')
                    ->with('success', 'School updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                    ->withInput()
                    ->with('error', $e->getMessage());

        }
    }
        /*
    |--------------------------------------------------------------------------
    | Block School
    |--------------------------------------------------------------------------
    */

    public function blockSchool($id)
    {
        DB::beginTransaction();

        try {

            $school = School::findOrFail($id);

            $school->update([
                'status' => false,
            ]);

            User::where('id', $school->user_id)->update([
                'status' => false,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.schools.index')
                ->with('success', 'School blocked successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Unblock School
    |--------------------------------------------------------------------------
    */

    public function unblockSchool($id)
    {
        DB::beginTransaction();

        try {

            $school = School::findOrFail($id);

            $school->update([
                'status' => true,
            ]);

            User::where('id', $school->user_id)->update([
                'status' => true,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.schools.index')
                ->with('success', 'School activated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete School
    |--------------------------------------------------------------------------
    */

    public function deleteSchool($id)
    {
        DB::beginTransaction();

        try {

            $school = School::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | Delete Tasks
            |--------------------------------------------------------------------------
            */

            Task::where('school_id', $school->id)->delete();

            /*
            |--------------------------------------------------------------------------
            | Delete Students
            |--------------------------------------------------------------------------
            */

            $students = Student::where('school_id', $school->id)->get();

            foreach ($students as $student) {

                User::where('id', $student->user_id)->delete();

                $student->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Delete School Login
            |--------------------------------------------------------------------------
            */

            User::where('id', $school->user_id)->delete();

            /*
            |--------------------------------------------------------------------------
            | Delete School
            |--------------------------------------------------------------------------
            */

            $school->delete();

            DB::commit();

            return redirect()
                ->route('admin.schools.index')
                ->with('success', 'School deleted successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

}