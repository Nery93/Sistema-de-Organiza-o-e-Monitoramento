<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Produto;

class UpdateProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $slug = request()->route('slug');
        $produtoId = $slug ? Produto::where('slug', $slug)->firstOrFail()?->id : null;
        return [
            "sku"             => "required|numeric|digits:7|unique:produtos,sku," . $produtoId,
            "ean"             => "required|numeric|digits:13|unique:produtos,ean," . $produtoId,
            "un"              => "required|integer|min:0",
            "categoria_id"    => "required|integer",
            "subcategoria_id" => "required|integer",
            "descrição"       => "required|string|max:200",
            "contagem"        => "required|integer|min:0",
            "stock"           => "required|integer|min:0",
            "diferença_stock" => "required|integer",
        ];
    }    
}
