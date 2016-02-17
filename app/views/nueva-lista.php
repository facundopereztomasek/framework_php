<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nueva Lista</title>
</head>
<body>
	<p>Crea tu lista.</p>
  
  <?php 
  foreach($products as $product) {
    if($product['tipo']=="0") { continue; }
  ?>
  <div>
    @label( 'product_{{$product["id"]}}' , '{{$product["nombre"]}}' , array('class'=>'clase') )
    @checkbox( 'product_{{$product["id"]}}' , '{{$product["id"]}}' , array('id'=>'product_{{$product["id"]}}', 'class'=>'clase') )
  </div>    
  
  <?php
  }
  ?>
</body>
</html>
