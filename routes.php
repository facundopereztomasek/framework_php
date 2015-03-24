<?php

	Route( 'get' , '/' , 'home@index' );
	Route( 'get' , 'config/{option}/{value}/{item}' , 'Config@index' );

?>
