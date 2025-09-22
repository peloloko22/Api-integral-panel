# 📊 Importador de Denuncias CSV

## Descripción

Este sistema permite importar denuncias policiales desde archivos CSV al sistema Laravel. Está diseñado específicamente para procesar datos de denuncias con toda la información relacionada (personas, ubicaciones, delitos, etc.).

## 🚀 Uso Rápido

### Comando Básico
```bash
php artisan denuncias:importar-csv
```

### Opciones Avanzadas
```bash
# Modo de prueba (no guarda datos)
php artisan denuncias:importar-csv --dry-run

# Procesar archivo específico
php artisan denuncias:importar-csv archivo_denuncias.csv

# Limitar número de registros
php artisan denuncias:importar-csv --limite=100

# Comenzar desde línea específica
php artisan denuncias:importar-csv --desde=50

# Combinación de opciones
php artisan denuncias:importar-csv mi_archivo.csv --limite=50 --dry-run
```

### Usando Seeder Directamente
```bash
php artisan db:seed --class=DenunciasCSVSeeder
```

## 📁 Preparación del Archivo

### Ubicación
Coloca tu archivo CSV en: `resources/primeros_10_registros.csv`

### Formato Requerido
- **Separador**: Comas (`,`)
- **Codificación**: UTF-8
- **Primera línea**: Encabezados
- **Mínimo**: 50 columnas por fila

### Estructura Esperada
El CSV debe contener las siguientes columnas principales:
- Datos administrativos (fecha, hora, dependencia)
- Información del denunciante
- Información de la víctima
- Datos del/los imputado/s
- Detalles del delito
- Relato de la denuncia

## 🔧 Configuración

### Archivo de Configuración
Edita `config/csv_mapping.php` para personalizar:

```php
'sexos' => [
    'MASCULINO' => 'MASCULINO',
    'VARON' => 'MASCULINO',
    // Agregar más mapeos...
],

'procesamiento' => [
    'batch_size' => 50,
    'timeout' => 300,
    'max_errores' => 100,
],
```

## 📋 Datos Procesados

### Personas
- **Denunciantes**: Información completa de quien hace la denuncia
- **Víctimas**: Datos de la persona afectada (si es diferente al denunciante)
- **Imputados**: Información de los acusados (hasta 2 por registro)

### Ubicaciones
- **Geográficas**: Provincia, departamento, municipio, localidad, barrio
- **Específicas**: Tipo de lugar, dirección, coordenadas GPS

### Delitos
- **Categorización**: Contra personas, propiedad, libertad, etc.
- **Tipificación**: Hurtos, robos, lesiones, amenazas, etc.
- **Elementos**: Objetos sustraídos/secuestrados con detalles

### Datos Judiciales
- **Fiscales**: Asignación de fiscales
- **Dependencias**: Comisarías y departamentales
- **Funcionarios**: Quien tomó la denuncia

## 🛡️ Manejo de Errores

### Tipos de Error
1. **Formato**: Filas incompletas, datos malformados
2. **Validación**: DNI inválidos, fechas incorrectas
3. **Relaciones**: Referencias a datos inexistentes

### Recuperación
- Los errores se registran en logs
- Se muestra resumen al final del proceso
- Transacciones de base de datos para rollback automático

### Logs
```bash
# Ver logs de importación
tail -f storage/logs/laravel.log | grep "DenunciasCSVSeeder"
```

## 📊 Monitoreo

### Durante la Importación
- Progreso cada 10 registros
- Contadores de éxito/error en tiempo real
- Tiempo transcurrido

### Después de la Importación
```bash
# Verificar registros creados
php artisan tinker
>>> App\Models\Denuncia::count()
>>> App\Models\Personas::count()
```

## 🔍 Solución de Problemas

### Problemas Comunes

**Error: "Archivo CSV no encontrado"**
```bash
# Verificar ubicación
ls -la resources/primeros_10_registros.csv
```

**Error: "Fila incompleta"**
- Verificar que el CSV tenga al menos 50 columnas
- Revisar saltos de línea internos en el relato

**Error: "Memoria agotada"**
```bash
# Aumentar límite de memoria
php -d memory_limit=512M artisan denuncias:importar-csv
```

**Datos duplicados**
- El sistema detecta personas existentes por DNI
- Configurar `skip_duplicados` en `config/csv_mapping.php`

### Depuración

**Modo de prueba**
```bash
# Ejecutar sin guardar datos
php artisan denuncias:importar-csv --dry-run
```

**Procesar pocos registros**
```bash
# Solo primeros 5 registros
php artisan denuncias:importar-csv --limite=5
```

## 🎯 Optimización

### Rendimiento
- Procesa en lotes de 50 registros por defecto
- Usa transacciones para consistencia
- Cachea consultas de datos de referencia

### Memoria
- Libera memoria después de cada lote
- Usa lazy loading para relaciones
- Configura timeout apropiado

## 📈 Estadísticas

Al finalizar la importación obtienes:
- ✅ Registros procesados exitosamente
- ❌ Registros con errores
- ⏱️ Tiempo total de procesamiento
- 📊 Resumen de datos creados

## 🔄 Mantenimiento

### Limpiar Datos de Prueba
```bash
# Eliminar denuncias importadas
php artisan tinker
>>> App\Models\Denuncia::where('registrada_en_estadisticas', true)->delete()
```

### Actualizar Mapeos
Edita `config/csv_mapping.php` para ajustar mapeos de valores según nuevos formatos de CSV.

### Backup
Siempre realiza backup antes de importaciones masivas:
```bash
php artisan backup:run
```

---

## 📞 Soporte

Para problemas o mejoras, revisa:
1. Logs en `storage/logs/laravel.log`
2. Configuración en `config/csv_mapping.php`
3. Código fuente en `database/seeders/DenunciasCSVSeeder.php`
