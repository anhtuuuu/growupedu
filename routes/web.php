<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssessController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FormLoginController;

/* Client sites start */
Route::get('/', [LayoutController::class, 'index']);
Route::get('/login', [FormLoginController::class, 'index']);
Route::get('/{alias_class}/{alias_lesson}/files-bai-giang', [ContentController::class, 'files']);
Route::get('/bai-giang/{alias_lesson}', [LessonController::class, 'index']);
Route::get('/{alias_class}/{alias_lesson}/{alias_chapter}/{alias_content}', [ContentController::class, 'index']);

Route::get('/persional-management/{num}', [AccountController::class, 'index']);
Route::get('{alias_class}/{test_code}/test', [TestController::class, 'index']);
Route::get('{alias_class}/test', [TestController::class, 'test_list']);
Route::get('/section-class/{any}', [ClassController::class, 'index']);
Route::get('/interact/{alias_class}', [ClassController::class, 'interact']);
Route::get('/assess/{alias_class}', [AssessController::class, 'index']);
Route::get('/{alias_class}/bang-diem', [ClassController::class, 'core_sheet_list']);
Route::get('/{alias_class}/{test_code}/bang-diem', [ClassController::class, 'core_sheet']);


// Route::get('/diem', function (){ return view(config('asset.view_page')('score-sheet'));});

/* Client sites end */

// =====================================================================================================================

/* Admin sites start */
Route::get('/admin', [AdminController::class, 'login']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'admin_index']);
Route::get('/logout', [AdminController::class, 'logout']);

Route::get('/danh-sach-tai-khoan', [AccountController::class, 'admin_index']);
Route::get('/danh-sach-danh-gia', [AssessController::class, 'admin_index']);
Route::get('/chi-tiet-danh-gia/{num}', [AssessController::class, 'assess_detail']);
Route::get('/danh-sach-lop-hoc-phan', [ClassController::class, 'admin_index']);
Route::get('/danh-sach-bai', [ContentController::class, 'admin_index']);
Route::get('/danh-sach-chuong', [ChapterController::class, 'admin_index']);
Route::get('/danh-sach-khoa', [DepartmentController::class, 'admin_index']);
Route::get('/danh-sach-giang-vien', [LecturerController::class, 'admin_index']);
Route::get('/danh-sach-bai-giang', [LessonController::class, 'admin_index']);
Route::get('/performance_management', [PerformanceController::class, 'admin_index']);
Route::get('/danh-sach-hoc-phan', [CourseController::class, 'admin_index']);
Route::get('/danh-sach-sinh-vien', [StudentController::class, 'admin_index']);
Route::get('/danh-sach-bo-mon', [SubjectController::class, 'admin_index']);
Route::get('/danh-sach-bai-kiem-tra', [TestController::class, 'admin_index']);

//thêm
Route::get('/them-bai-giang', [LessonController::class, 'admin_add']);
Route::post('/them-bai-giang', [LessonController::class, 'admin_add']);
Route::get('/them-khoa', [DepartmentController::class, 'admin_add']);
Route::post('/them-khoa', [DepartmentController::class, 'admin_add']);
Route::get('/them-bo-mon', [SubjectController::class, 'admin_add']);
Route::post('/them-bo-mon', [SubjectController::class, 'admin_add']);
Route::get('/them-hoc-phan', [CourseController::class, 'admin_add']);
Route::post('/them-hoc-phan', [CourseController::class, 'admin_add']);
Route::get('/them-bai', [ContentController::class, 'admin_add']);
Route::post('/them-bai', [ContentController::class, 'admin_add']);
Route::get('/them-chuong', [ChapterController::class, 'admin_add']);
Route::post('/them-chuong', [ChapterController::class, 'admin_add']);

Route::get('/cap-nhat-bai-giang/{value}', [LessonController::class, 'admin_update']);
Route::post('/cap-nhat-bai-giang', [LessonController::class, 'admin_update']);
Route::get('/cap-nhat-khoa/{value}', [DepartmentController::class, 'admin_update']);
Route::post('/cap-nhat-khoa', [DepartmentController::class, 'admin_update']);
Route::get('/cap-nhat-bo-mon/{value}', [SubjectController::class, 'admin_update']);
Route::post('/cap-nhat-bo-mon', [SubjectController::class, 'admin_update']);
Route::get('/cap-nhat-hoc-phan/{value}', [CourseController::class, 'admin_update']);
Route::post('/cap-nhat-hoc-phan', [CourseController::class, 'admin_update']);
Route::get('/cap-nhat-chuong/{value}', [ChapterController::class, 'admin_update']);
Route::post('/cap-nhat-chuong', [ChapterController::class, 'admin_update']);


Route::get('/{any}', [ClassController::class, 'index']);


/* Admin sites end */
