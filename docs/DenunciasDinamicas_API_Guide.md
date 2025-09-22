# API de Denuncias Dinámicas - Guía Completa

## Descripción General

El sistema de **Denuncias Dinámicas** permite procesar datos de denuncias policiales desde archivos JSON y realizar consultas avanzadas con filtros múltiples. Está diseñado para manejar la complejidad de los datos policiales reales con máxima flexibilidad.

## Endpoints Disponibles

### 1. Procesar JSON de Denuncias
**POST** `/api/denuncias-dinamicas/procesar-json`

Procesa un array de denuncias en formato JSON y crea automáticamente:
- **Denuncias** con información básica
- **Registros** con toda la información detallada
- **Personas** (denunciantes, imputados, víctimas)
- **Hechos** delictivos con tipificaciones
- **Elementos** sustraídos/recuperados
- **Información geográfica y temporal**

### 2. Consultar Registros con Filtros Dinámicos
**GET** `/api/denuncias-dinamicas/consultar`

Sistema de consultas avanzado que permite filtrar por múltiples criterios simultáneamente.

---

## 1. Procesamiento de JSON

### Estructura del Request

```json
{
  "denuncias": [
    {
      "Marca temporal": "23/7/2025 12:36:48",
      "TIPO DE INTERVENCION ": "DENUNCIA, 1",
      "DEPARTAMENTAL ": "D.S.C. ,8",
      "CRIAS. Y SUBCRIAS": "N° 64,  93",
      "FECHA DEL HECHO": "22/7/2025",
      "HORA DEL HECHO (NO COLOCAR HS.)": "17:00",
      "FRANJA HORARIA": "12:00 A 17:59",
      "DPTO. PROVINCIAL ": "ROBLES, 161",
      "LOCALIDAD ": "COLONIA EL SIMBOLAR, 020",
      "BARRIO": "SIN BARRIO",
      "TIPO DE LUGAR": "DOMICILIO PARTICULAR CON MORADORES    ,2",
      "APELLIDOS Y NOMBRES  (DENUNCIANTE.)": "SALVATIERRA EDGARGO MATIAS",
      "DNI (DENUNCIANTE.)": 42021259,
      "EDAD (DENUNCIANTE)": 46,
      "SEXO  (DENUNCIANTE)": "MASCULINO,   1",
      "CATEGORIAS DE HECHOS": "DELITOS CONTRA LA PROPIEDAD",
      "CONTRA LA PROPIEDAD (TIPIF)": "HURTOS, 19",
      "ELEMENTOS (CONDICION)": "SUSTRAIDO",
      "DESCRIPCION": "CAJA DE HERRAMIENTAS",
      "RELATO": "° 131234 HURTO DENUNCIA PENAL DE: salvatierra..."
    }
  ]
}
```

### Ejemplo de Request con cURL

```bash
curl -X POST http://localhost:8000/api/denuncias-dinamicas/procesar-json \
  -H "Content-Type: application/json" \
  -d @denuncias.json
```

### Respuesta Exitosa

```json
{
  "procesadas": 10,
  "errores": 0,
  "detalles": [
    {
      "index": 0,
      "denuncia_id": 1,
      "registro_id": 1,
      "status": "success"
    },
    {
      "index": 1,
      "denuncia_id": 2,
      "registro_id": 2,
      "status": "success"
    }
  ]
}
```

### Respuesta con Errores

```json
{
  "procesadas": 8,
  "errores": 2,
  "detalles": [
    {
      "index": 5,
      "error": "Error al procesar persona: DNI inválido",
      "status": "error"
    },
    {
      "index": 7,
      "error": "Fecha de hecho en formato inválido",
      "status": "error"
    }
  ]
}
```

---

## 2. Consultas Dinámicas

### Filtros Básicos

#### Por Ubicación Geográfica
```bash
# Filtrar por múltiples departamentales
GET /api/denuncias-dinamicas/consultar?departamentales=1,2,3

# Filtrar por localidades y barrios
GET /api/denuncias-dinamicas/consultar?localidades=1,5,10&barrios=2,8,15

# Filtrar por zona
GET /api/denuncias-dinamicas/consultar?zonas[]=URBANO / SUBURBANO&zonas[]=RURAL
```

#### Por Tiempo
```bash
# Rango de fechas del hecho
GET /api/denuncias-dinamicas/consultar?fecha_hecho_desde=2025-01-01&fecha_hecho_hasta=2025-12-31

# Filtrar por franjas horarias
GET /api/denuncias-dinamicas/consultar?franjas_horarias[]=06:00 A 11:59&franjas_horarias[]=12:00 A 17:59

# Filtrar por fechas de denuncia
GET /api/denuncias-dinamicas/consultar?fecha_denuncia_desde=2025-07-01&fecha_denuncia_hasta=2025-07-31
```

