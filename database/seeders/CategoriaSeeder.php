<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nome_categoria' => 'Eletrodomésticos',
            ],
            [
                'nome_categoria' => 'Informática',
            ],
            [
                'nome_categoria' => 'Smartphones e Tablets',
            ],
            [
                'nome_categoria' => 'Eletrônicos',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}