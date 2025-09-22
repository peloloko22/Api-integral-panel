<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $table = 'permisos';
    protected $fillable = ['nombre', 'created_at', 'updated_at'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'permisos_roles', 'permiso_id', 'rol_id');
    }
}
