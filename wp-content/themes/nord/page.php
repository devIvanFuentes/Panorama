<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

?>

<?php get_header(); ?>

<div class="post">

    <?php if( have_posts() ) {

            while( have_posts() ) {

                the_post(); ?>

                <div class="container small">

                    <div class="row">
                        <div class="column col-6">
                        	<h1><?php the_title(); ?></h1>
                        </div>
                    </div>

        			<!-- article -->
        			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                		<div class="post-content-text content clearfix"><?php the_content(); ?></div>
                        <?php wp_link_pages(); ?>

        			</article>
        			<!-- /article -->

                </div>

				<?php if ( comments_open() ) {
				    echo '<div class="container mb-5">';
				    comments_template( '', true ); // Remove if you don't want comments
                    echo '</div>';
                } ?>

        	<?php } ?>

    <?php } else { ?>

    <div class="container small">

        <!-- article -->
        <article>

        <h2><?php esc_html_e( 'Sorry, nothing to display.', 'nord' ); ?></h2>

        </article>
        <!-- /article -->

    </div>

    <?php } ?>

</div>

<?php get_footer(); ?>