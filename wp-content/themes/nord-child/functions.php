<?php
	
	add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
	
	function enqueue_child_theme_styles() {
  		wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}

	// FUNCIÓN PARA CARGAR ESTILOS NECESARION EN LA PÀGINA DE INCIO
	function pnrm_homepage(){
		if( is_front_page() ):
			wp_enqueue_style( 'pnrm_custom', get_stylesheet_directory_uri().'/css/main.css', array(), false, 'all' );
			wp_enqueue_style( 'ed-grid', get_stylesheet_directory_uri().'/css/ed-grid.min.css', array(), false, 'all' );
			
			
			wp_enqueue_script( 'slider', get_stylesheet_directory_uri().'/js/slider.js', array('jquery'), false, true );
			wp_enqueue_script( 'main-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), false, true );
		else:
			wp_enqueue_style( 'pnrm_custom', get_stylesheet_directory_uri().'/css/main.css', array(), false, 'all' );
		endif;
	}


	add_action( 'wp_enqueue_scripts','pnrm_homepage' );
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), false, true );


?>