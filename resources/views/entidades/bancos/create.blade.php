@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Nueva Entidad</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!! Form::open(array('url'=>'entidades/bancos','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
				<label>Codigo Contable</label>
				<select name="codigo" class="form-control selectpicker" id="codigo" data-live-search="true">
				@foreach($cuentas as $cuentas)
					<option value="{{$cuentas->idplan}}_{{$cuentas->codigo}}_{{$cuentas->detalle}}">
						{{$cuentas->cuentas}}
					</option>
				@endforeach
				</select>
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label>Tipo Cuenta</label>
					<select name="tipo" class="form-control">
						<option value="Ahorros">Ahorros</option>
						<option value="Corriente">Corriente</option>
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
				<label for="numero">Numero de Cuenta</label>
				<input type="text" name="numero" id="numero" class="form-control" placeholder="Numero....">		
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
				<label for="nombre">Banco</label>
				<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Banco....">		
				</div>
			</div>
				<input type="hidden" name="idcod" id="idcod" class="form-control" placeholder="Banco....">		
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
				</div>
			</div>
		{!! Form::close()!!}
	</div>
</div>

@push ('scripts')
	<script>

		 $("#codigo").change(mostrarvalores);

		function mostrarvalores()
		{
			//alert('hhhh');
			datosplan=document.getElementById('codigo').value.split('_');
			$("#nombre").val(datosplan[2]);
			$("#idcod").val(datosplan[1]);
		}
	</script>
@endpush
@endsection