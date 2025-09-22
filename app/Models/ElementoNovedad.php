<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementoNovedad extends Model
{

    protected $table = 'elementos_novedades';

    protected $fillable = [
        'novedad_id',
        'estado_elemento_id',
        'categoria_elemento_id',
        'cantidad',
        'valor',
        'detalles',
    ];

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }

    public function estadoElemento()
    {
        return $this->belongsTo(EstadoElemento::class, 'estado_elemento_id');
    }
    
    public function categoriaElemento()
    {
        return $this->belongsTo(CategoriaElemento::class, 'categoria_elemento_id');
    }
}
