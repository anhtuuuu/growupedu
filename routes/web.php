<?php

use Illuminate\Support\Facades\Route;

/* Client sites start */
Route::get('/', function () {
    return view(config('asset.view_page')('main'));
});
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
Route::get('/admin', function () {
    return view(config('asset.view_admin_page')('main'));
});
Route::get('/admin/lesson_management', function () {
    return view(config('asset.view_admin_page')('lesson_management'));
});
Route::get('/admin/content_management', function () {
    return view(config('asset.view_admin_page')('content_management'));
});
Route::get('/admin/plan_management', function () {
    return view(config('asset.view_admin_page')('plan_management'));
});
Route::get('/admin/account_management', function () {
    return view(config('asset.view_admin_page')('account_management'));
});
Route::get('/admin/assess_detail', function () {
    return view(config('asset.view_admin_page')('assess_detail'));
});
Route::get('/admin/performance_management', function () {
    return view(config('asset.view_admin_page')('performance_management'));
});
Route::get('/admin/lecturer_management', function () {
    return view(config('asset.view_admin_page')('lecturer_management'));
});
Route::get('/admin/subject_management', function () {
    return view(config('asset.view_admin_page')('subject_management'));
});
Route::get('/admin/assess_management', function () {
    return view(config('asset.view_admin_page')('assess_management'));
});
Route::get('/admin/course_management', function () {
    return view(config('asset.view_admin_page')('course_management'));
});
Route::get('/admin/department_management', function () {
    return view(config('asset.view_admin_page')('department_management'));
});
Route::get('/admin/class_management', function () {
    return view(config('asset.view_admin_page')('class_management'));
});
Route::get('/admin/student_management', function () {
    return view(config('asset.view_admin_page')('student_management'));
});
Route::get('/admin/test_management', function () {
    return view(config('asset.view_admin_page')('test_management'));
});

/* Admin sites end */
