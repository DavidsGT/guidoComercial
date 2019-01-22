@extends ('layouts.admin',['title'=>"Editar Contribuyente"])
@section ('contenido')
	{!! Form::model($persona,['method'=>'PATCH','route'=>['entidades.contribuyente.update',$persona->id]])!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="ruc">Ruc</label>
					<input type="text" name="ruc" required value="{{$persona->ruc}}" class="form-control" placeholder="Ruc....">
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="razon_social">Razon Social</label>
					<input type="text" name="razon_social" required value="{{$persona->razon_social}}" class="form-control" placeholder="Razon Social....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="cod_establecimiento">Codigo de Establecimiento</label>
					<input type="text" name="cod_establecimiento" required value="{{$persona->cod_establecimiento}}" class="form-control" placeholder="Cod....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="cod_emision">Codigo de Emision</label>
					<input type="text" name="cod_emision" required value="{{$persona->cod_emision}}" class="form-control" placeholder="Cod....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="direccion_matriz">Dirección Matriz</label>
					<textarea name="direccion_matriz" required class="form-control" placeholder="Dirección Matriz....">{{$persona->direccion_matriz}}</textarea>
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" name="telefono" required value="{{$persona->telefono}}" class="form-control" placeholder="Teléfono....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="text" name="email" required value="{{$persona->email}}" class="form-control" placeholder="E-mail....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label>Tipo de Documento de Representante</label>
					<select name="tipo_documento" class="form-control">
						<option value="" selected>Seleccione Tipo de Documento</option>
						@foreach($tipodocumentos as $tip_doc)
							@if ($persona->fk_pg_tipo_doc_representante == $tip_doc->id)
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
					<label for="num_documento">Numero Documento</label>
					<input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Numero Documento....">
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="ruc_contador">Ruc Contador</label>
					<input type="text" name="ruc_contador" value="{{$persona->ruc_contador}}" class="form-control" placeholder="Ruc Contador....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="lleva_contabilidad">Lleva Contabilidad?</label>
					@if ($persona->lleva_contabilidad == 1)
						<input type="checkbox" name="lleva_contabilidad" value="1" checked>
					@else
						<input type="checkbox" name="lleva_contabilidad" value="1">
					@endif
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label>Tipo de Emision</label>
					<select name="tipo_emision" class="form-control">
						<option value="">Seleccione Tipo de Emision</option>
						@foreach($tipoemisiones as $tip_emi)
							@if ($persona->fk_pg_tipo_emision == $tip_emi->id)
								<option value="{{$tip_emi->id}}" selected>{{$tip_emi->descripcion}}</option>
							@else
								<option value="{{$tip_emi->id}}">{{$tip_emi->descripcion}}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="tiempo_max_espera">Tiempo Máximo de Espera</label>
					<input type="number" name="tiempo_max_espera" value="{{$persona->tiempo_max_espera}}" class="form-control">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label>Tipo de Ambiente</label>
					<select name="tipo_ambiente" class="form-control">
						<option value="">Seleccione Tipo de Ambiente</option>
						@foreach($tipoambientes as $tip_ambi)
							@if ($persona->fk_pg_tipo_ambiente == $tip_ambi->id)
								<option value="{{$tip_ambi->id}}" selected>{{$tip_ambi->descripcion}}</option>
							@else
								<option value="{{$tip_ambi->id}}">{{$tip_ambi->descripcion}}</option>
							@endif
						@endforeach
					</select>
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
@endsection