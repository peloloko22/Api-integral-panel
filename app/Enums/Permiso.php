<?php

namespace App\Enums;

enum Permiso: string
{
    case VER_INMEDIATAS = 'ver_inmediatas';
    case VER_PARTE = 'ver_parte';
    case CARGAR_NOVEDAD = 'cargar_novedad';
    case EDITAR_NOVEDAD = 'editar_novedad';
    case ENVIAR_FORMULARIO_AYUDA = 'enviar_formulario_ayuda';
    case MANEJAR_BACKOFFICE = 'manejar_backoffice';
    case VER_DETALLES_ALERTA = 'ver_detalles_alerta';

    /**
     * Obtiene todos los valores de los permisos como array
     */
    public static function values(): array
    {
        return array_map(fn(self $permiso) => $permiso->value, self::cases());
    }

    /**
     * Obtiene todos los casos como array
     */
    public static function all(): array
    {
        return self::cases();
    }
}
