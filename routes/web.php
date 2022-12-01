<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/',function(){
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Custom Routes
|--------------------------------------------------------------------------
*/
    Route::get('/master',function(){
        return view('customeAuth.master');
    });

    Route::get('/newLogin', function () {
        return view('customeAuth.newLogin');
    });

    Route::get('/newRegister', function () {
        return view('customeAuth.newRegister');
    });

    Route::get('/newForget', function () {
        return view('customeAuth.newForget');
    });

    /*--------------------BACKEND-----------------------------------------------*/

    Route::get('/',function(){
        return view('frontend.blog');
    });

    Route::group(['middleware' => 'auth'], function(){

        Route::get('/dashboard',function(){
            return view('backend.dashboard');
        });

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/addCategory', [CategoryController::class, 'create']);
        Route::post('/getAllCategories',[CategoryController::class, 'getAllCategories']);

    });


    Route::get('/about', function () {
        return view('frontend.about');
    });

    Route::get('/contact', function () {
        return view('frontend.contact');
    });

    Route::get('/details', function () {
        return view('frontend.blogdetail');
    });