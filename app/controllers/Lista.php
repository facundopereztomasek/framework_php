<?php
	function index( $params ){
    global $Producto;
    var_dump($Producto['table']);
    $products = $Producto['get']();
		return View( 'nueva-lista' , array('products' => $products));
	}
?>
