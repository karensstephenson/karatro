<?php

use App\Http\Controllers\ProfileController;
use App\Models\Card;
use App\Models\Game;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::post('/game', function () {
    // scaffold new game instance
    $game = new Game(['uuid' => Str::uuid()->toString()]);
    $game->save();

    return redirect()->route('game', ['gameUuid' => $game->uuid]);
})->name('game.create');

Route::get('/game/{gameUuid}', function ($gameUuid) {

    $game = Game::where('uuid', $gameUuid)->first();

    return Inertia::render('Game', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cardList' => Card::all(),
        'game' => $game,
        'gameUuid' => $gameUuid,
        'cash' => $game->cash,
        'totalPoints' => $game->total_points,
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

require __DIR__.'/auth.php';
