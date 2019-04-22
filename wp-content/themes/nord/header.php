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

<?php if( fastwp_nord_theme\utils::get_option( 'show_preloader', true ) ) { ?>
    <!-- loader -->
    <div class="loader-mask">
        <div class="loader"></div>
    </div>
<?php } ?>

<header class="header">
    <div class="container">
        <?php if( ( $fastwp_nord_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' ) ) && !empty( $fastwp_nord_logo[0] ) ) { ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-logo float-left"><img src="<?php echo esc_url( $fastwp_nord_logo[0] ); ?>" alt="<?php echo esc_attr__( 'Home', 'nord' ); ?>"></a>
        <?php } else {
            $fastwp_logo_text = fastwp_nord_theme\utils::get_option( 'custom_logo_text' );
            echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="main-logo float-left">' . ( !empty( $fastwp_logo_text ) ? esc_html( $fastwp_logo_text ) : get_bloginfo( 'name' ) ) . '</a>';
        } ?>

    	<div class="main-nav float-right">
            <?php echo fastwp_nord_theme\markup::the_menu(); ?>
        </div>
        <div class="trigger float-right">
            <span class="icon-bar top"></span>
            <span class="icon-bar middle"></span>
            <span class="icon-bar bottom"></span>
        </div>
    </div>
    <div class="mobile-nav"></div>
</header>