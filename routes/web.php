<?php

use App\Http\Controllers\AdminPage\MainPageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MailSendController;
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


Route::get('logout', [AuthController::class, 'logout']);
Route::get('mailsend', [MailSendController::class, 'index']);
Route::get('login_page', [AuthController::class, 'index'])->name('login');
Route::post('auth', [AuthController::class, 'login'])->name('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', [MainPageController::class, 'index'])->name('admin');
    Route::get('/admin/category/{id}', 'AdminPages\AdminCategorysController@getCategorys');
    Route::get('/admin/products/{id}', 'AdminPages\AdminProductsController@getProducts');

    Route::post('/category', 'CategoryController@store');
    Route::post('/deleteCategory', 'CategoryController@delete');
    Route::put('/category', 'CategoryController@update');

    Route::post('/product', 'ProductController@store');
    Route::post('/productDelete', 'ProductController@delete');
    Route::put('/product', 'ProductController@update');

    Route::post('/dops', 'DopsCategorysController@store');
    Route::post('/dopProductDelete', 'DopsCategorysController@delete');
});
