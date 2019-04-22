<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

if ( ( !comments_open() && !have_comments() ) || post_password_required() ) {
	return;
}

?>

<div class="post-comments">

<?php if( have_comments() ) { ?>

<h3><?php comments_number(); ?></h3>

<ul class="comments-list">
    <?php wp_list_comments( array( 'callback' => array( 'fastwp_nord_theme\filters', 'comment' ), 'end-callback' => array( 'fastwp_nord_theme\filters', 'comment_close_tag' ) ) ); ?>
</ul>

<?php if( get_comment_pages_count() ) { ?>

<div class="list-item">
    <?php if( get_previous_comments_link() ) { ?>
    <div class="float-left">
        <?php previous_comments_link( esc_html__( '&larr; Older Comments', 'nord' ) ); ?>
    </div>
    <?php } ?>
    <?php if( get_next_comments_link() ) { ?>
    <div class="float-right">
        <?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'nord' ) ); ?>
    </div>
    <?php } ?>
</div>

<?php } ?>

<?php } else if( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>

<div class="post__comments">
    <div class="comments-list">
        <p><?php esc_html_e( 'Comments are closed here.', 'nord' ); ?></p>
    </div>
</div>

<?php } ?>

<?php comment_form( fastwp_nord_theme\filters::comment_form_args() ); ?>

</div>