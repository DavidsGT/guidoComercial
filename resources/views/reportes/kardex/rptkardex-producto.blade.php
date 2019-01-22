<!DOCTYPE html>
<html>
<head>
  <style>
    @page { margin: 180px 50px; }
    #header_title { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; }
    #footer .page:after { content: counter(page); }
  </style>
  <style type="text/css">
    td {
      margin: 10px;
      padding: 5px;
      border-width: 1px;border: solid; border-color: black;
      font-size: 12px;
    }
    th {
      font-size: 12px;
    }
    table {
      border-collapse: separate;
    }
  </style>
  <title>KARDEX</title>
</head>
<body>
  <div id="header">
    <div id="header_title">
      <h2>Almacen "Lolita"</h2>
      <h4>KARDEX DE MERCADERIAS</h4>
    </div>
    <table border="0" width="100%">
      <tr>
        <td><strong>CODIGO:</strong></td>
        <td>{{$det_articulo["codigo"]}}</td>
        <td><strong>ARTICULO</strong></td>
        <td>{{$det_articulo["articulo"]}}</td>  
      </tr>
      <tr>
        <td><strong>CATEGORIA:</strong></td>
        <td>{{$det_articulo["categoria"]}}</td>
        <td><strong>FECHA:</strong></td>
        <td><?php echo date("Y-m-d H:i:s"); ?></td>  
      </tr>
    </table>
    <table border="1" width="100%">
      <tr>
        <td rowspan="2">FECHA</td>
        <td rowspan="2">DETALLE</td>
        <td colspan="3">INGRESOS</td>
        <td colspan="3">EGRESOS</td>
      </tr>
      <tr>
        <td>CANTIDAD</td>
        <td>PRECIO UNITARIO</td>
        <td>PRECIO TOTAL</td>
        <td>CANTIDAD</td>
        <td>PRECIO UNITARIO</td>
        <td>PRECIO TOTAL</td>
      </tr>
    </table>
  </div>
  <div id="footer">
    <center><p class="page">Page </p></center>
  </div>
  <div id="content">
    <table style="width: 100%">
      <tbody>
@foreach ($kardexs as $kar)
        <tr>
          <td>{{$kar->fecha}}</td>
          <td>{{$kar->detalle}}</td>
  @if($kar->tipo == 'I')
          <td>{{$kar->cantidad}}</td>
          <td>{{$kar->precio_unitario}}</td>
          <td>{{$kar->precio_total}}</td>
          <td></td>
          <td></td>
          <td></td>
  @else
          <td></td>
          <td></td>
          <td></td>
          <td>{{$kar->cantidad}}</td>
          <td>{{$kar->precio_unitario}}</td>
          <td>{{$kar->precio_total}}</td>
  @endif
        </tr>
@endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2">TOTAL</td>
          <td colspan="3">$ {{$totalingresos}}</td>
          <td colspan="3">$ {{$totalegresos}}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</body>
</html>