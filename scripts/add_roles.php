<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Role;

$roles = [
    ['name' => 'admin', 'description' => 'Acceso total al sistema'],
    ['name' => 'farmaceutico', 'description' => 'Acceso operativo de farmacia'],
    ['name' => 'supervisor', 'description' => 'Supervisa operaciones y reportes'],
    ['name' => 'auditor', 'description' => 'Acceso para auditoría y consultas'],
    ['name' => 'contador', 'description' => 'Responsable de contabilidad y finanzas'],
    ['name' => 'almacenista', 'description' => 'Gestión de almacén y recepciones'],
];

foreach ($roles as $r) {
    $role = Role::firstOrCreate(['name' => $r['name']], ['description' => $r['description']]);
    echo "Ensured role: {$role->id} - {$role->name}\n";
}

echo "Done.\n";
