<?php
	// Modelo base que contiene todos los metodos necesarios para la interaccion
	// con la base de datos

	// TODO: Problema con model, se pisan los modelos
	$BaseModel = array(
		'table' => '',
		'model' => ($model = 'BaseModel'),
		'get' => function( $param = 'all' ){
			global $DB;
			global $Secure;
			global $model;
			global $$model;
			$this_model = $$model;


			switch( $param ){
				case 'all':
				default:
					$Secure['prepare']("SELECT * FROM " . $this_model['table'] );
					$rows = $Secure['execute'](null);

					$result = array();
					while( $r = mysqli_fetch_assoc( $rows )){
						$result[]=$r;
					}
					return $result;
					// $DB['raw']("SELECT * FROM " . $this_model['table'] . ";");
					// return $DB['fetch']();
				break;

			}
		},
		'new' => function( $id = null ){
			global $DB;
			global $Secure;
			global $model;
			global $$model;
			$this_model = $$model;

			$new_reg = array();

			if( $id ){
				global $new_reg;
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
				global $new_reg;
				$DB['raw']("SELECT * FROM " . $this_model['table'] . ";");
				$rows = $DB['fetch']();

				foreach( $rows[0] as $key => $value){
					$new_reg[ $key ] = null;
				}

			}

			$new_reg['save'] = function(){
				global $DB;
				global $model;
				global $$model;
				global $new_reg;

				$this_model = $$model;

				$values = array();

				$keys = "";

				$wildcard = "";
				foreach( $new_reg as $key => $value ){
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
				global $new_reg;

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
				global $new_reg;

				$this_model = $$model;
				$values = array( $new_reg['id'] );
				$Secure['prepare']("DELETE FROM " . $this_model['table'] . " WHERE id=?");
				$Secure['execute']( $values );
				// $DB['raw']("DELETE FROM " . $this_model['table'] . " WHERE id='" . $new_reg['id'] . "';");
				return $new_reg;
			};

			$new_reg['set'] = function( $tupla ){
				global $new_reg;
				foreach( $tupla as $key => $value ){
					$new_reg[ $key ] = $value;
				}
				return $new_reg;
			};

			return $new_reg;

		}
	);
?>
