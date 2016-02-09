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
    echo '<pre>';
    var_dump($product);
  ?>
    
  <?php 
  echo '</pre>';
  }
  ?>
</body>
</html>
