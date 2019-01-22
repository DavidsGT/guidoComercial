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
<h2>"Bazar Lolita"</h2>
<h2>Comprobante de Egreso No. {{$id}} </h2>
<h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>
<h2>Cliente.: {{$nombre}} </h2>
<table>
  <thead>
    <tr>
        <th style="width: 300px; ">Cuenta Contable</th>
        <th style="width: 100px; ">Debito</th>
        <th style="width: 100px; ">Credito</th>
    </tr>
     
      </thead>
     
      @foreach ($ventas as $ven)
      <tr>
      
        <td>{{ $ven->cuenta}}</td>
        <td>{{ $ven->debito}}</td>
        <td>{{ $ven->credito}}</td>       
      </tr>
      @endforeach
     
   </tbody>
   <tfoot>
   </tfoot>
</table>
<br>
<br><br><br>
 <h5>ELABORADO POR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AUTORIZADO POR</h5>   

</body>
</html>