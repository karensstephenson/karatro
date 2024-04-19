<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class SeedSvgNames extends Seeder
{
    private array $faceCards = ['K', 'Q', 'J'];

    private array $faceMap = [
        'K' => 'king',
        'Q' => 'queen',
        'J' => 'jack',
    ];

    public function run(): void
    {
        foreach (Card::all() as $card) {
            if (in_array($card->rank, $this->faceCards)) {
                $rank = $this->faceMap[$card->rank];

                $card->name = $rank.'_of_'.$card->suit;
            } elseif ($card->rank === 'A') {
                $card->name = 'ace_of_'.$card->suit;
            } else {
                $card->name = $card->rank.'_of_'.$card->suit;
            }

            $card->save();
        }
    }
}
