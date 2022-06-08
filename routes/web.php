<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController\UserController;

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
    return view('index');
});

Route::get('/all_users',[App\Http\Controllers\AdminController\UserController::class,'index']);
Route::delete('users/{id}', 'App\Http\Controllers\AdminController\UserController@destroy')->name('users.destroy');

Route::get('/approve/{id}', [App\Http\Controllers\AdminController\UserController::class, 'approve'])->name('user.approve');
