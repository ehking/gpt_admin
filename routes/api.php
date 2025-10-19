<?php

use App\Http\Controllers\Admin\FormBuilderController;
use App\Http\Controllers\Admin\ReportBuilderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/panels/{panel}/forms', [FormBuilderController::class, 'index']);
    Route::get('/panels/{panel}/reports', [ReportBuilderController::class, 'index']);
});
