<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $clientes = [
            [
                'Nombre' => 'Cliente 1',
                'email' => 'cliente1@example.com',
                'telefono' => '123456789',
                'direccion' => 'Direccion 1',
                'tipocliente_id' => '1',
            ],
            [
                'Nombre' => 'Cliente 2',
                'email' => 'cliente2@example.com',
                'telefono' => '123456789',
                'direccion' => 'Direccion 2',
                'tipocliente_id' => '2',
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
