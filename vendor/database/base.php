<?php
	// La pseudo clase DB:
	// Es la interfaz a traves de la cual se establece comunicacion con la base de
	// datos

	$DB = array(
		"raw" => function( $query ){
			global $DB;

			$DB['result'] = mysqli_query( $DB['connection'] , $query );

		},

		"fetch" => function(){
			global $DB;

			$collection = array();
			while( $row = mysqli_fetch_assoc( $DB['result'] )){
				array_push( $collection , $row );
			}
			return $collection;
		},


		"result" => null
	);
?>
