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

<header class="header">
    <?php 
        get_template_part( 'template-parts/content', 'headerBlack' );
    ?>
</header>