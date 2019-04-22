<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

/* Template Name: Normal Page Template */

get_header();
the_post();

echo '<div class="page__body">

<div class="container">';

the_content();
wp_link_pages();

echo '</div>

</div>';

get_footer();