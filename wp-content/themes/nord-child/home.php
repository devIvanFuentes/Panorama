<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

/* Template Name: Custom Home */

get_header('custom');
the_post();

// $fastwp_nord_page_title = get_post_meta( get_the_ID(), 'portfolio_title', true );
// $fastwp_nord_page_subtitle = get_post_meta( get_the_ID(), 'portfolio_subtitle', true );

if( !empty( $fastwp_nord_page_title ) ) { ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="column col-6">
                <h1>HOLA MUNDO</h1>
            	<h1><?php echo esc_html( $fastwp_nord_page_title ); ?></h1>
            	<p class="lead"><?php echo esc_html( $fastwp_nord_page_subtitle ); ?></p>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- SECCION DE ABOUT -->
    
<section class="about">
        <div class="ed-container">
            <div class="ed-item s-100 lg-50">
                <h2 class="pnrm__description">
                    Somos una consultora<br>premiada que ofrece <br>soluciones de estrategia,<br>diseño, y producción.
                </h2>
            </div>  

            <div class="ed-item s-100 lg-50">
                <p>
                    Panorama es el balance entre un estudio creativo y una consultora de negocios.

                </p>
                <p>
                    Somos un grupo de profesionales de la industria de la comunicación y el marketing que combina diferentes áreas de expertise para crear trabajo interdisciplinario que cumpla objetivos cuantificables.

                </p>

                <p>
                    Conoce nuestro <a class="pnrm__link" href="#">trabajo</a>, <a class="pnrm__link" href="#">nuestro equipo</a>, o nuestra <a class="pnrm__link" href="#">forma de pensar</a>.
                </p>
            </div>
        </div>
    </section>

<!-- END SECCION ABOUT -->

<div class="section pt-0 pb-0">
    <div class="container">
        <?php if( class_exists( 'fastwp_nord_shortcodes\Portfolio' ) ) {
            $fastwp_nord_inc_posts = (array) get_post_meta( get_the_ID(), 'portfolio_items', true );
            $fastwp_nord_items  = array();
            if( empty( $fastwp_nord_ing_posts ) ) {
                array_walk( $fastwp_nord_inc_posts, function( $v, $k ) use ( &$fastwp_nord_items ) {
                    if( !empty( $v ) ) {
                        $fastwp_nord_items[$k] = '';
                    }
                } );
            }

            $fastwp_nord_items_pr   = get_post_meta( get_the_ID(), 'portfolio_items_per_row', true );

            echo fastwp_nord_shortcodes\Portfolio::shortcode(
                array(
                        'iposts'        => ( !empty( $fastwp_nord_items ) ? array_keys( $fastwp_nord_items ) : array() ),
                        'iposts_by_id'  => get_post_meta( get_the_ID(), 'portfolio_items_by_id', true ),
                        'items_per_row' => ( !empty( $fastwp_nord_items_pr ) ? (int) $fastwp_nord_items_pr : 4 ),
                        'style'         => get_post_meta( get_the_ID(), 'portfolio_style', true ),
                        'margin'        => get_post_meta( get_the_ID(), 'portfolio_margin', true )
                    )
            );
        } ?>
    </div>
</div>

<?php get_footer();