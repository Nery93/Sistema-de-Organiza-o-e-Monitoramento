@extends('layout.app')
@section('title', 'Editar Inventário')

@section('page_title')
<div class="page-header">
    <h3 class="title-create">Editar Inventário</h3>
    <button id="clear-fields" class="button-clear-create btn btn-outline-danger">Limpar Campos</button>
</div>
@endsection

@section('sidebar')
<div class="sidebar bg-white shadow-sm create-sidebar">
    <a href="#"><img src="{{ asset('images/box.svg') }}"></a>
    <a href="#"><img src="{{ asset('images/truck.svg') }}"></a>
    <a href="#" class="active"><img src="{{ asset('images/task-square.svg') }}"></a>
    <a href="#"><img src="{{ asset('images/gallery.svg') }}"></a>
    <a href="#" class="non-active"><img src="{{ asset('images/clipboard-text.svg') }}"></i></a>
</div>
@endsection

@section('content')
<div style="margin: 50px 30px 0 100px">
    <div class="information card card-primary">
        <h3 class="sub-title-create">Informações básicas</h3>
        <div class="card-body-create">
            <form method="POST" action="{{ route('produto.update', $produto->slug) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input class="form-control" id="sku" name="sku" value="{{ $produto->sku }}" type="text" autocomplete="off" placeholder="SKU">
                        @error('sku')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ean">EAN</label>
                        <input class="form-control" id="ean" name="ean" value="{{ $produto->ean }}" type="text" autocomplete="off" placeholder="EAN">
                        @error('ean')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="un">UN</label>
                        <input class="form-control" id="un" name="un" value="{{ $produto->un }}" type="number" autocomplete="off" placeholder="UN">
                        @error('un')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input class="form-control" id="descricao" name="descricao" value="{{ $produto->descrição }}" type="text" autocomplete="off" placeholder="Descrição">
                        @error('descricao')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        <select class="form-select" id="categoria_id" name="categoria_id">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoriaOpcao)
                            <option value="{{ $categoriaOpcao->id }}" 
                                {{ $produto->categoria_id == $categoriaOpcao->id ? 'selected' : '' }}>
                                {{ $categoriaOpcao->nome_categoria }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategoria_id">Subcategoria</label>
                        
                        <select class="form-select" id="subcategoria_id" name="subcategoria_id">
                            <option value="">Selecione uma subcategoria</option>
                            @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}" 
                                {{ $produto->subcategoria_id == $subcategoria->id ? 'selected' : '' }}>
                                {{ $subcategoria->sub_categoria }}
                            </option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input class="form-control" id="stock" name="stock" value="{{ $produto->stock }}" type="number" autocomplete="off" placeholder="Stock">
                        @error('stock')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contagem">Contagem</label>
                        <input class="form-control" id="contagem" name="contagem" value="{{ $produto->contagem }}" type="number" autocomplete="off" placeholder="Contagem">
                        @error('contagem')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group full-width">
                        <label for="diferenca_stock">Diferença Stock</label>
                        <input class="form-control" id="diferenca_stock" name="diferenca_stock" value="{{ $produto->diferenca_stock }}" type="number" autocomplete="off" placeholder="Diferença Stock">
                        @error('diferenca_stock')
                        <div class="text-red-700 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<div class="container-footer">
    <footer>
        <button class="btn-footer-sair btn btn-outline-danger">Sair</button>
        <button type="button" onclick="document.forms[0].submit()" class="btn-footer-create btn btn-danger">Editar Inventário <img src="{{ asset('images/tick-circle.svg') }}"></button>
    </footer>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('clear-fields').addEventListener('click', function(event) {
            event.preventDefault();

            const campos = [
                document.getElementById('sku'),
                document.getElementById('ean'),
                document.getElementById('un'),
                document.getElementById('categoria_id'),
                document.getElementById('descricao'),
                document.getElementById('contagem'),
                document.getElementById('diferenca_stock'),
                document.getElementById('stock'),
            ];

            campos.forEach(campo => {
                campo.value = '';
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let subcategoriaSelect = document.getElementById('subcategoria_id');
        let categoriaSelect = document.getElementById('categoria_id');

        categoriaSelect.addEventListener('change', function() {
            let categoriaId = this.value;
            console.log("Categoria ID Selecionada:", categoriaId);
            subcategoriaSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>';

            if (categoriaId) {
                fetch(`/subcategorias/${categoriaId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        for (let id in data) {
                            let option = document.createElement('option');
                            option.value = id;
                            option.textContent = data[id];
                            subcategoriaSelect.appendChild(option);
                                                    }
                    })
                    .catch(error => console.error('Erro ao carregar subcategorias:', error));
            }
        });
    });

   
</script>