<?php
	function Route( $request_method , $url , $controller ){

		if( $_SERVER['REQUEST_METHOD'] != strtoupper( $request_method ) ) return;

		switch( strtoupper( $request_method ) ){
			case 'GET':
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
			break;

			case 'POST':
				if( isset( $_POST['r'] ) ){
					$route = $_POST['r'];
				}else{
					$route = '/';
				}


				if( isset( $_POST['p'] ) ){
					$params = $_POST['p'];
				}else{
					$params = '';
				}
			break;
		}

		// echo $route . '<br>';

		$route_tokens = explode( '/' , $route );
		$url_tokens = explode( '/' , $url );

		$route_name = $route_tokens[0];
		$url_name = $url_tokens[0];

		$url_variables = array();

		$pattern = '/^\{([a-z]*)\}$/';
		$cadena = '{hoho}';

		$params = explode( '/' , $params );

		$param_index = 0;

		$param_array = array();

		foreach( $url_tokens as $variable ){

			if(preg_match( $pattern , $variable)){

				$variable_name = preg_replace($pattern, '$1', $variable);

				$param_array[$variable_name] = $params[$param_index];
				$param_index++;

			}
		}



		if( $route_name != $url_name ) return;

		$controller_name = explode( "@" , $controller )[0];
		$controller_method = explode( "@" , $controller )[1];
		
		Controller( $controller_name , $controller_method , $param_array );
	}
?>
