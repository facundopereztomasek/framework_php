<?php
	// Compilacion de las views parseando al estilo blade
	$views_files = array();
	$views_path = '../app/views/';
	$compiled_views_path = '../app/storage/views/';

	// Lee todos los ficheros de vista en el directorio views.
	getViewFiles();

	// Ejecuta tareas de compilacion de las vistas.
	compileViews();


	function getViewFiles(){
		global $views_path;
		global $views_files;

		$views_directory = opendir( $views_path );

		while( $view = readdir( $views_directory ) ){
			if( $view == '.' || $view == '..' ) continue;
			$view_file = fopen( $views_path . $view, "r");
			$view_name = explode( '.', $view )[0];

			$views_files[ $view_name ] = fread( $view_file, filesize( $views_path . $view ));

			fclose( $view_file );
		}
	}

	function compileViews(){
		global $views_files;
		global $compiled_views_path;

		foreach( $views_files as $view => $view_content ){
			$view_parsed = parseView( $view_content );
			$view_compiled_file = fopen( $compiled_views_path . $view . '.php', "w");
			fwrite( $view_compiled_file, $view_parsed);
			fclose( $view_compiled_file );

		}
	}

	function parseView( $view_stream ){

		$view_pre_parsed = '<?php global $DB; ?>' . $view_stream;
		// TODO: Cuando hay un array lo deja en blanco / tira una notificacion de php y rompe el html
		// Token: {{{ ... }}} -- Impresion de contenido de variables y arrays con
		// escape de caracteres especiales
		$pattern = '/\{\{\{([^\{]*[^\{])\}\}\}/';
		$view_pre_parsed = preg_replace($pattern, '<?php print_r( mysqli_real_escape_string($DB["connection"], $1 )); ?>', $view_pre_parsed);

		// Token: {{ ... }} -- Impresion de contenido de variables y arrays
		$pattern = '/\{\{([^\{]*[^\{])\}\}/';
		$view_pre_parsed = preg_replace($pattern, '<?php print_r(' . '$1' . ') ?>', $view_pre_parsed);



		// *********************************************************************
		// INPUT TEXT

		// Token: @text( 'name' , 'value' , array('class'=>'clase') ) -- creacion inputs tipo texto
		$pattern = '/@text\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<input type="text" name="' . $result[1] . '" value="'. $result[2] .'" ' . $result[3] . ' />';
		}, $view_pre_parsed);

		// Token: @text( 'name' , 'value' ) -- creacion inputs tipo texto
		$pattern = '/@text\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="text" name="$1" value="$2" />', $view_pre_parsed);


		// Token: @text( 'name' ) -- creacion inputs tipo texto
		$pattern = '/@text\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="text" name="$1" />', $view_pre_parsed);



		// *********************************************************************
		// INPUT PASSWORD

		// Token: @password( 'name' , 'value' , array('class'=>'clase') ) -- creacion inputs tipo password
		$pattern = '/@password\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<input type="password" name="' . $result[1] . '" value="'. $result[2] .'" ' . $result[3] . ' />';
		}, $view_pre_parsed);

		// Token: @password( 'name' , 'value' ) -- creacion inputs tipo password
		$pattern = '/@password\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="password" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @password( 'name' ) -- creacion inputs tipo password
		$pattern = '/@password\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="password" name="$1" />', $view_pre_parsed);



		// *********************************************************************
		// INPUT HIDDEN

		// Token: @hidden( 'name' , 'value' , array('class'=>'clase') ) -- creacion inputs tipo hidden
		$pattern = '/@hidden\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<input type="hidden" name="' . $result[1] . '" value="'. $result[2] .'" ' . $result[3] . ' />';
		}, $view_pre_parsed);

		// Token: @hidden( 'name' , 'value' ) -- creacion inputs tipo hidden
		$pattern = '/@hidden\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="hidden" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @hidden( 'name' ) -- creacion inputs tipo hidden
		$pattern = '/@hidden\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="hidden" name="$1" />', $view_pre_parsed);



		// *********************************************************************
		// INPUT CHECKBOX

		// Token: @checkbox( 'name' , 'value' , array('class'=>'clase') ) -- creacion inputs tipo checkbox
		$pattern = '/@checkbox\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<input type="checkbox" name="' . $result[1] . '" value="'. $result[2] .'" ' . $result[3] . ' />';
		}, $view_pre_parsed);

		// Token: @checkbox( 'name' , 'value' ) -- creacion inputs tipo checkbox
		$pattern = '/@checkbox\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="checkbox" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @checkbox( 'name' ) -- creacion inputs tipo checkbox
		$pattern = '/@checkbox\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="checkbox" name="$1" />', $view_pre_parsed);



		// *********************************************************************
		// INPUT SUBMIT

		// Token: @submit( 'name' , 'value' , array('class'=>'clase') ) -- creacion inputs tipo submit
		$pattern = '/@submit\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<input type="submit" name="' . $result[1] .'" ' . $result[2] . ' />';
		}, $view_pre_parsed);

		// Token: @submit( 'name' ) -- creacion inputs tipo submit
		$pattern = '/@submit\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="submit" name="$1" />', $view_pre_parsed);



		// *********************************************************************
		// TEXTAREA

		// Token: @textarea( 'name' , 'text' , array('class'=>'clase') ) -- creacion de textareas
		$pattern = '/@textarea\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<textarea name="' . $result[1] . '" rows="8" cols="40" ' . $result[3] . ' >'. $result[2] .'</textarea>';
		}, $view_pre_parsed);

		// Token: @textarea( 'name' , 'value' ) -- creacion de textareas
		$pattern = '/@textarea\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<textarea name="$1" rows="8" cols="40">$2</textarea>', $view_pre_parsed);

		// Token: @textarea( 'name' ) -- creacion de textareas
		$pattern = '/@textarea\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<textarea name="$1" rows="8" cols="40"></textarea>', $view_pre_parsed);



		// *********************************************************************
		// LABEL

		// Token: @label( 'for' , 'text' , array('class'=>'clase') ) -- creacion inputs tipo texto
		$pattern = '/@label\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)/';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<label for="' . $result[1] . '" ' . $result[3] . ' >'. $result[2] .'</label>';
		}, $view_pre_parsed);

		// Token: @label( 'for' , 'value' ) -- creacion inputs tipo texto
		$pattern = '/@label\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<label for="$1" >$2</label>', $view_pre_parsed);

		// Token: @label( 'for' ) -- creacion inputs tipo texto
		$pattern = '/@label\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<label for="$1" ></label>', $view_pre_parsed);



		// *********************************************************************
		// FORM

		// Token: @form( 'action' , array('class'=>'clase') ) ... @endform() -- creacion de formularios
		$pattern = '/@form\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*array\((.*)\)\s*\)\n*(.*)\n*@endform\(\)/s';

		$view_pre_parsed = preg_replace_callback($pattern, function( $result ) {
			global $RouteAliases;

			$swap = $result[3];
			$result[3] = $result[2];
			$result[2] = $swap;
			// parse_result convierte los arrays en formato texto a duplas de atributo=valor
			$result = parse_result( $result );
			return '<form method="POST" action="/' . $RouteAliases[ $result[1] ] . '" ' . $result[3] . ' >'. $result[2] .'</form>';
		}, $view_pre_parsed);

		// Token: @form( 'action' ) ... @endform() -- creacion de formularios
		$pattern = '/@form\(\s*[\'*\"*](.*)[\'*\"*]\s*\)\n*(.*)\n*@endform\(\)/s';
		$view_pre_parsed = preg_replace($pattern, '<form action="$1" method="post" >$2</form>', $view_pre_parsed);

		return $view_pre_parsed;
	}

	function parse_result( $result ){
		if(isset($result[3])){
			$array_index = 3;
		}else{
			$array_index = 2;
		}
		$attr_array = $result[ $array_index ];
		$attr_array = explode( ',' , $attr_array );


		$attr_array = array_map( 'arr2attr' , $attr_array );

		$attr_string = '';
		foreach( $attr_array as $attr ){

		//HAY QUE FESTEJAR!!! ESTE BUG CASI ME GANA
		$attr[0] = preg_replace( '/^[\"](.*)[\"]$/' , "$1" , $attr[0]);
		$attr[0] = preg_replace( '/^[\'](.*)[\']$/' , "$1" , $attr[0]);
		$attr[1] = preg_replace( '/^[\"](.*)[\"]$/' , "$1" , $attr[1]);
		$attr[1] = preg_replace( '/^[\'](.*)[\']$/' , "$1" , $attr[1]);

			$attr_string .= ' ' . $attr[0] . '="' . $attr[1] . '" ';

		}
		$result[ $array_index ] = $attr_string;
		return $result;
	}

	function arr2attr( $arr ){
		return explode( '=>' , $arr);
	}

?>
