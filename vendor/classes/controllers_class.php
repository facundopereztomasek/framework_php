<?php
	function Controller( $controller_name , $method , $params ){
		$controller_path = '../app/controllers/';
		$controller = $controller_path . $controller_name . '.php';
		require_once( $controller );
		$method( $params );
	}
?>
