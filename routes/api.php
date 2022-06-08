<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\UserProfileController;
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

Route::POST('/register',[UserController::class,'register']);

Route::POST('/login',[UserController::class,'login']);

Route::get('/logout',[UserController::class,'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/show',[UserController::class,'show']);
Route::post('/user/{id}',[UserController::class,'deleteUser']);

Route::get('/edit/{id}',[UserController::class,'edit']);

Route::post('/update/{id}',[UserController::class,'update']);


Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify');

Route::POST('/profile_create',[UserProfileController::class,'create']);

Route::get('/profile_get',[UserProfileController::class,'profileGet']);

