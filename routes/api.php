<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/game/{gameUuid}/save', [GameController::class, 'saveCards']);

Route::get('/game/{gameUuid}/load', [GameController::class, 'loadCards']);

Route::put('/game/{gameUuid}/new-round', [GameController::class, 'newRound']);

Route::put('/game/{gameUuid}/cash-out', [GameController::class, 'cashOut']);


