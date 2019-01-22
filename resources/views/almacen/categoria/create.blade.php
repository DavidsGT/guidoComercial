@extends ('layouts.admin',['title'=>"Nueva Categoria"])
@section ('contenido')
	{!! Form::open(array('url'=>'almacen/categoria','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" class="form-control" placeholder="Nombre....">		
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
@endsection