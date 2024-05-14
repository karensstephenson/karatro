<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameRound;
use App\Models\CardsInPlay;
use Illuminate\Http\Request;
use App\Models\GamePlayedHands;

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
        Game::where('uuid', $gameUuid)->update(
            [
                'round_points' => $request->input(key: 'roundPoints'),
                'status' => $request->input(key: 'status'),
                'round' => $request->input(key: 'round'),
                'cash' => $request->input(key: 'cash'),
            ]
        );       

        GameRound::updateOrCreate(
            ['game_id' => $gameId],
            [
                'uuid' => $gameUuid,
                'remaining_hands' => $request->input(key: 'remainingHands'),
                'remaining_discards' => $request->input(key: 'remainingDiscards'),
            ]
        );
        GamePlayedHands::create(
            [
                'game_id' => $gameId,
                'played_hand' => $request->input(key: 'playedHand'),
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
                'round_points' => $game->round_points,
                'gameRoundState' => $gameRoundState,
                'round' => $game->round,
                'status' => $game->status,
                'cash' => $game->cash,
            ]);
        } else {
            return [];
        }
    }

    public function newRound(Request $request): void
    {
        $gameUuid = $request->route('gameUuid');

        Game::where('uuid', $gameUuid)->update(['round' => $request->input(key: 'round')]);
    }

    public function cashOut(Request $request): void
    {
        $gameUuid = $request->route('gameUuid');

        Game::where('uuid', $gameUuid)->update(['cash' => $request->input(key: 'cash')]);
    }
}
