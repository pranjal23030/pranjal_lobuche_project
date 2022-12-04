<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

    //Not so important
Route::get('/', [\App\Http\Controllers\PagesController::class,'home']);
Route::get('/profile', [\App\Http\Controllers\PagesController::class,'profile']);
Route::get('/profile',[\App\Http\Controllers\PagesController::class,'profile']);

//Crud Starts here
Route::get('/create', [\App\Http\Controllers\PagesController::class,'create']);
Route::post('/create',[\App\Http\Controllers\PagesController::class,'store']);
Route::get('/list', [\App\Http\Controllers\PagesController::class,'list']);
Route::get('/edit/{id}', [\App\Http\Controllers\PagesController::class,'edit']);
Route::post('edit', [\App\Http\Controllers\PagesController::class,'update']);
Route::get('/delete/{id}', [\App\Http\Controllers\PagesController::class,'delete']);

//Project -Employee Management System
Route::get('admin',[AdminController::class, 'index']);
Route::get('/admin/login',[AdminController::class, 'login']);
Route::post('/login',[AdminController::class, 'loginForm']);

Route::get('/admin/register',[AdminController::class, 'register']);
Route::post('/admin/create',[AdminController::class,'store']);

Route::get('logout',[AdminController::class, 'logout']);
