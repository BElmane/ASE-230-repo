<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // POST /api/enrollments - Create enrollment (SECURED)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer'
        ]);

        // Verify student exists
        $student = Student::find($validated['student_id']);
        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        // Verify course exists
        $course = Course::find($validated['course_id']);
        if (!$course) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }

        
        $exists = Enrollment::where('student_id', $validated['student_id'])
                           ->where('course_id', $validated['course_id'])
                           ->exists();
        
        if ($exists) {
            return response()->json([
                'error' => 'Student already enrolled in this course'
            ], 409);
        }

        $enrollment = Enrollment::create($validated);

        return response()->json([
            'message' => 'Student enrolled successfully',
            'id' => $enrollment->id,
            'enrollment' => $enrollment
        ], 201);
    }

    // DELETE /api/enrollments/{id} - Delete enrollment (SECURED)
    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json([
                'error' => 'Enrollment not found'
            ], 404);
        }

        $enrollment->delete();

        return response()->json([
            'message' => 'Enrollment deleted successfully'
        ]);
    }
}
