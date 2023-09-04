<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;


Route::get('/current/date/time', [HomeController::class, 'currentDateTime']);
Route::post('/news/search/by/name', [HomeController::class, 'apiSearchByName']);
Route::post('/user/register', [HomeController::class, 'register']);
Route::post('/user/login', [HomeController::class, 'login']);


Route::get('/navbar/category', [HomeController::class, 'category']);
Route::get('/navbar/subcategory', [HomeController::class, 'subcategory']);
Route::get('/breaking/news', [HomeController::class, 'breakingNews']);
Route::get('/slider/news', [HomeController::class, 'sliderNews']);
Route::get('/three/section/news', [HomeController::class, 'threeSectionNews']);
Route::get('/nine/section/news', [HomeController::class, 'nineSectionNews']);
Route::get('/live/tv', [HomeController::class, 'liveTv']);
Route::post('/news/search/by/date', [HomeController::class, 'searchByDate']);
Route::get('/banners', [HomeController::class, 'Adsbannner']);
Route::get('/category/wise/news', [HomeController::class, 'catWiseTabNews']);
Route::get('polical/category/news', [HomeController::class, 'policalCatNews']);
Route::get('entertainment/category/news', [HomeController::class, 'entertainmentCatNews']);
Route::get('automobiles/category/news', [HomeController::class, 'automobilesCatNews']);
Route::get('crime/category/news', [HomeController::class, 'crimeCatNews']);
Route::get('health/category/news', [HomeController::class, 'healthCatNews']);
Route::get('sports/category/news', [HomeController::class, 'sportsCatNews']);
Route::get('/photo/galleries', [HomeController::class, 'photoGallery']);
Route::get('/video/galleries', [HomeController::class, 'videoGallery']);
Route::post('/contact-us', [HomeController::class, 'contactUs']);

Route::get('/news/detail/{id}/{slug}', [HomeController::class, 'newsDetail']);
Route::get('/category/news/{id}/{slug}', [HomeController::class, 'categoryWiseNews']);
Route::get('/sub/category/news/{id}/{slug}', [HomeController::class, 'subCategoryWiseNews']);
Route::get('/admin/news/{id}', [HomeController::class, 'reporterWiseNews']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logged/user', [HomeController::class, 'logged_user']);
    Route::post('/user/profile/update', [HomeController::class, 'userProfileUpdate']);
    Route::post('/user/change/password', [HomeController::class, 'userChangePassword']);
    Route::get('/user/logout', [HomeController::class, 'userLogout']);
    Route::post('/review/post', [HomeController::class, 'reviewPost']);
});
