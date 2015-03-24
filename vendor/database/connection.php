<?php
	$DB['connection'] = mysqli_connect( $database_conf['db_host'] , $database_conf['db_user'] , $database_conf['db_pass'] , $database_conf['db_name'] );

	if( mysqli_connect_errno() ){
		echo "Error al conectar a la base de datos: " . mysqli_connect_error();
	}
?>
