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

<h2>Bazar Lolita</h2>
<h4>Ruc 09999999001</h4>
<h4>La Libertad </h4>
<h4>Provincia de Santa Elena </h4>
<h4>Fecha y Hora de Impresion: <?php echo date("Y-m-d H:i:s"); ?></h4>

<h4>Factura No.: {{$ventas->idventa}} </h4>


<h4>CI/Ruc.: {{$ventas->numero_documento}} </h4>
<h4>Nombre.: {{$ventas->nombre}}</h4>
<h4>Teléfono.: {{$ventas->telefono}} </h4>
<table>
  <thead>
    <tr>    
      <th>Articulo</th>
      <th>Cantidad</th>
      <th>P.Unit</th>
      <th>P.total</th>
    </tr>   
  </thead>
  <tbody>
    @foreach ($detalle as $ven)
      <tr>     
        <td><h4>{{ $ven->articulo}}</h4></td>
        <td><h3>{{ $ven->cantidad}}</h3></td>
        <td><h3>{{ $ven->precio_venta}}</h3></td>
        <td><h3>{{ $ven->cantidad*$ven->precio_venta-$ven->descuento}}</h3></td>
      </tr>
      @endforeach  
   </tbody>
   <tfoot>
     <tr>
      <h4>Total.: {{$ventas->total_venta+$ventas->impuesto}}</h4>
       <h4>Iva 12%.: {{$ventas->impuesto}} </h4>    
     </tr>
   </tfoot>
</table>
</body>
</html>

