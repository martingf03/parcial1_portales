<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\http\Controllers\HomeController::class, "home"])->name("home");

Route::get('/quienes-somos', [\App\http\Controllers\AboutController::class, "about"])->name("about");

Route::get('/servicios', [\App\http\Controllers\ServicesController::class, "services"])->name("services");

Route::get('/blog/index', [\App\http\Controllers\PostsController::class, "index"])->name("blog.index");

Route::get('/blog/{id}', [\App\http\Controllers\PostsController::class, "view"])->name("blog.view")->whereNumber("id");

Route::get('/blog/publicar', [\App\http\Controllers\PostsController::class, "create"])->name("blog.create");

Route::post('/blog/publicar', [\App\http\Controllers\PostsController::class, "store"])->name("blog.store");

Route::delete('/blog/{id}/eliminar', [\App\http\Controllers\PostsController::class, "destroy"])->name("blog.destroy")->whereNumber("id");

Route::get('/blog/{id}/eliminar', [\App\http\Controllers\PostsController::class, "delete"])->name("blog.delete")->whereNumber("id");
