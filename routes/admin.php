<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group([
    'namespace' => 'Admin',
    'prefix'=>'dashboard'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::group([
    'namespace' => 'Admin',
    'prefix'=>'dashboard/users',
    'midleware'=>'auth:admin'], function () {

    Route::get('/all', [UsersController::class, 'index'])->name('show.all.users');
    Route::get('/create', [UsersController::class, 'create'])->name('create.new.user');
    Route::get('/edit', [UsersController::class, 'edit'])->name('edit.user.info');
    Route::get('/destroy/{id}', [UsersController::class, 'destroy'])->name('destroy.user');
    Route::get('/view/{id}', [UsersController::class, 'view'])->name('view.user.info');
    Route::get('/change/status/{id}', [UsersController::class, 'status'])->name('change.user.status');
    Route::post('/store', [UsersController::class, 'store'])->name('store.user.info');
    Route::post('/update', [UsersController::class, 'update'])->name('update.user.info');
});
Route::group([
    'namespace' => 'Admin',
    'prefix'=>'dashboard/roles',
    'midleware'=>'auth:admin'], function () {

    Route::get('/all', [RolesController::class, 'index'])->name('show.all.roles');
    Route::get('/create', [RolesController::class, 'create'])->name('create.new.role');
    Route::get('/edit/{id}', [RolesController::class, 'edit'])->name('edit.role.info');
    Route::get('/destroy/{id}', [RolesController::class, 'destroy'])->name('destroy.role');
    Route::get('/view/{id}', [RolesController::class, 'view'])->name('view.role.info');
    Route::get('/change/status/{id}', [RolesController::class, 'status'])->name('change.role.status');
    Route::post('/store', [RolesController::class, 'store'])->name('store.role.info');
    Route::post('/update', [RolesController::class, 'update'])->name('update.role.info');
});
Route::group([
    'namespace' => 'Admin',
    'prefix'=>'dashboard/permissions',
    'midleware'=>'auth:admin'], function () {

    Route::get('/all', [PermissionsController::class, 'index'])->name('show.all.permissions');
    Route::get('/create', [PermissionsController::class, 'create'])->name('create.new.permission');
    Route::get('/edit', [PermissionsController::class, 'edit'])->name('edit.permission.info');
    Route::get('/destroy/{id}', [PermissionsController::class, 'destroy'])->name('destroy.permission');
    Route::get('/view/{id}', [PermissionsController::class, 'view'])->name('view.permission.info');
    Route::get('/change/status/{id}', [PermissionsController::class, 'status'])->name('change.permission.status');
    Route::post('/store', [PermissionsController::class, 'store'])->name('store.permission.info');
    Route::post('/update', [PermissionsController::class, 'update'])->name('update.permission.info');
});
