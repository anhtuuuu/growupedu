<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssessController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;

/* Client sites start */

Route::get('/', [HomeController::class, 'index']);

Route::get('/questions', function () {
    return view(config('asset.view_page')('questions'));
});
Route::get('/section-class', function () {
    return view(config('asset.view_page')('section-class'));
});
Route::get('/login', function () {
    return view(config('asset.view_page')('form-login'));
});
Route::get('/lession-file', function () {
    return view(config('asset.view_page')('lession-file'));
});
Route::get('/assess', function () {
    return view(config('asset.view_page')('assess'));
});
Route::get('/persional-manager', function () {
    return view(config('asset.view_page')('persional-manager'));
});

/* Client sites end */

// =====================================================================================================================

/* Admin sites start */
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/account_management', [AccountController::class, 'index']);
Route::get('/assess_management', [AssessController::class, 'index']);
Route::get('/assess_detail/{number}', [AssessController::class, 'detail']);
Route::get('/class_management', [ClassController::class, 'index']);
Route::get('/content_management', [ContentController::class, 'index']);
Route::get('/course_management', [CourseController::class, 'index']);
Route::get('/department_management', [DepartmentController::class, 'index']);
Route::get('/lecturer_management', [LecturerController::class, 'index']);
Route::get('/lesson_management', [LessonController::class, 'index']);
Route::get('/performance_management', [PerformanceController::class, 'index']);
Route::get('/plan_management', [PlanController::class, 'index']);
Route::get('/student_management', [StudentController::class, 'index']);
Route::get('/subject_management', [SubjectController::class, 'index']);
Route::get('/test_management', [TestController::class, 'index']);


/* Admin sites end */
