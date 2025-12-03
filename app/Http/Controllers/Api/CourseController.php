<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // GET /api/courses - Get all courses
    public function index()
    {
        $courses = Course::all();
        
        return response()->json([
            'courses' => $courses,
            'count' => $courses->count()
        ]);
    }

    // POST /api/courses - Create course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:20|unique:courses,course_code',
            'course_name' => 'required|string|max:200',
            'credits' => 'required|integer|min:1'
        ]);

        $course = Course::create($validated);

        return response()->json([
            'message' => 'Course created successfully',
            'id' => $course->id,
            'course' => $course
        ], 201);
    }
}
