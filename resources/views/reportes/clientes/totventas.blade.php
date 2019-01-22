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
<h4>Reporte General de Ventas Por Rutas</h4>
<h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
<table>
  <thead>
    <tr>
     
      <th>Detalle</th>
      <th>Ruta</th>
       <th>Cantidad</th>
      <th>Total</th>
      </tr>
     
      </thead>
     
      @foreach ($totventa as $per)
      <tr>
     
      <td>{{ $per->nombre}}</td>
      <td>{{ $per->descripcion}}</td>
      <td>{{ $per->cantidad}}</td>
      <td>{{ $per->total}}</td>
      </tr>
      @endforeach
 
   </tbody>
   <tfoot>
     <tr>
        <h4>El Total de la Venta es: {{$totvr}}  <h4>
     </tr>
   </tfoot>
</table>
<br>
<br>
<h4>Reporte General de Ventas Por Embarcación</h4>
<h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
<table>
  <thead>
    <tr>
     
      <th>Detalle</th>
      <th>Embarcación</th>
       <th>Cantidad</th>
      <th>Total</th>
      </tr>
     
      </thead>
     
      @foreach ($totventa as $per)
      <tr>
     
      <td>{{ $per->nombre}}</td>
      <td>{{ $per->chasis}}</td>
      <td>{{ $per->cantidad}}</td>
      <td>{{ $per->total}}</td>
      </tr>
      @endforeach
 
   </tbody>
   <tfoot>
     <tr>
        <h4>El Total de la Venta es: {{$totvr}}  <h4>
     </tr>
   </tfoot>
</table>
</body>
</html>

