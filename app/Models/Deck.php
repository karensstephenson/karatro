<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $table = 'decks';

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'hands',
        'discards',
    ];
}
