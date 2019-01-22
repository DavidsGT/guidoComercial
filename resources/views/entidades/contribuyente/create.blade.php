@extends ('layouts.admin',['title'=>"Nuevo Contribuyente"])
@section ('contenido')
		{!! Form::open(array('url'=>'entidades/contribuyente','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
	<div class="row">
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="ruc">Ruc</label>
					<input type="text" name="ruc" required class="form-control" placeholder="Ruc....">
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="razon_social">Razon Social</label>
					<input type="text" name="razon_social" required class="form-control" placeholder="Razon Social....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="cod_establecimiento">Codigo de Establecimiento</label>
					<input type="text" name="cod_establecimiento" required class="form-control" placeholder="Cod....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="cod_emision">Codigo de Emision</label>
					<input type="text" name="cod_emision" required class="form-control" placeholder="Cod....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="direccion_matriz">Dirección Matriz</label>
					<textarea name="direccion_matriz" required class="form-control" placeholder="Dirección Matriz...."></textarea>
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" name="telefono" required class="form-control" placeholder="Teléfono....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="text" name="email" required class="form-control" placeholder="E-mail....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label>Tipo de Documento de Representante</label>
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
					<label for="num_documento">Numero Documento</label>
					<input type="text" name="num_documento" class="form-control" placeholder="Numero Documento....">
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="ruc_contador">Ruc Contador</label>
					<input type="text" name="ruc_contador" class="form-control" placeholder="Ruc Contador....">		
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="lleva_contabilidad">Lleva Contabilidad?</label>
					<input type="checkbox" name="lleva_contabilidad" value="1">
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label>Tipo de Emision</label>
					<select name="tipo_emision" class="form-control">
						<option value="">Seleccione Tipo de Emision</option>
						@foreach($tipoemisiones as $tip_emi)
							<option value="{{$tip_emi->id}}">{{$tip_emi->descripcion}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label for="tiempo_max_espera">Tiempo Máximo de Espera</label>
					<input type="number" name="tiempo_max_espera" class="form-control">
				</div>
			</div>
			<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
				<div class="form-group">
					<label>Tipo de Ambiente</label>
					<select name="tipo_ambiente" class="form-control">
						<option value="">Seleccione Tipo de Ambiente</option>
						@foreach($tipoambientes as $tip_ambi)
							<option value="{{$tip_ambi->id}}">{{$tip_ambi->descripcion}}</option>
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