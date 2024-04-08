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
            ['name' => 'clubs_2', 'value' => 2, 'is_face' => false],
            ['name' => 'clubs_3', 'value' => 3, 'is_face' => false],
            ['name' => 'clubs_4', 'value' => 4, 'is_face' => false],
            ['name' => 'clubs_5', 'value' => 5, 'is_face' => false],
            ['name' => 'clubs_6', 'value' => 6, 'is_face' => false],
            ['name' => 'clubs_7', 'value' => 7, 'is_face' => false],
            ['name' => 'clubs_8', 'value' => 8, 'is_face' => false],
            ['name' => 'clubs_9', 'value' => 9, 'is_face' => false],
            ['name' => 'clubs_10', 'value' => 10, 'is_face' => false],
            ['name' => 'clubs_J', 'value' => 10, 'is_face' => true],
            ['name' => 'clubs_Q', 'value' => 10, 'is_face' => true],
            ['name' => 'clubs_K', 'value' => 10, 'is_face' => true],
            ['name' => 'clubs_A', 'value' => 11, 'is_face' => false],
            ['name' => 'diamonds_2', 'value' => 2, 'is_face' => false],
            ['name' => 'diamonds_3', 'value' => 3, 'is_face' => false],
            ['name' => 'diamonds_4', 'value' => 4, 'is_face' => false],
            ['name' => 'diamonds_5', 'value' => 5, 'is_face' => false],
            ['name' => 'diamonds_6', 'value' => 6, 'is_face' => false],
            ['name' => 'diamonds_7', 'value' => 7, 'is_face' => false],
            ['name' => 'diamonds_8', 'value' => 8, 'is_face' => false],
            ['name' => 'diamonds_9', 'value' => 9, 'is_face' => false],
            ['name' => 'diamonds_10', 'value' => 10, 'is_face' => false],
            ['name' => 'diamonds_J', 'value' => 10, 'is_face' => true],
            ['name' => 'diamonds_Q', 'value' => 10, 'is_face' => true],
            ['name' => 'diamonds_K', 'value' => 10, 'is_face' => true],
            ['name' => 'diamonds_A', 'value' => 11, 'is_face' => false],
            ['name' => 'hearts_2', 'value' => 2, 'is_face' => false],
            ['name' => 'hearts_3', 'value' => 3, 'is_face' => false],
            ['name' => 'hearts_4', 'value' => 4, 'is_face' => false],
            ['name' => 'hearts_5', 'value' => 5, 'is_face' => false],
            ['name' => 'hearts_6', 'value' => 6, 'is_face' => false],
            ['name' => 'hearts_7', 'value' => 7, 'is_face' => false],
            ['name' => 'hearts_8', 'value' => 8, 'is_face' => false],
            ['name' => 'hearts_9', 'value' => 9, 'is_face' => false],
            ['name' => 'hearts_10', 'value' => 10, 'is_face' => false],
            ['name' => 'hearts_J', 'value' => 10, 'is_face' => true],
            ['name' => 'hearts_Q', 'value' => 10, 'is_face' => true],
            ['name' => 'hearts_K', 'value' => 10, 'is_face' => true],
            ['name' => 'hearts_A', 'value' => 11, 'is_face' => false],
            ['name' => 'spades_2', 'value' => 2, 'is_face' => false],
            ['name' => 'spades_3', 'value' => 3, 'is_face' => false],
            ['name' => 'spades_4', 'value' => 4, 'is_face' => false],
            ['name' => 'spades_5', 'value' => 5, 'is_face' => false],
            ['name' => 'spades_6', 'value' => 6, 'is_face' => false],
            ['name' => 'spades_7', 'value' => 7, 'is_face' => false],
            ['name' => 'spades_8', 'value' => 8, 'is_face' => false],
            ['name' => 'spades_9', 'value' => 9, 'is_face' => false],
            ['name' => 'spades_10', 'value' => 10, 'is_face' => false],
            ['name' => 'spades_J', 'value' => 10, 'is_face' => true],
            ['name' => 'spades_Q', 'value' => 10, 'is_face' => true],
            ['name' => 'spades_K', 'value' => 10, 'is_face' => true],
            ['name' => 'spades_A', 'value' => 11, 'is_face' => false],
        ];

        foreach ($cards as $card) {

            Card::create([
                'name' => $card['name'],
                'value' => $card['value'],
                'is_face' => $card['is_face'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
