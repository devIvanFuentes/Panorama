<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

?>

<!-- sidebar -->
<div class="sidebar-widget">
    <?php if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'sidebar-1' ) ) ?>
</div>
<!-- /sidebar -->
