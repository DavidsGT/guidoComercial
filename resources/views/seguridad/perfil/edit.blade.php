@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Editar Perfil: {{ $perfil->detalle}} </h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!! Form::model($perfil,['method'=>'PATCH','route'=>['seguridad.perfil.update',$perfil->idperfil]]) !!}
			{{Form::token()}}
			<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="detalle" class="form-control" value="{{$perfil->detalle}}" placeholder="Nombre....">		
			</div>
			<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" class="form-control" value="{{$perfil->descripcion}}" placeholder="Descripcion....">		
			</div>

			<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		{!! Form::close()!!}
	</div>
	
</div>
@endsection