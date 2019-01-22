@extends ('layouts.admin',['title'=>"Categorias"])
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12"  style="display: -webkit-inline-box;">
		@include('almacen.categoria.search')
		<a style="margin-left: 100px;" href="categoria/create"><button class="btn btn-success">Nuevo</button></a>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Opciones</th>
			</thead>

			@foreach ($categorias as $cat)
			<tr>
				<td>{{ $cat->descripcion}}</td>
				<td>{{ $cat->detalle}}</td>
				<td>
				<a href="{{URL::action('CategoriaController@edit',$cat->id)}} "><button class="btn btn-info">Editar</button></a>
				<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('almacen.categoria.modal')
			@endforeach
		</table>
		</div>
		{{ $categorias->render()}}

	</div>
</div>

@endsection