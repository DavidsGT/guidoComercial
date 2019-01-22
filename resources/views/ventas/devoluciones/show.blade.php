@extends ('layouts.admin')
@section ('contenido')

{!! Form::open(array('action'=>array('DocumentoControl@store',$compegres->iddetorden),'method'=>'GET')) !!}
	<div class="row">
	<input type="hidden" name="codigo" value="{{$compegres->iddetorden}} ">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="">Proveedor</label>
			<input type="text" name="proveedor" readonly="" value="{{$compegres->proveedor}} " class="form-control">
		</div>
	</div>
	<div class="col-lg-3 col-mg-3 col-sg-3 col-xs-12">
		<div class="form-group">
			<label>Comprobante</label>
			<input type="comprobante" name="comprobante" readonly="" value="{{$compegres->comprobante}} " class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
		<div class="form-group">
			<label >Valor Por:</label>
			<input type="number" required="" name="valor" class="form-control">
		</div>
	</div>
	<div class="col-lg-3 col-mg-3 col-sg-3 col-xs-12">
			<div class="form-group">
				<label for="">Forma de Pago</label>
				<input type="text" name="forma" readonly="" value="{{$compegres->motivo}} " class="form-control">
			</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="valdeuda">Por Concepto de: </label><br>
				<textarea  name="concepto" value="" required=""  cols="70" rows="3" placeholder="Concepto de Orden de Egreso..."></textarea>		
			</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="valdeuda">Autorizado Por: </label><br>
				<input type="text" name="autoriza" required="" value="" class="form-control">
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
					<th><select name="codigocon[]" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
				    <th><input type="number" width="60px" name="debito[]" value="0" ></th>
					<th><input type="number" width="60px" name="credito[]" value="0" ></th>
					</tr>
					<tr>
					<th><select name="codigocon[]" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
					  <th><input type="number" width="60px" name="debito[]" value="0" ></th>
					<th><input type="number" width="60px" name="credito[]" value="0" ></th>
					</tr>
					<tr>
					<th><select name="codigocon[]" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
					  <th><input type="number" width="60px" name="debito[]" value="" ></th>
					<th><input type="number" width="60px" name="credito[]" value="" ></th>
					</tr>
					<tr>
					<th><select name="codigocon[]" class="form-control selectpicker" data-live-search="true">
					<option>_</option>
					@foreach($cuentas as $plan)
							<option value="{{$plan->cuentas}}">
							{{$plan->cuentas}}
						</option>
					@endforeach
					</select></th>
					  <th><input type="number" width="60px" name="debito[]" value="" ></th>
					<th><input type="number" width="60px" name="credito[]" value="" ></th>
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
				
{!! Form::close()!!}
@endsection