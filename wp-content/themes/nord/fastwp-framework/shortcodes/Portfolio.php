<?php

namespace fastwp_nord_shortcodes;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class Portfolio extends \fastwp_nord_core\main {

	function __construct() {
        self::add_new_shortcode( 'nord_portfolio', array( __CLASS__, 'shortcode' ) );
	}

    public static function get_terms() {
        $get_terms = get_terms( array(
            'taxonomy'  => 'portfolio-category',
            'hide_empty'=> false,
        ) );

        $terms = array();

        foreach( $get_terms as $term ) {
            $terms[$term->term_id] = array( 'name' => $term->name, 'slug' => $term->slug );
        }

        return $terms;
    }

    protected static function get_terms_with_name() {
        $get_terms = get_terms( array(
            'taxonomy'  => 'portfolio-category',
            'hide_empty'=> false,
        ) );

        $terms = array();

        foreach( $get_terms as $term ) {
            $terms[$term->name] = $term->term_id;
        }

        return $terms;
    }

    protected static function get_terms_with_slug() {
        $get_terms = get_terms( array(
            'taxonomy'  => 'portfolio-category',
            'hide_empty'=> false,
        ) );

        $terms = array();

        foreach( $get_terms as $term ) {
            $terms[$term->name] = $term->slug;
        }

        return $terms;
    }

    protected static function all_post_categories( $array = false, $before = '', $after = '', $separator = ' / ' ) {
        $terms = get_the_terms( get_the_ID(), 'portfolio-category' );

        if( !isset( $terms->errors ) && !empty( $terms ) ) {
            $items = array();

            foreach( $terms as $term ) {
                $items[$term->term_id] = array( 'name' => $term->name, 'slug' => $term->slug );
            }

            if( $array ) {
                return $items;
            }

            $markup = $before;
            $markup .= implode( $separator, array_keys( $items ) );
            $markup .= $after;

            return $markup;
        }

        return ( $array ? array() : '' );
    }

    public static function all_posts() {
        $query_options = array(
                                'post_type'         => 'fwp_portfolio',
                                'posts_per_page'    => -1
                            );

        $loop = new \WP_Query( $query_options );

        $posts = array();

        if( $loop->have_posts() ) {
            while ( $loop->have_posts() ) {
                $loop->the_post();
                $posts[get_the_ID()] = get_the_title();
            }
        }

        return $posts;
    }

    protected function all_posts_with_img() {
        $query_options = array(
                                'post_type'         => 'fwp_portfolio',
                                'posts_per_page'    => -1
                            );

        $loop = new \WP_Query( $query_options );

        $posts = array();

        if( $loop->have_posts() ) {
            while ( $loop->have_posts() ) {
                $loop->the_post();
                $posts['<img src="' . esc_url( get_the_post_thumbnail_url() ) . '" title="' . esc_attr( get_the_title() ) . '" alt="' . esc_attr( get_the_title() ) . '" />'] = get_the_ID();
            }
        }

        return $posts;
    }

