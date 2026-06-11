<?php
// Form Request para validar datos de Medicina
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMedicinaRequest extends FormRequest
{
    public function authorize()
    {
        // Puedes usar policies aquí si lo deseas
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'requiere_receta' => $this->has('requiere_receta'),
        ]);
    }

    public function rules()
    {
        $medicinaId = $this->route('medicina');

        return [
            'nombre_comercial' => 'required|string|max:255',
            'principio_activo' => 'required|string|max:255',
            'presentacion' => 'nullable|string|max:255',
            'concentracion' => 'nullable|string|max:255',
            'laboratorio' => 'nullable|string|max:255',
            'codigo_barras' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('medicinas', 'codigo_barras')->ignore($medicinaId),
            ],
            'ubicacion' => 'nullable|string|max:255',
            'stock_minimo' => 'required|integer|min:0',
            'requiere_receta' => 'boolean',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'categoria_id' => 'required',
            'nueva_categoria' => 'nullable|required_if:categoria_id,nueva|string|max:255',
        ];
    }
}
