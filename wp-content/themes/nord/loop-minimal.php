<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

?>

<?php if( have_posts() ) {

    while( have_posts() ) {

    the_post(); ?>
    <article class="post<?php echo ( is_sticky() ? ' sticky-post' : '' ); ?>">
        <div class="row">
        	<div class="column col-6">
            <?php if( has_post_thumbnail() && !post_password_required() && !is_attachment() ) { ?>
        		<a href="<?php the_permalink(); ?>">
        			<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
        		</a>
            <?php } else { ?>
                &nbsp;
            <?php } ?>
        	</div>

        	<div class="column col-6">
        		<div class="post-content">
        			<h3 class="post-title">
        				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        			</h3>
        			<div class="entry-metas">
                        <div class="meta author"><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="link"><?php the_author(); ?></a></div>
                        <div class="meta category"><i class="fa fa-tag"></i> <?php fastwp_nord_theme\markup::the_category(); ?></div>
                        <?php if( ! (boolean) fastwp_nord_theme\utils::get_option( 'fwp_blog_date_meta' ) ) { ?>
                        <div class="meta date"><i class="fa fa-clock-o"></i> <b><?php echo get_the_date(); ?></b></div>
                        <?php } ?>
        			</div>

                    <div class="excerpt"><?php the_excerpt(); ?></div>

                    <a href="<?php the_permalink(); ?>" class="btn"><?php esc_html_e( 'Read more', 'nord' ); ?></a>
        		</div>
        	</div>
		</div>
    </article>

    <?php }

    wp_reset_postdata();

} else { ?>
   <div class="clearfix">
        <!-- article -->
        <article>
            <div class="gap-100"></div>
            <h2><?php _e( 'Sorry, nothing to display.', 'nord' ); ?></h2>
            <?php get_search_form(); ?>
        </article>
        <!-- /article -->
    </div>

<?php } ?>
