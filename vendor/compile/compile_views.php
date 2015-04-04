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

		// Token: {{{ ... }}} -- Impresion de contenido de variables y arrays con
		// escape de caracteres especiales
		$pattern = '/\{\{\{(.*)\}\}\}/';
		$view_pre_parsed = preg_replace($pattern, '<?php print_r( mysqli_real_escape_string($DB["connection"], $1 )); ?>', $view_pre_parsed);


		// Token: {{ ... }} -- Impresion de contenido de variables y arrays
		$pattern = '/\{\{(.*)\}\}/';
		$view_pre_parsed = preg_replace($pattern, '<?php print_r(' . '$1' . ') ?>', $view_pre_parsed);


		// Token: @text( 'name' , 'value' ) -- creacion inputs tipo texto
		$pattern = '/@text\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="text" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @password( 'name' , 'value' ) -- creacion inputs tipo texto
		$pattern = '/@password\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="password" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @hidden( 'name' , 'value' ) -- creacion inputs tipo texto
		$pattern = '/@hidden\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="hidden" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @checkbox( 'name' , 'value' ) -- creacion inputs tipo checkbox
		$pattern = '/@checkbox\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="checkbox" name="$1" value="$2" />', $view_pre_parsed);

		// Token: @submit( 'value' ) -- creacion inputs tipo submit
		$pattern = '/@submit\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<input type="submit" value="$1" />', $view_pre_parsed);

		// Token: @textarea( 'value' ) -- creacion de textarea
		$pattern = '/@textarea\(\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<textarea col="10" row="10" >$1</textarea>', $view_pre_parsed);

		// Token: @label( 'for' , 'text' ) -- creacion inputs tipo texto
		$pattern = '/@label\(\s*[\'*\"*](.*)[\'*\"*]\s*\,\s*[\'*\"*](.*)[\'*\"*]\s*\)/';
		$view_pre_parsed = preg_replace($pattern, '<label for="$1" >$2</label>', $view_pre_parsed);

		// Token: @form( 'action' ) ... @endform() -- creacion de formularios
		$pattern = '/@form\(\s*[\'*\"*](.*)[\'*\"*]\s*\)\n*(.*)\n*@endform\(\)/s';
		$view_pre_parsed = preg_replace($pattern, '<form action="$1" method="post">$2</form>', $view_pre_parsed);

		return $view_pre_parsed;
	}

?>
