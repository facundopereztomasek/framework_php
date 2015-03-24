<?php
	$models_path = opendir('../app/models/');

	while( $models = readdir( $models_path ) ){
		if( $models == '.' || $models == '..' ) continue;
		require_once( '../app/models/' . $models );
	}
?>
