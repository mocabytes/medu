<?php
// Form Request para validar datos de Movimiento
namespace App\Http\Requests;

use App\Models\Lote;
use App\Models\Medicina;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovimientoRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() !== null;
    }

    public function rules()
    {
        return [
            'medicina_id' => ['required', 'exists:medicinas,id'],
            'lote_id' => ['nullable', 'exists:lotes,id'],
            'tipo_movimiento' => ['required', Rule::in(['Entrada', 'Salida'])],
            'cantidad' => ['required', 'integer', 'min:1'],
            'fecha' => ['required', 'date'],
            'motivo' => ['required', Rule::in(['compra', 'venta', 'merma', 'devolucion'])],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (! $this->filled('medicina_id') || ! $this->filled('tipo_movimiento') || ! $this->filled('cantidad')) {
                return;
            }

            $medicina = Medicina::find($this->input('medicina_id'));
            if ($medicina && $this->input('tipo_movimiento') === 'Salida' && $this->input('cantidad') > $medicina->stock_actual) {
                $validator->errors()->add('cantidad', 'La cantidad a retirar supera el stock actual de la medicina.');
            }

            if ($this->filled('lote_id') && $this->input('tipo_movimiento') === 'Salida') {
                $lote = Lote::find($this->input('lote_id'));
                if ($lote && $this->input('cantidad') > $lote->cantidad_restante) {
                    $validator->errors()->add('cantidad', 'La cantidad a retirar supera la cantidad restante del lote seleccionado.');
                }
            }
        });
    }
}
