<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

get_header();
the_post();

switch( (int) get_post_meta( get_the_ID(), 'portfolio_template', true ) ) {
    case 2:
        include FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/theme/portfolio-templates/template_2.php';
    break;
    case 3:
        include FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/theme/portfolio-templates/template_3.php';
    break;
    case 4:
        include FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/theme/portfolio-templates/template_4.php';
    break;
    case 5:
        include FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/theme/portfolio-templates/template_5.php';
    break;
    case 6:
        include FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/theme/portfolio-templates/template_6.php';
    break;
    default:
        include FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/theme/portfolio-templates/template_default.php';
    break;
}

get_footer(); ?>