<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeedCards extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [
            ['name' => 'clubs_2', 'suit' => 'clubs', 'value' => 2, 'is_face' => false, 'rank' => '2'],
            ['name' => 'clubs_3', 'suit' => 'clubs', 'value' => 3, 'is_face' => false, 'rank' => '3'],
            ['name' => 'clubs_4', 'suit' => 'clubs', 'value' => 4, 'is_face' => false, 'rank' => '4'],
            ['name' => 'clubs_5', 'suit' => 'clubs', 'value' => 5, 'is_face' => false, 'rank' => '5'],
            ['name' => 'clubs_6', 'suit' => 'clubs', 'value' => 6, 'is_face' => false, 'rank' => '6'],
            ['name' => 'clubs_7', 'suit' => 'clubs', 'value' => 7, 'is_face' => false, 'rank' => '7'],
            ['name' => 'clubs_8', 'suit' => 'clubs', 'value' => 8, 'is_face' => false, 'rank' => '8'],
            ['name' => 'clubs_9', 'suit' => 'clubs', 'value' => 9, 'is_face' => false, 'rank' => '9'],
            ['name' => 'clubs_10', 'suit' => 'clubs', 'value' => 10, 'is_face' => false, 'rank' => '10'],
            ['name' => 'clubs_J', 'suit' => 'clubs', 'value' => 10, 'is_face' => true, 'rank' => 'J'],
            ['name' => 'clubs_Q', 'suit' => 'clubs', 'value' => 10, 'is_face' => true, 'rank' => 'Q'],
            ['name' => 'clubs_K', 'suit' => 'clubs', 'value' => 10, 'is_face' => true, 'rank' => 'K'],
            ['name' => 'clubs_A', 'suit' => 'clubs', 'value' => 11, 'is_face' => false, 'rank' => 'A'],
            ['name' => 'hearts_2', 'suit' => 'hearts', 'value' => 2, 'is_face' => false, 'rank' => '2'],
            ['name' => 'hearts_3', 'suit' => 'hearts', 'value' => 3, 'is_face' => false, 'rank' => '3'],
            ['name' => 'hearts_4', 'suit' => 'hearts', 'value' => 4, 'is_face' => false, 'rank' => '4'],
            ['name' => 'hearts_5', 'suit' => 'hearts', 'value' => 5, 'is_face' => false, 'rank' => '5'],
            ['name' => 'hearts_6', 'suit' => 'hearts', 'value' => 6, 'is_face' => false, 'rank' => '6'],
            ['name' => 'hearts_7', 'suit' => 'hearts', 'value' => 7, 'is_face' => false, 'rank' => '7'],
            ['name' => 'hearts_8', 'suit' => 'hearts', 'value' => 8, 'is_face' => false, 'rank' => '8'],
            ['name' => 'hearts_9', 'suit' => 'hearts', 'value' => 9, 'is_face' => false, 'rank' => '9'],
            ['name' => 'hearts_10', 'suit' => 'hearts', 'value' => 10, 'is_face' => false, 'rank' => '10'],
            ['name' => 'hearts_J', 'suit' => 'hearts', 'value' => 10, 'is_face' => true, 'rank' => 'J'],
            ['name' => 'hearts_Q', 'suit' => 'hearts', 'value' => 10, 'is_face' => true, 'rank' => 'Q'],
            ['name' => 'hearts_K', 'suit' => 'hearts', 'value' => 10, 'is_face' => true, 'rank' => 'K'],
            ['name' => 'hearts_A', 'suit' => 'hearts', 'value' => 11, 'is_face' => false, 'rank' => 'A'],
            ['name' => 'diamonds_2', 'suit' => 'diamonds', 'value' => 2, 'is_face' => false, 'rank' => '2'],
            ['name' => 'diamonds_3', 'suit' => 'diamonds', 'value' => 3, 'is_face' => false, 'rank' => '3'],
            ['name' => 'diamonds_4', 'suit' => 'diamonds', 'value' => 4, 'is_face' => false, 'rank' => '4'],
            ['name' => 'diamonds_5', 'suit' => 'diamonds', 'value' => 5, 'is_face' => false, 'rank' => '5'],
            ['name' => 'diamonds_6', 'suit' => 'diamonds', 'value' => 6, 'is_face' => false, 'rank' => '6'],
            ['name' => 'diamonds_7', 'suit' => 'diamonds', 'value' => 7, 'is_face' => false, 'rank' => '7'],
            ['name' => 'diamonds_8', 'suit' => 'diamonds', 'value' => 8, 'is_face' => false, 'rank' => '8'],
            ['name' => 'diamonds_9', 'suit' => 'diamonds', 'value' => 9, 'is_face' => false, 'rank' => '9'],
            ['name' => 'diamonds_10', 'suit' => 'diamonds', 'value' => 10, 'is_face' => false, 'rank' => '10'],
            ['name' => 'diamonds_J', 'suit' => 'diamonds', 'value' => 10, 'is_face' => true, 'rank' => 'J'],
            ['name' => 'diamonds_Q', 'suit' => 'diamonds', 'value' => 10, 'is_face' => true, 'rank' => 'Q'],
            ['name' => 'diamonds_K', 'suit' => 'diamonds', 'value' => 10, 'is_face' => true, 'rank' => 'K'],
            ['name' => 'diamonds_A', 'suit' => 'diamonds', 'value' => 11, 'is_face' => false, 'rank' => 'A'],
            ['name' => 'spades_2', 'suit' => 'spades', 'value' => 2, 'is_face' => false, 'rank' => '2'],
            ['name' => 'spades_3', 'suit' => 'spades', 'value' => 3, 'is_face' => false, 'rank' => '3'],
            ['name' => 'spades_4', 'suit' => 'spades', 'value' => 4, 'is_face' => false, 'rank' => '4'],
            ['name' => 'spades_5', 'suit' => 'spades', 'value' => 5, 'is_face' => false, 'rank' => '5'],
            ['name' => 'spades_6', 'suit' => 'spades', 'value' => 6, 'is_face' => false, 'rank' => '6'],
            ['name' => 'spades_7', 'suit' => 'spades', 'value' => 7, 'is_face' => false, 'rank' => '7'],
            ['name' => 'spades_8', 'suit' => 'spades', 'value' => 8, 'is_face' => false, 'rank' => '8'],
            ['name' => 'spades_9', 'suit' => 'spades', 'value' => 9, 'is_face' => false, 'rank' => '9'],
            ['name' => 'spades_10', 'suit' => 'spades', 'value' => 10, 'is_face' => false, 'rank' => '10'],
            ['name' => 'spades_J', 'suit' => 'spades', 'value' => 10, 'is_face' => true, 'rank' => 'J'],
            ['name' => 'spades_Q', 'suit' => 'spades', 'value' => 10, 'is_face' => true, 'rank' => 'Q'],
            ['name' => 'spades_K', 'suit' => 'spades', 'value' => 10, 'is_face' => true, 'rank' => 'K'],
            ['name' => 'spades_A', 'suit' => 'spades', 'value' => 11, 'is_face' => false, 'rank' => 'A'],
        ];

        foreach ($cards as $card) {

            Card::create([
                'name' => $card['name'],
                'suit' => $card['suit'],
                'rank' => $card['rank'],
                'value' => $card['value'],
                'is_face' => $card['is_face'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
