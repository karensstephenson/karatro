<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRound extends Model
{
    protected $table = 'game_played_cards';

    protected $fillable = [
        'id',        
        'game_id',
        'hand_id',
    ];
}
