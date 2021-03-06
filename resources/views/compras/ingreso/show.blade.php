@extends ('layouts.admin')
@section ('contenido')
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'orden')">Detalle de Ingreso</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Detalle de Retencion</button>

</div>

<div id="orden" class="tabcontent">
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
					<th style="text-align: right;"><h4 id="total">{{$ingreso->subtotal}}</h4>
					
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
					
					<th style="text-align: right;"><h4 id="total12">{{$ingreso->impuesto + $ingreso->subtotal}}</h4>
					</tr>
					</tfoot>
						<tbody>
							@foreach($detalles as $det)
							<tr>
								<td>{{$det->articulo}}</td>
								<td>{{$det->cantidad}}</td>
								<td>{{$det->precio_compra}}</td>
								<td>{{$det->precio_venta_normal}}</td>
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

<div id="Paris" class="tabcontent">

			<h3>Retencion</h3>
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							<th>Base Fuente</th>
							<th>Porcentaje</th>
							<th>Retencion</th>
							<th>Base Iva</th>
							<th>Porcentaje</th>
							<th>Retencion</th>
						</thead>
					<tfoot>
					
					</tfoot>
						<tbody>
						
							<tr>
								<td>{{$ingreso->subtotal}}</td>
								<td>{{$ingreso->retfuente}}</td>
								<td>{{($ingreso->retfuente/100)*$ingreso->retfuente}}</td>
								<td>{{$ingreso->retiva}}</td>
								<td>{{$ingreso->impuesto}}</td>
								<td>{{($ingreso->retiva/100)*$ingreso->impuesto}}</td>
							</tr>
							
						</tbody>
					</table>
	</div>
</div>

				
{!! Form::close()!!}

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