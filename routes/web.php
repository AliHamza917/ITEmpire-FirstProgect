<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UpdateProfileImgController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserTableController;
use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware'=>['guest']] , function (){

    Route::get('/', function () {
        return view('SignIn');
    })->name('/');


    Route::get('signup',[ViewsController::class,'signUpView'])->name('signUpPage');
    Route::post('signup',[AuthController::class,'AuthSignUp'])->name('signup');
    Route::post('signin',[AuthController::class,'AuthSignIn'])->name('signin');

});





Route::group(['middleware'=>['auth']],function (){

    Route::group(['middleware'=>['AdminAccess']],function (){
        Route::get('update-role/{id}',[UserRoleController::class,'MakeManager'])->name('UpdateRole');

        Route::post('create-product-by-admin',[ManagerController::class,'addProductByAdmin'])->name('addProductByAdmin');
        Route::get('create-product-by-admin',[ViewsController::class,'createProductByAdminView'])->name('createProductByAdminView');
        Route::get('create-new-user-by-admin',[ViewsController::class,'createNewUserByAdminView'])->name('createNewUserByAdminView');
        Route::post('create-new-user-by-admin',[ManagerController::class,'addNewUserByAdmin'])->name('addNewUserByAdmin');


    });

    Route::group(['middleware'=>['ManagerAccess']],function (){
        Route::get('user-table',[UserTableController::class ,'UserTableData'])->name('UserTable')->middleware('ManagerAccess');

        Route::get('create-category',[ViewsController::class,'ProductCategoryView'])->name('createCategoryPage');
        Route::get('edit-category/{id}',[CategoryController::class ,'getCategory'])->name('GetCategory');
        Route::get('DelCategory/{id}',[CategoryController::class ,'delCategory'])->name('DelCategory');
        Route::post('UpdateCategory/{id}',[CategoryController::class ,'UpdateCategory'])->name('UpdateCategory');

        Route::get('create-product-by-manager',[ViewsController::class,'createProductByManager'])->name('create-product-by-manager');
        Route::post('create-product-by-manager',[ManagerController::class,'addProductByManager'])->name('create-product-by-manager');



        Route::post('create-category',[CategoryController::class,'createCategory'])->name('create-category');
        Route::post('create-new-user',[ManagerController::class,'addNewUser'])->name('create-new-user');

        Route::get('create-new-user' , [ViewsController::class,'createNewUser'])->name('createNewUser');
        Route::get('create-new-manager' , [ViewsController::class,'createNewManagerView'])->name('createNewManagerView');
        Route::post('create-new-manager' , [ManagerController::class,'createNewManager'])->name('createNewManager');




    });



    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('homePage',[ProductsController::class ,'ProductsTable'])->name('homePage');

    Route::get('UpdateStatus/{id}',[UserTableController::class ,'UpdateStatus'])->name('UpdateStatus');

    Route::get('create-product',[ViewsController::class,'createProductView'])->name('createProductPage');
    Route::get('products-table',[ProductsController::class ,'ProductsTable'])->name('ProductsTable');
    Route::get('edit-product/{id}',[ProductsController::class ,'getProducts'])->name('GetProducts');
    Route::get('update-profile',[ViewsController::class ,'UpdateProfileView'])->name('UpdateProfileView');
    Route::post('update-profile/{id}',[UpdateProfileImgController::class ,'UpdateProfileImg'])->name('UpdateProfile');
    Route::get('del-product/{id}',[ProductsController::class ,'delProducts'])->name('DelProducts');
    Route::post('update-product/{id}',[ProductsController::class ,'UpdateProducts'])->name('UpdateProduct');
    Route::post('create-product',[ProductsController::class,'CreateProduct'])->name('create-product');

    Route::get('category-table',[CategoryController::class ,'categoryTableData'])->name('CategoryTable');






});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
