<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AssignedTextController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
   Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // ✅ correct
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Client Management
        Route::resource('clients', ClientController::class);

        Route::resource('assigned-texts', AssignedTextController::class);
});

Route::middleware(['auth','client'])->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

         Route::get('/assigned-texts/{assignedText}', [\App\Http\Controllers\Client\AssignedTextController::class, 'show'])
        ->name('assigned-texts.show');
    });



require __DIR__.'/auth.php';
