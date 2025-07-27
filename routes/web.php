<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ViewAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("Client.Layout.master");
});

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
        Route::post('/create', [SubCategoryController::class, 'createSubCategory']);
        Route::post('/update', [SubCategoryController::class, 'updateSubCategory']);
        Route::post('/delete', [SubCategoryController::class, 'deleteSubCategory']);
        Route::post('/change', [SubCategoryController::class, 'changeStatusSubCategory']);
    });

    // chưa viết xong
    Route::prefix('/post')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewPost']);
        Route::get('/create', [ViewAdminController::class, 'viewAddPost']);
        Route::post('/data', [PostController::class, 'getDataPost']);
        Route::post('/upload', [PostController::class, 'uploadPostImage']);
        Route::post('/create', [PostController::class, 'createPost']);
        Route::post('/update', [PostController::class, 'updatePost']);
        Route::post('/delete', [PostController::class, 'deletePost']);
    });
    // end chưa viết xong

    Route::prefix('/admin')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewAdmin']);
        Route::post('/data', [AdminController::class, 'getDataAdmin']);
        Route::post('/create', [AdminController::class, 'createAdmin']);
        Route::post('/update', [AdminController::class, 'updateAdmin']);
        Route::post('/delete', [AdminController::class, 'deleteAdmin']);
        Route::post('/change', [AdminController::class, 'changeStatus']);
        Route::post('/upload', [AdminController::class, 'uploadAvatar']);
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewProfile']);
        Route::post('/update', [AdminController::class, 'updateProfile']);
    });
});
