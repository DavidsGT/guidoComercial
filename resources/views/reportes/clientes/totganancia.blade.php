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
     
      @foreach ($totvents as $per)
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
     </tr>
   </tfoot>
</table>
<br><br>

<h4>Listado de aportaciones por cuotas</h4>
<table>
  <thead>
    <tr>
     
      <th>Fecha pago</th>
      <th>Socio</th>
      <th>Periodo</th>
      <th>Tipo de Pago</th>
      <th>Valor Pago</th>
      </tr>
     
      </thead>
     
      @foreach ($totgana as $per)
      <tr>
     
      <td>{{ $per->fechapago}}</td>
      <td>{{ $per->nombre}}</td>
      <td>{{ $per->periodo}}</td>
      <td>{{ $per->tipopago}}</td>
      <td>{{ $per->valpago}}</td>
      </tr>
      @endforeach
 
   </tbody>
   <tfoot>
     <tr>
      El Pago a Socios es: {{$totvp}}<br> 
      El Total de los Ingresos es: {{$totvs}}<br>
      El Ingreso por Ventas para la Cooperativa es: {{$totvs-$totvp}}<br>
      El Total de Cuotas de los Socios es: {{$totga}}<br>
      El Total Neto de Ingresos para la Coop. es: {{$totga+($totvs-$totvp)}}<br>
     </tr>
   </tfoot>
</table>

</body>
</html>