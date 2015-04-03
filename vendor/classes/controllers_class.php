<?php
	// La pseudo clase Controller: Carga la clase necesaria para manejar el pedido
	// a traves de routes. Si ya fue cargada anteriormente no hay conflictos.
	// Luego ejecuta el metodo invocado en la configuracion del routes.
	
	function Controller( $controller_name , $method , $params ){
		$controller_path = '../app/controllers/';
		$controller = $controller_path . $controller_name . '.php';
		require_once( $controller );
		$method( $params );
	}
?>
