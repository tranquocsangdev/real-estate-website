<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ViewAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Admin.Layout.master');
});

Route::prefix('/admin')->group(function () {

    Route::prefix('/category')->group(function () {
        Route::get('/', [ViewAdminController::class, 'viewCategory']);
        Route::post('/data', [CategoryController::class, 'getDataCategory']);
        Route::post('/data-open', [CategoryController::class, 'getDataCategoryOpen']);
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
});
