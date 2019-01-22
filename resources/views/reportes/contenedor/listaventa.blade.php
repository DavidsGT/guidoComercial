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
    <div>
      <h1>Reporte de ventas</h1>
    </div>
    {!! Form::open(array('action'=>'RptVentasController@getPDFVentaDetalladoCajero','target' => 'rep'))!!}
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Tipo</th>
                <th>Clasificar por</th>
                <th>Opciones</th>
            </thead>
            <tr>
                <td>
                    <div id="datetimepicker2" class="input-append date">
                        <center><input type="text" style="width: 100px; " class="form-control datepicker" name="date3"></center>
                    </div>
                </td>
                <td>
                    <div id="datetimepicker3" class="input-append date">
                        <center><input type="text" style="width: 100px; " class="form-control datepicker" name="date4"></center>
                    </div>
                </td>
                <td>
                  <ul style="list-style:none;">
                    <li>
                      <input type="radio" value="detallado" name="tipo" checked>Detallado
                    </li>
                    <li>
                      <input type="radio" value="general" name="tipo">General
                    </li>
                  </ul>
                </td>
                <td>
                  <ul style="list-style:none;">
                    <li>
                      <input type="radio" value="cajero" name="clasificacion" checked>Cajero
                    </li>
                    <li>
                      <input type="radio" value="categoria" name="clasificacion">Categoria
                    </li>
                  </ul>
                </td>
                <td>
                    <center><button class="btn btn-primary" type="submit">Ver PDF</button></center>
                </td>
            </tr>
        </table>
    {!! Form::close()!!}
    <center><iframe src="" name="rep" width="1050" height="500" frameborder="1"></iframe></center>
    
  
    <script>
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true
        });
    </script>

@endsection