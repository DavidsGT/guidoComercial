@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Asigancion de menus</h3>
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
		{!! Form::open(array('url'=>'control/menu','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
			{{Form::token()}}
<div class="row">
	
<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
        <div class="form-group">
            <label>Tipo Usuario</label>
            <select name="usuario" class="form-control">
             @foreach($perfil as $per)
               <option value="{{$per->idperfil}}_{{$per->detalle}}">
                {{$per->detalle}}
                </option>
              @endforeach
            </select>
         </div>
    </div>

	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="idpadre">Menu Padre</label>
			<select name="idpadre" id="idpadre" class="form-control selectpicker" data-live-search="true">
				<option value="1">Registro</option>
				<option value="2">Operaciones</option>
				<option value="3">Reportes e Informes</option>
				<option value="4">Control</option>
			</select>
		</div>
	</div>
	
	<input type="hidden" name="detpadre" id="detpadre" value="">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="idhijo">Menu Hijo</label>
			<select name="idhijo" id="idhijo" class="form-control selectpicker" data-live-search="true">
			@foreach($item as $it)
					<option value="{{$it->iditenmemu}}_{{$it->link}}_{{$it->detalle}}">
					{{$it->detalle}}
				</option>
			@endforeach
			</select>
		</div>
	</div>
	<input type="hidden" name="link" id="link" value="">
	<input type="hidden" name="dethijo" id="dethijo" value="">
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

@push ('scripts')
<script>

 $("#idpadre").change(mostrarvalores);
 $("#idhijo").change(mostrarvalores);

function mostrarvalores()
{

	datosArticulo=document.getElementById('idpadre').value;
	var menus=$("#idpadre option:selected").text();
	//alert(menus)
	document.getElementById('detpadre').value=menus;
	//$("#detpadre").text(menus);
	
	datosArticulo1=document.getElementById('idhijo').value.split('_');
		$("#dethijo").val(datosArticulo1[2]);
		$("#link").val(datosArticulo1[1]);
}
</script>
@endpush
@endsection