<?php 

/**
 * ruder palencia
 */
class Errors
{

 public function NoFound()
	{
		
		//echo "Mensaje desde el Controlador Inicio";
		echo "Error en el controlador";
	}


}

$error = new Errors();
$error->NoFound();
 ?>