<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jerarquia extends Model
{
    protected $table = 'jerarquias';

    protected $fillable = [
        'nombre',
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class);
    }

    public function tiposAlerta()
    {
        return $this->belongsToMany(TipoAlerta::class, 'alerta_jerarquias', 'jerarquia_id', 'tipo_alerta_id')
            ->withTimestamps();
    }
}
