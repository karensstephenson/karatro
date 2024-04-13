<?php

use App\Models\Card;
use App\Models\Game;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cardList' => Card::all(),
    ]);
});

Route::post('/game', function () {
    // scaffold new game instance
    $game = new Game();
    $game->save();

    return redirect()->route('game', ['gameId' => $game->id]);
});

Route::get('/game/{gameId}', function ($gameId) {

    $game = Game::find($gameId);

    return Inertia::render('Game', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cardList' => Card::all(),
        'game' => $game,
        'gameId' => $gameId,
    ]);
})->name('game');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
