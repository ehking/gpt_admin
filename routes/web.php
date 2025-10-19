<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FormBuilderController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PanelUserController;
use App\Http\Controllers\Admin\ReportBuilderController;
use App\Http\Controllers\Auth\OAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/redirect', [OAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('/auth/callback', [OAuthController::class, 'callback'])->name('oauth.callback');
Route::post('/logout', [OAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

    Route::resource('panels', PanelController::class);

    Route::prefix('panels/{panel}')->middleware('panel')->group(function () {
        Route::resource('users', PanelUserController::class)->only(['index', 'store', 'destroy'])->names('panels.users');

        Route::resource('forms', FormBuilderController::class)->parameters(['forms' => 'form'])->except(['show', 'destroy'])->names('forms');

        Route::resource('reports', ReportBuilderController::class)->parameters(['reports' => 'report'])->except(['show', 'destroy'])->names('reports');
        Route::post('reports/{report}/preview', [ReportBuilderController::class, 'preview'])->name('reports.preview');
    });
});
