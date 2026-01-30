<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ViewAdminController;
use App\Http\Controllers\ViewClientController;
use Illuminate\Support\Facades\Route;


Route::get('admin/login', [ViewAdminController::class, 'viewLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'actionLogin']);
Route::get('/admin/logout', [AdminAuthController::class, 'actionLogout']);

Route::group(['prefix' => 'admin', 'middleware' => 'adminMiddle'], function () {

    Route::prefix('/category')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewCategory']);
        Route::post('/data', [CategoryController::class, 'getDataCategory']);
        Route::get('/data-open', [CategoryController::class, 'getDataCategoryOpen']);
        Route::post('/create', [CategoryController::class, 'createCategory']);
        Route::post('/update', [CategoryController::class, 'updateCategory']);
        Route::post('/delete', [CategoryController::class, 'deleteCategory']);
        Route::post('/change', [CategoryController::class, 'changeStatusCategory']);
    });

    Route::prefix('/subcategory')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewSubCategory']);
        Route::post('/data', [SubcategoryController::class, 'getDataSubCategory']);
        Route::post('/data-post', [SubcategoryController::class, 'getDataSubCategoryPost']);
        Route::post('/create', [SubCategoryController::class, 'createSubCategory']);
        Route::post('/update', [SubCategoryController::class, 'updateSubCategory']);
        Route::post('/delete', [SubCategoryController::class, 'deleteSubCategory']);
        Route::post('/change', [SubCategoryController::class, 'changeStatusSubCategory']);
    });

    Route::prefix('/post')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewPost']);
        Route::get('/create', [ViewAdminController::class, 'viewAddPost']);
        Route::get('/update/{id}', [ViewAdminController::class, 'viewUpdatePost']);
        Route::post('/data', [PostController::class, 'getDataPost']);
        Route::post('/upload', [PostController::class, 'uploadPostImage']);
        Route::post('/create', [PostController::class, 'createPost']);
        Route::post('/update', [PostController::class, 'updatePost']);
        Route::post('/delete', [PostController::class, 'deletePost']);
    });

    Route::prefix('/admin')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewAdmin']);
        Route::post('/data', [AdminController::class, 'getDataAdmin']);
        Route::post('/create', [AdminController::class, 'createAdmin']);
        Route::post('/update', [AdminController::class, 'updateAdmin']);
        Route::post('/delete', [AdminController::class, 'deleteAdmin']);
        Route::post('/change', [AdminController::class, 'changeStatus']);
        Route::post('/upload', [AdminController::class, 'uploadAvatar']);
    });

    Route::prefix('/settings')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewSettings']);
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewProfile']);
        Route::post('/update', [AdminController::class, 'updateProfile']);
    });

    Route::prefix('/message')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewMessage']);
        Route::get('/user', [MessageController::class, 'userAdmin']);
        Route::post('/send', [MessageController::class, 'sendMessage']);
    });

    // conversation: đoạn hội thoại
    Route::prefix('/conversation')->group(function () {
        Route::post('/data', [MessageController::class, 'getDataConversation']);
    });
});

Route::get('/', [HomeController::class, 'viewHome']);
Route::get('/user/login', [ViewClientController::class, 'viewLogin']);
Route::get('/user/register', [ViewClientController::class, 'viewRegister']);
Route::get('/post/{slug}/{id}', [HomeController::class, 'viewPostDetail']);

Route::prefix('/home')->group(function () {
    Route::prefix('/category')->group(function () {
        Route::get('/{slug}', [HomeController::class, 'categoryDetail']);
    });
});

// Lấy 50 tin gần nhất (test)
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

// Lấy cuộc hội thoại giữa 2 user
Route::get('/messages/{from}/{to}', [MessageController::class, 'between'])->name('messages.between');

// Gửi tin nhắn
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// Đánh dấu đã đọc
Route::patch('/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('messages.read');

// Đánh dấu đã đọc theo cặp user
Route::patch('/messages/read-between/{from}/{to}', [MessageController::class, 'markBetweenAsRead'])->name('messages.readBetween');
