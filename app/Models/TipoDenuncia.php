<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDenuncia extends Model
{
    protected $table = 'tipo_denuncias';
    protected $fillable = ['nombre'];

    public function denuncias()
    {
        return $this->hasMany(Denuncia::class, 'tipo_denuncia_id');
    }
}
