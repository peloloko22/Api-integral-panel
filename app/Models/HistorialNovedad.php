<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialNovedad extends Model
{
    public const ACCION_CREACION = 'crear';
    public const ACCION_MODIFICACION = 'modificar';
    public const ACCION_ELIMINACION = 'eliminar';
    public const ACCION_INCLUIR_PARTE = 'incluir_parte';
    public const ACCION_EXCLUIR_PARTE = 'excluir_parte';

    protected $fillable = [
        'novedad_id',
        'usuario_revision_id',
        'contenido',
        'accion',
    ];

    protected $table =  'historial_novedades';

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
