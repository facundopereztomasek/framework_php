<?php

	// Fichero de configuracion de las rutas del sitio y comportamiento del mismo.

	Route( 'get' , '/' , 'home@index' );
	Route( 'get' , 'config/{option}/{value}/{item}' , 'Config@index' );

?>
