@extends ('layouts.admin',['title'=>"Editar Proveedor: $persona->apellido $persona->nombre"])
@section ('contenido')
		{!! Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update',$persona->id]])!!}
			{{Form::token()}}
			<div class="row">
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" value="{{$persona->nombre}}" required class="form-control" placeholder="Nombre....">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" value="{{$persona->apellido}}" required class="form-control" placeholder="Apellido....">
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Direccion</label>
				<textarea name="direccion" required class="form-control" placeholder="Direccion....">{{$persona->direccion}}</textarea>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Documento</label>
				<select name="tipo_documento" class="form-control">
					<option value="" selected>Seleccione Tipo de Documento</option>
					@foreach($tipodocumentos as $tip_doc)
						@if ($persona->fk_pg_tipo_documento == $tip_doc->id)
							<option value="{{$tip_doc->id}}" selected>{{$tip_doc->descripcion}}</option>
						@else
							<option value="{{$tip_doc->id}}">{{$tip_doc->descripcion}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="codigo">Numero Documento</label>
				<input type="text" name="numero_documento" value="{{$persona->numero_documento}}" class="form-control" placeholder="Numero Documento....">
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="stock">Teléfono</label>
				<input value="{{$persona->telefono}}" type="text" name="telefono" class="form-control" placeholder="Telefono....">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="descripcion">E-mail</label>
				<input value="{{$persona->email}}" type="text" name="email" class="form-control" placeholder="E-mail....">		
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label>Tipo Documento del Representante</label>
				<select name="tipo_documento_representante" class="form-control">
					<option value="" selected>Seleccione Tipo de Documento</option>
					@foreach($tipodocumentos as $tip_doc)
						@if ($persona->fk_pg_tipo_doc_rep == $tip_doc->id)
							<option value="{{$tip_doc->id}}" selected>{{$tip_doc->descripcion}}</option>
						@else
							<option value="{{$tip_doc->id}}">{{$tip_doc->descripcion}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="cedularepresenta">Cedula Repersentante</label>
				<input value="{{$persona->num_doc_rep}}" type="text" name="cedularepresenta" required class="form-control" placeholder="Cedula Reprsentante....">		
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="representante">Nombre Completo Repersentante</label>
				<input value="{{$persona->nom_completo_rep}}" type="text" name="representante" required class="form-control" placeholder="Reprsentante....">		
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="emailrepresenta">E-mail</label>
				<input value="{{$persona->email_rep}}" type="text" name="emailrepresenta" required class="form-control" placeholder="Correo Reprsentante....">		
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="telefonorepresenta">Telefono Representante</label>
				<input value="{{$persona->telefono_rep}}" type="text" name="telefonorepresenta" required class="form-control" placeholder="Reprsentante....">		
			</div>
		</div>
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
		{!! Form::close()!!}
@endsection