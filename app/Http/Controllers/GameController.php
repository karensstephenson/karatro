<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Game;
use App\Models\CardsInPlay;
use App\Models\GameRound;
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
                'played_cards' => $request->input(key: 'playedCards'),
                'discards' => $request->input(key: 'discards'),
            ]
        );
        Game::where('uuid', $gameUuid)->update(['total_points' => $request->input(key: 'totalPoints')]);

        GameRound::updateOrCreate(
            ['game_id' => $gameId],
            [
                'uuid' => $gameUuid,
                'remaining_hands' => $request->input(key: 'remainingHands'),
                'remaining_discards' => $request->input(key: 'remainingDiscards'),
            ]
        );

        return response()->json(['message' => 'Game state saved successfully']);
    }

    public function loadCards(Request $request)
    {
        $gameUuid = $request->route('gameUuid');
        $gameId = Game::where('uuid', $gameUuid)->firstOrFail()->id;
        $gameState = CardsInPlay::where('game_id', $gameId)->first();
        $game = Game::where('uuid', $gameUuid)->first();
        $gameRoundState = GameRound::where('uuid', $gameUuid)->first();

        if ($gameState) {
            return response()->json([
                'gameState' => $gameState,
                'total_points' => $game->total_points,
                'gameRoundState' => $gameRoundState,
            ]);
        } else {
            return [];
        }
    }
}
