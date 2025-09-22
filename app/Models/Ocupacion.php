<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $fillable = ['nombre', 'codigo_snic', 'codigo_sat'];
    protected $table = 'ocupaciones';
}
