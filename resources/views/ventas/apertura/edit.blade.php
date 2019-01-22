@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Editar Categoria: {{ $apertura->usuario}} </h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!! Form::model($apertura,['method'=>'PATCH','route'=>['ventas.apertura.update',$apertura->idacaja]]) !!}
			{{Form::token()}}
			<div class="row">
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
				  	<label for="nombre">Fecha de Cierre</label>
	                <input type="text" style="width: 150px; " class="form-control" disabled="" value="{{date('Y-m-d')}} " name="fapertura">
	            </div>
            </div>

			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Usuario</label>
					<input type="text" name="usuarioc" class="form-control" readonly="" value="{{Auth::user()->name}}" placeholder="Descripcion....">		
				</div>
			</div>
			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Valor de Cierre</label>
				<input type="number" name="valorfin" step="0.01" class="form-control" placeholder="Valor de Apertura....">		
			</div>
			</div>

			<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Novedad Cierre</label>
					<input type="text" name="novedadc" class="form-control" placeholder="Descripcion....">		
				</div>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			</div>
		{!! Form::close()!!}
	</div>
	
</div>
@endsection