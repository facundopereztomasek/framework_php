<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Configuracion</title>
</head>
<body>
		@form( 'loginDo' , array('class'=>'pendorcho'))
			@text( 'username' , '' , array('class'=>'input-username') )
			@text( 'password' , '' , array('class'=>'input-password') )
			@submit( 'pass'  )
		@endform()
</body>
</html>
