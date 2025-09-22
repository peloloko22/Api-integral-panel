<?php

namespace App\Enums;

enum Rol: string
{
    case OPERADOR = 'operador';
    case SUPERVISOR = 'supervisor';
    case AUTORIDAD = 'autoridad';
    case ADMIN = 'admin';

    /**
     * Obtiene todos los valores de los roles como array
     */
    public static function values(): array
    {
        return array_map(fn(self $rol) => $rol->value, self::cases());
    }

    /**
     * Obtiene todos los casos como array
     */
    public static function all(): array
    {
        return self::cases();
    }

    /**
     * Obtiene los permisos asignados a cada rol
     */
    public function getPermisos(): array
    {
        return match ($this) {
            self::OPERADOR => [Permiso::CARGAR_NOVEDAD],
            self::SUPERVISOR => [
                Permiso::VER_INMEDIATAS,
                Permiso::VER_PARTE,
                Permiso::CARGAR_NOVEDAD,
                Permiso::EDITAR_NOVEDAD,
                Permiso::MANEJAR_BACKOFFICE,
                Permiso::VER_DETALLES_ALERTA
            ],
            self::AUTORIDAD => [
                Permiso::VER_INMEDIATAS,
                Permiso::VER_PARTE,
                Permiso::VER_DETALLES_ALERTA
            ],
            self::ADMIN => Permiso::all(),
        };
    }
}
