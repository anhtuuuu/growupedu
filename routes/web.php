<?php

use Illuminate\Support\Facades\Route;
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