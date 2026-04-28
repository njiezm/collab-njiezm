<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Middleware\AdminAuth;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Route::post('/admin/projects/create', [AdminController::class, 'createProject'])->name('admin.project.create');

// ROUTE LOGIN (Accessible à tous)
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.process');

// GROUPE DES ROUTES ADMIN PROTÉGÉS
Route::middleware([AdminAuth::class])->prefix('admin')->group(function () {
    // Ton Dashboard existant
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Création Projet
    Route::post('/projects/create', [AdminController::class, 'createProject'])->name('admin.project.create');

    // Configuration
    Route::get('/project/{id}/config', [AdminController::class, 'configProject'])->name('admin.project.config');
    Route::post('/project/{id}/config', [AdminController::class, 'saveConfig'])->name('admin.project.save.config');

    // Voir Données
    Route::get('/project/{id}/view-data', [AdminController::class, 'viewProjectData'])->name('admin.project.view.data');

});

// Logout
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/onboarding/{token}', [OnboardingController::class, 'showForm'])->name('client.onboarding');
Route::post('/onboarding/{token}', [OnboardingController::class, 'submitForm'])->name('client.onboarding.submit');

// Route::get('/admin/project/{id}/config', [AdminController::class, 'configProject'])->name('admin.project.config');
// Route::post('/admin/project/{id}/config', [AdminController::class, 'saveConfig'])->name('admin.project.save.config');
// Route::get('/admin/project/{id}/view-data', [AdminController::class, 'viewProjectData'])->name('admin.project.view.data');

// Route pour fichiers projets (Accessible seulement si connecté/admin normalement)
Route::get('/storage/projects/{path}', [FileController::class, 'getProjectFile'])
    ->where('path', '.*') // Accepte tout le chemin (ex: 1/images/logo.jpg)
    ->name('projects.file.get');
