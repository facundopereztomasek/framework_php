<?php
	session_start();
	// La pseudo clase Auth: se encarga de realizar la validacion de usuarios y
	// login, generando una sesion.
	$Auth = array();

	if(isset($_SESSION['active_session'])){
		echo 'logueado desde antes <br>';
	}

	$Auth['login'] = function( $username, $password ){
		global $DB;
		global $Secure;
		global $Usuarios;

		$password = sha1( $password );

		$Secure['prepare']("SELECT * FROM users WHERE user=? AND password=?;");
		$result = $Secure['execute']( array(
			mysqli_real_escape_string( $DB['connection'], $username ),
			mysqli_real_escape_string( $DB['connection'], $password )
		) );
		// print_r($result);
		// $result = $DB['raw']("SELECT * FROM users WHERE user='$username' AND password='$password';");

		// Si el login es exitoso
		if( mysqli_num_rows( $result )){
			echo 'Logueado.';
			$data = mysqli_fetch_assoc( $result );
			$logged_user = $Usuarios['new']($data['id']);

			$_SESSION['active_session'] = true;
			$_SESSION['username'] = $logged_user['user'];

			return $logged_user;
		}

		// Si no existe el usuario o el password es incorrecto
		echo 'Error, no logueado.';

	};

	$Auth['logout'] = function(){

		session_destroy();

		echo 'Te deslogueaste.';

	};

	$Auth['create'] = function( $username, $password ){
		global $DB;
		global $Secure;
		global $Usuarios;

		$password = sha1( $password );

		$Secure['prepare']("SELECT * FROM users WHERE user=?");
		$result = $Secure['execute']( array(
			mysqli_real_escape_string( $DB['connection'], $username )
		) );

		// $result = $DB['raw']("SELECT * FROM users WHERE user='$username';");

		// Si el login es exitoso
		if( mysqli_num_rows( $result )){
			return false;
		}

		$Secure['prepare']("INSERT INTO users( user , password ) VALUES ( ? , ? )");
		$result = $Secure['execute']( array(
			mysqli_real_escape_string( $DB['connection'], $username ),
			mysqli_real_escape_string( $DB['connection'], $password )
		) );

		// $result = $DB['raw']("INSERT INTO users( user , password ) VALUES ( '$username' , '$password' );");

		return true;
	};

	$Auth['remove'] = function( $username, $password ){
		global $DB;
		global $Secure;
		$password = sha1( $password );

		$Secure['prepare']("SELECT * FROM users WHERE user=? AND password=?;");
		$result = $Secure['execute']( array(
			mysqli_real_escape_string( $DB['connection'], $username ),
			mysqli_real_escape_string( $DB['connection'], $password )
		) );

		// $result = $DB['raw']("SELECT * FROM users WHERE user='$username' AND password='$password';");

		// Si el login es exitoso
		if( mysqli_num_rows( $result )){
			$Secure['prepare']("DELETE FROM users WHERE user=? AND password=?");
			$result = $Secure['execute']( array(
				mysqli_real_escape_string( $DB['connection'], $username ),
				mysqli_real_escape_string( $DB['connection'], $password )
			) );

			// $result = $DB['raw']("DELETE FROM users WHERE user='$username' AND password='$password';");
			return true;
		}


		return false;
	};

	$Auth['session'] = function( $route ){

		if(isset($_SESSION['active_session'])){
			$route();
			return true;
		}

		return false;

	};

	$Auth['guest'] = function( $route ){

		if(isset($_SESSION['active_session'])){
			return false;
		}

		$route();
		return true;

	};

?>
