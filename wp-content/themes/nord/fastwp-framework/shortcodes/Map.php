<?php

namespace fastwp_nord_shortcodes;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class Map extends \fastwp_nord_core\main {

	function __construct() {
        self::add_new_shortcode( 'nord_map', array( __CLASS__, 'shortcode' ) );
	}

	public static function shortcode( $atts, $content ) {
        global $fastwp_nord_custom_js;
		extract( shortcode_atts(array(
            'title'         => '',
            'marker_content'=> '',
			'center'		=> '44.434596,26.080533',
            'pins'          => '',
			'map_style'		=> 'fastwp',
			'map_zoom'		=> 8,
			'map_izoom'		=> 12,
            'extra_class'   => ''
		), $atts ) );

        if( empty( $pins ) ) {
            return ;
        }

        $mapId = 'map' . rand( 1, 99999 );

        $pin_list = array();

        $pins = explode( ';', $pins );
        $title = explode( ';', $title );
        $marker_content = explode( ';', $marker_content );

        foreach( $pins as $k => $pin ) {
            $marker_pos = explode( ',', $pin );
    		$fastwp_nord_custom_js[$mapId]['gmap_marker_title'][]  = ( isset( $title[$k] ) ? esc_html( $title[$k] ) : '' );
    		$fastwp_nord_custom_js[$mapId]['gmap_marker_addrs'][]  = ( $marker_lat_lng = array_map( 'trim', $marker_pos ) );
    		$fastwp_nord_custom_js[$mapId]['gmap_marker_ct'][]     = ( isset( $marker_content[$k] ) ? esc_html( $marker_content[$k] ) : '' );
            $fastwp_nord_custom_js[$mapId]['gmap_marker'][] = get_template_directory_uri() . '/assets/img/map-marker.png';
            $pin_list[] = array( 'title' => ( isset( $title[$k] ) ? esc_html( $title[$k] ) : '' ),
                                 'lat' => $marker_lat_lng[0],
                                 'lng' => $marker_lat_lng[1]
                                );
        }

		$map_center_pos = explode( ',', $center );
		$fastwp_nord_custom_js[$mapId]['gmap_center']       = $center_lat_lng = array_map( 'trim', $map_center_pos );
		$fastwp_nord_custom_js[$mapId]['gmap_style']        = $map_style;
		$fastwp_nord_custom_js[$mapId]['gmap_zoom'] 		= $map_zoom;
		$fastwp_nord_custom_js[$mapId]['gmap_izoom'] 		= $map_izoom;

        return '<div class="map-container' . ( !empty( $extra_class ) ? ' ' . esc_attr( $extra_class ) : '' ) . '">
        <div class="fwp-map" data-mapId="' . esc_attr( $mapId ) . '"></div>
        </div>';
	}

}

?>