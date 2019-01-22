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
      <?php $anio = Date('Y') ?>
    </div>
    {!! Form::open(array('action'=>'RptKardexController@getPDFKardex','target' => 'rep'))!!}
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Articulos</th>
                <th>Mes del Año {{$anio}}</th>
                <th>Opciones</th>
            </thead>
            <tr>
                <td>
                    <div id="datetimepicker2" class="input-append date">
                        <center><select name="idarticulo" class="form-control selectpicker" id="idarticulo" data-live-search="true">
                            <option value="0" selected>Seleccionar Articulo...</option>
                        @foreach($articulos as $articulo)
                            <option value="{{$articulo->idarticulo}}">
                                {{$articulo->articulo}}
                            </option>
                        @endforeach
                        </select></center>
                    </div>
                </td>
                <td>
                    <div id="datetimepicker3" class="input-append date">
                        <center><select name="mes" class="form-control selectpicker" id="mes">
                            <option value="0" selected>Seleccionar Mes...</option>
                            <option value="enero">Enero</option>
                            <option value="febrero">Febrero</option>
                            <option value="marzo">Marzo</option>
                            <option value="abril">Abril</option>
                            <option value="mayo">Mayo</option>
                            <option value="junio">Junio</option>
                            <option value="julio">Julio</option>
                            <option value="agosto">Agosto</option>
                            <option value="septiembre">Septiembre</option>
                            <option value="octubre">Octubre</option>
                            <option value="noviembre">Noviembre</option>
                            <option value="diciembre">Diciembre</option>
                        </select></center>
                    </div>
                </td>
                <td>
                    <center><button class="btn btn-primary" type="submit">Ver PDF</button></center>
                </td>
            </tr>
        </table>
    {!! Form::close()!!}
    <center><iframe src="" name="rep" width="1050" height="500" frameborder="1"></iframe></center>
@endsection