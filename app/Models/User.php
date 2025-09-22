<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    public const RELACIONES = [
        'funcionario.jerarquia',
        'sexo',
        'roles.permisos',
        'subs'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'domicilio',
        'email',
        'password',
        'sexo_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subs()
    {
        return $this->hasMany(UserSub::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_usuarios', 'user_id', 'rol_id');
    }


    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, "usuario_id");
    }

    public function sexo()
    {
        return $this->belongsTo(Sexos::class, 'sexo_id');
    }


    public function gruposPersonas()
    {
        return $this->belongsToMany(GrupoPersonas::class, 'persona_grupo_personas', 'persona_id', 'grupo_persona_id');
    }

    public function fcmTokens()
    {
        return $this->hasMany(UserFCMToken::class, 'user_id');
    }
}
