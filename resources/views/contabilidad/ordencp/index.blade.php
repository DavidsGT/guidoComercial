@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Cuentas Por Pagar</h3>
		@include('contabilidad.ordencp.search')
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
			    <th>Tipo Pago</th>
			    <th>Total Deuda</th>
			    <th>Total Pago</th>
			    <th>Estado</th>
			    <th>Opciones</th>
			</thead>

			@foreach ($ingresos as $ing)
			<tr>
				<td>{{ $ing->idingreso}}</td>
				<td>{{ $ing->fecha_hora}}</td>
				<td>{{ $ing->nombre}}</td>
				<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->numero_comprobante}}</td>
				<td>{{ $ing->formapago}}</td>
				<td>{{ $ing->total}}</td>
				<td>100</td>
				<td>Pendiente</td>
				<td>
				<a href="{{URL::action('OrdencpController@create',$ing->idingreso)}} "><button class="btn btn-primary">Procesar</button></a>
				</td>
			</tr>
			@include('contabilidad.ordencp.modal')
			@endforeach
		</table>
		</div>
		{{ $ingresos->render()}}

	</div>
</div>

@endsection