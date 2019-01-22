var precio_normal = 0,
	precio_empresarial = 0,
	precio_distribucion = 0,
	bancodvend = false;
var span = document.getElementsByClassName("close")[0];
//Ocultar el modal de alerta de Stock
span.onclick = function() {
	$("#modal-alerta").css("display", "none");
}
window.onclick = function(event) {
    if (event.target == $("#modal-alerta")) {
    	$("#modal-alerta").css("display", "none");
    }
}

var paso=0,
	opcion,
	i=0,
	nsubtot0 = 0,
    nsubtot12 = 0,
    tipoiva = 0,
    subtotal = 0,
    iva12 = 0
    porpagar = 0;

var cont=0;
total=0;
total0=0;
total12=0;
totiva12=0;
totalpagar=0;
subtot=0;
subtotal=[];

//No pierde el foco mientras la cantidad de Stock sea la Adecuada
var perderfoco = function(){
	$("input[name='cantidad[]']").blur(function(){
		var maxi = parseInt($(this).prop("max"));
		var ext = $(this).parent().prop('id');
		if((parseInt($(this).val())>maxi)||($(this).val() == "")||(parseInt($(this).val()) == 0)){
			var sms = JSON.parse('{"respuesta":"ERROR","dato":"Ingrese cant. < a <strong>'+maxi+'</strong>"}');
			mostrar_mensaje(sms,"#"+ext);
			$(this).focus();
		}
	});
}

//Evalua el codigo del vendedor para que sea el correcto caso contrario marca una x.
$("#codvendedor").keyup(function() {
	var codvend = $(this).val();
	if(codvend.length == 5){
		bancodvend = true;
		$.get(`codigo/${codvend}`,function(res,sta){
			$("#nombreVendedor").empty();
			$("#nombreVendedor").append(': &nbsp;<font id="cd" color="green">'+res[0].nombre+'</font>');
			$("#idvendedor").val(res[0].id);
		});
		//evaluar fallo si no retorna nada no pierde el foco
	}else if(codvend.length == 0){
		bancodvend = false;
		$("#nombreVendedor").empty();
		$("#idvendedor").val(0);
	}else if(codvend.length != 10){
		bancodvend = false;
		$("#nombreVendedor").empty();
		$("#idvendedor").val(0);
		$("#nombreVendedor").append(': &nbsp;<font id="cd" color="red">X</font>');
		$(this).focus();
	}
});

//Al inicializar el boton guardar esta oculto
$("#guardar").hide();

//Si hay cambio de valor en el combo Articulo realiza el Split para mostrar los valores en el resto del campo
$("#pidarticulo").change(mostrarvalores);

//Si hay un cambio en combo cliente tambien muestra sus respectivos valores
$("#idcliente").change(mostrarvalores);

//Desde la lectura del Page
//1.- Valida que el enter no mande a guardar la facturacion.
//2.- Al realizar un Enter en la cantidad de los articulos este agrega todos los datos a lista de cotizacion
$(document).ready(function(){
  	entervalidation();
  	$('#pcantidad').keypress(function(e) {
	    if(e.which == 13) {
	        agregar();
	    }
	});
});

//Valida que el enter no mande a guardar la facturacion.
var entervalidation = function(){
	$('form').keypress(function(e){   
    	if(e == 13){
      		return false;
    	}
  	});
  	$('input').keypress(function(e){
    	if(e.which == 13){
      		return false;
    	}
  	});
}

//Coge los valores del combo para mostrar en los otros inputs
function mostrarvalores(){
	datosArticulo=document.getElementById('pidarticulo').value.split('_');
	precio_normal = datosArticulo[2];
	precio_empresarial = datosArticulo[4];
	precio_distribucion = datosArticulo[5];
	var arti = $("#pidarticulo option:selected").text(),
		stock = datosArticulo[1],
		stockmin = datosArticulo[6],
		alertStock = parseInt(stockmin) + Math.ceil(stockmin*0.10);
	if(stock <= alertStock){
		$("#modal-alerta").css("display", "block");
		$("#modal-alerta > div > p").text( "El producto "+arti+" esta por LLEGAR o es MENOR al STOCK MINIMO: "+stockmin);;
	}
	$("#pprecio_venta").val(precio_normal);
	$("#pstock").val(stock);
	$("#piva").val(datosArticulo[3]);
	datosArticulo1=document.getElementById('idcliente').value.split('_');
	$("#tipo_cliente").val(datosArticulo1[1]);
	//$("#pdescuento").val(datosArticulo1[2]);
}

//Guarda la cotizacion pero no sin antes evaluar si el codigo del vendedor es valido.
function save(){
	if ($("#cd").text()=="X"){
		$("#modal-alerta").css("display", "block");
		$("#modal-alerta > div > p").text( "Codigo de vendedor Incorrecto");;
	}else{
		if(confirm('Si ya termino la Cotización Pulse aceptar.'))
			$("#venta").submit();
	}
};

