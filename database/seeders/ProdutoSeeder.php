<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;
use Illuminate\Support\Str;
class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $produtos = Produto::all();
        foreach ($produtos as $produto) {
            $produto->slug = Str::slug($produto->descrição);
            $produto->save();
        }

        $produtos = [
            
            [
                'sku' => 1234567,
                'ean' => '1234567890123',
                'un' => 1,
                'categoria_id' => 1,
                'subcategoria_id' => 1,
                'descrição' => 'Frigorífico Combinado LG 320L',
                'contagem' => 5,
                'stock' => 7,
            ],
            [
                'sku' => 2345678,
                'ean' => '2345678901234',
                'un' => 2,
                'categoria_id' => 1,
                'subcategoria_id' => 1,
                'descrição' => 'Máquina de lavar roupa Bosch 8kg',
                'contagem' => 10,
                'stock' => 10,
            ],
           
            [
                'sku' => 3456789,
                'ean' => '3456789012345',
                'un' => 3,
                'categoria_id' => 1,
                'subcategoria_id' => 2,
                'descrição' => 'Aspirador Rowenta',
                'contagem' => 8,
                'stock' => 6,
            ],
            [
                'sku' => 4567890,
                'ean' => '4567890123456',
                'un' => 4,
                'categoria_id' => 1,
                'subcategoria_id' => 2,
                'descrição' => 'Liquidificadora Philips',
                'contagem' => 20,
                'stock' => 22,
            ],
            
            [
                'sku' => 5678901,
                'ean' => '5678901234567',
                'un' => 5,
                'categoria_id' => 2,
                'subcategoria_id' => 3,
                'descrição' => 'Portátil HP 15" Intel Core i5',
                'contagem' => 5,
                'stock' => 5,
            ],
            [
                'sku' => 6789012,
                'ean' => '6789012345678',
                'un' => 6,
                'categoria_id' => 2,
                'subcategoria_id' => 3,
                'descrição' => 'Monitor LG 27"',
                'contagem' => 5,
                'stock' => 5,
            ],
            
            [
                'sku' => 7890123,
                'ean' => '7890123456789',
                'un' => 1,
                'categoria_id' => 3,
                'subcategoria_id' => 4,
                'descrição' => 'Capa para iPhone 13',
                'contagem' => 10,
                'stock' => 10,
            ],
            [
                'sku' => 8901234,
                'ean' => '8901234567890',
                'un' => 2,
                'categoria_id' => 3,
                'subcategoria_id' => 4,
                'descrição' => 'Carregador sem fio Samsung',
                'contagem' => 10,
                'stock' => 15,
            ],
            
            [
                'sku' => 9012345,
                'ean' => '9012345678901',
                'un' => 3,
                'categoria_id' => 4,
                'subcategoria_id' => 5,
                'descrição' => 'TV Samsung 55" 4K',
                'contagem' => 10,
                'stock' => 15,
            ],
            
            [
                'sku' => 1112345,
                'ean' => '1112345678901',
                'un' => 4,
                'categoria_id' => 4,
                'subcategoria_id' => 6,
                'descrição' => 'Barra de som LG',
                'contagem' => 10,
                'stock' => 15,
            ],
            
            [
                'sku' => 1112346,
                'ean' => '1112345678902',
                'un' => 4,
                'categoria_id' => 4,
                'subcategoria_id' => 7,
                'descrição' => 'Playstation 5',
                'contagem' => 10,
                'stock' => 15,
            ],
            
            [
                'sku' => 1112347,
                'ean' => '1112345678903',
                'un' => 4,
                'categoria_id' => 4,
                'subcategoria_id' => 8,
                'descrição' => 'Kindle Paperwhite',
                'contagem' => 10,
                'stock' => 15,
            ],
        ];

        foreach ($produtos as $produto) {
            Produto::create([
                'sku' => $produto['sku'],
                'ean' => $produto['ean'],
                'un' => $produto['un'],
                'categoria_id' => $produto['categoria_id'],
                'subcategoria_id' => $produto['subcategoria_id'],
                'descrição' => $produto['descrição'],
                'contagem' => $produto['contagem'],
                'stock' => $produto['stock'],
                'diferença_stock' => $produto['stock'] - $produto['contagem'],
            ]);
        }
    }
}