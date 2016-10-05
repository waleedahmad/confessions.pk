<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confession extends Model
{
    protected $table = 'confessions';

    protected $fillable = [
        'confession',
        'mood',
        'category'
    ];
}
