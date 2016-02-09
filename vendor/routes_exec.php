<?php
  // Comprobación temporal
  // Si esta configurado un controller, rutea
  if(isset($RouteExec[ 'controller_name' ])) {
    Controller(
      $RouteExec[ 'controller_name' ] ,
      $RouteExec[ 'controller_method' ] ,
      $RouteExec[ 'param_array' ]
    );
  } else {
  // Si no esta configurado un controller
  // informa un error
    echo "Error: No existe router para la url";
  }

?>
