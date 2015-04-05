<?php
	function index( $params ){
		global $DB;
		global $Usuarios;
		global $Auth;
		global $Secure;

		$Secure['prepare']("SELECT * FROM users WHERE user=? AND apellido=?");
		// print_r(mysqli_fetch_assoc($Secure['execute'](array("Facundo",'Perez'))));

		$myOptions = $params['option'];
		$myValue = $params['value'];
		$myItem = $params['item'];


		// $users = $Usuarios['get']('name');

		$users = $Usuarios['new'](11);
		$users = $users['set']( array('user' => 'Juancito' ) );
		$users = $users['set']( array('apellido' => 'Lalala' ) );
		// $users = $users['delete']();
		// $users = $users['delete']();

		$Auth['login']( 'Facundo' , '1234' );
		// $Auth['logout']();
		// $Auth['create']('Juancho2' , '1234');
		// $Auth['remove']( 'Juancho2' , '1234' );

		return View( 'configuration' , array('myOptions' => $myOptions , 'myValue' => $myValue , 'myItem' => $myItem , 'myUsers' => array($users)) );
	}

	function submitted( $params ){

		return View( 'form_posted' );
	}
?>
