<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlayedHands extends Model
{
    protected $table = 'game_played_hands';

    protected $fillable = [
        'id',
        'game_id',
        'played_hand',
    ];
}
