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

		<div>Usuario: <strong>{{ $user['name'] }}</strong></div>
		<div>Usuario: <strong>{{{ $user['name'] }}}</strong></div>

		@form( 'form_post' )
			@text( 'nombre' , 'd' )
			@textarea( 'texto' )
			@label( 'check' , 'Elige la opcion' )
			@checkbox( 'check' , '1' )
			@password( 'pass' , 'unpassword' )
			@hidden( 'hid' , 'algo' )
			@submit( 'Dale!' )
		@endform()
	<?php
	}
	?>

</body>
</html>