//Agrega datos del articulo a la lista de la cotizacion
function agregar(){
	var banart = false;
	datosArticulo=document.getElementById('pidarticulo').value.split('_');
	idarticulo=datosArticulo[0];
	$("#detalles > tbody > tr > td > input[type=hidden]").each(function() {
		if(idarticulo == $(this).val()){
			banart = true;
		}
	});
	if(banart == false){
	    articulo=$("#pidarticulo option:selected").text();
	    stock=$("#pstock").val();
	    cantidad=$("#pcantidad").val();
	    descuento=$("#pdescuento").val();
	    precio_venta=$("#pprecio_venta").val();
	    iva=$("#piva").val();
		if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_venta!=""){
			if(Number(stock)>=Number(cantidad)){
				if (iva==12){
					subtotal[cont]=Math.round(((cantidad*precio_venta) - ((cantidad*precio_venta)*descuento/100))*100)/100;
					total=total+(Math.round(subtotal[cont]*100)/100);
					totiva12=Math.round((total*(iva/100))*100)/100;
				}else{
					subtotal[cont]=Math.round(((cantidad*precio_venta) - ((cantidad*precio_venta)*descuento/100))*100)/100;
					total0=total0+(Math.round(subtotal[cont]*100)/100);
				}
				subtot=	Math.round((total+total0-totiva12)*100)/100;
				totalpagar=Math.round((subtot+totiva12)*100)/100;
			//	totalpagar=Math.round((subtot)*100)/100;
				total=total*100/100
				var fila='<tr onkeyup="calcula('+cont+')" class="selected" id="fila'+cont+'">'+
							'<td align="center" width="80"><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td>'+
							'<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
							'<td align="center">'+
								'<div id="div_c'+cont+'"><input type="hidden" id="d'+cont+'" name="descuento[]" readonly value="'+descuento+'" style="width: 80px; text-align:right;"><input type="number" max="'+stock+'" id="c'+cont+'" name="cantidad[]" value="'+cantidad+'" style="width: 100px; text-align:center;  width: 60px;">'+
								'<h5 style="width=100%;" class="text-center"> <small class="mensaje"></small></h5></div>'+
							'</td>'+
							'<td align="center"><input type="number" id="p'+cont+'" name="precio_venta[]" readonly value="'+precio_venta+'" style="text-align:center;   width: 100px;"></td>'+
							'<td align="center">'+iva+'</td>'+
							'<td align="center">'+subtotal[cont]+'</td>'+
						'</tr>';
				cont++;
		       limpiar();
		       $('#total12').html("$ " + total);
		       $('#total_12').val(total);
		       $('#total0').html("$ " + total0);
		       $('#total_0').val(total0);
		 	   $('#subtot').html("$ " + subtot);
		       $('#subtotal').val(subtot);
		       $('#totiva12').html("$ " + totiva12);
			   $('#tot_iva12').val(totiva12);
			   $('#desc').html("$ " + totiva12);
		       $('#desc').val(totiva12);
		       $('#totalpagar').html("$ " + totalpagar);
		       $('#total_pagar').val(totalpagar);
		       evaluar();
		       $('#detalles').append(fila);
		       perderfoco();
		       entervalidation();
		       numberchange();
			}else{
				alert('No se puede realizar la venta cuando la cantidad supera el stock');
			}		
		}else{
			alert("Error en el ingreso de datos");
		}
	}else{
		var sms = JSON.parse('{"respuesta":"ERROR","dato":"Este articulo ya se encuentra en DETALLES"}');
		mostrar_mensaje(sms,"#agregar_articulo");
	}
}

//Una vez que agrega los valores del art estos se limpian
function limpiar(){
	$("#pcantidad").val("");
	$("#pdescuento").val(0);
	$("#pprecio_venta").val("");
	$("#pstock").val("");
	$("#piva").val("");
	$('#pidarticulo').val(0);
	$('.selectpicker').selectpicker('refresh')
}

//Evaluan si tienen un costo mayor a 0 entonces muestra el boton guardar
function evaluar(){
	if (total>0 || total12>0)
	{
		$("#guardar").show();
	}else {
		$("#guardar").hide();
	}
}

//Elimina El item seleccionado en caso de dar click en la X
function eliminar(index){
	opcion = confirm("Esta seguro de retirar este Item");
    if (opcion == true) {
		total = 0;
		total0 = 0;
		subtot = 0;
		totiva12 = 0;
		totalpagar = 0;
		tipoiva=0;
		$("#fila"+index).remove();
		for (paso = 0 ; paso <  document.getElementById('detalles').rows.length-5; paso++) {
		  // Se ejecuta 5 veces, con valores desde paso desde 0 hasta 4.
			tipoiva=Number(document.getElementById("detalles").rows[paso].cells[4].innerText);
	  
	     if(tipoiva==12){
			total=total + Number(document.getElementById("detalles").rows[paso].cells[6].innerText);
		//	alert(total);
	     }
	     else if(tipoiva==0) {
	    	total0=total0 + Number(document.getElementById("detalles").rows[paso].cells[6].innerText);
	     }
	     totiva12=Math.round((total*(tipoiva/100))*100)/100;
	     subtot=Math.round((total+total0)*100)/100;
	     totalpagar= Math.round((totiva12 + subtot)*100)/100; 
		}
		$('#total12').html("$ " + total);
		$('#total_12').val(total);
		$('#total0').html("$ " + total0);
		$('#total_0').val(total0);
		$('#subtot').html("$ " + subtot);
		$('#subtotal').val(subtot);
		$('#totiva12').html("$ " + totiva12);
		$('#tot_iva12').val(totiva12);
		$('#totalpagar').html("$ " + totalpagar);
		$('#total_pagar').val(totalpagar);
	}
}

