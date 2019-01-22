@extends ('layouts.admin')
@section ('contenido')

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'pagos')">Proceso Devolucion</button>
  <button class="tablinks" onclick="openCity(event, 'detalle')">Detalle de Venta</button>
</div>

<div id="pagos" class="tabcontent">
	<div class="row">
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
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
		{!! Form::open(array('url'=>'ventas/devoluciones','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="idingreso">Factura No.</label>
				<input type="number" readonly name="idingreso" value="{{$ordenes->idventa}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Cliente</label>
				<input type="text" readonly name="proveedor" value="{{$ordenes->nombre}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="fechacredito">Fecha de Venta</label>
				<input type="text" readonly name="fechacredito" value="{{$ordenes->fecha_hora}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="comprobante">Número de Comprobante</label>
				<input type="text" readonly name="comprobante" value="{{$ordenes->comprobante}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Escoja el Articulo a Devolver</label>
				<select name="articulo" id="articulo" class="form-control">
					<option>Escoja Producto</option>
					@foreach($detalles as $det)
					<option value="{{$det->idarticulo}}_{{$det->cantidad}}_{{$det->articulo}}">{{$det->articulo}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<input type="hidden" name="artiselect" id="artiselect">	
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="cantcompra">Cantidad de Venta</label>
				<input type="number" readonly="" id="cantcompra" name="cantcompra" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="cantidad">Cantidad a Devolver</label>
				<input type="number" name="cantidad" required value="{{old('cantidad')}}" class="form-control" step="any">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Motivo de Devolucion</label>
				<select name="motivo" class="form-control">
					<option value="Efectivo">Mal Estado</option>
					<option value="Cheque">Producto Caducado</option>
					<option value="Transferencia">Informacion Ilegible</option>
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="numdoc">Autorizado Por:</label>
				<input type="number" name="numdoc" required value="{{old('numdoc')}}" class="form-control" placeholder="Nombre de quien Autoriza...">		
			</div>
		</div>
		
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
				</div>
			</div>
		</div>
</div>
{!! Form::close()!!}
<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>No.</th>
				<th>FechaVenta</th>
				<th>FechaDevolucion</th>
				<th>Comprobante</th>
			    <th>Cant.Compra</th>
			    <th>Cant.Devuelta</th>
			    <th>Articulo</th>  
			    <th>Estado</th>
			    <th>Opciones</th>
			    <th>CEgreso</th>
			</thead>
		@foreach ($detallecp as $ing)
			<tr>
				<td>{{ $ing->iddetorden}}</td>
				<td>{{ $ing->fechacredito}}</td>
				<td>{{ $ing->fechadevol}}</td>
				<td>{{ $ing->comprobante}}</td>
				<td>{{ $ing->valdeuda}}</td>
				<td>{{ $ing->cantidad}}</td>
				<td>{{ $ing->articulo}}</td>
				<td>{{ $ing->estado}}</td>
				<td>
			@if($ing->estado=="ABIERTA")		
			<a href="{{URL::action('DevolucionControl@show',$ing->iddetorden)}} "><button class="btn btn-primary">Procesar</button></a>
			@else
			<a href="{{URL::action('DevolucionControl@show',$ing->iddetorden)}} "><button disabled="" class="btn btn-primary">Procesar</button></a>
			@endif
				</td>
			<td>	
			@if($ing->estado=="ABIERTA")		
			<a  href="{{URL::action('DocumentoControl@rptce',$ing->iddetorden)}}" target="_blank" ><input disabled="" src="{{asset('img/print.png')}}" width="30" height="30" align="center" type="image"></a>
				@else
			<a href="{{URL::action('DocumentoControl@rptce',$ing->iddetorden)}}" target="_blank" ><input src="{{asset('img/print.png')}}" width="30" height="30" align="center" type="image"></a>
			@endif
			</td>
			</tr>
			
		@endforeach
			
		</table>
		</div>
		

	</div>
</div>
</div>

<div id="detalle" class="tabcontent">
	<div class="row">
		<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Cliente</label>
				<p>{{$ingreso->nombre}} </p>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Comprobante</label>
						<p>{{$ingreso->tipo_comprobante}} </p>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="serie_comprobante">Serie Comprobante</label>
						<p>{{$ingreso->serie_comprobante}} </p>
			</div>
		</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="numero_comprobante">Numero Comprobante</label>
						<p>{{$ingreso->idventa}} </p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
			
				<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							<th>Articulo</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Precio Venta</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;" >Subtotal </th>
					<th style="text-align: right;"><h4 id="total">{{$ingreso->total}}</h4>
					
					</tr>
					<tr>
					
					<th style="text-align: right;" >Total Ingreso</th>
					
					<th style="text-align: right;"><h4 id="total12">{{$ingreso->subtotal}}</h4>
					</tr>
					</tfoot>
						<tbody>
							@foreach($detalles as $det)
							<tr>
								<td>{{$det->articulo}}</td>
								<td>{{$det->cantidad}}</td>
								
								<td>{{$det->precio_venta}}</td>
								<td>{{$det->cantidad*$det->precio_venta}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>	


		


<style type="text/css">
	
/* Style the tab */

div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {

    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

</style>

@push ('scripts')

				

<script>
	 $("#articulo").change(mostrarvalores);
	function mostrarvalores()
	{

		datosArticulo=document.getElementById('articulo').value.split('_');
		$("#cantcompra").val(datosArticulo[1]);
		$("#artiselect").val(datosArticulo[2]);
		
	}

	function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
       tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
   
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


</script>

@endpush

@endsection