@extends ('layouts.admin',['title'=>"Nuevo Cliente"])
@section ('contenido')
		{!! Form::open(array('url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'))!!}
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
				<label>Tipo Cliente</label>
				<select name="tipo_cliente" class="form-control">
					<option value="">Seleccione Tipo de Cliente</option>
					@foreach($tipoclientes as $tip_cli)
						<option value="{{$tip_cli->id}}">{{$tip_cli->descripcion}}</option>
					@endforeach
				</select>
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
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Fecha Nacimiento</label>
	            <input type="date" style="width: 150px;"class="form-control" required name="fecha_nacimiento">
	        </div>
        </div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		</div>
	</div>
{!! Form::close()!!}
@push ('scripts')
<script src="{{ asset('js/ventas/cliente.js') }}"></script>
@endpush
@endsection