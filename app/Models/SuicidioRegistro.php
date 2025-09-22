<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuicidioRegistro extends Model
{
    protected $table = 'suicidio_registros';
    protected $fillable = ['testigo_id', 'suicida_id', 'tipo_lugar_suicidio_id', 'tipo_suicidio_id', 'mecanismo_suicidio_id', "descripcion" ];

    public function testigo()
    {
        return $this->belongsTo(Personas::class);
    }

    public function suicida()
    {
        return $this->belongsTo(Personas::class);
    }
    
    public function mecanismoSuicidio()
    {
        return $this->belongsTo(MecanismoSuicidio::class);
    }

    public function tipoLugarSuicidio()
    {
        return $this->belongsTo(TipoLugarSuicidio::class);
    }

    public function tipoSuicidio()
    {
        return $this->belongsTo(TipoSuicidio::class);
    }

}
