<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('dashboard', [Controller::class, 'dashboard']);


//CATEGORIES
Route::get('categoriesadmin', [CategoryController::class, 'index']);
Route::get('addcategory', [CategoryController::class, 'create']);
Route::post('addcategory', [CategoryController::class, 'store']);
Route::get('editcategory/{category}', [CategoryController::class, 'edit']);
Route::post('editcategory/{category}', [CategoryController::class, 'update']);
Route::delete('deletecategory/{category}', [CategoryController::class, 'destroy']);

//SUBCATEGORIES
Route::get('subcategoriesadmin', [SubCategoryController::class, 'index']);
Route::get('addsubcategory', [SubCategoryController::class, 'create']);
Route::post('addsubcategory', [SubCategoryController::class, 'store']);
Route::get('editsubcategory/{subCategory}', [SubCategoryController::class, 'edit']);
Route::post('editsubcategory/{subCategory}', [SubCategoryController::class, 'update']);
Route::delete('deletesubcategory/{subCategory}', [SubCategoryController::class, 'destroy']);
