<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class SeedRankValues extends Seeder
{
    public function run(): void
    {
        foreach (Card::all() as $card) {
            if ($card->rank === 'A') {
                $card->rank = 14;
            } elseif ($card->rank === 'K') {
                $card->rank = 13;
            } elseif ($card->rank === 'Q') {
                $card->rank = 12;
            } elseif ($card->rank === 'J') {
                $card->rank = 11;
            } else {
                $card->rank = $card->value;
            }

            $card->save();
        }
    }
}
