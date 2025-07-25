<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategoria;

class SubCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategorias = [
            [
                'sub_categoria' => 'Grandes Eletrodomésticos',
                'categoria_id' => 1,
            ],
            [
                'sub_categoria' => 'Pequenos Eletrodomésticos',
                'categoria_id' => 1, 
            ],
            [
                'sub_categoria' => 'Computadores e Monitores',
                'categoria_id' => 2,
            ],
            [
                'sub_categoria' => 'Acessórios de Telemóveis',
                'categoria_id' => 3, 
            ],
            [
                'sub_categoria' => 'Televisores',
                'categoria_id' => 4,
            ],
            [
                'sub_categoria' => 'TV e Vídeo',
                'categoria_id' => 4,
            ],
            [
                'sub_categoria' => 'Jogos e Consolas',
                'categoria_id' => 4,
            ],
            [
                'sub_categoria' => 'Livros e E-readers',
                'categoria_id' => 4,
            ],
        ];

        foreach ($subcategorias as $subcategoria) {
            SubCategoria::create($subcategoria);
        }
    }
}