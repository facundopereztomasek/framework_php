<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Configuracion</title>
</head>
<body>
	<p>Esta es la configuracion.</p>
	{{{ $myOptions }}}
	{{{ $myValue }}}
	{{{ $myItem }}}

	<?php
	foreach( $myUsers as $user ){
	?>

		<div>Usuario: <strong>{{ $user['user'] }}</strong></div>
		<div>Usuario: <strong>{{{ $user['user'] }}}</strong></div>

		@form( 'form_post' , array('class'=>'pendorcho'))
			@text( 'nombre' , 's' , array('class'=>'miTexto') )
			@textarea( 'texto' )
			@textarea( 'texto' , 'este es mi mensaje' )
			@textarea( 'texto' , 'este es mi mensaje' ,array('class'=>'caja'))
			@label( 'check' )
			@label( 'check' , 'Elige la opcion' )
			@label( 'check' , 'Elige la opcion', array('class'=>'caja'))
			@checkbox( 'check' , '1' , array('id'=>'check') )
			@submit( 'pass'  )
			@submit( 'pass' ,  array('class'=>'miTexto'))
			@hidden( 'hid' , 'algo' )
			@submit( 'Dale!' )
		@endform()
	<?php
	}
	?>

</body>
</html>
