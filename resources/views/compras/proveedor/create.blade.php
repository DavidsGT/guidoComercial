@extends ('layouts.admin',['title'=>"Nuevo Proveedor"])
@section ('contenido')
{!! Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required class="form-control" placeholder="Nombre....">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" required class="form-control" placeholder="Apellido....">
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Direccion</label>
				<textarea name="direccion" required class="form-control" placeholder="Direccion...."></textarea>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Documento</label>
				<select name="tipo_documento" class="form-control">
					<option value="" selected>Seleccione Tipo de Documento</option>
					@foreach($tipodocumentos as $tip_doc)
						<option value="{{$tip_doc->id}}">{{$tip_doc->descripcion}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="codigo">Numero Documento</label>
				<input type="text" name="numero_documento" class="form-control" placeholder="Numero Documento....">
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="stock">Teléfono</label>
				<input type="text" name="telefono" class="form-control" placeholder="Telefono....">		
			</div>
		</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="descripcion">E-mail</label>
				<input type="text" name="email" class="form-control" placeholder="E-mail....">		
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
						<option value="{{$tip_doc->id}}">{{$tip_doc->descripcion}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="cedularepresenta">Cedula Repersentante</label>
				<input type="text" name="cedularepresenta" required class="form-control" placeholder="Cedula Reprsentante....">		
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="representante">Nombre Completo Repersentante</label>
				<input type="text" name="representante" required class="form-control" placeholder="Reprsentante....">		
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="emailrepresenta">E-mail</label>
				<input type="text" name="emailrepresenta" required class="form-control" placeholder="Correo Reprsentante....">		
			</div>
		</div>
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="telefonorepresenta">Telefono Representante</label>
				<input type="text" name="telefonorepresenta" required class="form-control" placeholder="Reprsentante....">		
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