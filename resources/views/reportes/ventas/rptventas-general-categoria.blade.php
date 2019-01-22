<!DOCTYPE html>
<html>
<head>
  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
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
  <title>Reporte de Ventas General por Categoria</title>
</head>
<body>
  <div id="header">
    <h2>Almacen "Lolita"</h2>
    <h4>REPORTE DE VENTAS GENERAL POR CATEGORIA</h4>
    <h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
  </div>
  <div id="footer">
    <center><p class="page">Page </p></center>
  </div>
  <div id="content">
    <h3></h3>
    <?php $lastVen = null;?>
    @foreach ($ventas as $ven)
    @if(is_null($lastVen))
          <center><h3>{{$ven->categoria}}</h3></center>
        <table style="width: 100%">
          <thead>
            <tr>
              <th style="width: 50%">Producto</th>
              <th style="width: 30%">En Comprobantes</th>
              <th style="width: 8%">Cantidad</th>
              <th style="width: 14%">Precio<br>de<br>Venta</th>
              <th style="width: 14%">Desc</th>
              <th style="width: 14%">Iva</th>
              <th style="width: 14%">Total</th>
            </tr>
          </thead>
          <tbody>
          @elseif(!is_null($lastVen) AND ($ven->categoria != $lastVen->categoria))
          </tbody>
        </table>
        
      
          <center><h3>{{$ven->categoria}}</h3></center>
        <table style="width: 100%">
          <thead>
            <tr>
              <th style="width: 50%">Producto</th>
              <th style="width: 30%">En Comprobantes</th>
              <th style="width: 8%">Cantidad</th>
              <th style="width: 14%">Precio<br>de<br>Venta</th>
              <th style="width: 14%">Desc</th>
              <th style="width: 14%">Iva</th>
              <th style="width: 14%">Total</th>
            </tr>
          </thead>
          <tbody>
          @endif
            <tr>
              <td style="width: 50%">{{$ven->nombre}}</td>
              <td style="width: 30%">
                <?php
                  $facturas = explode('--',$ven->facturas);
                ?>
                @foreach($facturas as $fac)
                  {{$fac}}<br>
                @endforeach
              </td>
              <td style="width: 8%">{{$ven->cantidad}}</td>
              <td style="width: 14%">{{$ven->precio_venta}}</td>
              <td style="width: 14%">{{$ven->descuento}}</td>
              <td style="width: 14%">{{$ven->iva}}</td>
              <td style="width: 14%">{{($ven->cantidad*$ven->precio_venta) + $ven->iva - $ven->descuento}}</td>
            </tr>
    <?php $lastVen = $ven;?>
    @endforeach
      </tbody>
        </table>
    <h4>Total de la Venta: {{$tot}} dolares<h4>    
  </div>
</body>
</html>