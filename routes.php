<?php

	// Fichero de configuracion de las rutas del sitio y comportamiento del mismo.

	// Las rutas dentro de Auth['session'] solo son accedidas en sesiones activas.
	$Auth['session'](function(){
		Route( 'get' , '/' , 'home@panel' );
	});


	// Las rutas dentro de Auth['guest'] solo son accedidas en sin sesion.
	$Auth['guest'](function(){
		Route( 'get' , '/' , 'home@index' );
	});

	// Las rutas fuera de Auth son accedidas independientemente de la sesion.
	Route( 'get' , 'config/{option}/{value}/{item}' , 'Config@index' );

?>