#### Por Personas Involucradas
```bash
# Filtrar por género y edad
GET /api/denuncias-dinamicas/consultar?generos_personas=1,2&edad_minima=18&edad_maxima=65

# Filtrar por nacionalidad
GET /api/denuncias-dinamicas/consultar?nacionalidades[]=ARGENTINA&nacionalidades[]=BOLIVIANA

# Filtrar por rol (denunciante, imputado, víctima)
GET /api/denuncias-dinamicas/consultar?roles_personas=1,2
```

### Filtros Avanzados

#### Por Hechos Delictivos
```bash
# Múltiples tipificaciones y calificaciones
GET /api/denuncias-dinamicas/consultar?tipificaciones=1,5,10&calificaciones=2,7

# Por modalidad y tipo de arma
GET /api/denuncias-dinamicas/consultar?modalidades[]=ARREBATO&modalidades[]=ESCALAMIENTO&tipos_arma[]=ARMA DE FUEGO

# Por categoría de hechos
GET /api/denuncias-dinamicas/consultar?categorias_hechos[]=DELITOS CONTRA LA PROPIEDAD&categorias_hechos[]=DELITOS CONTRA LAS PERSONAS
```

#### Por Elementos
```bash
# Filtrar por tipo y condición de elementos
GET /api/denuncias-dinamicas/consultar?tipos_elementos[]=CELULAR&tipos_elementos[]=VEHICULO&condiciones_elementos[]=SUSTRAIDO

# Por marcas y rango de valor
GET /api/denuncias-dinamicas/consultar?marcas[]=SAMSUNG&marcas[]=APPLE&valor_minimo=50000&valor_maximo=500000
```

#### Búsqueda por Texto
```bash
# Búsqueda general
GET /api/denuncias-dinamicas/consultar?search=Juan Perez

# Búsqueda en campos específicos
GET /api/denuncias-dinamicas/consultar?search=Samsung&search_fields[]=elementos&search_fields[]=descripcion
```

### Filtros Geoespaciales

#### Por Coordenadas
```bash
# Búsqueda por radio (5km alrededor de un punto)
GET /api/denuncias-dinamicas/consultar?coordenada_central[]=-27.7833&coordenada_central[]=-64.2667&radio_busqueda=5

# Búsqueda por área rectangular (bounding box)
GET /api/denuncias-dinamicas/consultar?coordenadas_bbox[]=-27.8&coordenadas_bbox[]=-64.3&coordenadas_bbox[]=-27.7&coordenadas_bbox[]=-64.2
```

### Configuración de Respuesta

#### Paginación y Ordenamiento
```bash
# Paginación
GET /api/denuncias-dinamicas/consultar?per_page=20&sort=created_at&direction=desc

# Obtener todos los resultados (sin paginación)
GET /api/denuncias-dinamicas/consultar?all=true

# Ordenamiento personalizado
GET /api/denuncias-dinamicas/consultar?sort=departamental_id&direction=asc
```

#### Eager Loading
```bash
# Cargar relaciones específicas (más rápido)
GET /api/denuncias-dinamicas/consultar?departamentales=1,2

# Cargar todas las relaciones (más completo pero más lento)
GET /api/denuncias-dinamicas/consultar?with_all_relations=true
```

### Consultas Complejas - Ejemplos Reales

#### 1. Robos en zona céntrica en horario nocturno
```bash
GET /api/denuncias-dinamicas/consultar?\
  tipificaciones=15&\
  franjas_horarias[]=18:00 A 23:59&franjas_horarias[]=00:00 A 05:59&\
  zonas[]=URBANO / SUBURBANO&\
  localidades=1,2,3&\
  fecha_hecho_desde=2025-01-01&\
  per_page=50
```

#### 2. Denuncias con elementos de alto valor en el último mes
```bash
GET /api/denuncias-dinamicas/consultar?\
  valor_minimo=100000&\
  fecha_denuncia_desde=2025-06-23&\
  condiciones_elementos[]=SUSTRAIDO&\
  sort=created_at&direction=desc&\
  with_all_relations=true
```

#### 3. Casos de violencia de género con imputados conocidos
```bash
GET /api/denuncias-dinamicas/consultar?\
  categorias_hechos[]=DELITOS CONTRA LAS PERSONAS&\
  generos_personas=2&\
  search=CONOCIDO&\
  competencias[]=VIOLENCIA DE GENERO&\
  per_page=25
```

