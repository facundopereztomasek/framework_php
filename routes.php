<?php

	// Fichero de configuracion de las rutas del sitio y comportamiento del mismo.

	// Las rutas dentro de Auth['session'] solo son accedidas en sesiones activas.
	$Auth['session'](function(){
		Route( 'get' , '/' , array( 'uses' => 'home@index') );
		Route( 'get' , 'logout' , 'logout@index' );
		Route( 'get' , 'crear-lista' , 'lista@index' );
	});


	// Las rutas dentro de Auth['guest'] solo son accedidas sin sesion.
	$Auth['guest'](function(){
		Route( 'get' , 'login' , 'login@index' );
		Route( 'post' , 'login' , array('uses' => 'login@loginDo' , 'as' => 'loginDo') );
	});

	// Las rutas fuera de Auth son accedidas independientemente de la sesion.
	Route( 'get' , 'config/{option}/{value}/{item}' , array('uses' => 'Config@index') );

	// Route( 'post' , 'config' , array('uses' => 'Config@submitted' , 'as' => 'form_post') );


?>
