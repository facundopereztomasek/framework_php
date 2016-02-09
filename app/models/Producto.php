<?php
	// Modelo que extiende al modelo base
	
	$Producto = array_merge( $BaseModel , array(
		'table' => 'productos',
		'model' => ($model = 'Producto'),
	));


?>
