<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicina;
use App\Models\Categoria;

class MedicinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener categorías existentes
        $categorias = Categoria::all()->keyBy('nombre');

        $medicinas = [
            // Analgésicos
            [
                'nombre_comercial' => 'Paracetamol Kern Pharma 500mg',
                'principio_activo' => 'Paracetamol',
                'precio_compra' => 2.50,
                'precio_venta' => 3.50,
                'stock_actual' => 150,
                'categoria' => 'Analgésicos'
            ],
            [
                'nombre_comercial' => 'Ibuprofeno Normon 600mg',
                'principio_activo' => 'Ibuprofeno',
                'precio_compra' => 3.00,
                'precio_venta' => 4.20,
                'stock_actual' => 200,
                'categoria' => 'Analgésicos'
            ],
            [
                'nombre_comercial' => 'Enantyum 25mg',
                'principio_activo' => 'Dexketoprofeno',
                'precio_compra' => 4.20,
                'precio_venta' => 5.80,
                'stock_actual' => 75,
                'categoria' => 'Analgésicos'
            ],
            [
                'nombre_comercial' => 'Nolotil 575mg',
                'principio_activo' => 'Metamizol',
                'precio_compra' => 2.10,
                'precio_venta' => 2.90,
                'stock_actual' => 120,
                'categoria' => 'Analgésicos'
            ],
            [
                'nombre_comercial' => 'Tramadol Retard 100mg',
                'principio_activo' => 'Tramadol',
                'precio_compra' => 6.20,
                'precio_venta' => 8.50,
                'stock_actual' => 45,
                'categoria' => 'Analgésicos'
            ],

            // Antibióticos
            [
                'nombre_comercial' => 'Amoxicilina Normon 500mg',
                'principio_activo' => 'Amoxicilina',
                'precio_compra' => 4.50,
                'precio_venta' => 6.20,
                'stock_actual' => 180,
                'categoria' => 'Antibióticos'
            ],
            [
                'nombre_comercial' => 'Augmentine 875/125mg',
                'principio_activo' => 'Amoxicilina + Ácido Clavulánico',
                'precio_compra' => 9.00,
                'precio_venta' => 12.50,
                'stock_actual' => 90,
                'categoria' => 'Antibióticos'
            ],
            [
                'nombre_comercial' => 'Azitromicina Teva 500mg',
                'principio_activo' => 'Azitromicina',
                'precio_compra' => 7.10,
                'precio_venta' => 9.80,
                'stock_actual' => 65,
                'categoria' => 'Antibióticos'
            ],
            [
                'nombre_comercial' => 'Ciprofloxacino Stada 500mg',
                'principio_activo' => 'Ciprofloxacino',
                'precio_compra' => 5.30,
                'precio_venta' => 7.30,
                'stock_actual' => 110,
                'categoria' => 'Antibióticos'
            ],
            [
                'nombre_comercial' => 'Doxiciclina Cinfa 100mg',
                'principio_activo' => 'Doxiciclina',
                'precio_compra' => 3.90,
                'precio_venta' => 5.40,
                'stock_actual' => 85,
                'categoria' => 'Antibióticos'
            ],

            // Antiinflamatorios
            [
                'nombre_comercial' => 'Diclofenaco Llorens 50mg',
                'principio_activo' => 'Diclofenaco',
                'precio_compra' => 3.50,
                'precio_venta' => 4.80,
                'stock_actual' => 140,
                'categoria' => 'Antiinflamatorios'
            ],
            [
                'nombre_comercial' => 'Naproxeno Rovi 550mg',
                'principio_activo' => 'Naproxeno',
                'precio_compra' => 4.40,
                'precio_venta' => 6.10,
                'stock_actual' => 95,
                'categoria' => 'Antiinflamatorios'
            ],
            [
                'nombre_comercial' => 'Celecoxib Pfizer 200mg',
                'principio_activo' => 'Celecoxib',
                'precio_compra' => 11.00,
                'precio_venta' => 15.20,
                'stock_actual' => 40,
                'categoria' => 'Antiinflamatorios'
            ],
            [
                'nombre_comercial' => 'Piroxicam Mylan 20mg',
                'principio_activo' => 'Piroxicam',
                'precio_compra' => 2.80,
                'precio_venta' => 3.90,
                'stock_actual' => 70,
                'categoria' => 'Antiinflamatorios'
            ],

            // Antihistamínicos
            [
                'nombre_comercial' => 'Loratadina Cinfa 10mg',
                'principio_activo' => 'Loratadina',
                'precio_compra' => 1.80,
                'precio_venta' => 2.50,
                'stock_actual' => 200,
                'categoria' => 'Antihistamínicos'
            ],
            [
                'nombre_comercial' => 'Cetirizina Ratiopharm 10mg',
                'principio_activo' => 'Cetirizina',
                'precio_compra' => 2.30,
                'precio_venta' => 3.20,
                'stock_actual' => 175,
                'categoria' => 'Antihistamínicos'
            ],
            [
                'nombre_comercial' => 'Bilastina Almirall 20mg',
                'principio_activo' => 'Bilastina',
                'precio_compra' => 5.60,
                'precio_venta' => 7.80,
                'stock_actual' => 85,
                'categoria' => 'Antihistamínicos'
            ],
            [
                'nombre_comercial' => 'Fexofenadina Teva 180mg',
                'principio_activo' => 'Fexofenadina',
                'precio_compra' => 6.40,
                'precio_venta' => 8.90,
                'stock_actual' => 60,
                'categoria' => 'Antihistamínicos'
            ],

            // Antipiréticos
            [
                'nombre_comercial' => 'Aspirina 500mg',
                'principio_activo' => 'Ácido Acetilsalicílico',
                'precio_compra' => 1.50,
                'precio_venta' => 2.10,
                'stock_actual' => 250,
                'categoria' => 'Antipiréticos'
            ],
            [
                'nombre_comercial' => 'Termalgin 500mg',
                'principio_activo' => 'Paracetamol',
                'precio_compra' => 2.40,
                'precio_venta' => 3.30,
                'stock_actual' => 190,
                'categoria' => 'Antipiréticos'
            ],

            // Cardiovasculares
            [
                'nombre_comercial' => 'Enalapril Normon 20mg',
                'principio_activo' => 'Enalapril',
                'precio_compra' => 3.30,
                'precio_venta' => 4.50,
                'stock_actual' => 130,
                'categoria' => 'Cardiovasculares'
            ],
            [
                'nombre_comercial' => 'Amlodipino Cinfa 5mg',
                'principio_activo' => 'Amlodipino',
                'precio_compra' => 3.80,
                'precio_venta' => 5.20,
                'stock_actual' => 115,
                'categoria' => 'Cardiovasculares'
            ],
            [
                'nombre_comercial' => 'Losartán Teva 50mg',
                'principio_activo' => 'Losartán',
                'precio_compra' => 4.90,
                'precio_venta' => 6.80,
                'stock_actual' => 100,
                'categoria' => 'Cardiovasculares'
            ],
            [
                'nombre_comercial' => 'Atorvastatina Pfizer 20mg',
                'principio_activo' => 'Atorvastatina',
                'precio_compra' => 6.90,
                'precio_venta' => 9.50,
                'stock_actual' => 80,
                'categoria' => 'Cardiovasculares'
            ],
            [
                'nombre_comercial' => 'Omeprazol Cinfa 20mg',
                'principio_activo' => 'Omeprazol',
                'precio_compra' => 2.00,
                'precio_venta' => 2.80,
                'stock_actual' => 220,
                'categoria' => 'Cardiovasculares'
            ],

            // Gastrointestinales
            [
                'nombre_comercial' => 'Omeprazol Mylan 40mg',
                'principio_activo' => 'Omeprazol',
                'precio_compra' => 3.00,
                'precio_venta' => 4.20,
                'stock_actual' => 160,
                'categoria' => 'Gastrointestinales'
            ],
            [
                'nombre_comercial' => 'Pantoprazol Teva 40mg',
                'principio_activo' => 'Pantoprazol',
                'precio_compra' => 4.00,
                'precio_venta' => 5.60,
                'stock_actual' => 125,
                'categoria' => 'Gastrointestinales'
            ],
            [
                'nombre_comercial' => 'Metoclopramida Normon 10mg',
                'principio_activo' => 'Metoclopramida',
                'precio_compra' => 1.70,
                'precio_venta' => 2.40,
                'stock_actual' => 180,
                'categoria' => 'Gastrointestinales'
            ],
            [
                'nombre_comercial' => 'Loperamida Ratiopharm 2mg',
                'principio_activo' => 'Loperamida',
                'precio_compra' => 2.20,
                'precio_venta' => 3.10,
                'stock_actual' => 145,
                'categoria' => 'Gastrointestinales'
            ],

            // Respiratorios
            [
                'nombre_comercial' => 'Salbutamol Ventolin 100mcg',
                'principio_activo' => 'Salbutamol',
                'precio_compra' => 6.20,
                'precio_venta' => 8.50,
                'stock_actual' => 90,
                'categoria' => 'Respiratorios'
            ],
            [
                'nombre_comercial' => 'Budesonida Pulmicort 200mcg',
                'principio_activo' => 'Budesonida',
                'precio_compra' => 8.90,
                'precio_venta' => 12.30,
                'stock_actual' => 55,
                'categoria' => 'Respiratorios'
            ],
            [
                'nombre_comercial' => 'Montelukast Singulair 10mg',
                'principio_activo' => 'Montelukast',
                'precio_compra' => 13.40,
                'precio_venta' => 18.50,
                'stock_actual' => 40,
                'categoria' => 'Respiratorios'
            ],
            [
                'nombre_comercial' => 'Ambroxol Mucosan 30mg',
                'principio_activo' => 'Ambroxol',
                'precio_compra' => 2.70,
                'precio_venta' => 3.70,
                'stock_actual' => 165,
                'categoria' => 'Respiratorios'
            ],

            // Suplementos
            [
                'nombre_comercial' => 'Vitamina C Bayer 500mg',
                'principio_activo' => 'Ácido Ascórbico',
                'precio_compra' => 3.50,
                'precio_venta' => 4.80,
                'stock_actual' => 200,
                'categoria' => 'Suplementos y Vitaminas'
            ],
            [
                'nombre_comercial' => 'Vitamina D3 Cinfa 1000UI',
                'principio_activo' => 'Colecalciferol',
                'precio_compra' => 3.80,
                'precio_venta' => 5.20,
                'stock_actual' => 175,
                'categoria' => 'Suplementos y Vitaminas'
            ],
            [
                'nombre_comercial' => 'Omega-3 Sandoz 1000mg',
                'principio_activo' => 'Ácidos Grasos Omega-3',
                'precio_compra' => 6.70,
                'precio_venta' => 9.20,
                'stock_actual' => 85,
                'categoria' => 'Suplementos y Vitaminas'
            ],
            [
                'nombre_comercial' => 'Hierro Ferrosan 100mg',
                'principio_activo' => 'Sulfato Ferroso',
                'precio_compra' => 4.60,
                'precio_venta' => 6.40,
                'stock_actual' => 120,
                'categoria' => 'Suplementos y Vitaminas'
            ],

            // Antidiabéticos
            [
                'nombre_comercial' => 'Metformina Cinfa 850mg',
                'principio_activo' => 'Metformina',
                'precio_compra' => 2.80,
                'precio_venta' => 3.90,
                'stock_actual' => 150,
                'categoria' => 'Antidiabéticos'
            ],
            [
                'nombre_comercial' => 'Sitagliptina Januvia 100mg',
                'principio_activo' => 'Sitagliptina',
                'precio_compra' => 16.30,
                'precio_venta' => 22.50,
                'stock_actual' => 35,
                'categoria' => 'Antidiabéticos'
            ],
            [
                'nombre_comercial' => 'Empagliflozina Jardiance 10mg',
                'principio_activo' => 'Empagliflozina',
                'precio_compra' => 20.80,
                'precio_venta' => 28.80,
                'stock_actual' => 25,
                'categoria' => 'Antidiabéticos'
            ],
        ];

        foreach ($medicinas as $medicina) {
            $categoria = $categorias->get($medicina['categoria']);
            
            if ($categoria) {
                Medicina::firstOrCreate(
                    [
                        'nombre_comercial' => $medicina['nombre_comercial'],
                        'categoria_id' => $categoria->id,
                    ],
                    [
                        'principio_activo' => $medicina['principio_activo'],
                        'precio_compra' => $medicina['precio_compra'],
                        'precio_venta' => $medicina['precio_venta'],
                        'stock_actual' => $medicina['stock_actual'],
                    ]
                );
            }
        }
    }
}
