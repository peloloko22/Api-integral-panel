<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\AlertaJerarquiaController;
use App\Http\Controllers\Auth0Controller;
use App\Http\Controllers\AuthSyncController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\CalificacionHechoController;
use App\Http\Controllers\CalificacionTipificacionController;
use App\Http\Controllers\CapacidadPersonaController;
use App\Http\Controllers\FiscalController;
use App\Http\Controllers\TipoNovedadController;
use App\Http\Controllers\CategoriaDelitoController;
use App\Http\Controllers\CategoriaElementoController;
use App\Http\Controllers\CausaFallecimientoController;
use App\Http\Controllers\CondicionClimaticaController;
use App\Http\Controllers\CondicionPersonaController;
use App\Http\Controllers\ConfiguracionParteController;
use App\Http\Controllers\ConocimientoImputadoController;
use App\Http\Controllers\ConsecuenciaHechoController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\DenunciasDinamicasController;
use App\Http\Controllers\DepartamentalController;
use App\Http\Controllers\EstadoElementoController;
use App\Http\Controllers\EstadoPersonaController;
use App\Http\Controllers\TipificacionDelitoController;
use App\Http\Controllers\JerarquiaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\ParteController;
use App\Http\Controllers\RolSiniestroController;
use App\Http\Controllers\SexosController;
use App\Http\Controllers\TipoAlertaController;
use App\Http\Controllers\TipoSiniestroVialNovedadController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\FormularioAyudaController;
use App\Http\Controllers\FranjaHorariaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\GrupoPersonasController;
use App\Http\Controllers\MecanismoArmaController;
use App\Http\Controllers\MecanismoArmaTipificacionController;
use App\Http\Controllers\ModusOperandiController;
use App\Http\Controllers\ModusOperandiTipificacionController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\NivelInstruccionController;
use App\Http\Controllers\OcupacionController;
use App\Http\Controllers\ParajeController;
use App\Http\Controllers\PermisoRolController;
use App\Http\Controllers\PersonaGrupoPersonasController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPersonaController;
use App\Http\Controllers\TipoAlertaGrupoPersonasController;
use App\Http\Controllers\TipoDenunciaController;
use App\Http\Controllers\TipoFormularioAyudaController;
use App\Http\Controllers\TipoLugarController;
use App\Http\Controllers\TipoPersonaController;
use App\Http\Controllers\TipoRegistro;
use App\Http\Controllers\TipoSiniestroController;
use App\Http\Controllers\TipoTransporteInputadoController;
use App\Http\Controllers\TipoViaController;
use App\Http\Controllers\TipoZonaController;
use App\Http\Controllers\UserFCMTokenController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VinculoVictimaController;
use App\Http\Controllers\EmpaquetadoDataController;
use App\Http\Controllers\EstadoCivilController;
use App\Http\Controllers\EstadoVehiculoRegistroController;
use App\Http\Controllers\MecanismoSuicidioController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SemaforoSiniestroController;
use App\Http\Controllers\TipoInformacionSumariaController;
use App\Http\Controllers\TipoLugarSiniestroVialController;
use App\Http\Controllers\TipoLugarSuicidioController;
use App\Http\Controllers\TipoMonedaController;
use App\Http\Controllers\TipoSuicidioController;
use App\Http\Controllers\TipoEsclarecimientoController;
use App\Http\Controllers\TipoEsclarecimientoHechoController;
use App\Models\User;
use App\Models\UserSub;
use App\Services\Firebase\FirebaseMicroService;


Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('funcionarios', FuncionarioController::class);
Route::apiResource('dependencias', DependenciaController::class);
Route::apiResource('provincias', ProvinciaController::class);
Route::apiResource('departamentos', DepartamentoController::class);
Route::apiResource('municipios', MunicipioController::class);
Route::apiResource('localidades', LocalidadController::class);
Route::apiResource('barrios', BarrioController::class);
Route::apiResource('fiscales', FiscalController::class);
Route::apiResource('tipo-novedades', TipoNovedadController::class);
Route::apiResource('categorias-delito', CategoriaDelitoController::class)->parameters(['categorias-delito' => 'categoria_delito']);
Route::apiResource('tipificacion-delito', TipificacionDelitoController::class)->parameter('tipificacion-delito', 'tipificacion_delito');

