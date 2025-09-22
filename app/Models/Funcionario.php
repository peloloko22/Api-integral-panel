<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = [
        'lp',
        'usuario_id',
        'jerarquia_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function jerarquia()
    {
        return $this->belongsTo(Jerarquia::class);
    }

    public function novedades()
    {
        return $this->hasMany(Novedad::class);
    }
}
