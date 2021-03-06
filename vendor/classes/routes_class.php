<?php
	/*
	La pseudo clase Route: Toma la url entregada luego de la conversion a
	traves del modulo rewrite y la parsea, definiendo que controlador es necesario
	para que ruta. Ademas parsea los parametros entregados por url. Los parametros
	son asignados a indices del array param_array, indices que son definidos en
	la misma llamada a routes mediante llaves '{}'.

	Ej.:

	Route( 'get' , 'config/{option}/{value}/{item}' , 'Config@index' );

	La ruta es 'config', la cual esta asociada al controlador Config, llamando
	al metodo index.

	Luego los valores de parametros /1/2/3 son guardados en los indices 'option',
	'value' e 'item' del array param_array.

	Esto es definido por el usuario, premitiendo una facil asociacion de parametros
	con variables que luego son utilizadas en la vista.

	Finalmente se delegan los datos parseados a la pseudo clase Controller que se
	encarga de servir la peticion requerida vinculando un posible modelo con una
	vista.
	*/
	$RouteAliases = array();
	$RouteExec = array();

	function Route( $request_method , $url , $controller ){
		global $RouteAliases;
		global $RouteExec;

		if( is_array( $controller ) && isset( $controller['as'] ) ){
			$RouteAliases[ $controller['as'] ] = $url;
		}

		if( $_SERVER['REQUEST_METHOD'] != strtoupper( $request_method ) ) return true;
		// switch( strtoupper( $request_method ) ){
		// 	case 'GET':
		// 		if( isset( $_GET['r'] ) ){
		// 			$route = $_GET['r'];
		// 		}else{
		// 			$route = '/';
		// 		}
		//
		//
		// 		if( isset( $_GET['p'] ) ){
		// 			$params = $_GET['p'];
		// 		}else{
		// 			$params = '';
		// 		}
		// 	break;
		//
		// 	case 'POST':
		// 		if( isset( $_GET['r'] ) ){
		// 			$route = $_GET['r'];
		// 		}else{
		// 			$route = '/';
		// 		}
		//
		//
		// 		if( isset( $_GET['p'] ) ){
		// 			$params = $_GET['p'];
		// 		}else{
		// 			$params = '';
		// 		}
		// 	break;
		// }

		if( isset( $_GET['r'] ) ){
			$route = $_GET['r'];
		}else{
			$route = '/';
		}


		if( isset( $_GET['p'] ) ){
			$params = $_GET['p'];
		}else{
			$params = '';
		}


		$route_tokens = explode( '/' , $route );
		$url_tokens = explode( '/' , $url );

		$route_name = $route_tokens[0];
		$url_name = $url_tokens[0];

		if( $route_name != $url_name ) return true;

		$pattern = '/^\{([a-z]*)\}$/';

		$params = explode( '/' , $params );

		$param_index = 0;

		$param_array = array();


		foreach( $url_tokens as $variable ){
			if($variable == ''){ continue; }
			if(preg_match( $pattern , $variable)){

				$variable_name = preg_replace($pattern, '$1', $variable);

				$param_array[$variable_name] = $params[$param_index];
				$param_index++;

			}
		}


		if( is_array( $controller ) ){
			$controller_name = explode( "@" , $controller['uses'] )[0];
			$controller_method = explode( "@" , $controller['uses'] )[1];
		}else{
			$controller_name = explode( "@" , $controller )[0];
			$controller_method = explode( "@" , $controller )[1];
		}

		$RouteExec[ 'controller_name' ] = $controller_name;
		$RouteExec[ 'controller_method' ] = $controller_method;
		$RouteExec[ 'param_array' ] = $param_array;
		// Controller( $controller_name , $controller_method , $param_array );
		return true;
	}
?>
