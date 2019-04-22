<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

?>

<?php get_header(); ?>

<div class="container">
    <div class="hero text-center">
		<h1><strong><?php esc_html_e( 'Error 404', 'nord' ); ?></strong></h1>
		<p><?php esc_html_e( 'Oops! Page not found.', 'nord' ); ?></p>
		<div class="gap-50"></div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'Back to Home', 'nord' ); ?></a>
	</div>
</div>

<?php get_footer(); ?>
