@extends('layout.app')
@section('title', 'Index')
@section('page_title')
<h3 class="page-title">
   PICAGEM 123
   <span class="stock-livre-button">
      Stock Livre
   </span>
</h3>
@endsection
@section('breadcrumb')
<nav aria-label="breadcrumb">
   <ol class="breadcrumb mt-3" style="margin-left: 130px">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Operações de Artigo</a></li>
      <li class="breadcrumb-item"><a href="#">Contagens Livres</a></li>
      <li class="breadcrumb-item active" aria-current="page">Picagem 123</li>
   </ol>
</nav>
@endsection
@section('sidebar')
<div class="sidebar bg-white shadow-sm">
   <a href="#"><img src="{{ asset('images/box.svg') }}"></a>
   <a href="#"><img src="{{ asset('images/truck.svg') }}"></a>
   <a href="#"><img src="{{ asset('images/task-square.svg') }}"></a>
   <a href="#"><img src="{{ asset('images/gallery.svg') }}"></a>
   <!-- Ícone ativo -->
   <a href="#" class="active"><img src="{{ asset('images/clipboard-text.svg') }}"></i></a>
   <!-- Separador -->
   <div class="separator">
   </div>
   <!-- Ícone no final -->
   <a href="#" class="bottom-icon"><img src="{{ asset('images/shop.svg') }}"></i></a>
</div>
@endsection
@section('content')
<div class="filtros">
   <form id="filtro-form"  method="GET" action="{{ url()->full() }}">
      <div class=" filters row align-items-center">
         <div class="col-auto">
            <input placeholder="SKU" type="text" name="search" class="form-control form-control-sm filter-input" value="{{ request('search') }}">
         </div>

         <div class="col-auto">
            <input placeholder="EAN" type="text" name="filter[ean]" class="form-control form-control-sm filter-input" value="{{ request('filter.ean') }}">
         </div>

         <div class="col-auto">
            <div class="dropdown">
               <button class="un-input dropdown-toggle form-control form-control-sm" style="text-align: left" type="button" id="dropdownUnidades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  UN
               </button>
               <div class="dropdown-menu p-2" aria-labelledby="dropdownUnidades">
                  @foreach ($uniqueValues->unique('un') as $uni)
                  <label class="dropdown-item">
                     <input type="checkbox" name="filter[un][]" value="{{ $uni->un }}" class="me-2"
                     {{ in_array($uni->un, request('filter.un', [])) ? 'checked' : '' }}> 
                     {{ $uni->un }}
                  </label>
                  @endforeach
               </div>
            </div>
         </div>
         <div class="col-auto">
            <div class="dropdown">
               <button class="categoria-input dropdown-toggle form-control form-control-sm" type="button" id="dropdownUnidades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categoria
               </button>
               <div class="dropdown-menu p-2" aria-labelledby="dropdownUnidades">
               @foreach ($categorias as $cat)
                  <label class="dropdown-item">
                  <input type="checkbox" name="filter[categoria][]" value="{{ $cat->id }}" class="me-2"
                  {{ in_array($cat->id, request('filter.categoria', [])) ? 'checked' : '' }}>
                  {{ $cat->id }}
                  </label>
               @endforeach
               </div>
            </div>
         </div>
         <div class="col-auto">
            <div class="dropdown">
               <button class="stock-diff-input dropdown-toggle form-control form-control-sm" type="button" id="dropdownUnidades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Diferença Stock
               </button>
               <div class="dropdown-menu p-2" aria-labelledby="dropdownUnidades">
                  @foreach ($uniqueValues->unique('diferença_stock') as $dif)
                  <label class="dropdown-item">
                     <input type="checkbox" name="filter[diferença_stock][]" class="me-2"
                     {{ in_array($dif->diferença_stock, request('filter.diferença_stock', [])) ? 'checked' : '' }}>
                     {{ $dif->diferença_stock }}
                  </label>
                  @endforeach
               </div>
            </div>
         </div>
         <div class="col-auto">
            <span class="me-2"> |</span>
            <img class="limpar" src="{{ asset('images/Trash Shape.svg') }}" class="ml-2"><a href="{{ route('produto.index') }}" class="limpar-input" type="reset">
               Limpar</a>
         </div>
         <div class="col-auto d-flex" style="margin-left: 15px;">
            <img src="{{ asset('images/Check_Shape.svg') }}" class="ml-2" style="position: relative; top: 1px;">
            <button class="aplicar-input" type="submit">
               Aplicar</button>
         </div>
      </div>
   </form>
</div>

