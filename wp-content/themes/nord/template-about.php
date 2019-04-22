<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

/* Template Name: About Page Template */

get_header();
the_post();

$fastwp_nord_page_title = get_post_meta( get_the_ID(), 'about_title', true );
$fastwp_nord_page_subtitle = get_post_meta( get_the_ID(), 'about_subtitle', true );
$fastwp_nord_content_title = get_post_meta( get_the_ID(), 'about_contenttitle', true );

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

    <?php if( has_post_thumbnail() ) { ?>
    <div class="row">
        <div class="column col-12">
        	<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_html( $fastwp_nord_page_title ); ?>" />
        </div>
    </div>
    <?php } ?>

    <div class="row">
        <div class="column col-6">
        	<h3><?php echo esc_html( $fastwp_nord_content_title ); ?></h3>
        </div>

        <div class="column col-6">
        	<?php the_content(); ?>
        </div>
    </div>

    </div>
</div>

<?php get_footer();