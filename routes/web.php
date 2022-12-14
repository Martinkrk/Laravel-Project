<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FilterSubcategoryController;
use App\Http\Controllers\ProductFilterController;

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

//FILTERS
Route::get('filtersadmin', [FilterController::class, 'index']);
Route::get('addfilter', [FilterController::class, 'create']);
Route::post('addfilter', [FilterController::class, 'store']);
Route::get('editfilter/{filter}', [FilterController::class, 'edit']);
Route::post('editfilter/{filter}', [FilterController::class, 'update']);
Route::delete('deletefilter/{filter}', [FilterController::class, 'destroy']);

//FILTERSSUBCATEGORIES
Route::get('filtersubcategoriesadmin', [FilterSubcategoryController::class, 'index']);
Route::get('addfiltersubcategory', [FilterSubcategoryController::class, 'create']);
Route::post('addfilterubcategory', [FilterSubcategoryController::class, 'store']);
Route::delete('deletefiltersubcategory/{filterSubcategory}', [FilterSubcategoryController::class, 'destroy']);

//PRODUCTFILTERS
Route::get('productfiltersadmin', [ProductFilterController::class, 'index']);
Route::get('addproductfilter', [ProductFilterController::class, 'create']);
Route::post('addproductfilter', [ProductFilterController::class, 'store']);
Route::delete('deleteproductfilter/{productFilter}', [ProductFilterController::class, 'destroy']);
