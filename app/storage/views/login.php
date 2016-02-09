<?php global $DB; ?><!DOCTYPE html>
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
      <form method="POST" action="/"  class=""  >        <label for="username" >Username</label>
        <input type="text" name="username" value=""  class="input-username col-sm-8"   autofocus="true"  />
        <label for="password" >Password</label>
        <input type="text" name="password" value=""  class="input-password col-sm-8"  />
        <input type="submit" name="pass"  class="input-submit col-sm-8"  />
      </form>
    </div>
  </div>
</body>
</html>
