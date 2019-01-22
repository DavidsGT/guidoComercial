@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Editar Articulo: {{ $articulo->nombre}} </h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
		{!! Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
			{{Form::token()}}
			<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label>Categoria</label>
			<select name="idcategoria" class="form-control">
				@foreach($categorias as $cat)
				@if ($cat->idcategoria==$articulo->idcategoria)
					<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
				@else
					<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="codigo">Codigo</label>
			<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="stock">Stock</label>
			<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="stock">Stock Minimo</label>
			<input type="text" name="stockmin" required value="{{$articulo->stockmin}}" class="form-control">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" required value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripcion....">		
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label>Tipo Iva</label>
			<select name="iva" class="form-control">
				<option value="12">12</option>
				<option value="0">0</option>
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<label for="imagen">Imagen</label>
			<input type="file" name="imagen" class="form-control">	
			@if($articulo->imagen!="")
			<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="80px" height="60px">
			@endif	
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