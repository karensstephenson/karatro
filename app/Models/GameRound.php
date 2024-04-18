<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRound extends Model
{
    protected $table = 'game_rounds';

    protected $fillable = [
        'id',
        'uuid',
        'game_id',
        'remaining_hands',
        'remaining_discards',
    ];
}
