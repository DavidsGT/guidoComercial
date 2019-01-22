@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Nueva Apertura</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!! Form::open(array('url'=>'ventas/apertura','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="row">
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
				  	<label for="nombre">Fecha de Apertura</label>
	                <input type="text" style="width: 150px; " class="form-control" disabled="" value="{{date('Y-m-d')}} " name="fapertura">
	            </div>
            </div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Usuario</label>
					<input type="text" name="usuario" class="form-control" readonly="" value="{{Auth::user()->name}}" placeholder="Descripcion....">
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Valor Inicial</label>
				<input type="number" name="valorini" step="0.01" class="form-control" placeholder="Valor de Apertura....">		
			</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Novedad</label>
					<input type="text" name="novedad" class="form-control" placeholder="Descripcion....">		
				</div>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>

		{!! Form::close()!!}
	</div>
	</div>
</div>

  <script>
      $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
        });
  </script>

@endsection