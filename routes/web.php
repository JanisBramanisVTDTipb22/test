<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;
// Routes/web.php

use App\Http\Controllers\MoodDetectionController;

// Show the Mood Detection app page
Route::get('/mood-detection', function () {
    return view('playlists.mood'); // Referencing the Blade view here
})->name('mood.detection');

// Show the "Choose Mood" page (the one with image upload) for mood detection
Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');

// Handle the mood detection via image upload (POST request)
Route::post('/mood-detection', [MoodDetectionController::class, 'detectMood'])->name('mood.detect');




Route::get('/playlists/history', [PlaylistController::class, 'history'])->name('playlists.history');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/playlists/history', [PlaylistController::class, 'history'])->name('playlists.history');
});

require __DIR__.'/auth.php';
