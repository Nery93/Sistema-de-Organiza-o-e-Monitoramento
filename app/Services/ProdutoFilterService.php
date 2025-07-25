<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoFilterService
{
    public function applyFilters(Request $request, $query)
    {
        if ($request->has('search')) {$query->where('sku', 'like', '%' . $request->input('search') . '%');}
        if ($request->has('filter.ean')) {$query->where('ean', 'like', '%' . $request->input('filter.ean') . '%');}
        if ($request->has('filter.un')) {$query->whereIn('un', $request->input('filter.un'));}
        if ($request->has('filter.categoria')) {$query->whereIn('produtos.categoria_id', $request->input('filter.categoria'));}
        if ($request->has('filter.diferença_stock')) {$query->whereIn('diferença_stock', $request->input('filter.diferença_stock'));}
        return $query;
    }

    public function applySorting($sort, $direction, $query)
{
    $validSorts = Produto::getColumns(); 

    // Para eu não me esquecer, diciona aliases válidos que vêm da view
    $aliasMap = [
        'categoria'         => 'categorias.nome_categoria',
        'subcategoria'      => 'subcategorias.sub_categoria',
        'categoria_nome'    => 'categorias.nome_categoria',
        'subcategoria_nome' => 'subcategorias.sub_categoria',
    ];

    if (isset($aliasMap[$sort])) {$sort = $aliasMap[$sort];
    } elseif (!in_array($sort, $validSorts)) {$sort = 'id';}
    if (!in_array($direction, ['asc', 'desc'])) {$direction = 'asc';}

    return $query->orderBy($sort, $direction);
}

}