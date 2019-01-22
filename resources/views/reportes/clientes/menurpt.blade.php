@extends ('layouts.admin')
@section ('contenido')

 <!--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Optional theme -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
    <!-- Latest compiled and minified JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Jquery -->
   <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>



  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="">
    	<div class="col-lg-8 col-mg-8 col-sg-8 col-xs-12 ">
    		<h3>Reportes del Sistema</h3>
    	</div>
    </div>

  <div class="">
  	<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12 ">
  		<div class="table-responsive">
  		<table class="table table-striped table-bordered table-condensed table-hover">
  			<thead>
  				<th>No.</th>
  				<th>NombreReporte</th>
  				<th>Descripcion</th>
  				<th>Fecha Inicial</th>
  				<th>Fecha Final</th>
  				<th>Opciones</th>
  			</thead>

  			<tr>
  				<td>1</td>
  				<td>Listado de Clientes</td>
  				<td>Detalle de clientes - empresas y extarnjeros</td>
  				<td>
  				<!--	<div id="datetimepicker" class="input-append date"> 
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date">
            </div>-->
  				</td>
          <td>
           <!-- <div id="datetimepicker1" class="input-append date">
            <input type="text" style="width: 100px; " class="form-control datepicker" name="date2">
            </div>-->
          </td>
  				<td>
  				<a href="{{URL::action('PdfController@getPDFCL')}}"><button class="btn btn-info">Visualizar</button></a>
  				</td>
  			</tr>	
        {!! Form::open(array('url'=>'pdf/clientes/reportecliente','method'=>'POST','autocomplete'=>'off'))!!}
  			<tr>
  				<td>2</td>
  				<td>Listado de Ventas</td>
  				<td>Detalle de Ingreso por Ventas</td>
  				<td>
            <div id="datetimepicker2" class="input-append date">
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date3">
            </div>
          </td>
          <td>
            <div id="datetimepicker3" class="input-append date">
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date4">
            </div>
          </td>
          <td>
  			 <button class="btn btn-primary" type="submit">Ver PDF</button>
  				</td>
  			</tr>
  			{!! Form::close()!!}

        {!! Form::open(array('url'=>'pdf/clientes/reportecuotas','method'=>'POST','autocomplete'=>'off'))!!}
  			<tr>	
  				<td>4</td>
  				<td>Listado de Cuotas</td>
  				<td>Detalle de Cuotas de Socios</td>
  				<td>
            <div id="datetimepicker6" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date5">
            </div>
          </td>
          <td>
            <div id="datetimepicker7" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date6">
            </div>
          </td>
          <td>
  			 <button class="btn btn-primary" type="submit">Ver PDF</button>
  				</td>
  			</tr>
        {!! Form::close()!!}
    {!! Form::open(array('url'=>'pdf/clientes/reportebitacora','method'=>'POST','autocomplete'=>'off'))!!}
  			<tr>	
  				<td>5</td>
  				<td>Bitacora General</td>
  				<td>Detalle de Salidas de Embarcaciones</td>
  				<td>
            <div id="datetimepicker8" class="input-append date">
            <input type="text" style="width: 100px; " class="form-control datepicker" name="date7">
            </div>
          </td>
          <td>
            <div id="datetimepicker9" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date8">
            </div>
          </td>
          <td>
  				 <button class="btn btn-primary" type="submit">Ver PDF</button>
  				</td>
  			</tr>
       {!! Form::close()!!}
       {!! Form::open(array('url'=>'pdf/clientes/totventas','method'=>'POST','autocomplete'=>'off'))!!}
        <tr>  
          <td>6</td>
          <td>Ventas Por Rutas </td>
          <td>Detalle General de Ventas</td>
          <td>
            <div id="datetimepicker10" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date9">
            </div>
          </td>
          <td>
            <div id="datetimepicker11" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date10">
            </div>
          </td>
          <td>
         <button class="btn btn-primary" type="submit">Ver PDF</button>
          </td>
        </tr>
               {!! Form::close()!!}
{!! Form::open(array('url'=>'pdf/clientes/repgeneraling','method'=>'POST','autocomplete'=>'off'))!!}
        <tr>  
          <td>7</td>
          <td>Reporte de Ingresos </td>
          <td>Detalle General de Ingresos por Ruta</td>
          <td>
            <div id="datetimepicker12" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date11">
            </div>
          </td>
          <td>
            <div id="datetimepicker13" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date12">
            </div>
          </td>
          <td>
          <button class="btn btn-primary" type="submit">Ver PDF</button>
          </td>
        </tr>
{!! Form::close()!!}

{!! Form::open(array('url'=>'pdf/clientes/totingreso','method'=>'POST','autocomplete'=>'off'))!!}
         <tr>  
          <td>7</td>
          <td>Reporte General de Ingresos </td>
          <td>Detalle General de Ingresos y Pago a socios</td>
          <td>
            <div id="datetimepicker14" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date13">
            </div>
          </td>
          <td>
            <div id="datetimepicker15" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date14">
            </div>
          </td>
          <td>
          <button class="btn btn-primary" type="submit">Ver PDF</button>
          </td>
        </tr>
{!! Form::close()!!}

{!! Form::open(array('url'=>'pdf/clientes/totganancia','method'=>'POST','autocomplete'=>'off'))!!}
         <tr>  
          <td>7</td>
          <td>Reporte General de Ganancia </td>
          <td>Detalle General de Ingresos y Pago de Cuotas</td>
          <td>
            <div id="datetimepicker14" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date15">
            </div>
          </td>
          <td>
            <div id="datetimepicker15" class="input-append date">
             <input type="text" style="width: 100px; " class="form-control datepicker" name="date16">
            </div>
          </td>
          <td>
          <button class="btn btn-primary" type="submit">Ver PDF</button>
          </td>
        </tr>
{!! Form::close()!!}
  		</table>
  		</div>
  		

  	</div>
  </div>

    <script>
      $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
        });
    </script>
@endsection