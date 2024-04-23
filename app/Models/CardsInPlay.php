<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardsInPlay extends Model
{
    protected $table = 'cards_in_play';

    protected $fillable = [
        'id',
        'game_id',      
        'played_cards',
    ];

    protected $casts = [
        'hand_cards' => 'array',
        'cards_left' => 'array',
    ];
}
