<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game_Round extends Model
{
    protected $table = 'game_rounds';

    protected $fillable = [
        'id',
        'uuid',
        'game_id',
        'remaining_hands',
        'remaining_discards',
        'cash',
        'total_points',
    ];
}
