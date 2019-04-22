<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

/* Template Name: Contact Page Template */

get_header();
the_post();

$fastwp_nord_page_title = get_post_meta( get_the_ID(), 'contact_title', true );
$fastwp_nord_page_subtitle = get_post_meta( get_the_ID(), 'contact_subtitle', true );
$fastwp_nord_form = get_post_meta( get_the_ID(), 'contact_form', true );

if( !empty( $fastwp_nord_page_title ) ) { ?>
    <div class="section pt-50">
        <div class="container">
            <div class="row">
                <div class="column col-6">
                	<h1><?php echo esc_html( $fastwp_nord_page_title ); ?></h1>
                	<p class="lead"><?php echo esc_html( $fastwp_nord_page_subtitle ); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="main-content">
    <div class="container">
        <?php if( has_post_thumbnail() && !post_password_required() && !is_attachment() ) { ?>
        <div class="row">
            <div class="column col-12">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo esc_html( $fastwp_nord_page_title ); ?>" />
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="column col-6">
            	<?php the_content(); ?>
            </div>

            <?php if( !empty( $fastwp_nord_form ) ) { ?>
            <div class="column col-6">
            	<h5><?php esc_html_e( 'Send us a Message', 'nord' ); ?></h5>
            	<?php echo apply_filters( 'the_content', $fastwp_nord_form ); ?>
            </div>
            <?php } ?>
        </div>
        <?php $fastwp_nord_coordinates = get_post_meta( get_the_ID(), 'map_coordinates', true );
        if( !empty( $fastwp_nord_coordinates ) && class_exists( 'fastwp_nord_shortcodes\Map' ) ) {
            echo fastwp_nord_shortcodes\Map::shortcode( array( 'pins' => $fastwp_nord_coordinates, 'center' => get_post_meta( get_the_ID(), 'map_center', true ), 'title' => get_post_meta( get_the_ID(), 'marker_title', true ), 'marker_content' => get_post_meta( get_the_ID(), 'marker_content', true ) ), '' );
        } ?>
    </div>
</div>

<?php get_footer();