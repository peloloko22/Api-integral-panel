<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'denuncias';

    protected $fillable = [
        'tipo_denuncia_id',
        'dependencia_id',
        'tipificacion_delito_id',
        'fecha_hecho',
        'fecha_denuncia',
        'fiscal_id',
        'funcionario_interviniente',
        'victima_id',
        'denunciante_id',
        'registrada_en_estadisticas',
        'relato',
    ];

    public function tipoDenuncia()
    {
        return $this->belongsTo(TipoDenuncia::class, 'tipo_denuncia_id');
    }

    public function departamental()
    {
        return $this->hasOneThrough(
            Departamental::class,
            Dependencia::class,
            'id', // Foreign key on dependencias table
            'id', // Foreign key on departamentales table
            'dependencia_id', // Local key on denuncias table
            'departamental_id' // Local key on dependencias table
        );
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'dependencia_id');
    }

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class, 'fiscal_id');
    }

    
    public function tipificacionDelito()
    {
        return $this->belongsTo(TipificacionDelito::class, 'tipificacion_delito_id');
    }

    public function victima()
    {
        return $this->belongsTo(Personas::class, 'victima_id');
    }

    public function denunciante()
    {
        return $this->belongsTo(Personas::class, 'denunciante_id');
    }
}
