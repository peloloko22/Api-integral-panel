<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultimediaNovedad extends Model
{
    protected $table = 'multimedia_novedades';

    protected $fillable = [
        'novedad_id',
        'ruta',
        'tipo',
    ];

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }
}
