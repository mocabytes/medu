<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@example.com';
$password = 'secreto123';
$name = 'Admin Test';

$role = Role::firstOrCreate(
    ['name' => 'admin'],
    ['description' => 'Administrador']
);

$user = User::where('email', $email)->first();
if ($user) {
    $user->update(['role_id' => $role->id]);
    echo "Updated existing user: {$user->id} ({$user->email})\n";
} else {
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'role_id' => $role->id,
    ]);
    echo "Created new admin user: {$user->id} ({$user->email})\n";
}

echo "Role: {$role->name}\n";

echo "Credentials: email={$email} password={$password}\n";
