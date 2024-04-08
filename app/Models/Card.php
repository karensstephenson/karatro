<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = [
        'suit',
        'rank',
        'suit',
        'is_face',
        'value',
    ];
}
