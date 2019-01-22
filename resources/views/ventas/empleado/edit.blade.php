@extends ('layouts.admin',['title'=>"Editar Empleado: $persona->apellido $persona->nombre"])
@section ('contenido')
		{!! Form::model($persona,['method'=>'PATCH','route'=>['ventas.empleado.update',$persona->id]])!!}
			{{Form::token()}}
		<div class="row">
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="apellido">Apellido</label>
					<input type="text" name="apellido" required value="{{$persona->apellido}}" class="form-control" placeholder="Apellido....">		
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
					<label>Cargo</label>
					<select name="cargo" class="form-control">
						<option value="">Seleccione Cargo</option>
						@foreach($cargos as $car)
							@if ($persona->fk_pg_cargo == $car->id)
								<option value="{{$car->id}}" selected>{{$car->descripcion}}</option>
							@else
								<option value="{{$car->id}}">{{$car->descripcion}}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="stock">Teléfono</label>
					<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Telefono....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="descripcion">E-mail</label>
					<input type="text" name="email" value="{{$persona->email}}" class="form-control" placeholder="E-mail....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Fecha Nacimiento</label>
		            <input type="date" style="width: 150px;"class="form-control" value="{{$persona->fecha_nacimiento}}" required name="fecha_nacimiento">
		        </div>
	        </div>
	        <div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="stock">Codigo Único</label>
					<div style="display:  -webkit-box;">
						<input style="width: 75px" type="text" id="codigo" name="codigo" value="{{$persona->codigo}}" class="form-control" placeholder="Codigo....">	
						<button type="button" class="btn btn-primary" onclick="rand_code()" id="generar_code">Generar</button>
					</div>
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
	<script src="{{ asset('js/ventas/empleado.js') }}"></script>
	@endpush
@endsection