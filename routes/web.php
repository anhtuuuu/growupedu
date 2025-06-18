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
use App\Http\Controllers\FormLoginController;

/* Client sites start */
Route::get('/', [HomeController::class, 'index']);
Route::get('/assess', [AssessController::class, 'index']);
Route::get('/login', [FormLoginController::class, 'index']);
Route::get('/lession-files', [LessonController::class, 'index']);
Route::get('/persional-management', [PerformanceController::class, 'index']);
Route::get('/test', [TestController::class, 'index']);
Route::get('/section-class', [ClassController::class, 'index']);
/* Client sites end */

// =====================================================================================================================

/* Admin sites start */
Route::get('/admin', [AdminController::class, 'admin_index']);
Route::get('/account_management', [AccountController::class, 'admin_index']);
Route::get('/assess_management', [AssessController::class, 'admin_index']);
Route::get('/assess_detail/{number}', [AssessController::class, 'assess_detail']);
Route::get('/class_management', [ClassController::class, 'admin_index']);
Route::get('/content_management', [ContentController::class, 'admin_index']);
Route::get('/course_management', [CourseController::class, 'admin_index']);
Route::get('/department_management', [DepartmentController::class, 'admin_index']);
Route::get('/lecturer_management', [LecturerController::class, 'admin_index']);
Route::get('/lesson_management', [LessonController::class, 'admin_index']);
Route::get('/performance_management', [PerformanceController::class, 'admin_index']);
Route::get('/plan_management', [PlanController::class, 'admin_index']);
Route::get('/student_management', [StudentController::class, 'admin_index']);
Route::get('/subject_management', [SubjectController::class, 'admin_index']);
Route::get('/test_management', [TestController::class, 'admin_index']);


/* Admin sites end */
