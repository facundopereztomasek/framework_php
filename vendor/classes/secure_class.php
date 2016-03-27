<?php
	// La pseudo clase Secure: se encarga de preparar y ejecutar las consultas
	// SQL evitando la inyeccion.
	$Secure = array();

	$Secure['prepare'] = function( $prepared ){
		global $DB;

		$query = "PREPARE prepared_stmt FROM '" . $prepared . "';";
		$statment = mysqli_query( $DB['connection'] , $query );

		// return $DB['result'];

	};

	$Secure['execute'] = function( $sets ){
		global $DB;

		$parameters = '';
		if( is_array( $sets ) ){
			foreach( $sets as $key => $parameter){
				$sanitized_parameter = mysqli_real_escape_string( $DB['connection'] , $parameter );
				$query = "SET @p" . $key . "='" . $sanitized_parameter . "'; ";
				$statment = mysqli_query( $DB['connection'] , $query );
				$parameters .= "@p" . $key . ',';
			}
			$parameters = substr($parameters, 0, -1);

			$query = "EXECUTE prepared_stmt USING " . $parameters . ";";
		}else{
			$query = "EXECUTE prepared_stmt";
		}

		$statment = mysqli_query( $DB['connection'] , $query );
		$last_id = mysqli_insert_id($DB['connection']);

		mysqli_query( $DB['connection'] , "DEALLOCATE PREPARE prepared_stmt;" );

		return $last_id;

	};

?>
