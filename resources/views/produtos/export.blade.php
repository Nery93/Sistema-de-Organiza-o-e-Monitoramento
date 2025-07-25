@extends('layout.app')
@section('title', 'Exportar Produtos')

@section('page_title')
<div class="page-header">
    <h3 class="title-create">Exportar Produtos</h3>
</div>
@endsection

@section('sidebar')
<div class="sidebar bg-white shadow-sm create-sidebar">
    <a href="#"><img src="{{ asset('images/box.svg') }}"></a>
    <a href="#"><img src="{{ asset('images/truck.svg') }}"></a>
    <a href="#"><img src="{{ asset('images/task-square.svg') }}"></a>
    <a href="#"><img src="{{ asset('images/gallery.svg') }}"></a>
    <a href="#" class="active"><img src="{{ asset('images/clipboard-text.svg') }}"></i></a>
</div>
@endsection

@section('content')
<div style="margin: 50px 30px 0 100px">
    <div class="information card card-primary">
        <h3 class="sub-title-create">Exportar Produtos</h3>
        <div class="card-body-create">
            <form method="POST" action="{{ route('produtos.handleExport') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 mb-3">
                        <label for="categoria">Categoria</label>
                        <select class="form-select" id="categoria" name="categoria">
                            <option value="">Todas as categorias</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger">Exportar <img src="{{ asset('images/tick-circle.svg') }}"></button>
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
    </footer>
</div>
@endsection 