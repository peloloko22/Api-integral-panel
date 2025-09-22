<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementoRegistro extends Model
{
    protected $fillable = [
        'registro_id',
        'categoria_elemento_id',
        'estado_elemento_id',
        'cantidad',
        'marca',
        'color',
        'valor',
        'descripcion',
        'fecha_secuestro',
        'tipo_moneda_id',
    ];




    public function categoriaElemento()
    {
        return $this->belongsTo(CategoriaElemento::class, 'categoria_elemento_id');
    }

    public function estadoElemento()
    {
        return $this->belongsTo(EstadoElemento::class, 'estado_elemento_id');
    }

    public function tipoMoneda()
    {
        return $this->belongsTo(TipoMoneda::class, 'tipo_moneda_id');
    }
}
