<?php global $DB; ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Configuracion</title>
</head>
<body>
	<p>Esta es la configuracion.</p>
	<?php print_r( mysqli_real_escape_string($DB["connection"],  $myOptions  )); ?>
	<?php print_r( mysqli_real_escape_string($DB["connection"],  $myValue  )); ?>
	<?php print_r( mysqli_real_escape_string($DB["connection"],  $myItem  )); ?>
	
	<?php
	foreach( $myUsers as $user ){
	?>

		<div>Usuario: <strong><?php print_r( $user['name'] ) ?></strong></div>
		<div>Usuario: <strong><?php print_r( mysqli_real_escape_string($DB["connection"],  $user['name']  )); ?></strong></div>

		<form action="form_post" method="post">			<input type="text" name="nombre" value="d" />
			<textarea col="10" row="10" >texto</textarea>
			<label for="check" >Elige la opcion</label>
			<input type="checkbox" name="check" value="1" />
			<input type="password" name="pass" value="unpassword" />
			<input type="hidden" name="hid" value="algo" />
			<input type="submit" value="Dale!" />
		</form>
	<?php
	}
	?>

</body>
</html>
