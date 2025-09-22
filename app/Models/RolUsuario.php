<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    protected $table = 'rol_usuarios';
    protected $fillable = ['rol_id', 'usuario_id', 'created_at', 'updated_at'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
