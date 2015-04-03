<?php

	/*
	La pseudo clase View:
	Se encarga de levantar un documento con formato html, pasandole como parametros
	los datos necesarios para esa seccion.
	*/
	function View( $view_name , $params ){

		if( is_array( $params ) ){
			foreach( $params as $key => $value ){
				$$key = $value;
			}
		}
		// $view = fopen( '../app/views/' . $view_name . '.php' , 'r' );
		// $content = fread( $view, filesize( '../app/views/' . $view_name . '.php' ) );
		// echo $content;
		include('../app/views/' . $view_name . '.php');
	}
?>
