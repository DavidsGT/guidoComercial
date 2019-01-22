@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Listado de Perfiles <a href="perfil/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('seguridad.perfil.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Opciones</th>
			</thead>

			@foreach ($perfil as $cat)
			<tr>
				<td>{{ $cat->idperfil}}</td>
				<td>{{ $cat->detalle}}</td>
				<td>{{ $cat->descripcion}}</td>
				<td>
				<a href="{{URL::action('PerfilControl@edit',$cat->idperfil)}} "><button class="btn btn-info">Editar</button></a>
				<a href="" data-target="#modal-delete-{{$cat->idperfil}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('seguridad.perfil.modal')
			@endforeach
		</table>
		</div>
		{{ $perfil->render()}}

	</div>
</div>

@endsection