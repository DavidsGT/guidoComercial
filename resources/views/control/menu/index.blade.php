@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Opciones del Sistema <a href="menu/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('control.menu.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Menu Padre</th>
				<th>Menu Hijo</th>
				<th>Link</th>
				<th>Id Usuario</th>
				<th>Opciones</th>
			</thead>

			@foreach ($menu as $art)
			<tr>
				<td>{{ $art->idmenu}}</td>
				<td>{{ $art->detpadre}}</td>
				<td>{{ $art->dethijo}}</td>
				<td>{{ $art->link}}</td>
				<td>{{ $art->usuario}}</td>
				<td>
				<a href="{{URL::action('MenuControl@edit',$art->idmenu)}} "><button class="btn btn-info">Editar</button></a>
				<a href="" data-target="#modal-delete-{{$art->idmenu}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('control.menu.modal')
			@endforeach
		</table>
		</div>
		{{ $menu->render()}}

	</div>
</div>

@endsection