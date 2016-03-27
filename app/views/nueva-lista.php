<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nueva Lista</title>
</head>
<body>
	<p>Crea tu lista.</p>
  
  @form( 'guarda-lista' , array('class'=>''))
    <?php 
    foreach($products as $product) {
      if($product['tipo']=="0") { continue; }
      ?>
      <div>
        @label( 'product_{{$product["id"]}}' , '{{$product["nombre"]}}' , array('class'=>'clase') )
        @checkbox( 'products[]' , '{{$product["id"]}}' , array('name'=>'product','value'=>'{{$product["id"]}}','id'=>'product_{{$product["id"]}}', 'class'=>'clase') )
      </div>    
      
      <?php
    }
    ?>

    <div>
      @label( 'novio' , 'Nombre del novio' , array('class'=>'clase') )
      @text( 'novio' , 'Juan' , array('id'=>'novio', 'class'=>'clase') )
    </div>

    <div>
      @label( 'novia' , 'Nombre del novia' , array('class'=>'clase') )
      @text( 'novia' , 'Carla' , array('id'=>'novia', 'class'=>'clase') )
    </div>

    <div>
      @label( 'lugar' , 'Lugar de casamiento' , array('class'=>'clase') )
      @text( 'lugar' , 'En la Iglesia' , array('id'=>'lugar', 'class'=>'clase') )
    </div>

    <div>
      @label( 'fecha' , 'Fecha de casamiento' , array('class'=>'clase') )
      @text( 'fecha' , '2016-01-16' , array('id'=>'fecha', 'class'=>'clase') )
    </div>


    @submit( 'pass' , array('class'=>'input-submit col-sm-8') )
  @endform()
</body>
</html>
