@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('compras.ingreso.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>No.</th>
				<th>Fecha</th>
				<th>Proveedor</th>
				<th>Comprobante</th>
			    <th>Impuesto</th>
			    <th>Total Ingreso</th>
			    <!-- <th>Estado</th> -->
			    <th style="text-align: center; " >Opciones</th>
			</thead>

			@foreach ($ingresos as $ing)
			<tr>
				<td>{{ $ing->idingreso}}</td>
				<td>{{ $ing->fecha_hora}}</td>
				<td>{{ $ing->proveedorEncargado}}</td>
				<td>{{ comercial\PgDetalle::find($ing->fk_pg_tipo_comprobante)->descripcion.': '.$ing->serie_comprobante.'-'.$ing->numero_comprobante}}</td>
				<td>{{ $ing->impuesto}}</td>
				<td>{{$ing->subtotal + $ing->impuesto}}</td>
				<!-- <td>{{ $ing->estado}}</td> -->
				<td>
				<a href="{{URL::action('IngresoController@show',$ing->idingreso)}} "><button class="btn btn-primary">Procesar</button></a>
				<a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
				</td>
			</tr>
			@include('compras.ingreso.modal')
			@endforeach
		</table>
		</div>
		{{ $ingresos->render()}}

	</div>
</div>

@endsection