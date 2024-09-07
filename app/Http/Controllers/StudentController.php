<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    //create
    public function Create()
    {
        return view('students.student');
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $student = new Student();
        $student->name = $name;
        $student->email = $email;
        $student->profileimage = $imageName;

        $student->save();
        return back()->with('student_add', 'Studen has saved successfully.');
    }

    public function showinfo() {
        $students = Student::all();
        
        return view('students.stdlist' , compact('students'));
    }

    public function Delete($id) {
        $student = Student::find($id);
        unlink(public_path('images').'/'.$student->profileimage);
        $student->delete();

        return back();
    }
}