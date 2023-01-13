<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FilterSubcategoryController;
use App\Http\Controllers\ProductFilterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;

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

//Route::get('/', function () {
//    return view('start');
//});
Route::get('/', [CategoryController::class, 'mainPage']);

Route::group(['middleware'=>['auth']], function () {

    Route::get('dashboard', [Controller::class, 'dashboard']);

    //ADMINPANEL
    Route::middleware('manager')->group(function() {

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

            //PRODUCTFILTERS
            Route::get('productfiltersadmin', [ProductFilterController::class, 'index']);
            Route::get('addproductfilter', [ProductFilterController::class, 'create']);
            Route::post('addproductfilter', [ProductFilterController::class, 'store']);
            Route::delete('deleteproductfilter/{productFilter}', [ProductFilterController::class, 'destroy']);

            //PRODUCTS
            Route::get('productsadmin', [ProductController::class, 'index']);
            Route::get('addproduct', [ProductController::class, 'create']);
            Route::post('addproduct', [ProductController::class, 'store']);
            Route::get('editproduct/{product}', [ProductController::class, 'edit']);
            Route::post('editproduct/{product}', [ProductController::class, 'update']);
            Route::delete('deleteproduct/{product}', [ProductController::class, 'destroy']);

            ////COMMENTS
            //Route::get('commentsadmin', [ProductController::class, 'index']);
            //Route::get('addcomment', [ProductController::class, 'create']);
            //Route::post('addcomment', [ProductController::class, 'store']);
            //Route::get('editcomment/{comment}', [ProductController::class, 'edit']);
            //Route::post('editcomment/{comment}', [ProductController::class, 'update']);
            //Route::delete('deletecomment/{comment}', [ProductController::class, 'destroy']);

    });

        Route::middleware('admin')->group(function() {

            //USERS
            Route::get('users', [UserController::class, 'index']);
            Route::get('adduser', [UserController::class, 'create']);
            Route::post('adduser', [UserController::class, 'store']);
            Route::get('edituser/{user}', [UserController::class, 'edit']);
            Route::post('edituser/{user}', [UserController::class, 'update']);
            Route::delete('deleteuser/{user}', [UserController::class, 'destroy']);

            //ROLES
            Route::get('roles', [RoleController::class, 'index']);
            Route::get('addrole', [RoleController::class, 'create']);
            Route::post('addrole', [RoleController::class, 'store']);
            Route::delete('deleterole/{role}', [RoleController::class, 'destroy']);

        });


    //MAIN
        Route::get('account/{user}', [UserController::class, 'edit']);

});


Route::get('catalog/{subCategory}', [ProductController::class, 'catalog']);

//Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('signup', [AuthController::class, 'signup']);

