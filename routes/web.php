<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProductsCategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProvidersController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UnitsController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\StoresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

    Route::get('/all',                              [RolesController::class, 'index'])->name('show.all.roles');
    Route::get('/create',                           [RolesController::class, 'create'])->name('create.new.role');
    Route::post('/store',                           [RolesController::class, 'store'])->name('store.role.info');
    Route::post('/update',                          [RolesController::class, 'update'])->name('update.role.info');
    Route::get('/view/{id}',                        [RolesController::class, 'view'])->name('view.role.info');
    Route::get('/edit/{id}',                        [RolesController::class, 'edit'])->name('edit.role.info');
    Route::get('/destroy/{id}',                     [RolesController::class, 'destroy'])->name('destroy.role');
    Route::get('/change/status/{id}',               [RolesController::class, 'status'])->name('change.role.status');
    Route::post('/assign/role/to/admin',            [RolesController::class, 'assignToAdmin'])->name('assign.role.to.admin');
    Route::get('/get/permissions/{id}',             [RolesController::class, 'getPermissions'])->name('get.permissions');
    Route::post('/assign/permissions/to/role',      [RolesController::class, 'assignPermissions'])->name('assign.permissions.to.role');
    Route::get('/get/admins/to/give/role/{id}',     [RolesController::class, 'getAdmins'])->name('get.admins.to.assign.role');
});
Route::group([
    'namespace' => 'Admin',
    'prefix'=>'dashboard/permissions',
    'midleware'=>'auth:admin'], function () {

    Route::get('/all', [PermissionsController::class, 'index'])->name('show.all.permissions');
    Route::get('/create', [PermissionsController::class, 'create'])->name('create.new.permission');
    Route::get('/edit/{id}', [PermissionsController::class, 'edit'])->name('edit.permission.info');
    Route::get('/destroy/{id}', [PermissionsController::class, 'destroy'])->name('destroy.permission');
    Route::get('/view/{id}', [PermissionsController::class, 'view'])->name('view.permission.info');
    Route::get('/change/status/{id}', [PermissionsController::class, 'status'])->name('change.permission.status');
    Route::post('/store', [PermissionsController::class, 'store'])->name('store.permission.info');
    Route::post('/update', [PermissionsController::class, 'update'])->name('update.permission.info');
});

Route::group([
    'namespace' => 'Dashboard',
    'prefix'=>'dashboard/units',
    'midleware'=>'auth:admin'], function () {
  
    Route::get('/all', [UnitsController::class, 'index'])->name('show.all.units');
    Route::get('/create', [UnitsController::class, 'create'])->name('create.new.unit');
    Route::get('/edit/{id}', [UnitsController::class, 'edit'])->name('edit.unit.info');
    Route::get('/destroy/{id}', [UnitsController::class, 'destroy'])->name('destroy.unit');
    Route::get('/view/{id}', [UnitsController::class, 'view'])->name('view.unit.info');
    Route::post('/store', [UnitsController::class, 'store'])->name('store.unit.info');
    Route::post('/update', [UnitsController::class, 'update'])->name('update.unit.info');
  });
  
Route::group([
    'namespace' => 'Dashboard',
    'prefix'=>'dashboard/providers',
    'midleware'=>'auth:admin'], function () {
  
    Route::get('/all', [ProvidersController::class, 'index'])->name('show.all.providers');
    Route::get('/create', [ProvidersController::class, 'create'])->name('create.new.provider');
    Route::get('/edit/{id}', [ProvidersController::class, 'edit'])->name('edit.provider.info');
    Route::get('/destroy/{id}', [ProvidersController::class, 'destroy'])->name('destroy.provider');
    Route::get('/view/{id}', [ProvidersController::class, 'view'])->name('view.provider.info');
    Route::post('/store', [ProvidersController::class, 'store'])->name('store.provider.info');
    Route::post('/update', [ProvidersController::class, 'update'])->name('update.provider.info');
  });

  Route::group([
    'namespace' => 'Dashboard',
    'prefix'=>'dashboard/categories',
    'midleware'=>'auth:admin'], function () {
  
    Route::get('/all', [ProductsCategoriesController::class, 'index'])->name('show.all.categories');
    Route::get('/create', [ProductsCategoriesController::class, 'create'])->name('create.new.Category');
    Route::get('/edit/{id}', [ProductsCategoriesController::class, 'edit'])->name('edit.category.info');
    Route::get('/destroy/{id}', [ProductsCategoriesController::class, 'destroy'])->name('destroy.category');
    Route::get('/view/{id}', [ProductsCategoriesController::class, 'view'])->name('view.category.info');
    Route::post('/store', [ProductsCategoriesController::class, 'store'])->name('store.category.info');
    Route::post('/update', [ProductsCategoriesController::class, 'update'])->name('update.category.info');
  });
  
  Route::group([
    'namespace' => 'Dashboard',
    'prefix'=>'dashboard/companies',
    'midleware'=>'auth:admin'], function () {
  
    Route::get('/all', [companiesController::class, 'index'])->name('show.all.companies');
    Route::get('/create', [companiesController::class, 'create'])->name('create.new.company');
    Route::get('/edit/{id}', [companiesController::class, 'edit'])->name('edit.company.info');
    Route::get('/destroy/{id}', [companiesController::class, 'destroy'])->name('destroy.company');
    Route::get('/view/{id}', [companiesController::class, 'view'])->name('view.company.info');
    Route::post('/store', [companiesController::class, 'store'])->name('store.company.info');
    Route::post('/update', [companiesController::class, 'update'])->name('update.company.info');
  });
  
  Route::group([
    'namespace' => 'Dashboard',
    'prefix'=>'dashboard/brands',
    'midleware'=>'auth:admin'], function () {
  
    Route::get('/all', [brandsController::class, 'index'])->name('show.all.brands');
    Route::get('/create', [brandsController::class, 'create'])->name('create.new.brand');
    Route::get('/edit/{id}', [brandsController::class, 'edit'])->name('edit.brand.info');
    Route::get('/destroy/{id}', [brandsController::class, 'destroy'])->name('destroy.brand');
    Route::get('/view/{id}', [brandsController::class, 'view'])->name('view.brand.info');
    Route::post('/store', [brandsController::class, 'store'])->name('store.brand.info');
    Route::post('/update', [brandsController::class, 'update'])->name('update.brand.info');
  });

  Route::group([
    'namespace' => 'Dashboard',
    'prefix'=>'dashboard/products',
    'midleware'=>'auth:admin'], function () {
  
    Route::get('/all', [ProductsController::class, 'index'])->name('show.all.products');
    Route::get('/create', [ProductsController::class, 'create'])->name('create.new.product');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit.product.info');
    Route::get('/destroy/{id}', [ProductsController::class, 'destroy'])->name('destroy.product');
    Route::get('/view/{id}', [ProductsController::class, 'view'])->name('view.product.info');
    Route::post('/store', [ProductsController::class, 'store'])->name('store.product.info');
    Route::post('/update', [ProductsController::class, 'update'])->name('update.product.info');
  });
  


require __DIR__.'/auth.php';