Route::apiResource('jerarquias', JerarquiaController::class);
Route::apiResource('novedades', NovedadController::class)->parameters(['novedades' => 'novedad']);
Route::patch('novedades/{novedad}/toggle-incluir-parte', [NovedadController::class, 'toggleIncluirParte']);
Route::apiResource('tipo-vehiculos', TipoVehiculoController::class);
Route::apiResource('causas-fallecimiento', CausaFallecimientoController::class);
Route::apiResource('sexos', SexosController::class);
Route::apiResource('rol-participante-siniestro', RolSiniestroController::class);
Route::apiResource('tipos-alerta', TipoAlertaController::class);
Route::apiResource('alertas', AlertaController::class);
Route::post('reenviar-alerta/{alerta}', [AlertaController::class, 'reenviarAlerta']);
Route::apiResource('roles', RolController::class);
Route::apiResource('alerta-jerarquias', AlertaJerarquiaController::class);
Route::get('alertas-por-jerarquias', [AlertaJerarquiaController::class, 'indexJerarquiaAlertas']);
Route::post('configurar-parte', [ConfiguracionParteController::class, 'store']);
Route::put('configurar-parte/{id}', [ConfiguracionParteController::class, 'update']);
Route::get('configurar-parte', [ConfiguracionParteController::class, 'index']);
Route::delete('configurar-parte/{id}', [ConfiguracionParteController::class, 'destroy']);
Route::apiResource('departamental', DepartamentalController::class);
Route::apiResource('formulario-ayuda', FormularioAyudaController::class);
Route::get('parte', [ParteController::class, 'index']);
Route::apiResource('tipo-formulario-ayuda', TipoFormularioAyudaController::class);
Route::put('alertas-por-jerarquias', [AlertaJerarquiaController::class, 'massUpdate']);
Route::get('permisos-rol', [PermisoRolController::class, 'indexPermisosPorRol']);
Route::put('permisos-rol', [PermisoRolController::class, 'updatePermisos']);



Route::apiResource(('grupo-personas'), GrupoPersonasController::class)
    ->parameters(['grupo-personas' => 'grupo_personas']);

Route::apiResource('persona-grupo-personas', PersonaGrupoPersonasController::class)
    ->parameters(['persona-grupo-personas' => 'personas_grupo_personas']);

Route::post('grupo-personas/editar-personas/{grupo_personas}', [GrupoPersonasController::class, 'sincronizarEnMasaPersonas']);
Route::post('grupo-personas/editar-tipos-alerta/{grupo_personas}', [GrupoPersonasController::class, 'sincronizarEnMasaTipoAlerta']);

Route::post('tipo-alerta-grupo-personas/agregar-en-masa', [TipoAlertaGrupoPersonasController::class, 'agregarEnMasa']);
Route::post('tipo-alerta-grupo-personas/quitar-en-masa', [TipoAlertaGrupoPersonasController::class, 'quitarEnMasa']);






Route::get('/ver-imagen/{filename}', function ($filename) {
    $path = storage_path("app/public/multimedia/{$filename}");
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Access-Control-Allow-Origin' => '*',
    ]);
});



Route::post('/probar-suscripcion-topico', function (Request $request) {
    $fcm = new FirebaseMicroService();

    return $fcm->suscribirATopicManualmente(
        $request->input('token', $request->input("token")),
        $request->input('topic', 'default-topic')
    );
});

Route::post('/probar-envio-topico', function (Request $request) {
    $fcm = new FirebaseMicroService();

    return $fcm->enviarAtopico(
        $request->input('topic'),
        "Test",
        "DesdeAPI"
    );
});



Route::apiResource('calificacion-hechos', CalificacionHechoController::class)
    ->parameters(['calificacion-hechos' => 'calificacion']);

Route::apiResource('categoria-elementos', CategoriaElementoController::class)
    ->parameters(['categoria-elementos' => 'categoria_elemento']);

Route::apiResource('condicion-personas', CondicionPersonaController::class)
    ->parameters(['condicion-personas' => 'condicion_persona']);

Route::apiResource('conocimiento-imputados', ConocimientoImputadoController::class)
    ->parameters(['conocimiento-imputados' => 'conocimiento_imputado']);

