<!DOCTYPE html>
<html>
<head>
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
  <title></title>
</head>
<body>
<h2>Almacen Lolita"</h2>
<h4>Reporte General de Ventas</h4>
<h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
<table>
  <thead>
    <tr>
       
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Comprobante</th>
        <th>Total</th>
        <th>Estado</th>
      </tr>
     
      </thead>
     
      @foreach ($ventas as $ven)
      <tr>
      
        <td>{{ $ven->fecha_hora}}</td>
        <td>{{ $ven->nombre}}</td>
        <td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->idventa}}</td>
        <td>{{ $ven->total_venta}}</td>
        <td>{{ $ven->estado}}</td>      
      </tr>
      @endforeach
     
   </tbody>
   <tfoot>
     <tr>
        <h4>Total de la Venta: {{$tot}} dolares<h4>
     </tr>
   </tfoot>
</table>
</body>
</html>