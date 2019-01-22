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
					<th></th>
					<th style="text-align: right;">
					
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th style="text-align: right;"> TOTAL</th>
					<th style="text-align: right;"><h4 id="cantidad">0.00</h4></th>
					<th style="text-align: right;">
					<th></th>
					<th style="text-align: right;" ></th>
					<th style="text-align: right;"></th>
					</tr>
					<tr>
					<th style="text-align: right;"></th>
					<th style="text-align: right;">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;"></th>
					
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
						<a href="javascript:window.history.go(-1);"><button class="btn btn-danger" type="reset">Regrear a Listado</button></a>

				</div>
			</div>
		</div>
	</div>
</div>
				
{!! Form::close()!!}

@push ('scripts')

<script>
	
tabla = document.getElementById("detalles");
var totali = 0;
var totale = 0;
var cadena=' '; 

for(var i = 1; tabla.rows[i]; i++)
//totalc += Number(tabla.rows[i].cells[4].innerHTML) *  Number(tabla.rows[i].cells[5].innerHTML);
//cadena = tabla.rows[i].cells[7].innerHTML;
//alert (cadena);
//if (cadena == 'EGRESO'){
totale += Number(tabla.rows[i].cells[4].innerHTML);
//}
//totalc += Number(tabla.rows[i].cells[4].innerHTML);
//alert("LA CANTIDAD ES: "+totale);

 $('#cantidad').html(totale);
 //$('#total_iva').val(totiva12);

</script>
				
@endpush

@endsection