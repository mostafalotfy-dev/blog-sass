<?php

use App\Http\Controllers\Home\HomeController;
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


Route::middleware(["guest"])->group(function (){
    Route::post("/", HomeController::class)->name("create_home");
    Route::get("/",[HomeController::class,"showHomeForm"]);
Auth::routes();
    Route::fallback(fn()=>redirect("/"));

});

