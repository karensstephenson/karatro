<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Game;
use Inertia\Inertia;
use App\Models\GameRound;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    $latestGame = Game::latest()->first();

    return Inertia::render('Welcome', [
        'gameStatus' => $latestGame->status,

    ]);
})->name("home");

Route::post('/game', function () {
    // scaffold new game instance
    $game = new Game(['uuid' => Str::uuid()->toString()]);
    $game->save();

    return redirect()->route('game', ['gameUuid' => $game->uuid]);
})->name('game.create');

Route::get('/game/{gameUuid}', function ($gameUuid) {

    $game = Game::where('uuid', $gameUuid)->first();
    $deckId = Game::where('uuid', $gameUuid)->firstOrFail()->deck_id;
    $deck = Deck::where('id', $deckId)->first();

    return Inertia::render('Game', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cardList' => Card::all(),
        'game' => $game,
        'gameUuid' => $gameUuid,
        'cash' => $game->cash,
        'roundPoints' => $game->round_points,
        'hands' => $deck->hands,
        'discards' => $deck->discards,
        'gameStatus' => $game->status,
    ]);
})->name('game');

Route::get('/game', function () {

    $latestGame = Game::latest()->first();
    return redirect()->route('resume', ['gameUuid' => $latestGame->uuid]);
})->name('game.resume');

Route::get('/resume/{gameUuid}', function ($latestGame) {

    $latestGame = Game::latest()->first();
    $deckId = Game::latest()->first()->deck_id;
    $deck = Deck::where('id', $deckId)->first();
    
    return Inertia::render('Game', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cardList' => Card::all(),
        'game' => $latestGame,
        'gameUuid' => $latestGame->uuid,
        'cash' => $latestGame->cash,
        'roundPoints' => $latestGame->round_points,
        'hands' => $deck->hands,
        'discards' => $deck->discards,
        'gameStatus' => $latestGame->status,
    ]);
})->name('resume');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
