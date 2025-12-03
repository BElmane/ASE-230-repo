<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // GET /api/grades?student_id={id} - Get grades for a student
    public function index(Request $request)
    {
        $studentId = $request->query('student_id');

        if (!$studentId) {
            return response()->json([
                'error' => 'Student ID is required'
            ], 400);
        }

        // Verify student exists
        $student = Student::find($studentId);
        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        // Get grades with course information
        $grades = Grade::where('student_id', $studentId)
                      ->with('course:id,course_code,course_name,credits')
                      ->get();

        return response()->json([
            'student' => $student,
            'grades' => $grades,
            'total_courses' => $grades->count()
        ]);
    }
}
