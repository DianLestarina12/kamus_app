<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawabans extends Model
{
    protected $fillable = [
        'id_soal',
        'jawaban',
        'true_false',
    ];
}
