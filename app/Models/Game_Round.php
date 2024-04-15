<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game_Round extends Model
{
    protected $table = 'game-rounds';

    protected $fillable = [
        'id',
        'uuid',
        'game_id',
        'remaining_hands',
        'remaining_discards',
    ];
}