//
function calcula(cual)	{
	//subtotal en la fila de subtotal
	document.getElementById("detalles").rows[cual+1].cells[6].innerText = document.getElementById("c"+cual).value*document.getElementById("p"+cual).value-(document.getElementById("d"+cual).value/100);
    //calcula el total de todo
    recal(cual+1);  
}

function recal(paso){
		total = 0;
    	total0 = 0;
    	subtot = 0;
    	totiva12 = 0;
    	totalpagar = 0;
    	tipoiva=0;
		for (paso = 0 ; paso <  document.getElementById('detalles').rows.length-5; paso++) {
		  // Se ejecuta 5 veces, con valores desde paso desde 0 hasta 4.
 		tipoiva=Number(document.getElementById("detalles").rows[paso].cells[4].innerText);
	  
	     if(tipoiva==12){
			total=total + Number(document.getElementById("detalles").rows[paso].cells[6].innerText);
		//	alert(total);
	     }
	     else if(tipoiva==0) {
	     //	alert(tipoiva);
	     	total0=total0 + Number(document.getElementById("detalles").rows[paso].cells[6].innerText);
	     }

	     totiva12=Math.round((total*(tipoiva/100))*100)/100;
	     subtot=Math.round((total+total0)*100)/100;
	     totalpagar= Math.round((totiva12 + subtot)*100)/100; 

		}
			$('#total12').html("$ " + total);
			$('#total_12').val(total);
			$('#total0').html("$ " + total0);
			$('#total_0').val(total0);
			$('#subtot').html("$ " + subtot);
			$('#subtotal').val(subtot);
			$('#totiva12').html("$ " + totiva12);
			$('#tot_iva12').val(totiva12);
			$('#totalpagar').html("$ " + totalpagar);
			$('#total_pagar').val(totalpagar);
}
function checkKeyCode(evt){
	var evt = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
	if(event.keyCode==116){
		evt.keyCode=0;
		return false
	}
}
document.onkeydown=checkKeyCode;

var mostrar_mensaje = function( informacion ,padre){
  var texto = "", color = "",
  	seg = 0,  relleno = "";
  
  if( informacion.respuesta == "BIEN" ){
      texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
      color = "#379911";
      relleno:  "#e625ed";
      seg = 3000;
  }else if( informacion.respuesta == "ERROR"){
      texto = informacion.dato+".";
      color = "#C9302C";
      relleno:  "#003366";
      seg = 7000;
  }else if( informacion.respuesta == "EXISTE" ){
      texto = "<strong>Información!</strong> el " + title + " ya existe.";
      color = "#5b94c5";
      relleno:  "#003366";
      seg = 7000;
  }else if( informacion.respuesta == "NO_EXISTE" ){
      texto = "<strong>Información!</strong> el " + title + " NO existe.";
      color = "#C9302C";
      relleno:  "#003366";
      seg = 5000;
  }else if( informacion.respuesta == "VACIO" ){
      texto = "<strong>Advertencia!</strong> Los Siguientes Datos no estan Llenos:" + informacion.dato + "<br>Debe llenar todos los campos solicitados.";
      color = "#ddb11d";
      relleno:  "#003366";
      seg = 10000;
  }else if( informacion.respuesta == "OPCION_VACIA" ){
      texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
      color = "#ddb11d";
      relleno:  "#003366";
      seg = 5000;
  }
  $(padre+" .mensaje").html( texto ).css({"background": relleno , "color": color });
  $(".mensaje").fadeOut(seg, function(){
      $(this).html("");
      $(this).fadeIn(seg);
  });     
}
var numberchange = function(){$("input[name='cantidad[]']").bind('keyup mouseup', function () {
    calcula(parseInt($(this).prop('id').substr(1)));            
});}

//Asigna los valores de Precio Normar, precio empresarial y precio d distribucion a los input
$('input[type=radio][name=prec]').change(function() {
    if (this.value == 'precio_normal') {
        $("#pprecio_venta").val(precio_normal);
    }
    else if (this.value == 'precio_empresarial') {
        $("#pprecio_venta").val(precio_empresarial);
    }
    else if (this.value == 'precio_distribucion') {
        $("#pprecio_venta").val(precio_distribucion);
    }
});
