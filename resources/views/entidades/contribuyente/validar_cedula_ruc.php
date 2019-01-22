<?php  
	//Cargar el autoload de composer
	require 'vendor/autoload.php';
	// Crear nuevo objeto
	$validador = new Tavo\ValidadorEc;

	// validar CI
	if ($validador->validarCedula('0926687856')) {
	    echo 'Cédula válida';
	} else {
	    echo 'Cédula incorrecta: '.$validador->getError();
	}

	// validar RUC persona natural
	if ($validador->validarRucPersonaNatural('0926687856001')) {
	    echo 'RUC válido';
	} else {
	    echo 'RUC incorrecto: '.$validador->getError();
	}

	// validar RUC sociedad privada
	if ($validador->validarRucSociedadPrivada('0992397535001')) {
	    echo 'RUC válido';
	} else {
	    echo 'RUC incorrecto: '.$validador->getError();
	}

	// validar RUC sociedad pública
	if ($validador->validarRucSociedadPublica('1760001550001')) {
	    echo 'RUC válido';
	} else {
	    echo 'RUC incorrecto: '.$validador->getError();
	}
?>