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
<h3>Listado General por Tipo de Clientes</h3>
<h3>Fecha: <?php echo date("Y-m-d H:i:s"); ?></h3>
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Identificacion</th>
      <th>Cedula/Ruc/Past</th>
      <th>Telefono</th>
      <th>Email</th>
     </tr>
     
      </thead>
     
      @foreach ($personas as $per)
      <tr>
      <td>{{ $per->idpersona}}</td>
      <td>{{ strtoupper($per->nombre)}}</td>
      <td>{{ $per->tipo_documento}}</td>
      <td>{{ $per->numero_documento}}</td>
      <td>{{ $per->telefono}}</td>
      <td>{{ $per->email}}</td>
      </tr>
      @endforeach
     
      @foreach ($empresa as $per)
      <tr>
      <td>{{ $per->idpersona}}</td>
      <td>{{ strtoupper($per->nombre)}}</td>
      <td>{{ $per->tipo_documento}}</td>
      <td>{{ $per->numero_documento}}</td>
      <td>{{ $per->telefono}}</td>
      <td>{{ $per->email}}</td>
      </tr>
      @endforeach

       @foreach ($turista as $per)
      <tr>
      <td>{{ $per->idpersona}}</td>
      <td>{{ strtoupper($per->nombre)}}</td>
      <td>{{ $per->tipo_documento}}</td>
      <td>{{ $per->numero_documento}}</td>
      <td>{{ $per->telefono}}</td>
      <td>{{ $per->email}}</td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
     <tr>
       
         <h4>Total de Clientes: {{$totp +  $tote + $tott}}<h4>
        <h4>Total de Clientes Locales: {{$totp}}<h4>
        <h4>Total de Clientes Empresa: {{$tote}}<h4>
        <h4>Total de Clientes Extranjeros: {{$tott}}<h4><br>  
       
     </tr>
   </tfoot>
</table>
<br>
        
<br>

<br>

</body>
</html>