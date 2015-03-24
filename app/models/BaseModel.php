<?php
	$BaseModel = array(
		'table' => '',
		'model' => ($model = 'BaseModel'),
		'get' => function( $param = 'all' ){
			global $DB;
			global $model;
			global $$model;
			$this_model = $$model;


			switch( $param ){
				case 'all':
					$DB['raw']("SELECT * FROM " . $this_model['table'] . ";");
					return $DB['fetch']();
				break;

				default:
					$DB['raw']("SELECT " . $param . " FROM " . $this_model['table'] . ";");
					return $DB['fetch']();
				break;
			}
		},
		'new' => function( $id = null ){
			global $DB;
			global $model;
			global $$model;
			$this_model = $$model;

			$new_reg = array();

			if( $id ){
				global $new_reg;
				$DB['raw']("SELECT * FROM " . $this_model['table'] . " WHERE id='" . $id . "';");
				$rows = $DB['fetch']();

				foreach( $rows[0] as $key => $value){
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

				$values = "";
				$keys = "";

				foreach( $new_reg as $key => $value ){
					if(is_object($value) || $key == 'id') continue;
					$keys .= $key . ", ";
					$values .= "'" . $value . "', ";
				}

				$keys = rtrim($keys , ', ');
				$values = rtrim($values , ', ');

				$DB['raw']("INSERT INTO " . $this_model['table'] . " ( " . $keys . " ) VALUES ( " . $values . " );");
				return $new_reg;
			};

			$new_reg['update'] = function(){
				global $DB;
				global $model;
				global $$model;
				global $new_reg;

				$this_model = $$model;

				$set = "";

				foreach( $new_reg as $key => $value ){
					if(is_object($value) || $key == 'id') continue;
					$set .= $key . " = '". $value . "', ";
				}

				$set = rtrim($set , ', ');

				$DB['raw']("UPDATE " . $this_model['table'] . " SET " . $set . " WHERE id='" . $new_reg['id'] . "';");
				return $new_reg;
			};

			$new_reg['delete'] = function(){
				global $DB;
				global $model;
				global $$model;
				global $new_reg;

				$this_model = $$model;

				$DB['raw']("DELETE FROM " . $this_model['table'] . " WHERE id='" . $new_reg['id'] . "';");
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
