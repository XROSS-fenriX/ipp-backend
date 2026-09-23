<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\NationalHolidayController;
use App\Http\Controllers\SchoolEventController;
use App\Http\Controllers\IncidentController;

use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\TeacherDetailController;
use App\Http\Controllers\UserAddressController;

use App\Http\Controllers\TrackController;
use App\Http\Controllers\ElectiveController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomMaterialController;
use App\Http\Controllers\ClassroomAnnouncementController;
use App\Http\Controllers\ClassroomDeadlineController;

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssessmentQuestionController;
use App\Http\Controllers\McqChoiceController;
use App\Http\Controllers\IdentificationAnswerController;
use App\Http\Controllers\EnumerationAnswerController;
use App\Http\Controllers\AssessmentSubmissionController;
use App\Http\Controllers\AssessmentAnswerController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'account.active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Your other protected routes go here
    // =========================================================================
    // ADMIN ONLY ROUTES
    // =========================================================================
    Route::middleware('role:admin')->group(function () {
        // School & System Configuration
        Route::apiResource('schools', SchoolController::class);
        Route::apiResource('national-holidays', NationalHolidayController::class);
        Route::apiResource('incidents', IncidentController::class);

        // Curriculum Management
        Route::apiResource('tracks', TrackController::class);
        Route::apiResource('electives', ElectiveController::class);
    });

    // =========================================================================
    // ADMIN & TEACHER ROUTES
    // =========================================================================
    Route::middleware('role:admin,teacher')->group(function () {
        // School Events Management
        Route::apiResource('school-events', SchoolEventController::class)->except(['index', 'show']);

        // Classroom Management (Creating/Deleting Classes)
        Route::apiResource('classrooms', ClassroomController::class)->except(['index', 'show']);

        // Coursework & Content Creation
        Route::apiResource('classroom-materials', ClassroomMaterialController::class);
        Route::apiResource('classroom-announcements', ClassroomAnnouncementController::class);
        Route::apiResource('classroom-deadlines', ClassroomDeadlineController::class);

        // Teacher profile details management
        Route::apiResource('teacher-details', TeacherDetailController::class);

        Route::post('classrooms/{classroom}/assessment', [ClassroomController::class, 'insertAssessment']);
    });

    // =========================================================================
    // STUDENT ONLY ROUTES
    // =========================================================================
    Route::middleware('role:student')->group(function () {
        // Submitting Assessments & Answers
        Route::apiResource('assessment-submissions', AssessmentSubmissionController::class);
        Route::apiResource('assessment-answers', AssessmentAnswerController::class);

        // Student profile details management
        Route::apiResource('student-details', StudentDetailController::class);

        // Enroll to a Classroom
        Route::post('/user/classroom', [UserController::class, 'enrollStudent']);
    });

    // =========================================================================
    // SHARED / ALL ROLES (Admin, Teacher, Student)
    // =========================================================================
    Route::middleware('role:admin,teacher,student')->group(function () {
        // Read-only access to class schedules, materials, and school events
        Route::get('classrooms', [ClassroomController::class, 'index']);
        Route::get('classrooms/{classroom}', [ClassroomController::class, 'show']);

        Route::get('school-events', [SchoolEventController::class, 'index']);
        Route::get('school-events/{school_event}', [SchoolEventController::class, 'show']);

        // Assessment Creation & Question Setup
        Route::apiResource('assessments', AssessmentController::class);
        Route::apiResource('assessment-questions', AssessmentQuestionController::class);
        Route::apiResource('mcq-choices', McqChoiceController::class);
        Route::apiResource('identification-answers', IdentificationAnswerController::class);
        Route::apiResource('enumeration-answers', EnumerationAnswerController::class);

        // User personal address profile
        Route::apiResource('user-addresses', UserAddressController::class);
    });

});