#### 4. Análisis geográfico de hurtos de vehículos
```bash
GET /api/denuncias-dinamicas/consultar?\
  tipos_elementos[]=VEHICULO&\
  tipificaciones=19&\
  coordenada_central[]=-27.7833&coordenada_central[]=-64.2667&\
  radio_busqueda=10&\
  incluir_estadisticas=true&\
  agrupar_por[]=barrio&agrupar_por[]=franja_horaria
```

### Respuesta de Consulta

#### Respuesta Paginada
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "created_at": "2025-07-23T15:30:00.000000Z",
      "denuncia": {
        "id": 1,
        "numero": "131234",
        "fecha_denuncia": "2025-07-22",
        "relato": "° 131234 HURTO DENUNCIA PENAL DE: salvatierra..."
      },
      "tiempoEspacio": {
        "fecha_hecho": "2025-07-22",
        "franja_horaria": "12:00 A 17:59",
        "localidad": {
          "nombre": "COLONIA EL SIMBOLAR"
        },
        "barrio": null
      },
      "personas": [
        {
          "persona": {
            "nombre": "EDGARDO MATIAS",
            "apellido": "SALVATIERRA",
            "dni": "42021259",
            "edad": 46
          },
          "rolPersonaRegistro": {
            "nombre": "DENUNCIANTE"
          }
        }
      ],
      "hechos": [
        {
          "tipificacion": {
            "nombre": "HURTOS"
          },
          "modalidad": null
        }
      ],
      "elementos": [
        {
          "condicion": "SUSTRAIDO",
          "descripcion": "CAJA DE HERRAMIENTAS"
        }
      ]
    }
  ],
  "first_page_url": "http://localhost:8000/api/denuncias-dinamicas/consultar?page=1",
  "from": 1,
  "last_page": 5,
  "per_page": 15,
  "to": 15,
  "total": 67
}
```

---

## Validaciones

### Campos Requeridos para Procesamiento
- `denuncias`: Array de objetos de denuncia (mínimo 1)
- Cada denuncia debe ser un objeto válido

### Validaciones de Consulta
- **Fechas**: No pueden ser futuras, fecha_hasta >= fecha_desde
- **Coordenadas**: Latitud [-90, 90], Longitud [-180, 180]
- **Edades**: Entre 0 y 150 años
- **Paginación**: Máximo 100 resultados por página
- **Búsqueda**: Mínimo 3 caracteres

### Códigos de Error Comunes

| Código | Descripción |
|--------|-------------|
| 422 | Datos de validación inválidos |
| 500 | Error interno del servidor durante procesamiento |
| 400 | Request malformado |

---

## Optimización y Rendimiento

### Consejos para Consultas Eficientes

1. **Use filtros específicos**: Evite consultas muy amplias sin filtros
2. **Paginación**: Use `per_page` apropiado (15-50 resultados)
3. **Eager Loading**: Use `with_all_relations=true` solo cuando necesite todos los datos
4. **Índices**: Los campos más consultados están indexados (departamental_id, localidad_id, etc.)

### Límites del Sistema
- **Procesamiento JSON**: Máximo 1000 denuncias por request
- **Consultas**: Máximo 100 resultados por página
- **Búsqueda por texto**: Mínimo 3 caracteres
- **Radio geográfico**: Máximo 100km

---

## Casos de Uso Comunes

### 1. Importación Masiva de Denuncias
```javascript
// Procesar archivo JSON grande en lotes
const denuncias = JSON.parse(fs.readFileSync('denuncias.json'));
const lotes = chunk(denuncias, 100); // Dividir en lotes de 100

for (const lote of lotes) {
  const response = await fetch('/api/denuncias-dinamicas/procesar-json', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ denuncias: lote })
  });
}
```

### 2. Dashboard de Estadísticas
```javascript
// Obtener estadísticas por departamental
const stats = await fetch('/api/denuncias-dinamicas/consultar?' + 
  'agrupar_por[]=departamental&' +
  'incluir_estadisticas=true&' +
  'fecha_hecho_desde=2025-01-01'
);
```

### 3. Búsqueda de Casos Similares
```javascript
// Buscar casos similares por elementos y modalidad
const similares = await fetch('/api/denuncias-dinamicas/consultar?' +
  'tipos_elementos[]=CELULAR&' +
  'modalidades[]=ARREBATO&' +
  'coordenada_central[]=-27.7833&coordenada_central[]=-64.2667&' +
  'radio_busqueda=2'
);
```

---

## Soporte y Troubleshooting

### Logs
Los errores se registran en `storage/logs/laravel.log` con detalles específicos de cada denuncia procesada.

### Debugging
Use el parámetro `debug=true` en desarrollo para obtener información adicional sobre las consultas SQL generadas.

### Contacto
Para problemas técnicos o mejoras, contactar al equipo de desarrollo.
