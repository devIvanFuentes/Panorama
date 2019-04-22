<div class="section pb-0">
    <div class="container">
        <div class="row">
            <?php $fastwp_nord_images = get_post_meta( get_the_ID(), 'project_gallery', true ); ?>
            <div class="column col-<?php echo ( !empty( $fastwp_nord_images ) ? 8 : 12 ); ?>">
                <?php $fastwp_nord_categories = get_the_terms( get_the_ID(), 'portfolio-category' );
                if( !empty( $fastwp_nord_categories ) ) {
                    $fastwp_nord_cats_arr = array();
                    foreach( $fastwp_nord_categories as $fastwp_nord_category ) {
                        $fastwp_nord_cats_arr[] = $fastwp_nord_category->name;
                    }
                    echo '<span class="project-categorie">' . implode( ', ', $fastwp_nord_cats_arr ) . '</span>';
                } ?>
            	<h1><?php the_title(); ?></h1>
            	<hr>
            	<?php the_content(); ?>
            </div>

            <?php
            $fastwp_nord_client = get_post_meta( get_the_ID(), 'project_client', true );
            $fastwp_nord_date   = get_post_meta( get_the_ID(), 'project_date', true );
            $fastwp_nord_role   = get_post_meta( get_the_ID(), 'project_role', true );
            $fastwp_nord_aurl   = get_post_meta( get_the_ID(), 'project_author_url', true );

            if( !empty( $fastwp_nord_client ) || !empty( $fastwp_nord_date ) || !empty( $fastwp_nord_role ) || !empty( $fastwp_nord_aurl ) ) { ?>

            <div class="column col-4">
                <?php echo '<h6>' . esc_html__( 'Project Info', 'nord' ) . '</h6>
            	<div class="project-info">';

                if( !empty( $fastwp_nord_client ) ) {
            		echo '<div class="project-info-item">
            			<span class="project-info-item-title">' . esc_html__( 'Client', 'nord' ) . '</span>
            			<p>' . esc_html( $fastwp_nord_client ) . '</p>
            		</div>';
                }
                if( !empty( $fastwp_nord_date ) ) {
            		echo '<div class="project-info-item">
            			<span class="project-info-item-title">' . esc_html__( 'Date', 'nord' ) . '</span>
            			<p>' . esc_html( $fastwp_nord_date ) . '</p>
            		</div>';
                }
                if( !empty( $fastwp_nord_date ) ) {
            		echo '<div class="project-info-item">
            			<span class="project-info-item-title">' . esc_html__( 'Role', 'nord' ) . '</span>
            			<p>' . esc_html( $fastwp_nord_role ) . '</p>
            		</div>';
                }
                if( !empty( $fastwp_nord_aurl ) ) {
                    $fastwp_nord_aurl = explode( '|', $fastwp_nord_aurl );
            		echo '<div class="project-info-item">
            			<span class="project-info-item-title">' . esc_html__( 'View site', 'nord' ) . '</span>
            			<p><a href="' . esc_url( $fastwp_nord_aurl[0] ) . '" class="link">' . ( isset( $fastwp_nord_aurl[1] ) ? esc_html( $fastwp_nord_aurl[1] ) : esc_html( $fastwp_nord_aurl[0] ) ) . '</a></p>
            		</div>';
                }
        	    echo '</div>'; ?>

                <?php if( function_exists( 'fastwp_nord_share_links' ) ) fastwp_nord_share_links( '<div class="gap-25"></div>' ); ?>
            </div>
            <?php } ?>
        </div>

        <?php if( !empty( $fastwp_nord_images ) ) {
        $fastwp_nord_gallery_images = array();
        foreach( $fastwp_nord_images as $fastwp_nord_image ) {
            if( isset( $fastwp_nord_image['image'] ) )
            $fastwp_nord_gallery_images[] = '<div class="column col-6">
                                                <a href="' . esc_url( $fastwp_nord_image['image'] ) . '">
                                                    <img src="' . esc_url( $fastwp_nord_image['image'] ) . '" alt="' . esc_attr( get_post_meta( $fastwp_nord_image['attachment_id'], '_wp_attachment_image_alt', true ) ) . '" />
                                                </a>
                                            </div>';
        }
        ?>
    	<div class="row magnific-popup" data-gallery="true">
            <?php echo implode( '', $fastwp_nord_gallery_images ); ?>
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