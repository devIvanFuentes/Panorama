<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

get_header();

// Start the loop.
while ( have_posts() ) :
the_post();

$fastwp_nord_sidebar = fastwp_nord_theme\utils::get_option( 'fwp_blog_sidebar' );

?>

<div class="section pb-0">
    <div class="container">
	    <div class="row">
            <?php if( $fastwp_nord_sidebar == 'left' ) { ?>
            <div class="column col-4">
                <?php get_template_part( 'sidebar' ); ?>
            </div>
            <?php } ?>
		    <div class="column col-<?php echo ( !empty( $fastwp_nord_sidebar ) && in_array( $fastwp_nord_sidebar, array( 'left', 'right' ) ) ? 8 : 12 ); ?>">

                <article class="post">
                    <?php if( has_post_thumbnail() && !post_password_required() && !is_attachment() ) { ?>
                    <div class="post-image">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                    </div>
                    <?php } ?>

                    <div class="post-content">
                        <h2 class="post-title">
                            <?php the_title(); ?>
                        </h2>
                        <div class="entry-metas">
                            <div class="meta author"><?php esc_html_e( 'By', 'nord' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="link"><?php the_author(); ?></a></div>
                            <div class="meta category"><?php esc_html_e( 'In', 'nord' ); ?> <?php fastwp_nord_theme\markup::the_category(); ?></div>
                            <?php if( ! (boolean) fastwp_nord_theme\utils::get_option( 'fwp_blog_date_meta' ) ) { ?>
                            <div class="meta date"><?php esc_html_e( 'Date', 'nord' ); ?> <b><?php echo get_the_date(); ?></b></div>
                            <?php } ?>
                        </div>
                        <hr>

                        <div class="content clearfix"><?php the_content(); ?></div>

                        <?php $fastwp_nord_tags = get_the_tags();
                        if( $fastwp_nord_tags ) {
                            echo '<div class="gap-25"></div>
                            <div class="widget tags">
                            ' . esc_html__( 'Tags: ', 'nord' ) . '
                            <ul class="tags">';
                            foreach( $fastwp_nord_tags as $fastwp_nord_tag ) {
                                echo '<li><a href="' . esc_url( get_tag_link( $fastwp_nord_tag->term_id ) ) . '">' . $fastwp_nord_tag->name . '</a></li>';
                            }
                            echo '</ul>
                            </div>';
                        } ?>

                        <?php wp_link_pages(); ?>

                        <?php if( function_exists( 'fastwp_nord_share_links' ) ) fastwp_nord_share_links( '<div class="gap-25"></div>' ); ?>
                    </div>

                    <?php if( ( $fastwp_nord_post_nav = fastwp_nord_theme\main::single_post_navigation( true ) ) ) { ?>
                    <div class="project-navigation clear">
                        <div class="float-left nav prev">
                            <?php if( isset( $fastwp_nord_post_nav['previous'] ) ) { ?>
                                <a class="prev page-numbers" href="<?php echo get_the_permalink( $fastwp_nord_post_nav['previous']['postID'] ); ?>"><div class="title"><span><?php esc_html_e( 'Prev Post', 'nord' ); ?></span><?php echo apply_filters( 'the_title', $fastwp_nord_post_nav['previous']['title'] ); ?></div></a>
                            <?php } ?>
                        </div>
                        <div class="float-right nav next">
                            <?php if( isset( $fastwp_nord_post_nav['next'] ) ) { ?>
                                <a class="next page-numbers" href="<?php echo get_the_permalink( $fastwp_nord_post_nav['next']['postID'] ); ?>"><div class="title"><span><?php esc_html_e( 'Next Post', 'nord' ); ?></span><?php echo apply_filters( 'the_title', $fastwp_nord_post_nav['next']['title'] ); ?></div></a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- comments -->
                    <?php comments_template( '', true ); ?>
                    <!-- /comments -->
                </article>

            </div>
            <?php if( $fastwp_nord_sidebar == 'right' ) { ?>
            <div class="column col-4">
                <?php get_template_part( 'sidebar' ); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php endwhile;

get_footer(); ?>
