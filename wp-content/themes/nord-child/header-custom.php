<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct script access denied.' );
}

/*** Body classes ***/
fastwp_nord_theme\options::get_body_class();

?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <?php 
        get_template_part( 'template-parts/content', 'menu' )
     ?>

<?php if( fastwp_nord_theme\utils::get_option( 'show_preloader', true ) ) { ?>
    <!-- loader -->
    <div class="loader-mask">
        <div class="loader"></div>
    </div>
<?php } ?>

<header class="header__panorama">
        <?php 
            get_template_part( 'template-parts/content', 'header' );
         ?>
        <div class="header__panorama__copy ">
            
            <div>
                <p>
                    <span class="quotes">Generamos cultura</span>
                    <span class="quotes">Resolvemos problemas</span>
                    <span class="quotes">Empoderamos proyectos</span>
                    <span class="quotes">Generamos cultura</span>
                    <span class="quotes">Impactamos mercados</span>
                    <span class="quotes">Cambiamos comportamientos</span>
                    a través de la <br>
                    influencia e identidad.
                </p>
            </div>

        </div>
    </header>