<div class="" style=" padding: 20px; margin: unset; margin-left: 40px;">
   <div class="table-responsive">
      <table id="table" class="table table-striped table-borderless">
         <thead class="cabecalho-principal">
            <tr>
               <th class="rounded border-bottom" scope="row" colspan="8">{{ $produtos->total() }} Artigos </th>
               <th class="rounded border-bottom" scope="row" colspan="8">
                  <div style="display: flex; align-items: center; right: 150px; position: relative;">
                     <a class="artigos">
                        <img src="{{ asset('images/export.svg') }}" style="margin-right: 10px;"></a>
                     <a class="export-csv" href="{{ route('produtos.export') }}">
                        Export</a>
                     <img src="{{ asset('images/plus-circle.svg') }}" style="margin-left: 20px;"></a>
                     <a class="rota-create" href="{{ route('produto.create') }}">
                        Criar</a>
                  </div>
               </th>
            <tr>

               <th scope="col">
                  <a class="SKU" href="{{ $sort['sku'] }}">
                     <span style="display: flex; align-items: center; margin-left: 6px;">
                        SKU
                        <i class="fa-solid {{ $mapDir[($sortColumn === 'sku') ? $sortDirection : ''] }}"></i>
                     </span>
                  </a>
               </th>

               <th scope="col">
                  <a class="EAN" href="{{ $sort['ean'] }}">
                     <span style="display: flex; align-items: center; margin-left: 6px;">
                        EAN
                        <i class="fa-solid {{ $mapDir[($sortColumn === 'ean') ? $sortDirection : ''] }}"></i>
                     </span>
                  </a>
               </th>

               <th scope="col">
                  <a class="UN" href="{{ $sort['un'] }}">
                     <span style="display: flex; align-items: center; margin-left: 6px;">
                        UN
                        <i class="fa-solid {{ $mapDir[($sortColumn === 'un') ? $sortDirection : ''] }}"></i>
                     </span>
                  </a>
               </th>

               
               <th scope="col">
                  <a class="CATEGORIA" href="{{ $sort['categoria'] }}">
                     <span style="display: flex; align-items: center; margin-left: 6px;">
                        Categoria
                        <i class="fa-solid {{ $mapDir[($sortColumn === 'categoria') ? $sortDirection : ''] }}"></i>
                     </span>
                  </a>
               </th>

               
               <th scope="col">
                  <a class="DESCRIÇÃO" href="{{ $sort['descrição'] }}">
                     <span style="display: flex; align-items: center; margin-left: 6px;">
                        Descrição do Artigo
                        <i class="fa-solid {{ $mapDir[($sortColumn === 'descrição') ? $sortDirection : ''] }}"></i>
                     </span>
                  </a>
               </th>

               
               <th scope="col">
                  <span style="display: flex; align-items: center;">
                     Contagem
                  </span>
               </th>

               <th scope="col">
                  <span style="display: flex; align-items: center;">
                     Stock
                  </span>
               </th>

               <th scope="col">
                  <a class="DIFERENÇA_STOCK" href="{{ $sort['diferença_stock'] }}">
                     <span style="display: flex; align-items: center; margin-left: 6px; color: #000;">
                        Diferença Stock
                        <i class="fa-solid {{ $mapDir[($sortColumn === 'diferença_stock') ? $sortDirection : ''] }}"></i>
                     </span>
                  </a>
               </th>

               </th>

               <th scope="col">
                  <span style="display: flex; align-items: center;"></span>
               </th>
            </tr>
         </thead>

         <tbody>
            @foreach ($produtos as $produto)
            <tr class="linha-tabela">
               <td style="height: 70px; padding: 20px;">{{ $produto->sku }}</td>
               <td style="padding: 20px;">{{ $produto->ean }}</td>
               <td style="text-align: center; padding: 20px;">{{ $produto->un }}</td>
               <td style="text-align: center; padding: 20px;">{{ $produto->categoria_id }}</td>
               <td style="height: 70px; padding: 20px;">{{ $produto->descrição }}</td>
               <td style="text-align: center; padding: 20px;">{{ $produto->stock }}</td>
               <td style="text-align: center; padding: 20px;">{{ $produto->contagem }}</td>
               <td style="padding: 20px; text-align: center;">{{ $produto->stock - $produto->contagem }}</td>
               <td>
                  <a href="{{ route('produto.edit',$produto->slug) }}"> <img src="{{ asset('images/Edit.svg') }}"></a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>


   <div class="paginate">
      @if ($produtos->hasPages())
      {{ $produtos->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
      @else
      <p class="text-muted small">Apenas 1 página de resultados</p>
      @endif
   </div>
@endsection

<script>
   document.addEventListener('DOMContentLoaded', function() {
      const filtroForm = document.getElementById('filtro-form');

      if(!filtroForm){return}

      filtroForm.addEventListener('submit', function(e){ 
         const params = new URLSearchParams(window.location.search);

         const currentPage = params.get('page');

         if(currentPage){
            const pageInput = document.createElement('input');
            pageInput.type = 'hidden';
            pageInput.name = 'page';
            pageInput.value = currentPage;
            filtroForm.appendChild(pageInput);
            form.appendChild(filtroForm);
         }
      }) 
   })
</script>
