<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolPersona extends Model
{
    public $table = 'rol_personas';

    protected $fillable = [
        'nombre',
    ];



}
