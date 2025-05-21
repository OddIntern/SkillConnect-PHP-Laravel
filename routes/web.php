<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\OpportunityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Publicly accessible pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/discover', [DiscoveryController::class, 'index'])->name('discover.index');

// Routes that require authentication
Route::middleware(['auth', 'verified'])->group(function () { // 'verified' is good if you use email verification
    Route::get('/dashboard', function () { // Simple dashboard route if not using PageController for it
        return view('dashboard');
    })->name('dashboard'); // Breeze creates dashboard.blade.php

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/my-projects', [ProjectController::class, 'index'])->name('projects.index');

    Route::get('/new-post', [OpportunityController::class, 'create'])->name('opportunities.create');
    Route::post('/new-post', [OpportunityController::class, 'store'])->name('opportunities.store');

    // Profile routes from Breeze are usually handled in auth.php or by ProfileController directly
    // If ProfileController exists and has edit/update/destroy methods:
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// This includes all authentication routes like login, register, logout, password reset, etc.
// It's added by Breeze.
require __DIR__.'/auth.php';