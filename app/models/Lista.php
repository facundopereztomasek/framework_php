<?php
  // Modelo base que contiene todos los metodos necesarios para la interaccion
  // con la base de datos

  $Prueba = array();
  $Prueba['name'] = 'La Prueba';
  $Prueba['new'] = function() {
    global $Prueba;
    $_prueba = array();
    $_prueba['save'] = function() {
      echo 'Guardado';
    };
    $_prueba['show'] = function() use (&$Prueba){
      echo '<pre>';
      var_dump($Prueba);
      echo '</pre>';
    };
    return $_prueba;
  };

  $p = &$Prueba['new']();
  $p['save']();
  $p['name'] = 'carlitos';
  $p['show']();
  die();

  $Lista = array();

  $Lista['table'] = 'listas';
  $Lista['model'] = ($model = 'Lista');
  $Lista['get']   = function( $param = 'all' ) use ($model){
      global $DB;
      global $Secure;
      global $$model;
      $this_model = $$model;


      switch( $param ){
        case 'all':
        default:
          $Secure['prepare']("SELECT * FROM " . $this_model['table'] );
          $rows = $Secure['execute'](null);

          $result = array();
          while( $r = mysqli_fetch_assoc( $rows )){
          // TODO: ojo con el []
            $result[]=$r;
          }
          return $result;
          // $DB['raw']("SELECT * FROM " . $this_model['table'] . ";");
          // return $DB['fetch']();
        break;

      }
    };
  $Lista['new']   = function( $id = null ) use ($model){
      global $DB;
      global $Secure;
      global $$model;
      global $Lista;
      $this_model = $$model;
      
      

      if( $id ){
        
        $Secure['prepare']("SELECT * FROM " . $this_model['table'] . " WHERE id=?");

        $rows = mysqli_fetch_assoc( $Secure['execute']( array($id) ));

        // print_r($rows);
        // return;
        // $DB['raw']("SELECT * FROM " . $this_model['table'] . " WHERE id='" . $id . "';");
        // $rows = $DB['fetch']();

        foreach( $rows as $key => $value){
          $new_reg[ $key ] = $value;
        }

      }else{
        
        $DB['raw']("SELECT * FROM " . $this_model['table'] . ";");
        $rows = $DB['fetch']();

        foreach( $rows[0] as $key => $value){
          $new_reg[ $key ] = null;
        }

      }

      $new_reg['save'] = function() use ($Lista) {
        global $DB;
        global $Secure;
        global $model;
        global $$model;
        

        $new_reg = $Lista;
        $this_model = $$model;

        $values = array();

        $keys = "";

        $wildcard = "";
        echo 'este';
        var_dump($new_reg);
        
        foreach( $new_reg as $key => $value ){
          echo $key . ' -> ' . $value;
          echo '<br>';
          if(is_object($value) || $key == 'id') continue;
          $sanitized_key = mysqli_real_escape_string( $DB['connection'] , $key);
          $keys .= $sanitized_key . ", ";
          $values[] = mysqli_real_escape_string( $DB['connection'] , $value);
          $wildcard .= "?, " ;
        }

        $keys = rtrim($keys , ', ');
        // $values = rtrim($values , ', ');
        $wildcard = rtrim($wildcard , ', ');

        $Secure['prepare']("INSERT INTO " . $this_model['table'] . " ( " . $keys . " ) VALUES ( " . $wildcard . " );");
        $Secure['execute']( $values );
        // $DB['raw']("INSERT INTO " . $this_model['table'] . " ( " . $keys . " ) VALUES ( " . $values . " );");
        return $new_reg;
      };

      $new_reg['update'] = function(){
        global $DB;
        global $Secure;
        global $model;
        global $$model;

        $this_model = $$model;

        $values = array();
        $set = "";

        foreach( $new_reg as $key => $value ){
          if(is_object($value) || $key == 'id') continue;
          $sanitized_key = mysqli_real_escape_string( $DB['connection'] , $key);
          $sanitized_value = mysqli_real_escape_string( $DB['connection'] , $value);
          $set .= $sanitized_key . " = ?, ";
          $values[] = mysqli_real_escape_string( $DB['connection'] , $value);
        }

        $values[] = $new_reg['id'];

        $set = rtrim($set , ', ');

        $Secure['prepare']("UPDATE " . $this_model['table'] . " SET " . $set . " WHERE id=?");
        $Secure['execute']( $values );

        return $new_reg;
      };

      $new_reg['delete'] = function(){
        global $DB;
        global $Secure;
        global $model;
        global $$model;


        $this_model = $$model;
        $values = array( $new_reg['id'] );
        $Secure['prepare']("DELETE FROM " . $this_model['table'] . " WHERE id=?");
        $Secure['execute']( $values );
        // $DB['raw']("DELETE FROM " . $this_model['table'] . " WHERE id='" . $new_reg['id'] . "';");
        return $new_reg;
      };

      $new_reg['set'] = function( $tupla ){

        foreach( $tupla as $key => $value ){
          $new_reg[ $key ] = $value;
        }
        return $new_reg;
      };

      return $new_reg;

    };
?>
