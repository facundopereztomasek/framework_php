<?php
	function index( $params ){
		global $DB;
		global $Usuarios;

		$myOptions = $params['option'];
		$myValue = $params['value'];
		$myItem = $params['item'];


		// $users = $Usuarios['get']('name');

		$users = $Usuarios['new'](2);
		// $users = $users['set']( array('name' => 'Emmanuel' ) );
		// $users = $users['delete']();

		return View( 'configuration' , array('myOptions' => $myOptions , 'myValue' => $myValue , 'myItem' => $myItem , 'myUsers' => array($users)) );
	}
?>
