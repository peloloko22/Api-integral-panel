<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoLugar extends Model
{
    protected $table = 'tipo_lugares';
    protected $fillable = ['nombre'];
}
