<div class="section pb-0">
    <div class="container">
        <div class="row">
            <div class="column col-12 text-center">
            	<h1 class="no-margin"><?php the_title(); ?></h1>
            	<span><?php the_content(); ?></span>
            </div>
        </div>

        <?php $fastwp_nord_images = get_post_meta( get_the_ID(), 'project_gallery', true );
        if( !empty( $fastwp_nord_images ) ) { ?>

        <div class="gallery magnific-popup" data-cols="2" data-margin="50" data-height="1" data-gallery="true">
            <?php foreach( $fastwp_nord_images as $fastwp_nord_image ) {
            if( !empty( $fastwp_nord_image['image'] ) ) {
                $fastwp_nord_height = get_post_meta( $fastwp_nord_image['attachment_id'], 'gallery_height', true );
                $fastwp_nord_width  = get_post_meta( $fastwp_nord_image['attachment_id'], 'gallery_width', true );
                echo '<div class="entry' . ( $fastwp_nord_height == 'h2' ? ' h2' : '' ) . ( $fastwp_nord_width == 'w2' ? ' w2' : '' ) . '">
                    	<a href="' . esc_url( $fastwp_nord_image['image'] ) . '" class="m-popup">
                    		<div class="entry-content" data-bg="' . esc_url( $fastwp_nord_image['image'] ) . '"></div>
                    	</a>
                    </div>';
                }
            } ?>
        </div>

        <?php } ?>

        <?php if( ( $fastwp_nord_post_nav = fastwp_nord_theme\main::single_post_navigation( true ) ) ) { ?>
        <div class="project-navigation clear">
            <div class="float-left nav prev">
                <?php if( isset( $fastwp_nord_post_nav['previous'] ) ) { ?>
                    <a class="prev page-numbers" href="<?php echo get_the_permalink( $fastwp_nord_post_nav['previous']['postID'] ); ?>"><div class="title"><span><?php esc_html_e( 'Prev Project', 'nord' ); ?></span><?php echo esc_html( $fastwp_nord_post_nav['previous']['title'] ); ?></div></a>
                <?php } ?>
            </div>
            <div class="float-right nav next">
                <?php if( isset( $fastwp_nord_post_nav['next'] ) ) { ?>
                    <a class="next page-numbers" href="<?php echo get_the_permalink( $fastwp_nord_post_nav['next']['postID'] ); ?>"><div class="title"><span><?php esc_html_e( 'Next Project', 'nord' ); ?></span><?php echo esc_html( $fastwp_nord_post_nav['next']['title'] ); ?></div></a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>