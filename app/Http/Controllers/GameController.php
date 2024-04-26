<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\CardsInPlay;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function saveCards(Request $request)
    {
        $gameUuid = $request->route('gameUuid');
        $gameId = Game::where('uuid', $gameUuid)->firstOrFail()->id;

        CardsInPlay::updateOrCreate(
            ['game_id' => $gameId],
            [
                'hand_cards' => $request->input(key: 'hand'),
                'cards_left' => $request->input(key: 'cards'),
                'played_cards' => $request->input(key: 'playedCards')
            ]
        );
        return response()->json(['message' => 'Game state saved successfully']);
    }

    public function loadCards(Request $request)
    {
        $gameUuid = $request->route('gameUuid');
        $gameId = Game::where('uuid', $gameUuid)->firstOrFail()->id;
        $gameState = CardsInPlay::where('game_id', $gameId)->first();

        if ($gameState) {
            return response()->json($gameState);
        } else {
            return [];
        }
    }
}
