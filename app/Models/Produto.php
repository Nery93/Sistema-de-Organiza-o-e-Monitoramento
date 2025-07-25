<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $fillable = [
        'sku',
        'slug',
        'ean',
        'un',
        'categoria_id',
        'subcategoria_id',
        'descrição',
        'contagem',
        'stock',
        'diferença_stock',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($produto) {
            $produto->slug = Str::slug($produto->descrição);
        });

        static::updating(function ($produto) {
            if ($produto->isDirty('descrição')) {
                $produto->slug = Str::slug($produto->descrição);
            }
        });
    }

    static function getColumns()
    {
        return [
            'sku',
            'ean',
            'un',
            'categoria',
            'descrição',
            'contagem',
            'stock',
            'diferença_stock'
        ];
    }

    public static function listarPorCategoria($categoriaId)
    {
        return self::join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
            ->where('produtos.categoria_id', $categoriaId)
            ->select('produtos.*', 'categorias.nome_categoria')
            ->get();
    }

    
}
