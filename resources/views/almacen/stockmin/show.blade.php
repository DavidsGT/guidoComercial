@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
			<h3>Inventario y Movimientos: {{$art->nombre}}</h3>

	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
			
				<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							<th>No.</th>
							<th>Fecha Transaccion</th>
							<th>No. Factura</th>
							<th>Detalle</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Total</th>
							<th>Tipo</th>
						</thead>
						<tfoot>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;" >Subtotal </th>
					<th style="text-align: right;">
					
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;"></th>
					<th style="text-align: right;">
					<th></th>
					<th style="text-align: right;" >Iva 12%</th>
					<th style="text-align: right;">
					</tr>
					<tr>
					<th style="text-align: right;"></th>
					<th style="text-align: right;">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;" >Total Ingreso</th>
					
					<th style="text-align: right;">
					</tr>
					</tfoot>
						<tbody>
							@foreach($ingreso as $det)
							<tr>
								<td>{{$det->idingreso}}</td>
								<td>{{$det->fecha_hora}}</td>
								<td>{{$det->numero_comprobante}}</td>
								<td>{{$det->nombre}}</td>
								<td>{{$det->cantidad}}</td>
								<td>{{$det->precio}}</td>
								<td>{{$det->cantidad*$det->precio}}</td>
								<td>{{$det->detalle}}</td>	
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
				
{!! Form::close()!!}

@push ('scripts')

<script>
	
tabla = document.getElementById("detalles");
var totalc = 0;
var totalp = 0;
for(var i = 1; tabla.rows[i]; i++)
totalc += Number(tabla.rows[i].cells[6].innerHTML);
//totalp += Number(tabla.rows[i].cells[6].innerHTML);
alert(totalc)
</script>
				
@endpush

@endsection