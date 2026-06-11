<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedores = [
            [
                'nombre' => 'Bayer Hispania S.A.',
                'telefono' => '+34 900 101 010',
                'email' => 'contacto@bayer.es',
                'direccion' => 'C/ Barcelona, 203, 08021 Barcelona, España'
            ],
            [
                'nombre' => 'Pizer Laboratories S.L.',
                'telefono' => '+34 900 200 300',
                'email' => 'pedidos@pizer.es',
                'direccion' => 'Av. de la Industria, 45, 28021 Madrid, España'
            ],
            [
                'nombre' => 'Novartis Farmacéutica S.A.',
                'telefono' => '+34 900 300 400',
                'email' => 'comercial@novartis.es',
                'direccion' => 'C/ Ronda de la Comunicación, 11, 28031 Madrid, España'
            ],
            [
                'nombre' => 'Laboratorios Almirall S.A.',
                'telefono' => '+34 900 400 500',
                'email' => 'info@almirall.com',
                'direccion' => 'C/ Sant Joan, 123, 08940 Cornellà de Llobregat, Barcelona, España'
            ],
            [
                'nombre' => 'Laboratorios Farmacéuticos Rovi S.A.',
                'telefono' => '+34 900 500 600',
                'email' => 'proveedores@rovi.es',
                'direccion' => 'C/ Julián Camarillo, 35, 28037 Madrid, España'
            ],
            [
                'nombre' => 'Laboratorios Cinfa S.A.',
                'telefono' => '+34 900 600 700',
                'email' => 'compras@cinfa.com',
                'direccion' => 'C/ Olaz-Chipi, 10, 31610 Huarte-Pamplona, España'
            ],
            [
                'nombre' => 'Laboratorios Teva S.L.U.',
                'telefono' => '+34 900 700 800',
                'email' => 'pedidos@teva.es',
                'direccion' => 'C/ Alcalá, 440, 28027 Madrid, España'
            ],
            [
                'nombre' => 'Laboratorios Mylan S.L.',
                'telefono' => '+34 900 800 900',
                'email' => 'contacto@mylan.es',
                'direccion' => 'C/ María de Molina, 52, 28006 Madrid, España'
            ],
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::firstOrCreate(
                ['nombre' => $proveedor['nombre']],
                [
                    'telefono' => $proveedor['telefono'],
                    'email' => $proveedor['email'],
                    'direccion' => $proveedor['direccion'],
                ]
            );
        }
    }
}
