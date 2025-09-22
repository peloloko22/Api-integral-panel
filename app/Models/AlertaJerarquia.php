<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertaJerarquia extends Model
{

    protected $table = 'alerta_jerarquias';

    protected $fillable = [
        'tipo_alerta_id',
        'jerarquia_id',
    ];

    public function alerta()
    {
        return $this->belongsTo(Alerta::class);
    }

    public function jerarquia()
    {
        return $this->belongsTo(Jerarquia::class);
    }
}
