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
            ['name' => 'clubs_2', 'suit' => 'clubs', 'value' => 2, 'is_face' => false],
            ['name' => 'clubs_3', 'suit' => 'clubs', 'value' => 3, 'is_face' => false],
            ['name' => 'clubs_4', 'suit' => 'clubs', 'value' => 4, 'is_face' => false],
            ['name' => 'clubs_5', 'suit' => 'clubs', 'value' => 5, 'is_face' => false],
            ['name' => 'clubs_6', 'suit' => 'clubs', 'value' => 6, 'is_face' => false],
            ['name' => 'clubs_7', 'suit' => 'clubs', 'value' => 7, 'is_face' => false],
            ['name' => 'clubs_8', 'suit' => 'clubs', 'value' => 8, 'is_face' => false],
            ['name' => 'clubs_9', 'suit' => 'clubs', 'value' => 9, 'is_face' => false],
            ['name' => 'clubs_10', 'suit' => 'clubs', 'value' => 10, 'is_face' => false],
            ['name' => 'clubs_J', 'suit' => 'clubs', 'value' => 10, 'is_face' => true],
            ['name' => 'clubs_Q', 'suit' => 'clubs', 'value' => 10, 'is_face' => true],
            ['name' => 'clubs_K', 'suit' => 'clubs', 'value' => 10, 'is_face' => true],
            ['name' => 'clubs_A', 'suit' => 'clubs', 'value' => 11, 'is_face' => false],
            ['name' => 'hearts_2', 'suit' => 'hearts', 'value' => 2, 'is_face' => false],
            ['name' => 'hearts_3', 'suit' => 'hearts', 'value' => 3, 'is_face' => false],
            ['name' => 'hearts_4', 'suit' => 'hearts', 'value' => 4, 'is_face' => false],
            ['name' => 'hearts_5', 'suit' => 'hearts', 'value' => 5, 'is_face' => false],
            ['name' => 'hearts_6', 'suit' => 'hearts', 'value' => 6, 'is_face' => false],
            ['name' => 'hearts_7', 'suit' => 'hearts', 'value' => 7, 'is_face' => false],
            ['name' => 'hearts_8', 'suit' => 'hearts', 'value' => 8, 'is_face' => false],
            ['name' => 'hearts_9', 'suit' => 'hearts', 'value' => 9, 'is_face' => false],
            ['name' => 'hearts_10', 'suit' => 'hearts', 'value' => 10, 'is_face' => false],
            ['name' => 'hearts_J', 'suit' => 'hearts', 'value' => 10, 'is_face' => true],
            ['name' => 'hearts_Q', 'suit' => 'hearts', 'value' => 10, 'is_face' => true],
            ['name' => 'hearts_K', 'suit' => 'hearts', 'value' => 10, 'is_face' => true],
            ['name' => 'hearts_A', 'suit' => 'hearts', 'value' => 11, 'is_face' => false],
            ['name' => 'spades_2', 'suit' => 'spades', 'value' => 2, 'is_face' => false],
            ['name' => 'spades_3', 'suit' => 'spades', 'value' => 3, 'is_face' => false],
            ['name' => 'spades_4', 'suit' => 'spades', 'value' => 4, 'is_face' => false],
            ['name' => 'spades_5', 'suit' => 'spades', 'value' => 5, 'is_face' => false],
            ['name' => 'spades_6', 'suit' => 'spades', 'value' => 6, 'is_face' => false],
            ['name' => 'spades_7', 'suit' => 'spades', 'value' => 7, 'is_face' => false],
            ['name' => 'spades_8', 'suit' => 'spades', 'value' => 8, 'is_face' => false],
            ['name' => 'spades_9', 'suit' => 'spades', 'value' => 9, 'is_face' => false],
            ['name' => 'spades_10', 'suit' => 'spades', 'value' => 10, 'is_face' => false],
            ['name' => 'spades_J', 'suit' => 'spades', 'value' => 10, 'is_face' => true],
            ['name' => 'spades_Q', 'suit' => 'spades', 'value' => 10, 'is_face' => true],
            ['name' => 'spades_K', 'suit' => 'spades', 'value' => 10, 'is_face' => true],
            ['name' => 'spades_A', 'suit' => 'spades', 'value' => 11, 'is_face' => false],
            ['name' => 'diamonds_2', 'suit' => 'diamonds', 'value' => 2, 'is_face' => false],
            ['name' => 'diamonds_3', 'suit' => 'diamonds', 'value' => 3, 'is_face' => false],
            ['name' => 'diamonds_4', 'suit' => 'diamonds', 'value' => 4, 'is_face' => false],
            ['name' => 'diamonds_5', 'suit' => 'diamonds', 'value' => 5, 'is_face' => false],
            ['name' => 'diamonds_6', 'suit' => 'diamonds', 'value' => 6, 'is_face' => false],
            ['name' => 'diamonds_7', 'suit' => 'diamonds', 'value' => 7, 'is_face' => false],
            ['name' => 'diamonds_8', 'suit' => 'diamonds', 'value' => 8, 'is_face' => false],
            ['name' => 'diamonds_9', 'suit' => 'diamonds', 'value' => 9, 'is_face' => false],
            ['name' => 'diamonds_10', 'suit' => 'diamonds', 'value' => 10, 'is_face' => false],
            ['name' => 'diamonds_J', 'suit' => 'diamonds', 'value' => 10, 'is_face' => true],
            ['name' => 'diamonds_Q', 'suit' => 'diamonds', 'value' => 10, 'is_face' => true],
            ['name' => 'diamonds_K', 'suit' => 'diamonds', 'value' => 10, 'is_face' => true],
            ['name' => 'diamonds_A', 'suit' => 'diamonds', 'value' => 11, 'is_face' => false],
        ];

        foreach ($cards as $card) {

            Card::create([
                'name' => $card['name'],
                'suit' => $card['suit'],
                'value' => $card['value'],
                'is_face' => $card['is_face'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
