@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Nuevo Perfil</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!! Form::open(array('url'=>'seguridad/perfil','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="detalle" class="form-control" placeholder="Nombre....">		
			</div>
			<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" class="form-control" placeholder="Descripcion....">		
			</div>

			<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
		<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		{!! Form::close()!!}
	</div>
	
</div>
@endsection