<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

?>

<footer class="section pt-100 footer">
    <div class="container">
        <div class="footer-bottom">
            <div class="copy float-left">
                <?php echo fastwp_nord_theme\utils::get_option( 'footer_copy' ); ?>
            </div>

            <?php $fastwp_nord_sp = fastwp_nord_theme\utils::get_option( 'footer_links' );
            if( is_array( $fastwp_nord_sp ) && !empty( $fastwp_nord_sp ) ) { ?>
            <ul class="social float-right">
                <?php foreach( $fastwp_nord_sp as $fastwp_nord_p ) {
                    $fastwp_nord_sp_exp = array_map( 'trim', explode( '|', $fastwp_nord_p ) );
                    if( isset( $fastwp_nord_sp_exp[0] ) && isset( $fastwp_nord_sp_exp[1] ) ) {
                        echo '<li><a href="' . esc_url( $fastwp_nord_sp_exp[1] ) . '"><i class="' . esc_attr( $fastwp_nord_sp_exp[0] ) . '"></i></a></li>';
                    }
                } ?>
            </ul>
            <?php } ?>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
