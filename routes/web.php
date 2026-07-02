<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\AddRecordController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// ── Auth ──────────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Protected routes (session auth) ───────────────────────────────────
Route::middleware('auth.session')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Records (view)
    Route::prefix('records')->name('records.')->group(function () {
        Route::get('/history',     [RecordsController::class, 'history'])->name('history');
        Route::get('/population',  [RecordsController::class, 'population'])->name('population');
        Route::get('/survival',    [RecordsController::class, 'survival'])->name('survival');
        Route::get('/development', [RecordsController::class, 'development'])->name('development');
        Route::get('/protection',  [RecordsController::class, 'protection'])->name('protection');
        Route::get('/disability',  [RecordsController::class, 'disability'])->name('disability');
        Route::get('/ip',          [RecordsController::class, 'ip'])->name('ip');
    });

    // Exports
    Route::get('/exports/{dataset}/{format}', [ExportController::class, 'download'])
        ->whereIn('dataset', ['population', 'survival', 'development', 'protection', 'disability', 'ip'])
        ->whereIn('format', ['pdf', 'excel'])
        ->name('exports.download');

    // Add / Update / Delete Records
    Route::prefix('add')->name('add.')->group(function () {
        Route::get('/', [AddRecordController::class, 'index'])->name('index');

        // Population
        Route::post('/population',            [AddRecordController::class, 'storePopulation'])->name('population');
        Route::post('/population/{id}',       [AddRecordController::class, 'updatePopulation'])->name('population.update');
        Route::delete('/population/{id}',     [AddRecordController::class, 'destroyPopulation'])->name('population.destroy');

        // Survival
        Route::post('/survival',              [AddRecordController::class, 'storeSurvival'])->name('survival');
        Route::post('/survival/{id}',         [AddRecordController::class, 'updateSurvival'])->name('survival.update');
        Route::delete('/survival/{id}',       [AddRecordController::class, 'destroySurvival'])->name('survival.destroy');

        // Development
        Route::post('/development',           [AddRecordController::class, 'storeDevelopment'])->name('development');
        Route::post('/development/{id}',      [AddRecordController::class, 'updateDevelopment'])->name('development.update');
        Route::delete('/development/{id}',    [AddRecordController::class, 'destroyDevelopment'])->name('development.destroy');

        // Protection
        Route::post('/protection',            [AddRecordController::class, 'storeProtection'])->name('protection');
        Route::post('/protection/{id}',       [AddRecordController::class, 'updateProtection'])->name('protection.update');
        Route::delete('/protection/{id}',     [AddRecordController::class, 'destroyProtection'])->name('protection.destroy');

        // Disability
        Route::post('/disability',            [AddRecordController::class, 'storeDisability'])->name('disability');
        Route::post('/disability/{id}',       [AddRecordController::class, 'updateDisability'])->name('disability.update');
        Route::delete('/disability/{id}',     [AddRecordController::class, 'destroyDisability'])->name('disability.destroy');

        // IP Children
        Route::post('/ip',                    [AddRecordController::class, 'storeIP'])->name('ip');
        Route::post('/ip/{id}',               [AddRecordController::class, 'updateIP'])->name('ip.update');
        Route::delete('/ip/{id}',             [AddRecordController::class, 'destroyIP'])->name('ip.destroy');
    });

    // Profile
    Route::get('/profile',                   [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile',                  [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password',         [ProfileController::class, 'changePassword'])->name('profile.password');

    // User Management
    Route::get('/users',                     [UserController::class, 'index'])->name('users.index');
    Route::post('/users',                    [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}',             [UserController::class, 'destroy'])->name('users.destroy');

});
