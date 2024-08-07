<?php

namespace Tests\Feature\Game;

use App\Models\Game;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class GameTest extends TestCase
{
    public function testNewGameCreated(): void
    {
        $initialGameCount = Game::count();

        $response = $this->post('/game');

        $this->assertEquals($initialGameCount + 1, Game::count());

        $game = Game::latest()->first();

        $response->assertRedirect(route('game', ['gameUuid' => $game->uuid]));
    }

    public function testEndUpOnGameId(): void
    {
        $game = Game::first();

        $response = $this->get(route('game', ['gameUuid' => $game->uuid]));

        $response->assertStatus(200);

        $response->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Game')
                ->has('cardList')
        );
    }

    public function testReloadPreviousGame(): void
    {
        //
        $game = Game::latest()->first();

        //
        $response = $this->get(route('resume', ['gameUuid' => $game->uuid]));

        //
        $response->assertStatus(200);

        $response->assertInertia(
            fn (AssertableInertia $page) => $page   
                ->component('Game')
                ->has('cardList')
        );
    }
}
