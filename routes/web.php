<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\http\Controllers\HomeController::class, "home"]);
Route::get('/quienes-somos', [\App\http\Controllers\AboutController::class, "about"]);

