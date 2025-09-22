<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermisosRol\PermisosRolStoreRequest;
use App\Models\Permisos;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;

class PermisoRolController extends Controller
{
    public function indexPermisosPorRol()
    {
        $roles = Rol::with('permisos')->get(); // Ajustá si tu modelo se llama Rol
        $todosLosPermisos = Permisos::all();

        $resultado = $roles->map(function ($rol) use ($todosLosPermisos) {
            $idsAsignados = $rol->permisos->pluck('id')->toArray();

            return [
                'rol_id' => $rol->id,
                'rol_nombre' => $rol->nombre,
                'permisos' => $todosLosPermisos->map(function ($permiso) use ($idsAsignados) {
                    return [
                        'id' => $permiso->id,
                        'nombre' => $permiso->nombre,
                        'asignado' => in_array($permiso->id, $idsAsignados),
                    ];
                })->toArray(),
            ];
        });

        return response()->json($resultado);
    }


    public function updatePermisos(PermisosRolStoreRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            // Obtener el ID del rol 'admin' (si existe)
            $rolAdmin = DB::table('roles')->where('nombre', 'admin')->first();

            // Eliminar todos los permisos de todos los roles, excepto del admin
            DB::table('permisos_roles')
                ->when($rolAdmin, fn ($q) => $q->where('rol_id', '!=', $rolAdmin->id))
                ->delete();

            $now = now();

            $nuevos = [];

            foreach ($data['permisos_por_rol'] as $item) {
                // Omitir si es el rol admin
                if ($rolAdmin && $item['rol_id'] == $rolAdmin->id) {
                    continue;
                }

                foreach ($item['permisos'] as $permisoId) {
                    $nuevos[] = [
                        'rol_id' => $item['rol_id'],
                        'permiso_id' => $permisoId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            if (!empty($nuevos)) {
                DB::table('permisos_roles')->insert($nuevos);
            }
        });

        return response()->json(['message' => 'Permisos actualizados correctamente.']);
    }

}
