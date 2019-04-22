<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

?>

<?php get_header(); ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="column col-6">
                <p><?php echo ( ( $fastwp_nord_blog_minititle = fastwp_nord_theme\utils::get_option( 'fwp_blog_minititle' ) ) && !empty( $fastwp_nord_blog_minititle ) ? esc_html( $fastwp_nord_blog_minititle ) : esc_html__( 'Our Blog', 'nord' ) ); ?></p>
            	<h1><?php echo ( ( $fastwp_nord_blog_title = fastwp_nord_theme\utils::get_option( 'fwp_blog_title' ) ) && !empty( $fastwp_nord_blog_title ) ? esc_html( $fastwp_nord_blog_title ) : esc_html__( 'Latest thoughts, ideas & plans.', 'nord' ) ); ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="section pt-0 pb-0">
    <div class="container">
        <div class="row">
            <?php $fastwp_nord_sidebar = fastwp_nord_theme\utils::get_option( 'fwp_blog_sidebar' );
            if( $fastwp_nord_sidebar == 'left' ) { ?>
            <div class="column col-4">
                <?php get_template_part( 'sidebar' ); ?>
            </div>
            <?php } ?>
            <div class="column col-<?php echo ( !empty( $fastwp_nord_sidebar ) && in_array( $fastwp_nord_sidebar, array( 'left', 'right' ) ) ? 8 : 12 ); ?>">
                <?php $fastwp_nord_blog_type = fastwp_nord_theme\utils::get_option( 'fwp_blog_type' ); ?>
                <!-- loop -->
                <?php if( $fastwp_nord_blog_type == 'minimal' && !in_array( $fastwp_nord_sidebar, array( 'left', 'right' ) ) ) {
                    get_template_part( 'loop-minimal' );
                } else {
                    get_template_part( 'loop' );
                } ?>
                <!-- navigation -->
                <?php get_template_part( 'navigation' ); ?>
                <!-- /navigation -->
            </div>
            <?php if( $fastwp_nord_sidebar == 'right' ) { ?>
            <div class="column col-4">
                <?php get_template_part( 'sidebar' ); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>