<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserIsExists;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::get('/app/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/app/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/app/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/app/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/{user}', AuthorController::class)->middleware([UserIsExists::class])->name('profile_author');

require __DIR__ . '/auth.php';
