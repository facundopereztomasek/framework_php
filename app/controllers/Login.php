<?php
	function index( $params ){
		return View( 'login' );
	}

	function loginDo( $params ){
		global $Auth;
		if(isset($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];
		}
		$usr = $Auth['login']( $username , $password );

		if($usr != false) {
			header('Location: ' . '/', true, $statusCode);
		  die();
		};
		return View( 'loginFail' );
	}
?>
