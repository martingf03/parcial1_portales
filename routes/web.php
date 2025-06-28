<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, "home"])->name("home");

Route::get('/quienes-somos', [\App\Http\Controllers\AboutController::class, "about"])->name("about");

Route::get('/servicios', [\App\Http\Controllers\ServicesController::class, "services"])->name("services");

Route::get('/blog/index', [\App\Http\Controllers\PostsController::class, "index"])->name("blog.index");

Route::get('/blog/{id}', [\App\Http\Controllers\PostsController::class, "view"])->name("blog.view")->whereNumber("id");

Route::get('/blog/publicar', [\App\Http\Controllers\PostsController::class, "create"])->name("blog.create")->middleware('auth');

Route::post('/blog/publicar', [\App\Http\Controllers\PostsController::class, "store"])->name("blog.store")->middleware('auth');

Route::delete('/blog/{id}/eliminar', [\App\Http\Controllers\PostsController::class, "destroy"])->name("blog.destroy")->whereNumber("id")->middleware('auth');

Route::get('/blog/{id}/eliminar', [\App\Http\Controllers\PostsController::class, "delete"])->name("blog.delete")->whereNumber("id")->middleware('auth');

Route::get('/blog/editar/{id}', [\App\Http\Controllers\PostsController::class, "edit"])->name("blog.edit")->whereNumber("id")->middleware('auth');

Route::put('/blog/editar/{id}', [\App\Http\Controllers\PostsController::class, "update"])->name("blog.update")->whereNumber("update")->middleware('auth');


Route::get('/iniciar-sesion', [\App\Http\Controllers\AuthController::class, "login"])->name("auth.login");

Route::post('/iniciar-sesion', [\App\Http\Controllers\AuthController::class, "authenticate"])->name("auth.authenticate");

Route::post('/cerrar-sesion', [\App\Http\Controllers\AuthController::class, "logout"])->name("auth.logout");

Route::get(
    '/registro',
    [\App\Http\Controllers\AuthController::class, 'register']
)->name('auth.register');

Route::post(
    '/registro',
    [\App\Http\Controllers\AuthController::class, 'store']
)->name('auth.store');

Route::get(
    '/ordenes/crear',
    [\App\Http\Controllers\OrderController::class, 'create']
)->name('orders.create')->middleware('auth');

Route::post(
    '/ordenes',
    [\App\Http\Controllers\OrderController::class, 'store']
)->name('orders.store')->middleware('auth');

Route::get('/ordenes/{id}', [\App\Http\Controllers\OrderController::class, 'show'])
    ->name('orders.show')
    ->middleware('auth');

Route::get('/cliente', [\App\Http\Controllers\ClientController::class, 'user'])
    ->name('client.profile')
    ->middleware('auth');

Route::get('/clientes/list', [\App\Http\Controllers\ClientController::class, 'list'])
    ->name('clients.list')
    ->middleware('auth');
