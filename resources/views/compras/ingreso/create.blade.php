@extends ('layouts.admin')
@section ('contenido')
@push ('scripts')
	<script src="{{ asset('js/compras/ingreso.js') }}"></script>
@endpush
		{!! Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
<div class="row">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="proveedor">Proveedor</label>
			<div style="display: flex;">
				<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
				@foreach($personas as $persona)
					<option value="{{$persona->id}}">
						{{$persona->nombre}}
					</option>
				@endforeach
				</select>
				<a href="" data-target="#modal-add-proveedor" data-toggle="modal"><button type="button" id="btn_newProveedor" class="btn btn-primary">...</button></a>
			</div>
		</div> 	
	</div>
	<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-proveedor">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close">
							<span aria-hidden="true">x</span>
						</button>
						<h4 class="modal-title">Nuevo Proveedor</h4>
					</div>
					<div id="data_proveedor" class="modal-body">
						<div class="row">
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" name="prov_nombre" class="form-control" placeholder="Nombre....">
								</div>
							</div>
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label for="apellido">Apellido</label>
									<input type="text" name="prov_apellido" class="form-control" placeholder="Apellido....">
								</div>
							</div>
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label for="nombre">Direccion</label>
									<textarea name="prov_direccion" class="form-control" placeholder="Direccion...."></textarea>
								</div>
							</div>
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label>Tipo Documento</label>
									<select name="prov_tipo_documento" class="form-control">
										<option value="" selected>Seleccione Tipo de Documento</option>
										@foreach($tipodocumentos as $tip_doc)
											<option value="{{$tip_doc->id}}">{{$tip_doc->descripcion}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label for="codigo">Numero Documento</label>
									<input type="text" name="prov_numero_documento" class="form-control" placeholder="Numero Documento....">
								</div>
							</div>
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label for="stock">Teléfono</label>
									<input type="text" name="prov_telefono" class="form-control" placeholder="Telefono....">		
								</div>
							</div>
							<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
								<div class="form-group">
									<label for="descripcion">E-mail</label>
									<input type="text" name="prov_email" class="form-control" placeholder="E-mail....">		
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
								<div class="form-group">
									<label>Tipo Documento del Representante</label>
									<select name="prov_tipo_documento_representante" class="form-control">
										<option value="" selected>Seleccione Tipo de Documento</option>
										@foreach($tipodocumentos as $tip_doc)
											<option value="{{$tip_doc->id}}">{{$tip_doc->descripcion}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
								<div class="form-group">
									<label for="cedularepresenta">Cedula Repersentante</label>
									<input type="text" name="prov_cedularepresenta" class="form-control" placeholder="Cedula Reprsentante....">		
								</div>
							</div>
							<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
								<div class="form-group">
									<label for="representante">Nombre Completo Repersentante</label>
									<input type="text" name="prov_representante" class="form-control" placeholder="Reprsentante....">		
								</div>
							</div>
							<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
								<div class="form-group">
									<label for="emailrepresenta">E-mail</label>
									<input type="text" name="prov_emailrepresenta" class="form-control" placeholder="Correo Reprsentante....">		
								</div>
							</div>
							<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
								<div class="form-group">
									<label for="telefonorepresenta">Telefono Representante</label>
									<input type="text" name="prov_telefonorepresenta" class="form-control" placeholder="Reprsentante....">		
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="prov_aceptar" class="btn btn-default" data-dismiss="modal">Aceptar</button>
					</div>		
				</div>
			</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<input type="hidden" id="idvendedor" name="idvendedor"  required>
			<label for="vendedor">Empleado Responsable</label><label id="nombreVendedor"></label>
			<input type="password" name="vendedor" id="vendedor" class="form-control" required placeholder="Codigo Empleado...." >
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Forma de Pago</label>
			<select name="formapago" class="form-control">
				<option value="" selected>Seleccione Forma de Pago</option>
				@foreach($formaPago as $for)
				<option value="{{$for->id}}">{{$for->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Tipo de Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="" selected>Seleccione Tipo de Comprobante</option>
				@foreach($tipoComprobante as $tcomp)
				<option value="{{$tcomp->id}}">{{$tcomp->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie Documento....">		
		</div>
	</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="numero_comprobante">Numero Comprobante</label>
			<input type="text" name="numero_comprobante" required value="{{old('numero_comprobante')}}" class="form-control" placeholder="Serie Documento....">		
		</div>
	</div>
</div>
<div class="row">
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-articulo">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">x</span>
					</button>
					<h4 class="modal-title">Nuevo Articulo</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" name="art_nombre" class="form-control" placeholder="Nombre....">		
							</div>
						</div>
						<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
							<div class="form-group">
								<label>Categoria</label>
								<select name="art_idcategoria" class="form-control">
									<option value="" selected>Seleccione Categoria</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
							<div class="form-group">
								<label>Tipo Producto</label>
								<select name="art_idTipoProductos" class="form-control">
									<option value="" selected>Seleccione Tipo Producto</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
							<div class="form-group">
								<label for="codigo">Codigo</label>
								<input type="text" name="art_codigo" value="{{old('codigo')}}" class="form-control" placeholder="Codigo....">
							</div>
						</div>
						<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
							<div class="form-group">
								<label for="descripcion">Descripcion</label>
								<input type="text" name="art_descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripcion....">		
							</div>
						</div>
						<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
							<div class="form-group">
								<label for="imagen">Imagen</label>
								<input type="file" name="art_imagen" class="form-control">	
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
				</div>		
			</div>
		</div>
</div>
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
			<label>Articulo</label>
			<div style="display: flex;">
				<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
				@foreach($articulos as $articulo)
					<option value="{{$articulo->idarticulo}}">
						{{$articulo->articulo}}
					</option>
				@endforeach
				</select>	
				<a href="" data-target="#modal-add-articulo" data-toggle="modal"><button type="button" id="btn_newArticulo" class="btn btn-primary">...</button></a>
			</div>
			
			</div>
		</div>
		<div class="col-lg-3 col-mg-3 col-sg-3 col-xs-12">
			<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad...." >
			</div>
		</div>
		<div class="col-lg-3 col-mg-3 col-sg-3 col-xs-12">
			<div class="form-group">
			<label for="precio_compra">Prec.Compra</label>
			<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Prec.Compra.." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="por_venta">% Ganancia</label>
			<input type="number" name="por_venta" id="por_venta" class="form-control" placeholder="% Ganancia.." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta Normal</label>
			<input type="number" name="pprecio_venta_normal" id="pprecio_venta_normal" class="form-control" placeholder="Prec.Venta.Normal." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta Empresarial</label>
			<input type="number" name="pprecio_venta_empresarial" id="pprecio_venta_empresarial" class="form-control" placeholder="Prec.Venta.Empresarial." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta Distribución</label>
			<input type="number" name="pprecio_venta_distribucion" id="pprecio_venta_distribucion" class="form-control" placeholder="Prec.Venta.Distribución." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
				<label for="tipoiva">Iva</label>
				<input name="ptipoiva" id="ptipoiva" type="checkbox" checked>
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<p>&nbsp;</p>
			<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
			</div>
		</div>
		<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5">
					<th>Opciones</th>
					<th>Articulo</th>
					<th>Cantidad</th>
					<th>Precio Compra</th>
					<th>Precio Venta</th>
					<th>Tipo Iva</th>
					<th>Subtotal</th>
				</thead>
				<tfoot>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
			
					<th style="text-align: right;" >Subtotal 12%</th>
					
					<th colspan="2" style="text-align: right;"><h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
					<th></th>
					</tr>
					<tr>
					<th>Retencion Fuente. </th>
					<th style="text-align: right;">
						
						<select name="pretfuente" class="form-control" id="pretfuente" onchange="mostrarValor(Math.round(((this.value/100)*subtotalr)*100)/100);">
						<option value="1">1 % Bienes</option>
						<option value="2">2 % Servicios</option>
						<option value="5">5 % Bancos</option>
						<option value="8">8 % ND</option>
						<option value="10">10 % Profesionales</option>
						</select>

					</th>
					<th ><input  name="retfuente" id="retfuente" value="" style="text-align: right; width: 80px; "></th>
					<th></th>
					<th style="text-align: right;" >Subtotal 0%</th>
					<th colspan="2" style="text-align: right;"><h4 id="total12">$ 0.00</h4><input type="hidden" name="total_venta12" id="total_venta12"></th>
					</tr>
					<th></th>
					<tr>
					<th>Retencion Iva. </th>
					<th style="text-align: right;">
						
						<select name="pretiva" class="form-control" id="pretiva" onchange="mostrarValor1(Math.round(((this.value/100)*totiva12)*100)/100);">
						<option value="10">10 %</option>
						<option value="30">30 %</option>
						<option value="70">70 %</option>
						<option value="100">100 %</option>
						</select>

					</th>
					<th><input name="retiva" id="retiva" style="text-align: right; width: 80px; "></th></th>
					<th></th>
				
					<th style="text-align: right;" >Subtotal</th>
					
					<th colspan="2" style="text-align: right;"><h4 id="subtot">$ 0.00</h4><input type="hidden" name="subtot1" id="subtot1" value=""></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>

					<th style="text-align: right;" >Iva 12%</th>					
	<th colspan="2" style="text-align: right;"><h4 id="totiva121">$ 0.00</h4><input type="hidden" name="total_iva" id="total_iva" value=""></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				
					<th style="text-align: right;" >Total a Pagar</th>
				
					<th colspan="2" style="text-align: right;"><h4 id="totalpagar">$ 0.00</h4><input type="hidden" name="total_pagar" id="total_pagar"></th>
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
					<button class="btn btn-primary" id="guardar" type="submit">Guardar</button>
					<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
				</div>
		</div>
	</div>
</div>
</div>
@endsection