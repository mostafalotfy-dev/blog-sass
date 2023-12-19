<?php

use App\Http\Controllers\Rest\LoginController;
use \App\Http\Controllers\Rest\PostController;
use App\Http\Controllers\Rest\RegisterController;
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
Route::post("profile",[\App\Http\Controllers\Rest\UserController::class,"update"])->name("profile.update");