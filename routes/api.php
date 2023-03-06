<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('category', 'CategoryController');
Route::apiResource('product', 'ProductController');
Route::apiResource('basket', 'BasketController');
Route::apiResource('order', 'OrderController');

Route::get('journal', 'JournalController@index');
Route::get('mailsend', 'MailSenderController@index');
Route::get('orderId', 'OrderController@getId');
Route::get('dops', 'DopsCategorysController@getDops');
