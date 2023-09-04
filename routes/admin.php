<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\Admin\LiveTvController;
use App\Http\Controllers\Admin\SeoController;


Route::get('/test', function () {
    echo "Abhiram";
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('news/create', [NewsController::class, 'create'])->name('news-create');


});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
    Route::post('/login', [AdminController::class, 'loginPost'])->name('admin-login-post');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::get('/logout', [Admincontroller::class, 'adminLogout'])->name('admin-logout');
        Route::get('/profile', [Admincontroller::class, 'adminProfile'])->name('admin-profile');
        Route::post('/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin-profile-update');
        Route::get('/change/password', [Admincontroller::class, 'changePassword'])->name('admin-change-password');
        Route::post('/update/password', [AdminController::class, 'updatePassword'])->name('admin-password-update');


        Route::get('/all/list', [Admincontroller::class, 'allAdmin'])->name('admin-all-list');
        Route::get('/create', [Admincontroller::class, 'addAdmin'])->name('admin-create');
        Route::post('/store', [AdminController::class, 'storeAdmin'])->name('admin-store');
        Route::get('/edit/{id}', [Admincontroller::class, 'editAdmin'])->name('admin-edit');
        Route::post('/update', [Admincontroller::class, 'updateAdmin'])->name('admin-update');
        Route::get('/delete/{id}', [Admincontroller::class, 'deleteAdmin'])->name('admin-delete');
        Route::get('/inactive/{id}', [AdminController::class, 'inactive'])->name('admin-inactive');
        Route::get('/active/{id}', [AdminController::class, 'active'])->name('admin-active');

        Route::get('/category/create', [CategoryController::class, 'create'])->name('category-create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category-store');
        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category-edit');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('category-update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category-delete');

        Route::get('/sub/category/create', [SubcategoryController::class, 'create'])->name('subcategory-create');
        Route::post('/sub/category/store', [SubcategoryController::class, 'store'])->name('subcategory-store');
        Route::get('/sub/category', [SubcategoryController::class, 'index'])->name('subcategory');
        Route::get('/sub/category/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory-edit');
        Route::post('/sub/category/update', [SubcategoryController::class, 'update'])->name('subcategory-update');
        Route::get('/sub/category/delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategory-delete');
        Route::get('/subcategory/ajax/{category_id}', [SubcategoryController::class, 'GetSubCategory']);

        Route::get('/permission', [RoleController::class, 'allPermission'])->name('all-permission');
        Route::get('add/permission', [RoleController::class, 'addPermission'])->name('add-permission');
        Route::post('store/permission', [RoleController::class, 'storePermission'])->name('store-permission');
        Route::get('/permission/edit/{id}', [RoleController::class, 'editPermission'])->name('edit-permission');
        Route::post('/permission/update', [RoleController::class, 'updatePermission'])->name('update-permission');
        Route::get('/permission/delete/{id}', [RoleController::class, 'deletePermission'])->name('delete-permission');


        Route::get('/roles', [RoleController::class, 'allRoles'])->name('all-roles');
        Route::get('add/roles', [RoleController::class, 'addRoles'])->name('add-roles');
        Route::post('store/roles', [RoleController::class, 'storeRoles'])->name('store-roles');
        Route::get('/roles/edit/{id}', [RoleController::class, 'editRoles'])->name('edit-roles');
        Route::post('/roles/update', [RoleController::class, 'updateRoles'])->name('update-roles');
        Route::get('/roles/delete/{id}', [RoleController::class, 'deleteRoles'])->name('delete-roles');


        Route::get('add/roles/permission', [RoleController::class, 'addRolesPermission'])->name('add-roles-permission');
        Route::post('store/roles/permission', [RoleController::class, 'rolePermisssionStore'])->name('store-roles-permission');
        Route::get('all/roles/permission', [RoleController::class, 'allRolesPermission'])->name('all-roles-permission');
        Route::get('edit/roles/permission/{id}', [RoleController::class, 'editRolesPermission'])->name('edit-roles-permission');
        Route::post('update/roles/permission/{id}', [RoleController::class, 'updateRolesPermission'])->name('update-roles-permission');
        Route::get('delete/roles/permission/{id}', [RoleController::class, 'deleteRolesPermission'])->name('delete-roles-permission');

        Route::get('/news', [NewsController::class, 'index'])->name('news');
        Route::post('/news/post', [NewsController::class, 'store'])->name('news-store');
        Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news-edit');
        Route::post('/news/update', [NewsController::class, 'update'])->name('news-update');
        Route::get('/news/delete/{id}', [NewsController::class, 'delete'])->name('news-delete');
        Route::get('/news/inactive/{id}', [NewsController::class, 'inactive'])->name('news-inactive');
        Route::get('/news/active/{id}', [NewsController::class, 'active'])->name('news-active');

        Route::get('/banner', [BannerController::class, 'index'])->name('banner');
        Route::post('/banner/update', [BannerController::class, 'update'])->name('banner-update');


        Route::get('/photo/gallery/create', [PhotoGalleryController::class, 'create'])->name('photo-create');
        Route::post('/photo/gallery/store', [PhotoGalleryController::class, 'store'])->name('photo-store');
        Route::get('/photo/gallery', [PhotoGalleryController::class, 'index'])->name('photo');
        Route::get('/photo/gallery/edit/{id}', [PhotoGalleryController::class, 'edit'])->name('photo-edit');
        Route::post('/photo/gallery/update', [PhotoGalleryController::class, 'update'])->name('photo-update');
        Route::get('/photo/gallery/delete/{id}', [PhotoGalleryController::class, 'delete'])->name('photo-delete');

        Route::get('/video/gallery/create', [VideoGalleryController::class, 'create'])->name('video-create');
        Route::post('/video/gallery/store', [VideoGalleryController::class, 'store'])->name('video-store');
        Route::get('/video/gallery', [VideoGalleryController::class, 'index'])->name('video');
        Route::get('/video/gallery/edit/{id}', [VideoGalleryController::class, 'edit'])->name('video-edit');
        Route::post('/video/gallery/update', [VideoGalleryController::class, 'update'])->name('video-update');
        Route::get('/video/gallery/delete/{id}', [VideoGalleryController::class, 'delete'])->name('video-delete');


        Route::get('/live-tv', [LiveTvController::class, 'index'])->name('live-tv');
        Route::post('/live-tv/update', [LiveTvController::class, 'update'])->name('live-tv-update');

        Route::get('/seo', [SeoController::class, 'index'])->name('seo');
        Route::post('/seo/update', [SeoController::class, 'update'])->name('seo-update');

        Route::get('/pending/review', [ReviewController::class, 'pendingReview'])->name('pending-reviews');
        Route::get('/review/approve/{id}', [ReviewController::class, 'approvingReview'])->name('approving-review');
        Route::get('/approved/review', [ReviewController::class, 'approvedReview'])->name('approved-reviews');
        Route::get('/review/delete/{id}', [ReviewController::class, 'deleteReview'])->name('delete-review');


        Route::get('/user/list', [UserController::class, 'userList'])->name('user-list');
        Route::get('/user/delete/{id}', [UserController::class, 'deleteUser'])->name('delete-user');


        Route::get('/contact-us/list', [ContactController::class, 'contactList'])->name('contact-list');
        Route::get('/contact-us/delete/{id}', [ContactController::class, 'deleteContact'])->name('delete-contact');

    });
});