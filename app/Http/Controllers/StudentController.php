<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $loggedInUser = null;

        if ($userId) {
            $loggedInUser = User::find($userId);
            if ($loggedInUser) {
                $loggedInUser->load('role');
            }
        }

        $students = Student::paginate(2);
        return view('students.index', compact('students', 'loggedInUser'));
    }


    public function create()
    {
        return view('students.create');
    }


    public function store(StoreStudentRequest $request)
    { 
        Student::create($request->validated());
        return redirect()->route('students.index')->with('success', 'Estudiante creado exitosamente.');
    }


    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }


    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }


    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index')->with('success', 'Estudiante actualizado exitosamente.');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado exitosamente.');
    }
}
