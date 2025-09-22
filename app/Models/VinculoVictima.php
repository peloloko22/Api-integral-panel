<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VinculoVictima extends Model
{
    protected $table = 'vinculo_victimas';

    protected $fillable = [
        'nombre',
        'codigo_snic',
        'codigo_sat'
    ];


}
