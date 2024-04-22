<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardsInPlay extends Model
{
    protected $table = 'cards_in_play';

    protected $fillable = [
        'id',
        'hand_cards',
        'cards_left',
        'played_cards',
    ];
}
