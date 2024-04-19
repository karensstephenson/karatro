<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRound extends Model
{
    protected $table = 'game_rounds';

    protected $fillable = [
        'id',
        'game_id',
        'played_hand',
    ];
}
