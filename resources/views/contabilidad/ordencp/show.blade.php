@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
		<div class="form-group">
			<label for="">Proveedor</label>
			<p>{{$compegres->proveedor}} </p>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Comprobante</label>
			<p>{{$compegres->comprobante}} </p>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label >Valor Por:</label>
			<p>{{$compegres->valpagado}} </p>
		</div>
	</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="">Forma de Pago</label>
				<p>{{$compegres->tipopago}} </p>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="valdeuda">Por Concepto de: </label>
				<textarea  name="concepto" value=""  cols="100" rows="3" placeholder="Concepto de Orden de Egreso..."></textarea>		
			</div>
		</div>
</div>
<div class="row">
<div class="panel panel-primary">
	<div class="panel-body">
		
		<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5">
					<tr><th style="text-align: center;" colspan="4">CONTABILIZACION</th></tr>
					<tr>
					<th>Cuenta Contable</th>
					<th>Debito</th>
					<th>Credito</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
					<th><select name="compegreso" id="compegreso" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
				    <th><input type="number" width="60px" name="codigocc" value="" ></th>
					<th><input type="number" width="60px" name="codigocc" value="" ></th>
					</tr>
					<tr>
					<th><select name="compegreso" id="compegreso" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
					<th><input type="number" width="60px" name="codigocc" value="" ></th>
					<th><input type="number" width="60px" name="codigocc" value="" ></th>
					</tr>
					<tr>
					<th><select name="compegreso" id="compegreso" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
					<th><input type="number" width="60px" name="codigocc" value="" ></th>
					<th><input type="number" width="60px" name="codigocc" value="" ></th>
					</tr>
				</tfoot>
				<tbody>
					
				</tbody>
			</table>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12" id="guardar">
		<div class="form-group">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<a href="javascript:window.history.go(-1);"><button class="btn btn-danger" type="reset">Cancelar</button></a>
				</div>
		</div>
	</div>
		</div>
	</div>
</div>
	
</div>
				

@endsection