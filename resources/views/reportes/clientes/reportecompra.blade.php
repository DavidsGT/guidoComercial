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
<h3>Reporte General de Ingresos</h3>
<h3>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h3>
<table>
  <thead>
    <tr>
       
        <th>Fecha</th>
        <th>Proveedor</th>
        <th>Comprobante</th>
          <th>Impuesto</th>
          <th>Subtotal</th>
          <th>Total</th>
          <th>Estado</th>
      </tr>
     
      </thead>
     
      @foreach ($ingreso as $ven)
      <tr>
      
        <td>{{ $ven->fecha_hora}}</td>
        <td>{{ $ven->nombre}}</td>
        <td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->numero_comprobante}}</td>
        <td>{{ $ven->impuesto}}</td>
        <td>{{ $ven->total-$ven->impuesto}}</td>
        <td>{{ $ven->total}}</td>
        <td>{{ $ven->estado}}</td>
       
      </tr>
      @endforeach
     
   </tbody>
   <tfoot>
     <tr>
        <h2>Total de los Ingresos: $. {{$totc}}<h2>
     </tr>
   </tfoot>
</table>
</body>
</html>

