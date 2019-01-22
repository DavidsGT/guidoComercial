@extends ('layouts.admin',['title'=>"Clientes"])
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12" style="display: -webkit-inline-box;">
		@include('ventas.cliente.search')
		<a style="margin-left: 100px;" href="cliente/create"><button class="btn btn-success">Nuevo</button></a>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th style='display:none'>Id</th>
				<th>Nombre</th>
				<th>Numero Doc.</th>
				<th>Telefono</th>
				<th>Email</th>
			    <th>Opciones</th>
			</thead>

			@foreach ($personas as $per)
			<tr>
				<td style='display:none'>{{ $per->id}}</td>
				<td>{{$per->apellido.' '.$per->nombre}}</td>
				<td>{{ $per->numero_documento}}</td>
				<td>{{ $per->telefono}}</td>
				<td>{{ $per->email}}</td>
				<td>
				<a href="{{URL::action('ClienteController@edit',$per->id)}} "><button class="btn btn-info">Editar</button></a>
				<a href="" data-target="#modal-delete-{{$per->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('ventas.cliente.modal')
			@endforeach
		</table>
		</div>
		{{ $personas->render()}}

	</div>
</div>

@endsection