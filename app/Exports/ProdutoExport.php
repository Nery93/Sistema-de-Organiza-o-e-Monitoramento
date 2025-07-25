<?php

namespace App\Exports;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProdutoExport implements FromCollection, WithHeadings, WithMapping
{
    private $categorias;
    private $subcategorias;

    public function __construct() 
    {
        $this->categorias = Categoria::all()->keyBy('id'); 
        $this->subcategorias = SubCategoria::all()->keyBy('id');
    }

    public function collection() 
    {
        return Produto::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'sku',
            'ean',
            'un',   
            'descrição',
            'categoria',
            'subcategoria',
            'stock',
            'diferença_stock',
            'contagem',
        ];
    }

    public function map($produto): array
    {
        $categoriaNome = $this->categorias[$produto->categoria_id]->nome_categoria ?? 'Sem Categoria';
        $subcategoriaNome = $this->subcategorias[$produto->subcategoria_id]->sub_categoria ?? 'Sem Subcategoria';

        return [
            $produto->id,
            $produto->sku,
            $produto->ean,
            $produto->un,
            $produto->descrição,
            $categoriaNome,
            $subcategoriaNome,
            $produto->contagem,
            $produto->stock,
            $produto->diferença_stock,
        ];
    }
}
