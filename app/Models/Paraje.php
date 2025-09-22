<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paraje extends Model
{
    protected $fillable = ['nombre', 'localidad_id'];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
}
