<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'id',
        'uuid',
        'deck_id',
        'status',
        'round',
        'total_points',
        'cash',
    ];
}
