<?php

use App\Http\Controllers\Backend\AssignmentController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\TenantController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::resource('client', ClientController::class);
Route::resource('assignment', AssignmentController::class);
Route::resource('task', TaskController::class);
Route::resource('document', DocumentController::class);
Route::resource('tenant', TenantController::class);