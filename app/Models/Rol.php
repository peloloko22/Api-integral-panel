<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'created_at', 'updated_at'];

    public function permisos()
    {
        return $this->belongsToMany(Permisos::class, 'permisos_roles', 'rol_id', 'permiso_id');
    }
}
