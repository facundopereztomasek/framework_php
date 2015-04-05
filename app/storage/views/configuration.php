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

		<div>Usuario: <strong><?php print_r( $user['user'] ) ?></strong></div>
		<div>Usuario: <strong><?php print_r( mysqli_real_escape_string($DB["connection"],  $user['user']  )); ?></strong></div>

		<form method="POST" action="/config"  class="pendorcho"  >			<input type="text" name="nombre" value="s"  class="miTexto"  />
			<textarea name="texto" rows="8" cols="40"></textarea>
			<textarea name="texto" rows="8" cols="40">este es mi mensaje</textarea>
			<textarea name="texto" rows="8" cols="40"  class="caja"  >este es mi mensaje</textarea>
			<label for="check" ></label>
			<label for="check" >Elige la opcion</label>
			<label for="check"  class="caja"  >Elige la opcion</label>
			<input type="checkbox" name="check" value="1"  id="check"  />
			<input type="submit" name="pass" />
			<input type="submit" name="pass"  class="miTexto"  />
			<input type="hidden" name="hid" value="algo" />
			<input type="submit" name="Dale!" />
		</form>
	<?php
	}
	?>

</body>
</html>
