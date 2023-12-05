<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\TechnologyController;
use App\Http\Controllers\admin\TypeController;



Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('projects', ProjectController::class);
        Route::resource('technologies', TechnologyController::class);
        Route::resource('types', TypeController::class);

        Route::get('type-projects', [TypeController::class, 'typeProject'])->name('type-projects');
        Route::get('project-technology/{technology}', [TechnologyController::class, 'projectsTechnologies'])->name('project-technology');
        Route::get('order-by/{direction}/{column}', [ProjectController::class, 'orderBy'])->name('order-by');
        Route::get('search', [ProjectController::class, 'search'])->name('search');
        Route::get('noTechnologies', [ProjectController::class, 'noTechnologies'])->name('no-Technologies');

    });


require __DIR__.'/auth.php';
