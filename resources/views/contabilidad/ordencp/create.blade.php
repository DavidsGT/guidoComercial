@extends ('layouts.admin')
@section ('contenido')

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'pagos')">Detalle de Pagos</button>
  <button class="tablinks" onclick="openCity(event, 'detalle')">Detalle de Ingreso</button>



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
		{!! Form::open(array('url'=>'contabilidad/ordencp','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="idingreso">Orden de Ingreso</label>
				<input type="number" readonly name="idingreso" value="{{$ordenes->idingreso}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Proveedor</label>
				<input type="text" readonly name="proveedor" value="{{$ordenes->nombre}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="fechacredito">Fecha de Ingreso</label>
				<input type="text" readonly name="fechacredito" value="{{$ordenes->fecha_hora}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="comprobante">Comprobante de Ingreso</label>
				<input type="text" readonly name="comprobante" value="{{$ordenes->comprobante}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Cuenta a Debitar</label>
				<select name="entidad" class="form-control">
					@foreach($cuentas as $cut)
					<option value="{{$cut->cuentas}}">{{$cut->cuentas}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="valdeuda">Valor de la Deuda</label>
				<input type="number" readonly name="valdeuda" value="{{$ordenes->total}}" class="form-control">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="valpagado">Valor a Debitar</label>
				<input type="number" name="valpagado" required value="{{old('valpagado')}}" class="form-control" step="any">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Pago</label>
				<select name="tipopago" class="form-control">
					<option value="Efectivo">Efectivo</option>
					<option value="Cheque">Cheque</option>
					<option value="Transferencia">Transferencia</option>
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="numdoc">Numero de Documento</label>
				<input type="number" name="numdoc" required value="{{old('numdoc')}}" class="form-control" placeholder="Documento de soporte...">		
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
				<th>FechaCredito</th>
				<th>FechaPago</th>
				<th>Comprobante</th>
			    <th>Credito</th>
			    <th>Pago</th>
			    <th>Forma</th>
			    <th>Entidad</th>
			    <th>Opciones</th>
			</thead>
		@foreach ($detallecp as $ing)
			<tr>
				<td>{{ $ing->iddetorden}}</td>
				<td>{{ $ing->fechacredito}}</td>
				<td>{{ $ing->fechapago}}</td>
				<td>{{ $ing->comprobante}}</td>
				<td>{{ $ing->valdeuda}}</td>
				<td>{{ $ing->valpagado}}</td>
				<td>{{ $ing->tipopago}}</td>
				<td>{{ $ing->entidad}}</td>
				<td>
			<a href="{{URL::action('OrdencpController@show',$ing->iddetorden)}} "><button class="btn btn-primary">Procesar</button></a>
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
				<label for="proveedor">Proveedor</label>
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
						<p>{{$ingreso->numero_comprobante}} </p>
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
					<th style="text-align: right;">Retencion Fuente. </th>
					<th style="text-align: right;"><h4 id="retfuente">{{$ingreso->retfuente}}</h4>
					<th></th>
					<th style="text-align: right;" >Iva 12%</th>
					<th style="text-align: right;"><h4 id="total12">{{$ingreso->impuesto}}</h4>
					</tr>
					<tr>
					<th style="text-align: right;">Retencion Iva. </th>
					<th style="text-align: right;"><h4 id="total12">{{$ingreso->retiva}}</h4>
					<th></th>
				
					<th style="text-align: right;" >Total Ingreso</th>
					
					<th style="text-align: right;"><h4 id="total12">{{$ingreso->subtotal}}</h4>
					</tr>
					</tfoot>
						<tbody>
							@foreach($detalles as $det)
							<tr>
								<td>{{$det->articulo}}</td>
								<td>{{$det->cantidad}}</td>
								<td>{{$det->precio_compra}}</td>
								<td>{{$det->precio_venta}}</td>
								<td>{{$det->cantidad*$det->precio_compra}}</td>
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