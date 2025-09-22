<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormularioAyuda extends Model
{


    protected $fillable = [
        'titulo',
        'descripcion',
        'usuario_id',
        'tipo_formulario_ayuda_id',
    ];

    public function tipoFormularioAyuda()
    {
        return $this->belongsTo(TipoFormularioAyuda::class, 'tipo_formulario_ayuda_id');
    }
}
