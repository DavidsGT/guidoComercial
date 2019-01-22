@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Facturar Cotizacion No.: {{$venta->idventa}}</h3>
		
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
		
			

<div class="row">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="cliente">Cliente</label>
			<p>{{$venta->nombre}} </p>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Direccion</label>
			<p>{{$venta->direccion}} </p>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="telefono">Telefono</label>
			<p>{{$venta->telefono}} </p>
		</div>
	</div>
	
</div>

<div class="row">
<div class="panel panel-primary">
	<div class="panel-body">
		
		<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5">
					<th>Codigo</th>
					<th>Articulo</th>
					<th>Cantidad</th>
					<th>Precio Venta</th>
					<th>Tipo Iva %</th>
					<th>Desc %</th>
					<th>Subtotal</th>
				</thead>
				<tfoot>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Subtotal</th>
					<th  style="text-align: right;"><h4 id="total">{{$venta->total_venta}}</h4></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Iva 12%</th>
					<th  style="text-align: right;"><h4 id="total1">{{$venta->impuesto}}</h4></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Total a Pagar</th>
					<th  style="text-align: right;"><h4 id="total2">{{$venta->impuesto+$venta->total_venta}}</h4></th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($detalles as $det)
					<tr>
						<td>{{$det->codigo}}</td>
						<td>{{$det->articulo}}</td>
						<td>{{$det->cantidad}}</td>
						<td>{{$det->precio_venta}}</td>
						<td>{{$det->tipoiva}}</td>
						<td>{{$det->descuento}}</td>
						<td>{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
					</tr>
				
					@endforeach
				</tbody>

			</table>
			<a href="javascript:window.history.go(-1);"><button class="btn btn-danger" type="reset">Regrear a Listado</button></a>
				@if ($venta->estado=='Procesado' or $venta->estado=='Facturado') 
				<a href="" data-target="#modal-delete-{{$venta->idventa}}" data-toggle="modal"><button disabled="" class="btn btn-primary">Facturar</button></a>
				@else 
				<a href="" data-target="#modal-delete-{{$venta->idventa}}" data-toggle="modal"><button  class="btn btn-primary">Facturar</button></a>
				@endif
				<a href="{{URL::action('PdfController@getPDFPR',$venta->idventa)}}" target="_blank" ><input src="{{asset('img/print.png')}}" width="30" height="30" align="center" type="image"></a>
				@include('ventas.factura.modal')
		</div>
	</div>
</div>

	
</div>
				


@push ('scripts')
<script>

$(document).ready(function(){
    $('#bt_add').click(function(){
    agregar();
    });
  });

var cont=0;
 total=0;
 subtotal=[];
 $("#guardar").hide();
 $("#pidarticulo").change(mostrarvalores);

function mostrarvalores()
{

	datosArticulo=document.getElementById('pidarticulo').value.split('_');
	$("#pprecio_venta").val(datosArticulo[2]);
	$("#pstock").val(datosArticulo[1]);
}



function agregar()
{
	datosArticulo=document.getElementById('pidarticulo').value.split('_');

	idarticulo=datosArticulo[0];
    articulo=$("#pidarticulo option:selected").text();
    stock=$("#pstock").val();
    cantidad=$("#pcantidad").val();
    descuento=$("#pdescuento").val();
    precio_venta=$("#pprecio_venta").val();
   



if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_venta!="")

		{
			 if(Number(stock)>=Number(cantidad))
			//if (stock >= cantidad)
			{
			//	alert(stock+cantidad);
			//subtotal[cont]=(cantidad*precio_venta-descuento);
			subtotal[cont]=(cantidad*precio_venta);
			total=total+subtotal[cont];

			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';

			   cont++;
		       limpiar();
		       $('#total').html("$ " + total);
		       $('#total_venta').val(total);
		       evaluar();
		       $('#detalles').append(fila);
			}
			else
			{
			alert('No se puede realizar la venta cuando la cantidad supera el stock');
			//	alert(stock+cantidad);
			}

		
		}

		else {
			alert("Error en el ingreso de datos");
		}
}


	function limpiar(){
		$("#pcantidad").val("");
		$("#pdescuento").val("");
		$("#pprecio_venta").val("");
		$("#pstock").val("");

	}

	function evaluar()
	{
		if (total>0)
		{
			$("#guardar").show();
		}
		else {
			$("#guardar").hide();
		}
	}


	function eliminar(index){
	//	alert(cont);
		total=total-subtotal[index];
		$("#total").html("$ "+total);
		$("#total_venta").val(total);
		$("#fila"+index).remove();
		evaluar();
	}

</script>
@endpush
@endsection