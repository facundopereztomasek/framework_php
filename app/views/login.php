<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/base.css">
</head>
<body>
  <div class="row">
    <div class="form-container col-sm-2 col-sm-offset-3">
      <h1>Login</h1>
      <p>Please login</p>
      @form( 'loginDo' , array('class'=>''))
        @label( 'username' , 'Username' )
        @text( 'username' , 'facundoperez@gmail.com' , array('class'=>'input-username col-sm-8', 'autofocus'=>'true') )
        @label( 'password' , 'Password' )
        @text( 'password' , 'abbbb55g' , array('class'=>'input-password col-sm-8') )
        @submit( 'pass' , array('class'=>'input-submit col-sm-8') )
      @endform()
    </div>
  </div>
</body>
</html>