Route::apiResource('denuncias', DenunciaController::class)
    ->parameters(['denuncias' => 'denuncia']);

Route::apiResource('estado-elementos', EstadoElementoController::class)
    ->parameters(['estado-elementos' => 'estado_elemento']);

Route::apiResource('estado-personas', EstadoPersonaController::class)
    ->parameters(['estado-personas' => 'estado_persona']);

Route::apiResource('franja-horarias', FranjaHorariaController::class)
    ->parameters(['franja-horarias' => 'franja_horaria']);

Route::apiResource('generos', GeneroController::class)
    ->parameters(['generos' => 'genero']);

Route::apiResource('mecanismo-armas', MecanismoArmaController::class)
    ->parameters(['mecanismo-armas' => 'mecanismo_arma']);

Route::apiResource('modus-operandi', ModusOperandiController::class)
    ->parameters(['modus-operandi' => 'modus_operandi']);

Route::apiResource('nacionalidades', NacionalidadController::class)
    ->parameters(['nacionalidades' => 'nacionalidad']);


Route::apiResource('nivel-instrucciones', NivelInstruccionController::class)
    ->parameters(['nivel-instrucciones' => 'nivel_instruccion']);

Route::apiResource('ocupacion', OcupacionController::class)
    ->parameters(['ocupacion' => 'ocupacion']);

Route::apiResource('paraje', ParajeController::class)
    ->parameters(['paraje' => 'paraje']);

Route::apiResource('personas', PersonasController::class)
    ->parameters(['personas' => 'persona']);

Route::apiResource('tipo-denuncia', TipoDenunciaController::class)
    ->parameters(['tipo-denuncia' => 'tipo_denuncia']);

Route::apiResource('tipo-lugar', TipoLugarController::class)
    ->parameters(['tipo-lugar' => 'tipo_lugar']);

Route::apiResource('tipo-persona', TipoPersonaController::class)
    ->parameters(['tipo-persona' => 'tipo_persona']);

Route::apiResource('tipo-registro', TipoRegistro::class)
    ->parameters(['tipo-registro' => 'tipo_registro']);

Route::apiResource('tipo-siniestro', TipoSiniestroController::class)
    ->parameters(['tipo-siniestro' => 'tipo_siniestro']);

Route::apiResource('tipo-transporte-imputado', TipoTransporteInputadoController::class)
    ->parameters(['tipo-transporte-imputado' => 'tipo_transporte_imputados']);

Route::apiResource('tipo-via', TipoViaController::class)
    ->parameters(['tipo-via' => 'tipo_via']);

Route::apiResource('tipo-zona', TipoZonaController::class)
    ->parameters(['tipo-zona' => 'tipo_zona']);

Route::apiResource('vehiculo', VehiculoController::class)
    ->parameters(['vehiculo' => 'vehiculo']);

Route::apiResource('vinculo-victima', VinculoVictimaController::class)
    ->parameters(['vinculo-victima' => 'vinculo_victima']);

Route::apiResource('calificacion-tipificacion', CalificacionTipificacionController::class)
    ->parameters(['calificacion-tipificacion' => 'tipificacion_delito']);

Route::apiResource('modus-operandi-tipificacion', ModusOperandiTipificacionController::class)
    ->parameters(['modus-operandi-tipificacion' => 'tipificacion_delito']);

Route::apiResource('mecanismo-arma-tipificaciones', MecanismoArmaTipificacionController::class)
    ->parameters(['mecanismo-arma-tipificaciones' => 'tipificacion_delito']);



Route::apiResource('rol-persona', RolPersonaController::class)
    ->parameters(['rol-persona' => 'rol_registro']);


Route::apiResource('registro', RegistroController::class);

Route::post('/auth/sync', [Auth0Controller::class, 'sync']);

Route::get('/mesub', [Auth0Controller::class, 'mesub']);
Route::get('/empaquetado-data', [EmpaquetadoDataController::class, 'empaquetadoData']);

Route::apiResource('mecanismo-suicidios', MecanismoSuicidioController::class)->parameters(['mecanismo-suicidios' => 'mecanismo_suicidio'])->only(['index', 'store', 'destroy']);

