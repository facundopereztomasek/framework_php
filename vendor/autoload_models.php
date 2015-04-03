<?php
	// Carga serial de los modelos definidos para su posterior utilizacion.

	$models_path = opendir('../app/models/');

	while( $models = readdir( $models_path ) ){
		if( $models == '.' || $models == '..' ) continue;
		require_once( '../app/models/' . $models );
	}
?>
