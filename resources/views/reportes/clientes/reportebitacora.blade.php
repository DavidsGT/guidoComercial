<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
 
    td {
  margin: 15px;
  padding: 15px;
  border-width: 1px;border: solid; border-color: blue;
  }

  table {
  border-collapse: separate;
  }
  </style>
  <title></title>
</head>
<body>
<h2>Almacen Lolita"</h2>
<h3>Control Diario por Bitacora </h3>
<h3>Fecha: <?php echo date("Y-m-d H:i:s"); ?></h3>
<table>
  <thead>
    <tr>
       <th>No.</th>
       <th>Fecha</th>
       <th>Chofer</th>
       <th>Hora.Salida</th>
       <th>Hora.Llegada</th>
       <th>Cliente.Llegada</th>
       <th>Novedad</th>
      </tr>
     
      </thead>
     
   @foreach ($bitacora as $cuo)
      <tr>
        <td>{{ $cuo->idbitacora}}</td>
        <td>{{ $cuo->fecha}}</td>
        <td>{{ $cuo->chofer}}</td>
        <td>{{ $cuo->hrasalida}}</td>
        <td>{{ $cuo->hrallegada}}</td>
        <td>{{ $cuo->clientellegada}}</td>
        <td>{{ $cuo->detalle}}</td>
      </tr>
      @endforeach   
   </tbody>
   <tfoot>
    
   </tfoot>
</table>
</body>
</html>

