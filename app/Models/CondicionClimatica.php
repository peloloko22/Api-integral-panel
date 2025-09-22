<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CondicionClimatica extends Model
{
    protected $table = 'condicion_climaticas';

    protected $fillable = ['nombre', 'codigo'];
}
