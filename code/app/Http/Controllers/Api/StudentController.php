<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // GET /api/students - Get all students
    public function index()
    {
        $students = Student::all();
        
        return response()->json([
            'students' => $students,
            'count' => $students->count()
        ]);
    }

    // POST /api/students - Create student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email'
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'id' => $student->id,
            'student' => $student
        ], 201);
    }

    // GET /api/students/{id} - Get one student
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'student' => $student
        ]);
    }

    // PUT /api/students/{id} - Update student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email,' . $id
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ]);
    }

    // DELETE /api/students/{id} - Delete student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}
