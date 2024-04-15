<?php

namespace Tests\Feature\Game;

use Tests\TestCase;

use App\Models\Game;
use Inertia\Testing\AssertableInertia;

class GameTest extends TestCase
{
    public function testNewGameCreated(): void
    {
        $initialGameCount = Game::count();

        $response = $this->post('/game');

        $this->assertEquals($initialGameCount + 1, Game::count());

        $game = Game::latest()->first();

        $response->assertRedirect(route('game', ['gameId' => $game->id]));
    }

    public function testEndUpOnGameId(): void
    {
        $game = Game::first();
        
        $response = $this->get(route('game', ['gameId' => $game->id]));

        $response->assertStatus(200);

        $response->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Game')
                ->has('cardList')
        );
    }
}
