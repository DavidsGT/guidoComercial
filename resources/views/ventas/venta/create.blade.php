@extends ('layouts.admin',['title'=>"Nueva Cotización"])
@section ('contenido')
@push ('scripts')
	<script src="{{ asset('js/ventas/venta.js') }}"></script>
@endpush
@push ('scripts')
	<link href="{{ asset('css/ventas/modal.css') }}" rel="stylesheet">
@endpush
		{!! Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off','id'=>'venta'))!!}
			{{Form::token()}}
<div class="row">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Tipo Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="Factura">Cotizacion</option>
				
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<input type="text" readonly="" name="serie_comprobante" value="001-001" class="form-control" placeholder="Serie Documento....">		
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
				<label for="numero_comprobante">Numero Comprobante</label>
				<input type="text" readonly="" name="numero_comprobante" required value="0" class="form-control" placeholder="Serie Documento....">
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="cliente">Cliente</label>
			<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">	
			@foreach($personas as $persona)
				@if ($persona->nombre == "999999999 Consumidor Final")
					<option value="{{$persona->id}}_{{$persona->fk_pg_tipo_cliente}}" selected>
						{{$persona->nombre}}
					</option>
				@else
					<option value="{{$persona->id}}_{{$persona->descripcion}}">
						{{$persona->nombre}}
					</option>
				@endif
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<input type="hidden" id="idvendedor" name="idvendedor" value="" class="form-control" placeholder="Codigo Vendedor...." required>	
			<label for="idvendedor">Codigo Vendedor</label><label id="nombreVendedor"></label>
			<input type="password" id="codvendedor" value="" required="" class="form-control" placeholder="Codigo Vendedor...." required>	
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="idvendedor">Tipo de Cliente</label>
			<input type="text" name="tipo_cliente" disabled="" id="tipo_cliente" value="" class="form-control" placeholder="tipo cliente....">	
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary">
		<div style="padding-top: 1px; padding-bottom: 1px;" class="panel-body">
			<div id="agregar_articulo">
				<div id="modal-alerta" class="modal">
					<!-- Modal content -->
					<div class="modal-content">
						<span class="close">&times;</span>
						<p>Alerta de Stock</p>
				  	</div>
				</div>
				<div>
					<div class="col-lg-5 col-mg-5 col-sg-5 col-xs-12">
						<div class="form-group">
						<label>Articulo</label>
						<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
							<option value="0" selected>Seleccionar Articulo...</option>
						@foreach($articulos as $articulo)
							<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_normal}}_{{$articulo->iva}}_{{$articulo->precio_empresarial}}_{{$articulo->precio_distribucion}}_{{$articulo->stockmin}}">
								{{$articulo->articulo}}
							</option>
						@endforeach
						</select>
						</div>
					</div>
					<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
						<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="pcantidad" min="1" max="" id="pcantidad" class="form-control" placeholder="cantidad...." >
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
							<label for="precio_venta">Prec.Venta &nbsp;</label><input type="radio" name="prec" value="precio_normal" checked>P   &nbsp;<input type="radio" name="prec" value="precio_empresarial">N   &nbsp;<input type="radio" name="prec" value="precio_distribucion">D
							<input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Prec.Venta.." >
						</div>
					</div>
					<div hidden="" class="col-lg-1 col-mg-1 col-sg-1 col-xs-12">
						<div class="form-group">
						<label for="iva">Iva</label>
						<input type="number" disabled name="piva" id="piva" class="form-control" placeholder="Iva %.." >
						</div>
					</div>
					<!--<div class="col-lg-1 col-mg-1 col-sg-1 col-xs-12">
						<div class="form-group">
						<label for="descuento">Desc %</label>-->
						<input type="hidden" name="pdescuento" id="pdescuento" disabled="" class="form-control" value="0" placeholder="0" >
						<!--</div>
					</div>-->
				</div>
				<div><h3 class="text-center"><small class="mensaje"></small></h3></div>
			</div>
			<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
				<div class="form-group">
				<button type="button" id="bt_add" onclick="agregar()" class="btn btn-primary">Agregar</button>
				</div>
			</div>
			<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						<th style="width: 70px; text-align:center;">Opciones</th>
						<th style="width: 100px; text-align:center;">Articulo</th>
						<th style="width: 80px; text-align:center;"">Cant</th>
						<th style="width: 100px; text-align:center;"">Prec.Unit</th>
						<th style="width: 70px; text-align:center;" >Iva %</th>
						<!--<th style="width: 70px; text-align:center;" ">Desc %</th>-->
						<th style="width: 90px; text-align:center;" ">Subtotal</th>
					</thead>
					<tfoot>
						<tr style="height: 30px;" nowrap>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--<th></th>-->
						<th style="text-align: right; line-height:5pt; ">Subtotal 12%</th>
						<th style="text-align: right;"><h4 style="line-height:5pt;" id="total12">$ 0.00</h4><input type="hidden" name="total_12" id="total_12"></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--<th></th>-->
						<th style="text-align: right; line-height:5pt;">Subtotal 0%</th>
						<th style="text-align: right;"><h4 style="line-height:5pt;" id="total0">$ 0.00</h4><input type="hidden" name="total_0" id="total_0"></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--<th></th>-->
						<th style="text-align: right; line-height:5pt;">Descuento </th>
						<th style="text-align: right;"><h4 style="line-height:5pt;" id="desc">$ 0.00</h4><input type="hidden" name="desc" id="desc"></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--<th></th>-->
						<th style="text-align: right;">Subtotal</th>
						<th style="text-align: right;"><h4 style="line-height:5pt;" id="subtot">$ 0.00</h4><input type="hidden" name="subtotal" id="subtotal"></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--<th></th>-->
						<th style="text-align: right;">Iva 12%</th>
						<th style="text-align: right;"><h4 style="line-height:5pt;" id="totiva12">$ 0.00</h4><input type="hidden" name="tot_iva12" id="tot_iva12"></th>
						</tr>
						<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--<th></th>-->
						<th style="text-align: right;">Total a Pagar</th>
						<th style="text-align: right;  background-color:blue; color: white;"><h4 style="line-height:5pt;" id="totalpagar">$ 0.00</h4><input type="hidden" name="total_pagar" id="total_pagar"></th>
						</tr>
					</tfoot>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="button" class="btn btn-primary" id="guardar" onclick="save()">Guardar</button>
				<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		</div>
	</div>
</div>
{!! Form::close()!!}


@endsection