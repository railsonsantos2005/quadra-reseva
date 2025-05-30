<?php

namespace Database\Seeders;

use App\Models\Quadra;
use Illuminate\Database\Seeder;

class QuadraSeeder extends Seeder
{
    public function run()
    {
        Quadra::create([
            'nome' => 'Quadra 1',
            'tipo' => 'Futsal',
            'disponivel' => true,
            'descricao' => 'Quadra principal para futsal, com piso sintético'
        ]);

        Quadra::create([
            'nome' => 'Quadra 2',
            'tipo' => 'Basquete',
            'disponivel' => true,
            'descricao' => 'Quadra coberta para basquete, com piso de madeira'
        ]);

        Quadra::create([
            'nome' => 'Quadra 3',
            'tipo' => 'Vôlei',
            'disponivel' => false,
            'descricao' => 'Quadra de vôlei em manutenção'
        ]);
    }
}
