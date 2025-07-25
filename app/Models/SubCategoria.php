<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $fillable = ['sub_categoria', 'categoria_id'];
    protected $table = 'subcategorias';

    static function listarSubCategorias($categoriaNome)
{
    return self::join('categorias', 'subcategorias.categoria_id', '=', 'categorias.id')
        ->where('categorias.nome_categoria', '=', $categoriaNome)
        ->select('subcategorias.sub_categoria')
        ->distinct()
        ->pluck('sub_categoria');
}
}
