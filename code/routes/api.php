<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\GradeController;

// Test token generation endpoint
Route::post('get-token', function (Request $request) {
    $token = $request->input('token');
    
    //  valid tokens from Project 1
    $validTokens = ['secret_bebba_key_2025', 'super_secure_token'];
    
    if (in_array($token, $validTokens)) {
        return response()->json([
            'token' => $token,
            'message' => 'Token validated successfully'
        ]);
    }
    
    return response()->json([
        'error' => 'Invalid token'
    ], 401);
});

// no authentication
Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class)->only(['index', 'store']);
Route::get('grades', [GradeController::class, 'index']);

// require Bearer token
Route::middleware('custom.token')->group(function () {
    Route::post('enrollments', [EnrollmentController::class, 'store']);
    Route::delete('enrollments/{id}', [EnrollmentController::class, 'destroy']);
});
