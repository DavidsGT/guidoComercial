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
<h3>Reporte General de Cuotas de Socios</h3>
<h3>Fecha: <?php echo date("Y-m-d H:i:s"); ?></h3>
<table>
  <thead>
    <tr>
        <th>No.</th>
        <th>Fecha.Pago</th>
        <th>Socio</th>
        <th>Periodo</th>
          <th>Valor</th>
          <th>Tipo.Pago</th>
          <th>Numero.Doc</th>
      </tr>
     
      </thead>
     
    @foreach ($cuotas as $cuo)
      <tr>
        <td>{{ $cuo->idcuota}}</td>
        <td>{{ $cuo->fechapago}}</td>
        <td>{{ $cuo->nombre}}</td>
        <td>{{ $cuo->periodo}}</td>
        <td>{{ $cuo->valpago}}</td>
        <td>{{ $cuo->tipopago}}</td>
        <td>{{ $cuo->numerodoc}}</td>      
      </tr>
      @endforeach   
   </tbody>
   <tfoot>
     <tr>
        <h2>El Total de cuotas es: {{$totcu}}<h2>
     </tr>
   </tfoot>
</table>
</body>
</html>

