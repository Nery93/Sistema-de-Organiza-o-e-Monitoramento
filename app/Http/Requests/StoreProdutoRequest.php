<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class StoreProdutoRequest extends FormRequest
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
    public function prepareForValidation(): void
    {
        /** @var Request $this */
        $this->merge([
            'slug' => Str::slug($this->get('descrição'))
        ]);
    }
    public function rules(): array
    {

        return [
            "sku" => "required|numeric|digits:7|unique:produtos,sku",
            "slug" => "required|string|max:200|unique:produtos,slug",
            "ean" => "required|numeric|digits:13|unique:produtos,ean",
            "un" => "required|integer|min:0",
            "categoria_id" => "required|integer",
            "subcategoria_id" => "required|integer",
            "descrição" => "required|string|max:200",
            "contagem" => "required|integer|min:0",
            "stock" => "required|integer|min:0",
            "diferença_stock" => "required|integer",
        ];
    }
    public function messages()
    {
        return [
            'sku.required' => 'O campo SKU é obrigatório.',
            'sku.numeric' => 'O campo SKU deve ser um número.',
            'sku.digits' => 'O campo SKU deve ter exatamente 7 dígitos.',
            'sku.unique' => 'O campo SKU já existe.',
            'slug.required' => 'O campo Slug é obrigatório.',
            'slug.string' => 'O campo Slug deve ser uma string.',
            'slug.max' => 'O campo Slug deve ter no máximo 200 caracteres.',
            'slug.unique' => 'O campo Slug já existe.',
            'ean.required' => 'O campo EAN é obrigatório.',
            'ean.numeric' => 'O campo EAN deve ser um número.',
            'ean.digits' => 'O campo EAN deve ter exatamente 13 dígitos.',
            'ean.unique' => 'O campo EAN já existe.',
            'un.required' => 'O campo Unidade é obrigatório.',
            'un.integer' => 'O campo Unidade deve ser um número inteiro.',
            'un.min' => 'O campo Unidade deve ser maior que 0.',
            'categoria_id.required' => 'O campo Categoria é obrigatório.',
            'categoria_id.integer' => 'O campo Categoria deve ser um número inteiro.',
            'subcategoria_id.required' => 'O campo Subcategoria é obrigatório.',
            'subcategoria_id.integer' => 'O campo Subcategoria deve ser um número inteiro.',
            'descrição.required' => 'O campo Descrição é obrigatório.',
            'descrição.string' => 'O campo Descrição deve ser uma string.',
            'descrição.max' => 'O campo Descrição deve ter no máximo 200 caracteres.',
            'contagem.required' => 'O campo Contagem é obrigatório.',
            'contagem.integer' => 'O campo Contagem deve ser um número inteiro.',
            'contagem.min' => 'O campo Contagem deve ser maior que 0.',
            'stock.required' => 'O campo Stock é obrigatório.',
            'stock.integer' => 'O campo Stock deve ser um número inteiro.',
            'stock.min' => 'O campo Stock deve ser maior que 0.',
            'diferença_stock.required' => 'O campo Diferença de Stock é obrigatório.',
            'diferença_stock.integer' => 'O campo Diferença de Stock deve ser um número inteiro.',
        ];
    }   
}
