<?php

namespace App\Http\Requests\DenunciasDinamicas;

use Illuminate\Foundation\Http\FormRequest;

class ProcesarDenunciasJsonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'denuncias' => 'required|array|min:1',
            'denuncias.*' => 'required|array',
            
            // Campos básicos requeridos
            'denuncias.*.TIPO DE INTERVENCION ' => 'nullable|string|max:255',
            'denuncias.*.DEPARTAMENTAL ' => 'nullable|string|max:255',
            'denuncias.*.CRIAS. Y SUBCRIAS' => 'nullable|string|max:255',
            
            // Fechas
            'denuncias.*.FECHA DEL HECHO' => 'nullable|string',
            'denuncias.*.FECHA DE LA DENUNCIA ' => 'nullable|string',
            'denuncias.*.HORA DEL HECHO (NO COLOCAR HS.)' => 'nullable|string|max:10',
            'denuncias.*.HORA DE DENUNCIA' => 'nullable|string|max:10',
            'denuncias.*.FRANJA HORARIA' => 'nullable|string|max:255',
            
            // Ubicación
            'denuncias.*.DPTO. PROVINCIAL ' => 'nullable|string|max:255',
            'denuncias.*.LOCALIDAD ' => 'nullable|string|max:255',
            'denuncias.*.BARRIO' => 'nullable|string|max:255',
            'denuncias.*.TIPO DE LUGAR' => 'nullable|string|max:255',
            'denuncias.*.TIPO DE VIA ' => 'nullable|string|max:100',
            'denuncias.*.CALLE / RUTA / MZNA ' => 'nullable|string|max:255',
            'denuncias.*.ALTURA / KM / LOTE' => 'nullable|string|max:100',
            'denuncias.*.ZONA' => 'nullable|string|max:100',
            'denuncias.*.LATITUD ' => 'nullable|numeric|between:-90,90',
            'denuncias.*.LONGITUD' => 'nullable|numeric|between:-180,180',
            
            // Funcionario
            'denuncias.*.JERARQUIA (TOMÓ LA DENUNCIA)' => 'nullable|string|max:255',
            'denuncias.*.APELLIDO Y NOMBRE FUNC. (TOMÓ LA DENUNCIA)' => 'nullable|string|max:255',
            
            // Denunciante
            'denuncias.*.APELLIDOS Y NOMBRES  (DENUNCIANTE.)' => 'nullable|string|max:255',
            'denuncias.*.DNI (DENUNCIANTE.)' => 'nullable|numeric',
            'denuncias.*.FECHA NAC. (DENUNCIANTE.)' => 'nullable|string',
            'denuncias.*.EDAD (DENUNCIANTE)' => 'nullable|integer|min:0|max:150',
            'denuncias.*.SEXO  (DENUNCIANTE)' => 'nullable|string|max:255',
            'denuncias.*.GENERO (DENUNC.)' => 'nullable|string|max:255',
            'denuncias.*.NACIONALIDAD (ej. ARGENTINA) (DENUNCIANTE.)\n' => 'nullable|string|max:100',
            'denuncias.*.OCUPACION (DENUNCIANTE)' => 'nullable|string|max:255',
            'denuncias.*.NIVEL DE INSTRUCCION (DENUNCIANTE)' => 'nullable|string|max:255',
            'denuncias.*.DOMICILIO (DENUNCIANTE)' => 'nullable|string|max:500',
            
            // Víctima/Damnificado
            'denuncias.*.EL DENUNCIANTE ES EL MISMO QUE DAMNIFICADO ?' => 'nullable|string|max:10',
            'denuncias.*.APELLIDOS Y NOMBRES - ENTIDAD (DAMNIF / VICT.)' => 'nullable|string|max:255',
            'denuncias.*.DNI (DAMIF / VICT.)' => 'nullable|numeric',
            'denuncias.*.EDAD (DAMNIF / VICT.)' => 'nullable|numeric|min:0|max:150',
            
            // Imputados
            'denuncias.*.IMPUTADO/ INCULPADO (IMPUT 1)' => 'nullable|string|max:255',
            'denuncias.*.APELLIDOS Y NOMBRES  (IMPUT 1)' => 'nullable|string|max:255',
            'denuncias.*.ALIAS / APODO (IMPUT 1)' => 'nullable|string|max:100',
            'denuncias.*.DNI (IMPUT 1)' => 'nullable|numeric',
            'denuncias.*.EDAD (IMPUT 1)' => 'nullable|numeric|min:0|max:150',
            'denuncias.*.SEXO  (IMPUT 1)' => 'nullable|string|max:255',
            'denuncias.*.GENERO (IMPUT 1)' => 'nullable|string|max:255',
            'denuncias.*.NACIONALIDAD (IMPUT 1)' => 'nullable|string|max:100',
            'denuncias.*.OCUPACION (IMPUT 1)' => 'nullable|string|max:255',
            'denuncias.*.VINCULO CON LA VICTIMA (IMPUT 1)' => 'nullable|string|max:255',
            
            // Imputado 2
            'denuncias.*.APELLIDOS Y NOMBRES  (IMPUT  2)' => 'nullable|string|max:255',
            'denuncias.*.ALIAS / APODO (IMPUT 2)' => 'nullable|string|max:100',
            'denuncias.*.DNI (IMPUT 2)' => 'nullable|numeric',
            'denuncias.*.EDAD (IMPUT 2)' => 'nullable|numeric|min:0|max:150',
            
            // Hechos
            'denuncias.*.CATEGORIAS DE HECHOS' => 'nullable|string|max:255',
            'denuncias.*.CONTRA LAS PERSONAS (TIPIF)' => 'nullable|string|max:255',
            'denuncias.*.CONTRA LA PROPIEDAD (TIPIF)' => 'nullable|string|max:255',
            'denuncias.*.CONTRA LA LIBERTAD (TIPIF)' => 'nullable|string|max:255',
            'denuncias.*.CONTRA LA INTEGRIDAD SEXUAL  (TIPIF)' => 'nullable|string|max:255',
            'denuncias.*.CALIFICACION ' => 'nullable|string|max:255',
            'denuncias.*.TIPO DE ARMA / MECANISMO' => 'nullable|string|max:255',
            'denuncias.*.MODALIDAD' => 'nullable|string|max:255',
            'denuncias.*.TRANSPORTE DEL IMPUTADO' => 'nullable|string|max:255',
            
            // Elementos
            'denuncias.*.ELEMENTOS (CONDICION)' => 'nullable|string|max:100',
            'denuncias.*.ELEMENTOS ' => 'nullable|string|max:255',
            'denuncias.*.CANTIDAD ' => 'nullable|string|max:50',
            'denuncias.*.MARCA ' => 'nullable|string|max:100',
            'denuncias.*.MODELO' => 'nullable|string|max:100',
            'denuncias.*.DOMINIO ' => 'nullable|string|max:20',
            'denuncias.*.COLOR' => 'nullable|string|max:50',
            'denuncias.*.VALOR    $' => 'nullable|numeric|min:0',
            'denuncias.*.DESCRIPCION' => 'nullable|string|max:1000',
            
            // Información judicial
            'denuncias.*.CIRCUNSCRIPCIONES' => 'nullable|string|max:255',
            'denuncias.*.COMPETENCIA' => 'nullable|string|max:255',
            'denuncias.*.FISCALES ' => 'nullable|string|max:255',
            'denuncias.*.FECHA DE ESCLARECIDO' => 'nullable|string',
            'denuncias.*.DEP. QUE ESCLARECIO' => 'nullable|string|max:255',
            
            // Relato
            'denuncias.*.RELATO' => 'nullable|string|max:10000',
            'denuncias.*.LP DEL CARGADOR (ESTADISTICAS)' => 'nullable|numeric'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'denuncias.required' => 'Debe proporcionar al menos una denuncia para procesar.',
            'denuncias.array' => 'Las denuncias deben estar en formato array.',
            'denuncias.min' => 'Debe proporcionar al menos una denuncia.',
            'denuncias.*.required' => 'Cada denuncia debe ser un objeto válido.',
            'denuncias.*.array' => 'Cada denuncia debe ser un objeto válido.',
            
            // Mensajes para campos específicos
            'denuncias.*.LATITUD .between' => 'La latitud debe estar entre -90 y 90 grados.',
            'denuncias.*.LONGITUD.between' => 'La longitud debe estar entre -180 y 180 grados.',
            'denuncias.*.EDAD (DENUNCIANTE).min' => 'La edad del denunciante debe ser mayor a 0.',
            'denuncias.*.EDAD (DENUNCIANTE).max' => 'La edad del denunciante debe ser menor a 150.',
            'denuncias.*.DNI (DENUNCIANTE.).numeric' => 'El DNI del denunciante debe ser numérico.',
            'denuncias.*.VALOR    $.numeric' => 'El valor debe ser un número.',
            'denuncias.*.VALOR    $.min' => 'El valor no puede ser negativo.',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     */
    public function attributes(): array
    {
        return [
            'denuncias' => 'denuncias',
            'denuncias.*.TIPO DE INTERVENCION ' => 'tipo de intervención',
            'denuncias.*.DEPARTAMENTAL ' => 'departamental',
            'denuncias.*.FECHA DEL HECHO' => 'fecha del hecho',
            'denuncias.*.APELLIDOS Y NOMBRES  (DENUNCIANTE.)' => 'nombre del denunciante',
            'denuncias.*.DNI (DENUNCIANTE.)' => 'DNI del denunciante',
            'denuncias.*.EDAD (DENUNCIANTE)' => 'edad del denunciante',
            'denuncias.*.LATITUD ' => 'latitud',
            'denuncias.*.LONGITUD' => 'longitud',
            'denuncias.*.RELATO' => 'relato',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        
        // Agrupar errores por denuncia para mejor legibilidad
        $groupedErrors = [];
        foreach ($errors as $field => $messages) {
            if (preg_match('/denuncias\.(\d+)\.(.+)/', $field, $matches)) {
                $denunciaIndex = $matches[1];
                $fieldName = $matches[2];
                $groupedErrors["denuncia_{$denunciaIndex}"][$fieldName] = $messages;
            } else {
                $groupedErrors['general'][$field] = $messages;
            }
        }
        
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'message' => 'Los datos proporcionados no son válidos.',
            'errors' => $groupedErrors,
            'total_errors' => count($errors)
        ], 422));
    }
}
