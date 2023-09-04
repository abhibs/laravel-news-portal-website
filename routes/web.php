<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


Route::get('/', [HomeController::class, 'index'])->name('user-home');
Route::get('/news/detail/{id}/{slug}', [HomeController::class, 'newsDetais'])->name('news-detail');
Route::get('/category/news/{id}/{slug}', [HomeController::class, 'categoryNews'])->name('category-news');
Route::get('/sub/category/news/{id}/{slug}', [HomeController::class, 'subCategoryNews'])->name('sub-category-news');
Route::post('/date/search', [HomeController::class, 'searchByDate'])->name('search-by-date');
Route::post('/search', [HomeController::class, 'searchByName'])->name('search-by-name');
Route::get('/admin/news/{id}', [HomeController::class, 'adminNews'])->name('admin-news');
Route::get('/all/photo/galleries', [HomeController::class, 'allPhotoGallery'])->name('all-photo-gallery');
Route::get('/all/video/galleries', [HomeController::class, 'allVideoGallery'])->name('all-video-gallery');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us/post', [HomeController::class, 'contactUsPost'])->name('contact-us-post');


Route::group(['prefix' => 'user'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('user-register');
    Route::get('/login', [UserController::class, 'login'])->name('user-login');

    Route::post('/register/post', [UserController::class, 'registerPost'])->name('user-register-post');
    Route::post('/login/post', [UserController::class, 'loginPost'])->name('user-login-post');

    Route::post('/review/post', [HomeController::class, 'reviewPost'])->name('review-post');

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('user-dashboard');
        Route::post('/profile/update', [UserController::class, 'userProfileUpdate'])->name('user-profile-update');
        Route::get('/change/password', [UserController::class, 'userChangePassword'])->name('user-change-password');
        Route::post('/change/password/update', [UserController::class, 'userChangePasswordUpdate'])->name('user-change-password-update');
        Route::get('/logout', [UserController::class, 'userLogout'])->name('user-logout');
    });
});