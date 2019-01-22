@extends ('layouts.admin',['title'=>"Nuevo Articulo"])
@section ('contenido')
{!! Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
			{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre....">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label>Categoria</label>
			<select name="idcategoria" class="form-control">
				<option value="" selected>Seleccione Categoria</option>
				@foreach($categorias as $cat)
				<option value="{{$cat->id}}">{{$cat->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label>Tipo Producto</label>
			<select name="idTipoProductos" class="form-control">
				<option value="" selected>Seleccione Tipo Producto</option>
				@foreach($tipoProductos as $prod)
				<option value="{{$prod->id}}">{{$prod->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="codigo">Codigo</label>
			<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo....">
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" required value="{{old('descripcion')}}" class="form-control" placeholder="Descripcion....">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="imagen">Imagen</label>
			<input type="file" name="imagen" class="form-control">	
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		</div>
	</div>
</div>
		{!! Form::close()!!}
@endsection