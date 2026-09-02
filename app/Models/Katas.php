<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katas extends Model
{
     protected $fillable = [
        'kruna_andap',
        'kruna_asi',
        'kruna_aso',
        'kruna_ami',
        'kruna_mider', 
        'kruna_kasar',
        'bahasa_Indonesia'
    ];
}
