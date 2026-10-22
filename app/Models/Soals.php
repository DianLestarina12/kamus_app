<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soals extends Model
{
   protected $fillable = [
        'soal',
        'jawaban',
        'opsi1',
        'opsi2',
        'opsi3',
        'opsi4',
    ];
}
