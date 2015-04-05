<?php

	/*
	La pseudo clase View:
	Se encarga de levantar un documento con formato html, pasandole como parametros
	los datos necesarios para esa seccion.

	La vista cargada no es directamente ninguna de las que se encuentra en el
	directorio app/views/, sino que las vistas son previamente compiladas para
	permitir el parseo de los templates con un codigo similar a blade.
	Las vistas que finalmente se leen se encuentran en app/storage/views/ ya
	compiladas.
	*/
	function View( $view_name , $params = null ){

		if( is_array( $params ) ){
			foreach( $params as $key => $value ){
				$$key = $value;
			}
		}
		// $view = fopen( '../app/views/' . $view_name . '.php' , 'r' );
		// $content = fread( $view, filesize( '../app/views/' . $view_name . '.php' ) );
		// echo $content;

		include('../app/storage/views/' . $view_name . '.php');
	}
?>
