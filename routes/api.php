<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addcart', [FrontController::class,'addCart']);
Route::post('/updatecart', [FrontController::class,'updateCart']);
Route::post('/subscribe', [FrontController::class,'subscribe']);
Route::post('/addclick', [FrontController::class,'addclick']);
