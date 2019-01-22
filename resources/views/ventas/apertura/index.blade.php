@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Apertura de Caja <a href="apertura/create"><button class="btn btn-success">Aperturar</button></a></h3>
		@include('ventas.apertura.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Fecha Inicio</th>
				<th>Fecha Cierre</th>
				<th>Usuario</th>
				<th>Valor Inicial</th>
				<th>Valor Final</th>
				<th>Estado</th>
				<th>Opciones</th>
			</thead>

			@foreach ($apertura as $cat)
			<tr>
				<td>{{ $cat->idacaja}}</td>
				<td>{{ $cat->fechaap}}</td>
				<td>{{ $cat->fechacie}}</td>
				<td>{{ $cat->usuario}}</td>
				<td>{{ $cat->valorini}}</td>
				<td>{{ $cat->valorfin}}</td>
				<td>
					@if($cat->estado==1)
					Abierta
					@elseif($cat->estado==0)
					Cerrado
					@else
					Eliminado
					@endif
				</td>
				<td>	
				@if($cat->estado==1)
				<a href="{{URL::action('FacturaController@index')}}"><button class="btn btn-secondary">Facturar</button></a>
				<a href="{{URL::action('CajaControl@edit',$cat->idacaja)}} "><button class="btn btn-info">Cerrar Caja</button></a>
				<a href="" data-target="#modal-delete-{{$cat->idacaja}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				@else
				<a href="{{URL::action('FacturaController@index')}}"><button disabled="" class="btn btn-secondary">Facturar</button></a>
				<a href="{{URL::action('CajaControl@edit',$cat->idacaja)}} "><button disabled="" class="btn btn-info">Cerrar Caja</button></a>
				<a href="" data-target="#modal-delete-{{$cat->idacaja}}" data-toggle="modal"><button disabled="" class="btn btn-danger">Eliminar</button></a>
				@endif
				</td>
			</tr>
			@include('ventas.apertura.modal')
			@endforeach
		</table>
		</div>
		{{ $apertura->render()}}

	</div>
</div>

@endsection