Route::apiResource('semaforo-siniestro', SemaforoSiniestroController::class)->parameters(['semaforo-siniestro' => 'semaforo_siniestro'])->only(['index', 'store', 'destroy']);

Route::apiResource('condicion-climatica', CondicionClimaticaController::class)->parameters(['condicion-climatica' => 'condicion_climatica'])->only(['index', 'store','update', 'destroy']);

Route::apiResource('tipo-lugar-suicidio', TipoLugarSuicidioController::class)->parameters(['tipo-lugar-suicidio' => 'tipo_lugar_suicidio'])->only(['index', 'store', 'destroy']);

Route::apiResource('tipo-moneda', TipoMonedaController::class)->parameters(['tipo-moneda' => 'tipo_moneda'])->only(['index', 'store', 'destroy'])->parameters(['tipo-moneda' => 'tipo_moneda']);

Route::apiResource('tipo-suicidio', TipoSuicidioController::class)->parameters(['tipo-suicidio' => 'tipo_suicidio'])->only(['index', 'store', 'destroy'])->parameters(['tipo-suicidio' => 'tipo_suicidio']);

Route::apiResource('consecuencia-hecho', ConsecuenciaHechoController::class)->parameters(['consecuencia-hecho' => 'consecuencia_hecho'])->only(['index', 'store','update', 'destroy'])->parameters(['consecuencia-hecho' => 'consecuencia_hecho']);

Route::apiResource('capacidad-persona', CapacidadPersonaController::class)->parameters(['capacidad-persona' => 'capacidad_persona'])->only(['index', 'store', 'update', 'destroy'])->parameters(['capacidad-persona' => 'capacidad_persona']);

Route::apiResource('estado-civil', EstadoCivilController::class)->parameters(['estado-civil' => 'estado_civil'])->only(['index', 'store', 'destroy'])->parameters(['estado-civil' => 'estado_civil']);

Route::apiResource('tipo-esclarecimiento', TipoEsclarecimientoHechoController::class)->parameters(['tipo-esclarecimiento' => 'tipo_esclarecimiento'])->only(['index', 'store', 'destroy'])->parameters(['tipo-esclarecimiento' => 'tipo_esclarecimiento']);

Route::apiResource('tipo-lugar-siniestro-vial', TipoLugarSiniestroVialController::class)->parameters(['tipo-lugar-siniestro-vial' => 'tipo_lugar_siniestro_vial'])->only(['index', 'store', 'destroy'])->parameters(['tipo-lugar-siniestro-vial' => 'tipo_lugar_siniestro_vial']);

Route::apiResource('tipo-informacion-sumaria', TipoInformacionSumariaController::class)->parameters(['tipo-informacion-sumaria' => 'tipo_informacion_sumaria'])->only(['index', 'store', 'destroy'])->parameters(['tipo-informacion-sumaria' => 'tipo_informacion_sumaria']);

Route::apiResource('estado-vehiculo-registro', EstadoVehiculoRegistroController::class)->parameters(['estado-vehiculo-registro' => 'estado_vehiculo_registro'])->only(['index', 'store', 'destroy'])->parameters(['estado-vehiculo-registro' => 'estado_vehiculo_registro']);

// Rutas para Denuncias Dinámicas - Procesamiento y consultas avanzadas
Route::prefix('denuncias-dinamicas')->group(function () {
    // Procesar JSON de denuncias y generar Registros + Denuncias
    Route::post('procesar-json', [DenunciasDinamicasController::class, 'procesarDenunciasJson']);
    
    // Consultas dinámicas con filtros múltiples
    Route::get('consultar', [DenunciasDinamicasController::class, 'consultarRegistros']);
});



// routes/api.php
Route::middleware(['auth0.authorize'])->group(function () {
    Route::get('/alertas/usuario/disponibles', [AlertaController::class, 'alertasDisponiblesUsuario']);

    Route::get('/oauth-me', [UsuarioController::class, 'oauthMe']);
    Route::post('registrar-token', [UserFCMTokenController::class, 'store']);
    Route::get('me', [UsuarioController::class, 'me']);
    Route::post('eliminar-token', [UserFcmTokenController::class, 'destroy']);
    // ...tus endpoints protegidos
});
