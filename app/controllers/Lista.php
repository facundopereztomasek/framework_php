<?php
	function index( $params ){
    $products = Model(array(
      "method" => "get",
      "table" => "productos"
    ));
    
    return View( 'nueva-lista' , array('products' => $products));
  }

  function save( $params ){
    if(isset($_POST)){
      $products = $_POST['products'];
      $novio = $_POST['novio'];
      $novia = $_POST['novia'];
      $lugar = $_POST['lugar'];
      $fecha = $_POST['fecha'];
    }

    $lista = array();
    $lista["novio"] = $novio;
    $lista["novia"] = $novia;
    $lista["lugar"] = $lugar;
    $lista["fecha"] = $fecha;
    $lista["fk_usuarios"] = 18;

    $list_id = Model(array(
      "method" => "save",
      "table" => "listas",
      "data" => $lista
    ));

    foreach ($products as $key => $value) {
      echo $value;
      Model(array(
        "method" => "save",
        "table" => "productos_lista",
        "data" => array(
          "fk_listas" => $list_id,
          "fk_productos" => $value
        )
      ));      
    }    
    
    return View( 'nueva-lista' , array('lista' => $lista));
  }
?>
