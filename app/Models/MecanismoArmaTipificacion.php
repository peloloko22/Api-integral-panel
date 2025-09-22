<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MecanismoArmaTipificacion extends Model
{
    protected $table = "mecanismo_arma_tipificaciones";
    protected $fillable = ['mecanismo_arma_id', 'tipificacion_id'];


}
