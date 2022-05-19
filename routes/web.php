<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PermissionRoleController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\RoleUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\SiteController;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->middleware('auth')->group(function () {


    //routes role x user
    Route::get('users/{id}/role/{idPermission}/detach', [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach');
    Route::post('users/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attach');
    Route::any('users/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
    Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('users.roles');
    Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users');


    //routes role x permission
    Route::get('roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionProfile'])->name('roles.permission.detach');
    Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsProfile'])->name('roles.permissions.attach');
    Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
    Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
    Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permission.roles');

    //routes tenants 
    Route::any('roles/search', [RolesController::class, 'search'])->name('roles.search');
    Route::resource('roles', RolesController::class);

    //routes tenants 
    Route::any('tenants/search', [TableController::class, 'search'])->name('tenants.search');
    Route::resource('tenants', TenantController::class);

    //routes tables 
    Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
    Route::resource('tables', TableController::class);

    //routes products x categories
    Route::get('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach');
    Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
    Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
    Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
    Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');

    //routes categories 
    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('products', ProductController::class);

    //routes categories 
    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('categories', CategoryController::class);

    //routes users 
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);

    //routes plan x profiles
    Route::get('plans/{id}/profile/{idProfile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
    Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
    Route::get('/profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');


    //routes permission x profile
    Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permission.profiles');

    //routes permission
    Route::resource('/permissions', PermissionController::class);
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');

    //routes Profile 
    Route::resource('/profiles', ProfileController::class);
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');

    //routes details plans
    Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
    Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
    Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
    Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');

    //routes plans
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
    Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
    Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');

    //route home dashboard
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});

//site
Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('site.home');

Auth::routes();
