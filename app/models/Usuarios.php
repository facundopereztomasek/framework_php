<?php
	// Modelo que extiende al modelo base
	
	$Usuarios = array_merge( $BaseModel , array(
		'table' => 'users',
		'model' => ($model = 'Usuarios'),
	));


?>
