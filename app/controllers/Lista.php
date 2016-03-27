<?php
	function index( $params ){
    global $Producto;
    $products = $Producto['get']();
    return View( 'nueva-lista' , array('products' => $products));
	}

  function save( $params ){
    global $Lista;
    $lista = $Lista['new']();
    
    if(isset($_POST)){
      $products = $_POST['products'];
      $novio = $_POST['novio'];
      $novia = $_POST['novia'];
      $lugar = $_POST['lugar'];
      $fecha = $_POST['fecha'];
    }

    $lista["products"] = $products;
    $lista["novio"] = $novio;
    $lista["novia"] = $novia;
    $lista["lugar"] = $lugar;
    $lista["fecha"] = $fecha;
    $lista["fk_usuarios"] = 18;

    $lista["save"]();


    echo '<pre>';
    var_dump($lista);
    echo '</pre>';
    
    
    return View( 'nueva-lista' , array('lista' => $lista));
  }
?>
