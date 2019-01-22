@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Nueva Venta</h3>
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
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
		<div class="form-group">
			<label for="proveedor">Cliente</label>
			<p>{{$venta->nombre}} </p>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Tipo Comprobante</label>
					<p>{{$venta->tipo_comprobante}} </p>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
					<p>{{$venta->serie_comprobante}} </p>
		</div>
	</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="numero_comprobante">Numero Comprobante</label>
					<p>{{$venta->numero_comprobante}} </p>
		</div>
	</div>
<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
				<label>Cliente</label>
				<p>{{$venta->nombre}} </p>
		</div>
	</div>

	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="idvendedor">Codigo Vendedor</label>
			<input type="text" name="idvendedor" value="" class="form-control" placeholder="Codigo Vendedor....">	
		</div>
	</div>
</div>

<div class="row">
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
			<label>Articulo</label>
			<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
			@foreach($articulos as $articulo)
				<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}_{{$articulo->iva}}">
					{{$articulo->articulo}}
				</option>
			@endforeach
			</select>
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad...." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="stock">Stock</label>
			<input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="stock...." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta</label>
			<input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Prec.Venta.." >
			</div>
		</div>
		<div class="col-lg-1 col-mg-1 col-sg-1 col-xs-12">
			<div class="form-group">
			<label for="iva">Iva</label>
			<input type="number" disabled name="piva" id="piva" class="form-control" placeholder="Iva %.." >
			</div>
		</div>
		<div class="col-lg-1 col-mg-1 col-sg-1 col-xs-12">
			<div class="form-group">
			<label for="descuento">Descuento</label>
			<input type="number" name="pdescuento" id="pdescuento" class="form-control" value="0" placeholder="descuento.." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
			</div>
		</div>
		<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5">
					<th style="width: 100px; text-align:center;">Opciones</th>
					<th style="width: 100px; text-align:center;">Articulo</th>
					<th style="width: 100px; text-align:center;"">Cantidad</th>
					<th style="width: 100px; text-align:center;"">Precio Venta</th>
					<th style="width: 100px; text-align:center;" >Tipo Iva %</th>
					<th style="width: 100px; text-align:center;" ">Desc %</th>
					<th style="width: 100px; text-align:center;" ">Subtotal</th>
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
						<td><a href="" data-target="#modald-delete-{{$det->iddetalle_venta}}" data-toggle="modal"><button class="btn btn-danger">x</button></a></td>
						<td>{{$det->articulo}}</td>
						<td style="width: 100px; text-align:center;">{{$det->cantidad}}</td>
						<td style="width: 100px; text-align:center;">{{$det->precio_venta}}</td>
						<td style="width: 100px; text-align:center;">{{$det->tipoiva}}</td>
						<td style="width: 100px; text-align:center;">{{$det->descuento}}</td>
						<td style="width: 100px; text-align:right;">{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
					</tr>
					@include('ventas.venta.modald')
					@endforeach
				</tbody>
			</table>
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
 total0=0;
 total12=0;
 totiva12=0;
 totalpagar=0;
 subtot=0;
 subtotal=[];
 $("#guardar").hide();
 $("#pidarticulo").change(mostrarvalores);

function mostrarvalores()
{

	datosArticulo=document.getElementById('pidarticulo').value.split('_');
	$("#pprecio_venta").val(datosArticulo[2]);
	$("#pstock").val(datosArticulo[1]);
	$("#piva").val(datosArticulo[3]);
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
    iva=$("#piva").val();

   

//alert(stock+cantidad);

if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_venta!="")

		{
			 if(Number(stock)>=Number(cantidad))
			{
			
			if (iva==12)
			{
				//alert('sdds')
				subtotal[cont]=Math.round(((cantidad*precio_venta) - ((cantidad*precio_venta)*descuento/100))*100)/100;
				total=total+(Math.round(subtotal[cont]*100)/100);
				totiva12=Math.round((total*(iva/100))*100)/100;
			}
			else
			{
				//alert('dddd')
				subtotal[cont]=Math.round(((cantidad*precio_venta) - ((cantidad*precio_venta)*descuento/100))*100)/100;
				//subtotal[cont]=(cantidad*precio_venta);
				total0=total0+(Math.round(subtotal[cont]*100)/100);
				
			}

			subtot=	Math.round((total+total0)*100)/100;
			totalpagar=Math.round((subtot+totiva12)*100)/100;
			
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'" style="width: 100px; text-align:center;"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'" style="text-align:center;"></td><td><input type="number" name="iva[]" value="'+iva+'" style="text-align:center;"></td><td><input type="number" name="descuento[]" value="'+descuento+'" style="width: 100px; text-align:center;"></td><td style="width: 100px; text-align:right; ">'+subtotal[cont]+'</td></tr>';

			   cont++;
		       limpiar();
		       $('#total12').html("$ " + total);
		       $('#total_12').val(total);
		       $('#total0').html("$ " + total0);
		       $('#total_0').val(total0);
		 	   $('#subtot').html("$ " + subtot);
		       $('#subtotal').val(subtot);
		       $('#totiva12').html("$ " + totiva12);
		       $('#tot_iva12').val(totiva12);
		       $('#totalpagar').html("$ " + totalpagar);
		       $('#total_pagar').val(totalpagar);
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
		$("#pdescuento").val(0);
		$("#pprecio_venta").val("");
		$("#pstock").val("");
		$("#piva").val("");

	}

	function evaluar()
	{
		if (total>0 || total12>0)
		{
			$("#guardar").show();
		}
		else {
			$("#guardar").hide();
		}
	}


	function eliminar(index){
		total=total-subtotal[index];
		$("#total").html("$ "+total);
		$("#total_venta").val(total);
		$("#fila"+index).remove();
		evaluar();
	}

</script>
@endpush
@endsection