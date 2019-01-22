var clear_prov = function(){
	$('#data_proveedor').find('input:text').val('');
	$('#data_proveedor').find('select').val('');
	$('#data_proveedor').find('textarea').val('');
}
$("#prov_aceptar").click( function( event ) {
  event.preventDefault();
  clear_prov();
  
});
$("#retfuente").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

$(document).ready(function () {
	$("#por_venta").keyup(function () {
		var porc = $(this).val();
		var valor2 = $("#pprecio_compra").val();
		var nuevoprecio = (porc/100) * valor2;
		var newPrecioEmpresarial
		nuevoprecio = parseFloat(valor2) + parseFloat(nuevoprecio);
		var pre_venta = parseFloat(Math.round(nuevoprecio * 100) / 100).toFixed(2);
		$("#pprecio_venta_normal").val(pre_venta);
	});
	$('#bt_add').click(function(){
    	agregar();
    });
});

var mostrarValor = function(x){
	document.getElementById('retfuente').value=x;
};

var mostrarValor1 = function(x){
	document.getElementById('retiva').value=x;
};

var cont=0,
total=0,
total12=0,
totiva12=0,
totalpagar=0,
subtotalr=0,
subtotal=[];
$("#guardar").hide();
$("#idproveedor").change(mostrarvalores);

function addRow(){
	idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_normal=$("#pprecio_venta_normal").val();
    precio_empresarial=$("#pprecio_venta_empresarial").val();
    precio_distribucion=$("#pprecio_venta_distribucion").val();
    tipoiva = ($("#ptipoiva").is(':checked')?true:false);
    if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && 
		precio_normal!="" && precio_distribucion!="" && precio_empresarial!=""){
    	if (tipoiva==true){
			subtotal=Math.round((cantidad*precio_compra));
		}else{
			subtotal=Math.round((cantidad*precio_compra));
		}
    }
}


function agregar(){
	idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_normal=$("#pprecio_venta_normal").val();
    precio_empresarial=$("#pprecio_venta_empresarial").val();
    precio_distribucion=$("#pprecio_venta_distribucion").val();
    tipoiva = ($("#ptipoiva").is(':checked')?true:false);
	if (idarticulo!="" && cantidad!="" && 
		cantidad>0 && precio_compra!="" && 
		precio_normal!="" && precio_distribucion!="" && 
		precio_empresarial!=""){
		if (tipoiva==true){
			subtotal[cont]=Math.round((cantidad*precio_compra));
			total=total+(Math.round(subtotal[cont]));
			totiva12=Math.round(total*(12/100));
		}else{
			subtotal[cont]=Math.round((cantidad*precio_compra));
			//subtotal[cont]=(cantidad*precio_venta);
			total12=total12+(Math.round(subtotal[cont]));
		}
		subtotalr=Math.round((total+total12));
		totalpagar=(Math.round((total+totiva12+total12)));
		
		var fila='<tr class="selected" id="fila'+cont+'">'+
					'<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td>'+
					'<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
					'<td><input type="number" name="cantidad[]" value="'+cantidad+'"></td>'+
					'<td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td>'+
					'<td>'+
						'<input type="number" name="precio_venta_normal[]" value="'+precio_normal+'">'+
						'<input type="hidden" name="precio_venta_empresarial[]" value="'+precio_empresarial+'">'+
						'<input type="hidden" name="precio_venta_distribucion[]" value="'+precio_distribucion+'">'+
					'</td>'+
					'<td ><input type="checkbox" name="iva[]" '+(tipoiva==true?"checked":"")+'></td>'+
					'<td>'+subtotal[cont]+'</td>'+
				'</tr>';
		cont++;
		limpiar();
		$('#total').html("$ " + total);
		//$('#total_venta').val(total);
		$('#total12').html("$ " + total12);
		//  $('#total_venta12').val(total12);
		$('#totiva121').html("$ " + totiva12);
		$('#total_iva').val(totiva12);
		$('#totalpagar').html("$ " + totalpagar);
		// $('#total_pagar').val(totiva12);
		$('#subtot').html("$ " + subtotalr);
		$('#subtot1').val(subtotalr);
			
		evaluar();
		$('#detalles').append(fila);
	}
	else {
		alert("Error en el ingreso de datos");
	}
}

function calcularTotal(){

}

function mostrarvalores(){
	datosProveedor=document.getElementById('idproveedor').value.split('_');
	$("#vendedor").val(datosProveedor[1]);
	//$("#pstock").val(datosArticulo[1]);
	//$("#piva").val(datosArticulo[3]);
}

function limpiar(){
	$("#pcantidad").val("");
	$("#pprecio_compra").val("");
	$("#pprecio_venta_normal").val("");
	$("#pprecio_venta_empresarial").val("");
	$("#pprecio_venta_distribucion").val("");
	$("#ptipoiva").val("");
}

function evaluar(){
	if (total>0 || total12>0){
		$("#guardar").show();
	}
	else{
		$("#guardar").hide();
	}
}

function eliminar(index){
	total=total-subtotal[index];
	$("#total").html("$ "+total);
	$("#total_venta").val(total);
	$("#fila"+index).remove();
	evaluar();
}

//Verifica al vendedor
$("#vendedor").keyup(function() {
	var codvend = $(this).val();
	if(codvend.length == 5){
		$.get(`codigo/${codvend}`,function(res,sta){
			$("#nombreVendedor").empty();
			$("#nombreVendedor").append(': &nbsp;<font id="cd" color="green">'+res[0].nombre+'</font>');
			$("#idvendedor").val(res[0].id);
		});
	}else if(codvend.length == 0){
		$("#nombreVendedor").empty();
		$("#idvendedor").val(0);
	}else if(codvend.length != 10){
		$("#nombreVendedor").empty();
		$("#idvendedor").val(0);
		$("#nombreVendedor").append(': &nbsp;<font id="cd" color="red">X</font>');
		$(this).focus();
	}
});