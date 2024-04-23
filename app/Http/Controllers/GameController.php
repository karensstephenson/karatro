<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\CardsInPlay;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function saveCards(Request $request)
    {
        //Returns []
        //dd($request->all());

        $gameUuid = $request->route('gameUuid');

        //Returns expected game uuid
        //dd($gameUuid);
        $gameId = Game::where('uuid', $gameUuid)->firstOrFail()->id;

        //Returns expected gameId
        //dd($gameId);
        
        //Returns ""
        //$rawRequestBody = $request->getContent();
        //dd($rawRequestBody);

        //Returns []
        //$requestData = $request->json()->all();
        //dd($requestData);
        // $hand = $requestData['hand'];
        // $cards = $requestData['cards'];
      
        //All return null
        //dd($data);
        //dd($request->input('hand'));
        //dd($request->input('cards'));
        
        //dd(json_encode($request->input(key:'hand')))

        CardsInPlay::updateOrCreate(
            ['game_id' => $gameId],
            [
                
                'hand_cards' => json_encode($request->input(key:'hand')),
                'cards_left' => json_encode($request->input(key:'cards'))
            ]
            
        );
        return response()->json(['message' => 'Game state saved successfully']);
    }

    // public function load(Request $request)
    // {
    //     $gameUuid = $request->route('gameUuid');
    //     $gameId = Game::where('uuid', $gameUuid)->first();
    //     $gameState = CardsInPlay::where('game_id', $gameId)->first();

    //     return response()->json($gameState);
    // }
}
