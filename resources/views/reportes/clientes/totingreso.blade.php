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
<h4>Reporte General de Ingresos y Pago a Socios</h4>
<h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
<table>
  <thead>
    <tr>
     
      <th>Fecha Venta</th>
      <th>Socio</th>
       <th>Embarcacion</th>
      <th>Total Venta</th>
      <th>Pago al Socio</th>
      <th>Total Neto</th>
      </tr>
     
      </thead>
     
      @foreach ($totventa as $per)
      <tr>
     
      <td>{{ $per->fecha_hora}}</td>
      <td>{{ $per->propietario}}</td>
      <td>{{ $per->chasis}}</td>
      <td>{{ $per->total_venta}}</td>
      <td>{{ $per->total_socio}}</td>
      <td>{{ $per->total_venta - $per->total_socio}}</td>
      </tr>
      @endforeach
 
   </tbody>
   <tfoot>
     <tr>
        <h4>El Total de los Ingresos es: {{$totvs}} <h4>
        <h4>El Pago a Socios es: {{$totvp}}  <h4>
         <h4>El Ingreso Neto para la Cooperativa es: {{$totvs-$totvp}}  <h4> 
     </tr>
   </tfoot>
</table>
</body>
</html>

