<?php
	function index( $params ){
    global $Producto;
    // var_dump($Producto['get']());
    $products = $Producto['get']();
    return View( 'nueva-lista' , array('products' => $products));
	}
?>
