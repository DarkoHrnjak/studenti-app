<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ime' => 'required|min:2',
            'prezime' => 'required|min:2',
            'status' => 'required|in:redovni,izvanredni',
            'godiste' => 'required|integer|between:1980,' . date('Y'),
            'prosjek' => 'required|numeric|between:1,5',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'ime' => 'required|min:2',
            'prezime' => 'required|min:2',
            'status' => 'required|in:redovni,izvanredni',
            'godiste' => 'required|integer|between:1980,' . date('Y'),
            'prosjek' => 'required|numeric|between:1,5',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}
