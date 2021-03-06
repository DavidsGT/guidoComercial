@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Articulos con Stock Minimo </h3>
		@include('almacen.stockmin.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Nombre</th>
				<th>Codigo</th>
				<th>Categoria</th>
				<th>Stock</th>
				<th>Stock Min</th>
				<th>Estado</th>
				<th>Opciones</th>
			</thead>

			@foreach ($stock as $art)
			<tr>
				<td>{{ $art->idarticulo}}</td>
				<td>{{ $art->nombre}}</td>
				<td>{{ $art->codigo}}</td>
				<td>{{ $art->categoria}}</td>
				<td>{{ $art->stock}}</td>
				<td>{{ $art->stockmin}}</td>
				<td>{{ $art->estado}}</td>
				<td>
				<a href="{{URL::action('InventarioControl@show',$art->idarticulo)}} "><button class="btn btn-info">Movimientos</button></a>
				
				</td>
			</tr>
			@include('almacen.stockmin..modal')
			@endforeach
		</table>
		</div>
		{{ $stock->render()}}

	</div>
</div>

@endsection