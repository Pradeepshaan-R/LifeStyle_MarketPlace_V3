<?php

use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TaskController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::resource('client', ClientController::class);
Route::resource('task', TaskController::class);