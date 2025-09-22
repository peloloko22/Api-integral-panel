# Seeder de Denuncias desde JSON

Este seeder permite cargar denuncias y registros desde el archivo JSON `resources/denucias.json` hacia la base de datos del sistema integral policial.

## Archivos Involucrados

- `database/seeders/DenunciasJsonSeeder.php` - Seeder principal
- `database/seeders/DenunciasJsonSeederHelper.php` - Métodos de procesamiento principal
- `database/seeders/DenunciasJsonSeederUtils.php` - Métodos utilitarios y de búsqueda
- `resources/denucias.json` - Archivo fuente de datos

## Funcionalidad

El seeder procesa el archivo JSON y crea:

### 1. Denuncias
- Mapea los datos del JSON a la tabla `denuncias`
- Asocia con dependencias, fiscales y tipificaciones existentes
- Crea personas (denunciante, víctima, imputado) según corresponda

### 2. Registros
- Crea registros asociados a cada denuncia
- Incluye información de tiempo-espacio (ubicación, fecha, hora)
- Asocia personas con roles específicos
- Crea hechos delictivos según las tipificaciones
- Registra elementos sustraídos/involucrados

## Mapeo de Datos

### Personas
- **Denunciante**: Se extrae de campos `APELLIDOS Y NOMBRES (DENUNCIANTE.)`
- **Víctima**: Si es diferente del denunciante, se extrae de `APELLIDOS Y NOMBRES - ENTIDAD (DAMNIF / VICT.)`
- **Imputado**: Se extrae de `APELLIDOS Y NOMBRES (IMPUT 1)` si no es "DESCONOCIDO"

### Ubicación
- **Departamental**: Se mapea desde `DEPARTAMENTAL` usando códigos existentes
- **Dependencia**: Se mapea desde `CRIAS. Y SUBCRIAS` usando códigos existentes
- **Localidad**: Se busca por nombre en `LOCALIDAD`
- **Barrio**: Se busca por nombre en `BARRIO`

### Delitos
- **Tipificación**: Se busca en múltiples campos:
  - `CONTRA LA PROPIEDAD (TIPIF)`
  - `CONTRA LAS PERSONAS (TIPIF)`
  - `CONTRA LA LIBERTAD (TIPIF)`
  - `CONTRA LA INTEGRIDAD SEXUAL (TIPIF)`

### Elementos
- **Categoría**: Se mapea desde `ELEMENTOS`
- **Estado**: Se mapea desde `ELEMENTOS (CONDICION)`
- **Descripción**: Se toma de `DESCRIPCION`, `MARCA`, `COLOR`, etc.

## Uso

### Ejecutar el Seeder

```bash
php artisan db:seed --class=DenunciasJsonSeeder
```

### Requisitos Previos

Antes de ejecutar el seeder, asegúrate de que existan los siguientes datos base:

1. **Departamentales** - Tabla `departamentales` con códigos
2. **Dependencias** - Tabla `dependencias` con códigos
3. **Tipificaciones** - Tabla `tipificacion_delitos` con nombres
4. **Fiscales** - Tabla `fiscales` con nombres
5. **Datos Geográficos** - Localidades y barrios
6. **Datos de Personas** - Sexos, géneros, nacionalidades, etc.
7. **Datos de Referencia** - Tipos de lugar, vía, zona, etc.

## Características Especiales

### 1. Búsqueda Inteligente
- Utiliza búsqueda aproximada por texto para mapear datos
- Maneja variaciones en nombres y códigos
- Limpia y normaliza texto para mejores coincidencias

### 2. Manejo de Errores
- Procesa denuncias individualmente
- Continúa procesando aunque una falle
- Registra errores en logs para revisión

### 3. Evita Duplicados
- Busca personas existentes por DNI o nombre
- Reutiliza entidades existentes cuando es posible

### 4. Transaccional
- Usa transacciones de base de datos
- Rollback completo en caso de error crítico

## Formato del JSON

El archivo JSON debe contener un array de objetos, donde cada objeto representa una denuncia con los siguientes campos principales:

```json
[
    {
        "Marca temporal": "23/7/2025 12:36:48",
        "TIPO DE INTERVENCION ": "DENUNCIA, 1",
        "DEPARTAMENTAL ": "D.S.C. ,8",
        "CRIAS. Y SUBCRIAS": "N° 64,  93",
        "FECHA DEL HECHO": "22/7/2025",
        "APELLIDOS Y NOMBRES  (DENUNCIANTE.)": "SALVATIERRA EDGARGO MATIAS",
        "DNI (DENUNCIANTE.)": 42021259,
        "CONTRA LA PROPIEDAD (TIPIF)": "HURTOS, 19",
        "ELEMENTOS ": "OTROS",
        "ELEMENTOS (CONDICION)": "SUSTRAIDO",
        "RELATO": "Descripción detallada del hecho...",
        // ... más campos
    }
]
```

## Logs y Depuración

- Los errores se registran en los logs de Laravel
- Información de progreso se muestra en consola
- Cada denuncia procesada se numera secuencialmente

## Consideraciones

1. **Rendimiento**: El seeder procesa denuncias secuencialmente para mejor control
2. **Memoria**: Para archivos muy grandes, considerar procesamiento por lotes
3. **Datos Faltantes**: Campos vacíos o nulos se manejan graciosamente
4. **Validación**: Se realizan validaciones básicas pero no exhaustivas

## Troubleshooting

### Error: "No se encontró el archivo denucias.json"
- Verifica que el archivo esté en `resources/denucias.json`
- Verifica permisos de lectura

### Error: "Error al leer el archivo JSON"
- Verifica que el JSON sea válido
- Usa herramientas de validación JSON

### Errores de Mapeo
- Revisa los logs para identificar datos faltantes
- Verifica que existan los datos de referencia necesarios

## Extensión

Para agregar nuevos campos o funcionalidades:

1. Modifica los métodos en `DenunciasJsonSeederHelper.php`
2. Agrega nuevos métodos de búsqueda en `DenunciasJsonSeederUtils.php`
3. Actualiza la documentación correspondiente
