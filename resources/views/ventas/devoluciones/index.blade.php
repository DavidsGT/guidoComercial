@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
		<h3>Devoluciones por Ventas</h3>
		@include('ventas.devoluciones.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>No.</th>
				<th>Fecha Compra</th>
				<th>Cliente</th>
				<th>Comprobante</th>
			    
			    <th>Total Compra</th>
			    <th>Cantidad</th>
			    <th>Estado</th>
			    <th>Opciones</th>
			</thead>

			@foreach ($ingresos as $ing)
			<tr>
				<td>{{ $ing->idventa}}</td>
				<td>{{ $ing->fecha_hora}}</td>
				<td>{{ $ing->nombre}}</td>
				<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->idventa}}</td>
			
				<td>{{ $ing->total}}</td>
				<td>{{ $ing->cantidad}}</td>
				<td>{{ $ing->estado}}</td>
				<td>
				<a href="{{URL::action('DeventasControl@create',$ing->idventa)}} "><button class="btn btn-primary">Procesar</button></a>
				</td>
			</tr>
			@include('ventas.devoluciones.modal')
			@endforeach
		</table>
		</div>
		{{ $ingresos->render()}}

	</div>
</div>

@endsection