	public static function shortcode( $atts = array(), $content = '' ) {
        extract( shortcode_atts( array(
            'iposts'        => array(),
            'iposts_by_id'  => '',
            'icategories'   => array(),
            'eposts'        => array(),
            'ecategories'   => array(),
            'style'         => '',
            'items_per_row' => 2,
            'margin'        => 60,
            'show_filters'  => true,
            'extra_class'   => ''
        ), $atts ) );

        $class = array();

        if( !empty( $extra_class ) ) {
            $class[] = $extra_class;
        }

        $query_options = array(
                                'post_type'         => 'fwp_portfolio',
                                'posts_per_page'    => -1,
                    			'suppress_filters'  => true
                            );

        if( !empty( $iposts ) ) {
            $query_options['post__in']  = ( gettype( $iposts ) == 'array' ? $iposts : explode( ',', $iposts ) );
        }

        if( !empty( $iposts_by_id ) ) {
            $query_options['post__in']  = array_filter( explode( ',', $iposts_by_id ) );
            $query_options['orderby']   = 'post__in';
        }

        if( !empty( $eposts ) ) {
            $query_options['post__not_in'] = ( gettype( $eposts ) == 'array' ? $eposts : explode( ',', $eposts ) );
        }

        if( !empty( $icategories ) ) {
            $query_options['tax_query']                 = array();
            $query_options['tax_query'][0]['taxonomy']  = 'portfolio-category';
            $query_options['tax_query'][0]['field']     = 'term_id';
            $query_options['tax_query'][0]['terms']     = ( gettype( $icategories ) == 'array' ? $icategories : explode( ',', $icategories ) );
            $query_options['tax_query'][0]['operator']  = 'IN';
        } else if( !empty( $ecategories ) ) {
            $query_options['tax_query']                 = array();
            $query_options['tax_query'][0]['taxonomy']  = 'portfolio-category';
            $query_options['tax_query'][0]['field']     = 'term_id';
            $query_options['tax_query'][0]['terms']     = ( gettype( $ecategories ) == 'array' ? $ecategories : explode( ',', $ecategories ) );
            $query_options['tax_query'][0]['operator']  = 'NOT IN';
        }

        $loop = new \WP_Query( $query_options );

        $markup = '<div' . ( !empty( $class ) ? ' class="' . esc_attr( implode( ' ', $class ) ) . '"' : '' ) . '>';

        $gallery_style = array();

        if( $loop->have_posts() ) {

            $gallery_atts = '';

            if( $style == 'masonry' || $style == 'grid' || $style == 'gallery' ) {
                $gallery_atts .= ' data-height="auto"';
            } else {
                $gallery_atts .= ' data-height="1"';
            }

            if( $style == 'gallery' ) {
                $gallery_style[] = 'magnific-popup';
            }

            if( $show_filters ) {

                $terms = self::get_terms_with_slug();
                if( !empty( $terms ) ) {
                    $markup .= '<ul class="filters">
    				<li data-filter="*" class="active">' . esc_html__( 'Show All', 'nord' ) . '</li>';
                    foreach( $terms as $term_name => $term_id ) {
                        $markup .= '<li data-filter=".' . $term_id . '">' . $term_name . '</li>';
                    }
    			    $markup .= '</ul>';
                }

            }

		    $markup .= '<div class="gallery' . ( !empty( $gallery_style ) ? ' ' . esc_attr( implode( ' ', $gallery_style ) ) : '' ) . '" data-cols="' . ( in_array( $items_per_row, array( 2, 3, 4 ) ) ? $items_per_row : 2 ) . '" data-margin="' . ( (int) $margin >= 0 && (int) $margin <= 100 ? $margin : 60 ) . '"' . $gallery_atts . '>';
            while ( $loop->have_posts() ) {
                $loop->the_post();

                $categories = self::all_post_categories( true );

                $slug   = $cats = array();

                foreach( $categories as $cat_id => $cat ) {
                    $slug[] = $cat['slug'];
                    $cats[] = $cat['name'];
                }

                if( $style == 'metro' ) {

                    $width  = get_post_meta( get_the_ID(), 'portfolio_image_width', true );
                    $height = get_post_meta( get_the_ID(), 'portfolio_image_height', true );

                    if( in_array( $width, array( 'w2', 'fw' ) ) ) {
                        $slug[] = $width;
                    }

                    if( in_array( $height, array( 'h2', 'fh' ) ) ) {
                        $slug[] = $height;
                    }

                    $markup .= '<div class="entry work-entry' . ( !empty( $slug ) ? ' ' . implode( ' ', $slug ) : '' ) . '">
                					<a href="' . esc_url( get_the_permalink() ) . '">
                						<div class="entry-content" data-bg="' . esc_url( get_the_post_thumbnail_url() ) . '">
                							<div class="overlay overlay-light hidden" data-overlay="10" data-pos="center">
                								<div class="overlay-content text-center">
                									<h5 class="title">' . get_the_title() . '</h5>
                                                    ' . ( !empty( $cats ) ? '<span class="cat">' . implode( ' ', $cats ) . '</span>' : '' ) . '
                								</div>
                							</div>
                						</div>
                					</a>
                				</div>';

                } else if( $style == 'grid' ) {

                    $markup .= '<div class="entry work-entry' . ( !empty( $slug ) ? ' ' . implode( ' ', $slug ) : '' ) . '">
                					<img src="' . esc_url( get_the_post_thumbnail_url() ) . '" alt="' . esc_attr( get_the_title() ) . '" />
                					<a href="' . esc_url( get_the_permalink() ) . '">
                						<div class="overlay hidden" data-overlay="9" data-pos="center">
                							<div class="overlay-content text-center light-content">
                								<h5 class="title">' . get_the_title() . '</h5>
   									            ' . ( !empty( $cats ) ? '<span class="cat">' . implode( ' ', $cats ) . '</span>' : '' ) . '
                							</div>
                						</div>
                					</a>
                				</div>';

                } else if( $style == 'gallery' ) {

                    $markup .= '<div class="entry work-entry' . ( !empty( $slug ) ? ' ' . implode( ' ', $slug ) : '' ) . '">
                					<img src="' . esc_url( get_the_post_thumbnail_url() ) . '" alt="' . esc_attr( get_the_title() ) . '" />
                					<a href="' . esc_url( get_the_post_thumbnail_url() ) . '">
                						<div class="overlay hidden" data-overlay="9" data-pos="center">
                							<div class="overlay-content text-center light-content">
                								<h5 class="title">' . get_the_title() . '</h5>
   									            ' . ( !empty( $cats ) ? '<span class="cat">' . implode( ' ', $cats ) . '</span>' : '' ) . '
                							</div>
                						</div>
                					</a>
                				</div>';

                } else {

                    $markup .= '<div class="entry work-entry' . ( !empty( $slug ) ? ' ' . implode( ' ', $slug ) : '' ) . '">
                					<img src="' . esc_url( get_the_post_thumbnail_url() ) . '" alt="' . esc_attr( get_the_title() ) . '" />
                					<a href="' . esc_url( get_the_permalink() ) . '">
                						<div class="overlay overlay-light hidden" data-overlay="9" data-pos="center">
                							<div class="overlay-content text-center">
                								<h5 class="title">' . get_the_title() . '</h5>
   									            ' . ( !empty( $cats ) ? '<span class="cat">' . implode( ' ', $cats ) . '</span>' : '' ) . '
                							</div>
                						</div>
                					</a>
                				</div>';

                }

            }

            wp_reset_query();

        }

        $markup .= '</div>
        </div>';

        return $markup;
    }

}

?>