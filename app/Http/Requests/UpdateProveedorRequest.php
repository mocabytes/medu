<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        $proveedor = $this->route('proveedor');
        return $this->user()->can('update', $proveedor);
    }

    public function rules(): array
    {
        $proveedor = $this->route('proveedor');

        return [
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('proveedores', 'email')->ignore($proveedor->id)],
            'direccion' => ['nullable', 'string', 'max:255'],
        ];
    }
}
