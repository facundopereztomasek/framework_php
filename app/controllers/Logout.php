<?php
	function index( $params ){
		global $Auth;
		$Auth['logout']();
    header('Location: ' . 'login', true, $statusCode);
    die();
	}
?>
