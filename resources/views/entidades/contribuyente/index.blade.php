@extends ('layouts.admin',['title'=>"Contribuyenes"])
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<a href="contribuyente/create"><button class="btn btn-success">Nuevo</button></a>
	</div>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th style='display:none'>Id</th>
				<th>Ruc</th>
				<th>Razon Social</th>
				<th>Direccion Matriz</th>
				<th>Telefono</th>
				<th>Email</th>
			    <th>Opciones</th>
			</thead>
			@foreach ($personas as $per)
			<tr>
				<td style='display:none'>{{$per->id}}</td>
				<td>{{$per->ruc}}</td>
				<td>{{ $per->razon_social}}</td>
				<td>{{ $per->direccion_matriz}}</td>
				<td>{{ $per->telefono}}</td>
				<td>{{ $per->email}}</td>
				<td>
				<a href="" data-target="#modal-details-{{$per->id}}" data-toggle="modal"><button class="btn btn-success">Detalles</button></a>
				<a href="{{URL::action('ContribuyenteController@edit',$per->id)}} "><button class="btn btn-info">Editar</button></a>
				<a href="" data-target="#modal-delete-{{$per->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('entidades.contribuyente.modal')
			@endforeach
		</table>
		</div>
		{{ $personas->render()}}

	</div>
</div>

@endsection