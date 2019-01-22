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
  <title>Reporte de Ventas Detallado por Cajeros</title>
</head>
<body>
  <div id="header">
    <h2>Almacen "Lolita"</h2>
    <h4>REPORTE DE VENTAS GENERAL POR CAJEROS</h4>
    <h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
  </div>
  <div id="footer">
    <center><p class="page">Page </p></center>
  </div>
  <div id="content">
    <?php $LastVen = NULL ?>
    <?php $CountFactVendedor = 0; $TotFactVendedor = 0; $facturas = []; ?>
    @foreach ($ventas as $ven)
      @if (is_null($LastVen))
        <?php $CountFactVendedor = 1; $TotFactVendedor = $ven->total;
          $factura = [
              "comprobante" => $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->idventa,
              "fecha" => $ven->fecha_hora,
              "impuesto" => $ven->impuesto,
              "subtotal" => $ven->subtotal,
              "total" => $ven->total
          ];
        ?>  
      @elseif (!is_null($LastVen) AND ($ven->idvendedor == $LastVen->idvendedor) AND ($ven->idventa != $LastVen->idventa))
        <?php 
          $CountFactVendedor = $CountFactVendedor+1; $TotFactVendedor = $TotFactVendedor + $ven->total;
          array_push($facturas,$factura);
          $factura = [
              "comprobante" => $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->idventa,
              "fecha" => $ven->fecha_hora,
              "impuesto" => $ven->impuesto,
              "subtotal" => $ven->subtotal,
              "total" => $ven->total
          ];
        ?>
      @elseif(!is_null($LastVen) AND ($ven->idvendedor != $LastVen->idvendedor) AND ($ven->idventa != $LastVen->idventa))
        <h3>Cajer@ {{ $LastVen->name}} Cantidad de Facturas vendidas: {{$CountFactVendedor}} Total de Facturas vendidas: {{ $TotFactVendedor}}</h3>
        <?php $CountFactVendedor = 1; $TotFactVendedor = $ven->total; 
        array_push($facturas,$factura);?>
        <table style="width: 100%">
              <thead>
                <tr>
                  <th>Comprobante</th>
                  <th>Fecha</th>
                  <th>Impuesto</th>
                  <th>Subtotal</th>
                  <th>Total</th>
                </tr>
              </thead>
              @foreach ($facturas as $fac)
              <tr>
                <td>{{ $fac["comprobante"]}}</td>
                <td>{{ $fac["fecha"]}}</td>
                <td>{{ $fac["impuesto"]}}</td>
                <td>{{ $fac["subtotal"]}}</td>
                <td>{{ $fac["total"]}}</td>      
              </tr>
              @endforeach
              </tbody>
           <tfoot>
             <tr>
             </tr>
           </tfoot>
        </table>
        <?php $facturas = [];
          $factura = [
              "comprobante" => $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->idventa,
              "fecha" => $ven->fecha_hora,
              "impuesto" => $ven->impuesto,
              "subtotal" => $ven->subtotal,
              "total" => $ven->total
          ];?>   
      @endif
      <?php $LastVen = $ven; ?>
    @endforeach
    @if(!is_null($LastVen))
        <h3>Cajer@ {{ $LastVen->name}} Cantidad de Facturas vendidas: {{ $CountFactVendedor}} Total de Facturas vendidas: {{ $TotFactVendedor}}</h3>
        <?php $CountFactVendedor = 1; $TotFactVendedor = $ven->total; 
        array_push($facturas,$factura);?>
        <table style="width: 100%">
          <thead>
            <tr>
              <th>Comprobante</th>
              <th>Fecha</th>
              <th>Impuesto</th>
              <th>Subtotal</th>
              <th>Total</th>
            </tr>
          </thead>
          @foreach ($facturas as $fac)
          <tr>
            <td>{{ $fac["comprobante"]}}</td>
            <td>{{ $fac["fecha"]}}</td>
            <td>{{ $fac["impuesto"]}}</td>
            <td>{{ $fac["subtotal"]}}</td>
            <td>{{ $fac["total"]}}</td>      
          </tr>
          @endforeach
          </tbody>
       <tfoot>
         <tr>
            <h4>Total de la Venta: {{$tot}} dolares<h4>
         </tr>
       </tfoot>
    </table>
    <?php $facturas = []; ?>
    @endif
  </div>
</body>
</html>