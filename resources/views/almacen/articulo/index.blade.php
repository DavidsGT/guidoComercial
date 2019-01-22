@extends ('layouts.admin',['title'=>"Artículos"])
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12"  style="display: -webkit-inline-box;">
		@include('almacen.articulo.search')
		<a style="margin-left: 100px;" href="articulo/create"><button class="btn btn-success">Nuevo</button></a>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table id="dt" class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Categoria</th>
				<th>Precio Unitario</th>
				<th>Precio Empresarial</th>
				<th>Precio Distribución</th>
				<th>Stock</th>
				<th>Iva</th>
				<th>Opciones</th>
			</thead>
			@foreach ($articulo as $art)
			<tr>
				<td>{{$art->codigo}}</td>
				<td>{{$art->nombre}}</td>
				<td>{{comercial\PgDetalle::find($art->fk_pg_categoria)->descripcion}}</td>
				<td>{{$art->precio_unitario}}</td>
				<td>{{$art->precio_empresarial}}</td>
				<td>{{$art->precio_distribucion}}</td>
				<td>{{$art->stock}}</td>
				<td>{{($art->iva?"Si":"No")}}</td>
				<td>
					<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}} "><button class="btn btn-info">Editar</button></a>
					<a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('almacen.articulo.modal')
			@endforeach
		</table>
		</div>
		{{ $articulo->render()}}
	</div>
</div>
@endsection