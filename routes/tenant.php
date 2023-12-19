<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    "auth",
    InitializeTenancyBySubDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view("main");
    })->name("home");

    Route::fallback(fn()=>redirect("/"));

});
Route::middleware([
    'web',
    InitializeTenancyBySubDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
 Auth::routes([
     "register"=>false
 ]);
});
