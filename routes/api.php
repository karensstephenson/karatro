<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/hello', function () {
//     return response()->json(['message' => 'Hello World!']);
// });


// Can get entry in db when get and change hand_cards and cards_left to null, but won't allow POST. 
// /game/{gameUuid} Network response to save gives a POST response and a JSON object containing cards and hand, but not able to access these.
Route::get('/game/{gameUuid}/save', [GameController::class, 'saveCards']);


//Route::get('/load-game', 'GameController::load');
