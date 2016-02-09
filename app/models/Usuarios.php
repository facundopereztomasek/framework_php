<?php
	// Modelo que extiende al modelo base
	
	$Usuarios = array_merge( $BaseModel , array(
		'table' => 'usuarios',
		'model' => ($model = 'Usuarios'),
	));


?>
