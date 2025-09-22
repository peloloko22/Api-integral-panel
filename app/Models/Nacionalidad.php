<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $fillable = ['nombre', 'codigo_snic', 'codigo_sat'];
    protected $table = 'nacionalidades';
}
