@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Listado de Bancos <a href="bancos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('entidades.bancos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Codigo Contable</th>
				<th>Tipo Cuenta</th>
				<th>Numero</th>
				<th>Entidad</th>
				<th>Estado</th>
				<th>Opciones</th>
			</thead>

			@foreach ($entidades as $ban)
			<tr>
				<td>{{ $ban->codigo}}</td>
				<td>{{ $ban->tipo}}</td>
				<td>{{ $ban->numero}}</td>
				<td>{{ $ban->nombre}}</td>
				<td>{{ $ban->estado}}</td>
				<td>
				<a href="{{URL::action('BancosController@edit',$ban->identidad)}} "><button class="btn btn-info">Editar</button></a>
				<a href="" data-target="#modal-delete-{{$ban->identidad}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('entidades.bancos.modal')
			@endforeach
		</table>
		</div>
		{{ $entidades->render()}}

	</div>
</div>

@endsection