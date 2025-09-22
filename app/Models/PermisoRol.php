<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoRol extends Model
{
    protected $table = 'permisos_roles';
    protected $fillable = ['rol_id', 'permiso_id', 'created_at', 'updated_at'];
}
