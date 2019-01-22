@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Editar Cliente: {{$persona->nombre}} </h3>
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
		{!! Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update',$persona->idpersona]])!!}
			{{Form::token()}}
			<div class="row">
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre....">		
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Direccion</label>
					<input type="text" name="direccion" required value="{{$persona->direccion}}" class="form-control" placeholder="Direccion....">		
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label>Tipo Documento</label>
					<select name="tipo_documento" class="form-control">
						@if ($persona->tipo_documento=='CEDULA')
							<option value="CEDULA" selected>Cedula</option>
							<option value="RUC">Ruc</option>
							<option value="PASAPORTE">Pasaporte</option>
						@elseif ($persona->tipo_documento=='RUC')
							<option value="CEDULA">Cedula</option>
							<option value="RUC" selected>Ruc</option>
							<option value="PASAPORTE">Pasaporte</option>
						@else 
							<option value="CEDULA">Cedula</option>
							<option value="RUC">Ruc</option>
							<option value="PASAPORTE" selected>Pasaporte</option>
						@endif
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="codigo">Numero Documento</label>
					<input type="text" name="numero_documento" value="{{$persona->numero_documento}}" class="form-control" placeholder="Numero Documento....">		
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="stock">Telefono</label>
					<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Telefono....">		
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">E-mail</label>
					<input type="text" name="email" required value="{{$persona->email}}" class="form-control" placeholder="E-mail....">		
				</div>
			</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<div class="form-group">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
</div>
			
		{!! Form::close()!!}
	
@endsection