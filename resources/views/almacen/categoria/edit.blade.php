@extends ('layouts.admin',['title'=>"Editar Categoria: $categoria->descripcion"])
@section ('contenido')
		{!! Form::model($categoria,['method'=>'PATCH','route'=>['almacen.categoria.update',$categoria->id]]) !!}
			{{Form::token()}}
			<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control" value="{{$categoria->descripcion}}" placeholder="Nombre....">		
			</div>
			<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" class="form-control" value="{{$categoria->detalle}}" placeholder="Descripcion....">		
			</div>

			<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		{!! Form::close()!!}
@endsection