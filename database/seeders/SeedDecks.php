<?php

namespace Database\Seeders;

use App\Models\Deck;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeedDecks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $redDeck = [
            'uuid' => Str::uuid()->toString(),
            'name' => 'Red Deck',
            'hands' => 4,
            'discards' => 4,
        ];
        $blueDeck = [
            'uuid' => Str::uuid()->toString(),
            'name' => 'Blue Deck',
            'hands' => 5,
            'discards' => 3,
        ];

        $decks = [$redDeck, $blueDeck];

        foreach ($decks as $deck) {
            Deck::create($deck);
        };
    }
}
