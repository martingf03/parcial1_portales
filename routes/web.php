<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\http\Controllers\HomeController::class, "home"])->name("home");
Route::get('/quienes-somos', [\App\http\Controllers\AboutController::class, "about"])->name("about");
Route::get('/servicios', [\App\http\Controllers\ServicesController::class, "services"])->name("services");

