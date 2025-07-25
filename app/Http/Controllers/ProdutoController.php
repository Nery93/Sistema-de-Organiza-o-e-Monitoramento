<?php

namespace App\Http\Controllers;

use App\Exports\ProdutoExport;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UpdateProdutoRequest;
use App\Helpers\SortHelper;
use App\Services\ProdutoFilterService;

class ProdutoController extends Controller
{
    public function index(Request $request, ProdutoFilterService $produtoFilterService, $sort = 'id', $direction = 'asc', )
    {           
        $query = Produto::query()
            ->join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
            ->join('subcategorias', 'produtos.subcategoria_id', '=', 'subcategorias.id')
            ->select('produtos.*', 'categorias.nome_categoria as categoria_nome', 'subcategorias.sub_categoria as subcategoria_nome');
    
        $categoriaId   = request('categoria_id', null);
        $categorias    = Categoria::select('id','nome_categoria')->distinct()->get();           
        $uniqueValues  = Produto::select('un', 'categoria_id', 'diferença_stock')->distinct()->get();
        $sortData      = SortHelper::generateSortData($sort, $direction);
        $query         = $produtoFilterService->applySorting($sort, $direction, $query);
        $filteredQuery = $produtoFilterService->applyFilters($request, $query);
        $produtos      = $filteredQuery->paginate(3)->withQueryString();

        return view('index', compact('produtos', 'uniqueValues','categorias') + $sortData);
    }

    public function create()
    {
        $categoriaId   = request('categoria_id', null);
        $categorias    = Categoria::select('id','nome_categoria')->distinct()->get();
        $subcategorias = request('categorias') ? SubCategoria::where('categoria_id', request('categorias'))->get() : [];
        $campos        = ["sku", "ean", "slug", "un", "descrição", "categoria_id", "subcategoria_id", "stock", "diferença_stock", "contagem"];
        return view("produtos.create", compact("campos", "categorias", "subcategorias"));
    }

    public function store(StoreProdutoRequest $request)
    {
        $dados = $request->validated();
        Produto::create($dados);
        return redirect()->route('produto.create')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($slug)
    {
        $campos        = ["sku", "ean", "un", "descrição", "stock", "diferença_stock", "contagem"];
        $produto       = Produto::where('slug', $slug)->firstOrFail();
        $categorias    = Categoria::select('id','nome_categoria')->distinct()->get();
        $subcategorias = SubCategoria::where('categoria_id', $produto->categoria_id)->get();
        return view('produtos.edit', compact('produto', 'campos', 'categorias', 'subcategorias'));
    }

    public function update(UpdateProdutoRequest $request, $slug)
    {
        $produto = Produto::where('slug', $slug)->firstOrFail();
        $produto->update($request->validated());
        return redirect()->route('produto.edit', $slug);
    }
    public function export()
    {
        return Excel::download(new ProdutoExport, 'produtos.xlsx');
    }

    public function getSubcategorias($categoriaId)
    {
        $subcategorias = SubCategoria::where('categoria_id', $categoriaId)->pluck('sub_categoria', 'id');
        return response()->json($subcategorias);
    }
}
