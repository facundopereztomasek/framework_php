<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Configuracion</title>
</head>
<body>
	<p>Esta es la configuracion.</p>
	<?php echo $myOptions; ?>
	<?php echo $myValue; ?>
	<?php echo $myItem; ?>
	<?php
	foreach( $myUsers as $user ){
	?>
		<div>Usuario: <strong><?php echo $user['name'] ?></strong></div>
	<?php
	}
	?>
</body>
</html>
