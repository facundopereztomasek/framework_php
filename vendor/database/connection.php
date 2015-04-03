<?php
	// Extension de la funcionalidad de la pseudo clase DB. Es necesario definir
	// esta funcionalidad por fuera del array DB que se define en base.php ya que
	// se necesita mostrar un error si esta conexion falla.
	// La extension consiste en preparar y establecer la conexion SQL.
	 
	$DB['connection'] = mysqli_connect( $database_conf['db_host'] , $database_conf['db_user'] , $database_conf['db_pass'] , $database_conf['db_name'] );

	if( mysqli_connect_errno() ){
		echo "Error al conectar a la base de datos: " . mysqli_connect_error();
	}
?>
