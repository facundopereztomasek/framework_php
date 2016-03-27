<?php
  function Model(array $params) {
    if(isset($params['method'])) $method = $params['method'];
    if(isset($params['table']))  $table  = $params['table'];
    if(isset($params['data']))   $data   = $params['data'];

    switch($method) {
      case "get":
        global $DB;
        global $Secure;

        $Secure['prepare']("SELECT * FROM " . $table );
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

      case "save":
        
        global $DB;
        global $Secure;

        $values = array();
        $keys = "";
        $wildcard = "";
        
        foreach( $data as $key => $value ){
          if(is_object($value) || $key == 'id') continue;
          $sanitized_key = mysqli_real_escape_string( $DB['connection'] , $key);
          $keys .= $sanitized_key . ", ";
          $values[] = mysqli_real_escape_string( $DB['connection'] , $value);
          $wildcard .= "?, " ;
        }

        $keys = rtrim($keys , ', ');

        $wildcard = rtrim($wildcard , ', ');

        $Secure['prepare']("INSERT INTO " . $table . " ( " . $keys . " ) VALUES ( " . $wildcard . " );");
        $last_id = $Secure['execute']( $values );

        return $last_id;

        break;
    }
	}
?>
