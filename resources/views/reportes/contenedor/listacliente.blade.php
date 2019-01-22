@extends ('layouts.admin')
@section ('contenido')

  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Optional theme -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
    <!-- Latest compiled and minified JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Jquery -->
   <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

	
<p></p>
<br>
@if ($num==1) 
	<iframe src="{{URL::action('PdfController@getPDFCL')}}" width="1050" height="500" frameborder="1"></iframe>				
@endif
@if ($num==2) 
 {!! Form::open(array('action'=>'PdfController@getPDFV','target' => 'rep'))!!}
  			<table class="table table-striped table-bordered table-condensed table-hover">
  			<thead>
  				<th>No. davids 1</th>
  				<th>NombreReporte</th>
  				<th>Descripcion</th>
  				<th>Fecha Inicial</th>
  				<th>Fecha Final</th>
  				<th>Opciones</th>
  			</thead>
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
  			</table>
  			{!! Form::close()!!}
 <iframe src="" name="rep" width="1050" height="500" frameborder="1"></iframe>  
	
@endif
@if ($num==3) 
	 {!! Form::open(array('action'=>'PdfController@getPDFC','target' => 'rep1'))!!}
        <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>No. davids 2</th>
          <th>NombreReporte</th>
          <th>Descripcion</th>
          <th>Fecha Inicial</th>
          <th>Fecha Final</th>
          <th>Opciones</th>
        </thead>
        <tr>
          <td>2</td>
          <td>Registro de Compras</td>
          <td>Detalle de Ingreso a Bodega</td>
          <td>
            <div id="datetimepicker2" class="input-append date">
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date7">
            </div>
          </td>
          <td>
            <div id="datetimepicker3" class="input-append date">
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date8">
            </div>
          </td>
          <td>
         <button class="btn btn-primary" type="submit">Ver PDF</button>
          </td>
        </tr>
        </table>
        {!! Form::close()!!}
 <iframe src="" name="rep1" width="1050" height="500" frameborder="1"></iframe>  
  
@endif
@if ($num==4) 
 {!! Form::open(array('action'=>'PdfController@getPDFCU','target' => 'rep2'))!!}
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
          <td>2</td>
          <td>Registro de Cuotas</td>
          <td>Detalle de Pago de Cuotas</td>
          <td>
            <div id="datetimepicker2" class="input-append date">
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date10">
            </div>
          </td>
          <td>
            <div id="datetimepicker3" class="input-append date">
              <input type="text" style="width: 100px; " class="form-control datepicker" name="date11">
            </div>
          </td>
          <td>
         <button class="btn btn-primary" type="submit">Ver PDF</button>
          </td>
        </tr>
        </table>
        {!! Form::close()!!}
 <iframe src="" name="rep2" width="1050" height="500" frameborder="1"></iframe>  
  
@endif

	
{!! Form::close()!!}

  <script>
   // alert('jjj');
      $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
        });
    </script>

@endsection