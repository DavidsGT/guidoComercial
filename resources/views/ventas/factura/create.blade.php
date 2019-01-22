@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Nueva Cotizacion</h3>
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
		{!! Form::open(array('url'=>'ventas/factura','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
<div class="row">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="cliente">Cliente</label>
			<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
			@foreach($personas as $persona)
				<option value="{{$persona->idpersona}}">
					{{$persona->nombre}}
				</option>
			@endforeach
			</select>
		</div>
	</div>

	<div class="col-lg-5 col-mg-5 col-sg-5 col-xs-12">
		<div class="form-group">
			<label for="vendedor">Codigo Vendedor</label>
			<input type="text" name="nvendedor" value="" class="form-control" placeholder="Codigo Vendedor....">	
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Tipo Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="Factura">Factura</option>
				<option value="NotaVenta">Nota Venta</option>
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<input type="text" name="serie_comprobante" value="001-001" class="form-control" placeholder="Serie Documento....">		
		</div>
	</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="numero_comprobante">Numero Comprobante</label>
			<input type="text" name="numero_comprobante" required value="0" class="form-control" placeholder="Serie Documento....">		
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
			<label for="descuento">Desc %</label>
			<input type="number" name="pdescuento" id="pdescuento" class="form-control" value=0 placeholder="descuento.." >
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
					<th>Opciones</th>
					<th>Articulo</th>
					<th style="width: 100px;">Cantidad</th>
					<th>Precio Venta</th>
					<th >Tipo Iva %</th>
					<th style="width: 100px; ">Desc %</th>
					<th style="width: 100px; ">Subtotal</th>
				</thead>
				<tfoot>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Subtotal 12%</th>
					<th style="text-align: right;"><h4 id="total12">$ 0.00</h4><input type="hidden" name="total_12" id="total_12"></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Subtotal 0%</th>
					<th style="text-align: right;"><h4 id="total0">$ 0.00</h4><input type="hidden" name="total_0" id="total_0"></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Subtotal</th>
					<th style="text-align: right;"><h4 id="subtot">$ 0.00</h4><input type="hidden" name="subtotal" id="subtotal"></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Iva 12%</th>
					<th style="text-align: right;"><h4 id="totiva12">$ 0.00</h4><input type="hidden" name="tot_iva12" id="tot_iva12"></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">Total a Pagar</th>
					<th style="text-align: right;"><h4 id="totalpagar">$ 0.00</h4><input type="hidden" name="total_pagar" id="total_pagar"></th>
					</tr>
				</tfoot>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12" id="guardar">
		<div class="form-group">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
				</div>
		</div>
	</div>
</div>
				
{!! Form::close()!!}

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
			
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'" style="width: 100px;"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="iva[]" value="'+iva+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'" style="width: 100px;" ></td><td style="width: 100px; text-align:right; ">'+subtotal[cont]+'</td></tr>';

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