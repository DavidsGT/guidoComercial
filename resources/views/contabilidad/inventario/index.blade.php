@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Inventario de Bodega </h3>
		@include('contabilidad.inventario.search')
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
				<th>Iva</th>
				<th>Estado</th>
				<th>Opciones</th>
			</thead>

			@foreach ($articulo as $art)
			<tr>
				<td>{{ $art->idarticulo}}</td>
				<td>{{ $art->nombre}}</td>
				<td>{{ $art->codigo}}</td>
				<td>{{ $art->categoria}}</td>
				<td>{{ $art->stock}}</td>
				<td>{{ $art->iva}}</td>
				<td>{{ $art->estado}}</td>
				<td>
				<a href="{{URL::action('InventarioControl@show',$art->idarticulo)}} "><button class="btn btn-info">Movimientos</button></a>
				
				</td>
			</tr>
			@include('contabilidad.inventario.modal')
			@endforeach
		</table>
		</div>
		{{ $articulo->render()}}

	</div>
</div>

@endsection