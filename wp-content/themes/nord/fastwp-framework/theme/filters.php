<?php

// FastWP Framework - filters

namespace fastwp_nord_theme;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct script access denied.' );
}

class filters extends \fastwp_nord_core\main {

    /* Custom search form */

    public static function search_form() {
        return '<div class="widget widget__search">
        			<div class="widget__content">
        				<form method="get" action="' . esc_url( home_url( '/' ) ) . '">
        					<div class="form-group">
        						<input name="s" placeholder="' . esc_attr__( 'Type &amp; Hit Enter', 'nord' ) . '" type="search">
        					</div>
        				</form>
        			</div>
        		</div>';
    }

    /* Footer content */

    public static function footer_content() {
		global $fastwp_nord_custom_js;
        if( !empty( $fastwp_nord_custom_js ) ) {
		    wp_localize_script( 'custom', 'fastwp', $fastwp_nord_custom_js );
        }
        if( \fastwp_nord_theme\utils::get_option( 'fwp_custom_js' ) != '' ) {
            echo '<script>';
            echo \fastwp_nord_theme\utils::get_option( 'fwp_custom_js' );
            echo '</script>';
        }
    }

    /* Comment form */

    public static function comment_form_args() {
        global $user_identity;

        $commenter  = wp_get_current_commenter();
        $req        = get_option( 'require_name_email' );
        $aria_req   = ( $req ? " aria-required='true'" : '' );

        $args = array(
            'id_form'           => 'commentform',
            'class_form'        => '',
            'id_submit'         => 'submit',
            'class_submit'      => 'button mb-0',
            'name_submit'       => 'submit',
            'title_reply'       => '<strong>' . esc_html__( 'Leave a Reply', 'nord' ) . '</strong>',
            'title_reply_to'    => '<strong>' . esc_html__( 'Leave a Reply to %s', 'nord' ) . '</strong>',
            'cancel_reply_link' => esc_html__( 'Cancel Reply', 'nord' ),
            'label_submit'      => esc_html__( 'Post Comment', 'nord' ),
            'format'            => 'xhtml',

            'comment_field'     => '<div class="form-group">
                                        <textarea name="comment" id="comment" placeholder="' . esc_attr__( 'Your Comment', 'nord' ) . '"></textarea>
                                    </div>',

            'must_log_in'       => '<div class="form-group">
                                        <p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'nord' ), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) ) . '</p>
                                    </div>',

            'logged_in_as'      => '<div class="form-group">
                                        <p class="logged-in-as">' .
                                            sprintf(
                                            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'nord' ),
                                              admin_url( 'profile.php' ),
                                              $user_identity,
                                              esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) )
                                            ) . '
                                        </p>
                                    </div>',

            'comment_notes_before'
                                => '<div class="form-group">
                                        <p class="small mb-5">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'nord' ) . '</p>
                                    </div>',

             'submit_button'    => '<div class="form-group">
                                        <input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />
                                    </div>',

            'fields'        => array(
                                    'author' =>
                                    '<div class="form-group">
                                        <input name="author" id="author" placeholder="' . esc_attr__( 'Your Name', 'nord' ) . ( $req ? '*' : '' ) . '" type="text"' . $aria_req . ' />
                                    </div>',

                                    'email' =>
                                    '<div class="form-group">
                                        <input name="email" id="email" placeholder="' . esc_attr__( 'Email', 'nord' ) . ( $req ? '*' : '' ) . '" type="email"' . $aria_req . ' />
                                    </div>',

                                    'url' =>
                                    '<div class="form-group">
                                        <input name="url" id="url" placeholder="' . esc_attr__( 'URL', 'nord' ) . '" type="text" />
                                    </div>'
                                    )
        );

        return $args;
    }

    /* Reply link filter */

    public static function comment_reply_link( $link ) {
        return str_replace( 'comment-reply-link', 'reply comment-reply-link', $link );
    }

    /* Markup before comment form */

    public static function before_comment_form() {
        echo '<div class="post__comments__form">';
    }

    /* Markup after comment form */

    public static function after_comment_form() {
        echo '</div>';
    }

    /* Comment */

    public static function comment( $comment, $args, $depth ) {
        switch ( $comment->comment_type ) {

        case 'pingback':
        case 'trackback': ?>

        <li class="pingback-comment"><p><?php esc_html_e( 'Pingback:', 'nord' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'nord' ), ' / <i class="edit-link">', '</i>' ); ?></p>

        <?php break;
        default: ?>

        <li class="comment content">
        	<div class="comment-user">
        		<img src="<?php echo get_avatar_url( get_comment_author_email() ); ?>" alt="<?php echo esc_attr( get_comment_author() ); ?>">
        	</div>
        	<div class="comment-content">
        		<div class="name"><h5><?php echo get_comment_author(); ?></h5></div>
        		<div class="date"><?php echo get_comment_date(); ?></div>
        		<p class="comment-text"><?php comment_text(); ?></p>
        		<?php echo str_replace( 'comment-reply-link', 'comment-reply-link link', get_comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'nord' ), 'before'=> '', 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ); ?>
        	</div>

    <?php break;
        }
    }

    /* Comment close tag */

    public static function comment_close_tag( $post = 0 ) { ?>
        </li>
    <?php }

    public static function save_attachment_location( $attachment_id ) {
        if ( isset( $_REQUEST['attachments'][$attachment_id]['gallery_height'] ) ) {
            $location = $_REQUEST['attachments'][$attachment_id]['gallery_height'];
            update_post_meta( $attachment_id, 'gallery_height', $location );
        }
        if ( isset( $_REQUEST['attachments'][$attachment_id]['gallery_width'] ) ) {
            $location = $_REQUEST['attachments'][$attachment_id]['gallery_width'];
            update_post_meta( $attachment_id, 'gallery_width', $location );
        }
    }

    public static function image_attachment_fields_to_edit( $form_fields, $post ) {
        $def_height = get_post_meta( $post->ID, 'gallery_height', true );
        $def_width  = get_post_meta( $post->ID, 'gallery_width', true );

        $form_fields["gallery_height"] = array(
            'label' =>  esc_html__( 'Portfolio Template Height', 'nord' ),
            'input' =>  'html',
            'html'  =>  '<select name="attachments[' . $post->ID . '][gallery_height]">
                            <option value=""' . ( !in_array( $def_height, array( 'h2' ) ) ? ' selected' : '' ) . '>' . esc_html__( 'Default', 'nord' ) . '</option>
                            <option value="h2"' . ( $def_height == 'h2' ? ' selected' : '' ) . '>' . esc_html__( 'Tall', 'nord' ) . '</option>
                        </select>',
            'value' =>  $def_height
        );

        $form_fields["gallery_width"] = array(
            'label' =>  esc_html__( 'Portfolio Template Width', 'nord' ),
            'input' =>  'html',
            'html'  =>  '<select name="attachments[' . $post->ID . '][gallery_width]">
                            <option value=""' . ( !in_array( $def_width, array( 'w2' ) ) ? ' selected' : '' ) . '>' . esc_html__( 'Default', 'nord' ) . '</option>
                            <option value="w2"' . ( $def_width == 'w2' ? ' selected' : '' ) . '>' . esc_html__( 'Wide', 'nord' ) . '</option>
                        </select>',
            'value' =>  $def_width
        );

       return $form_fields;
    }

}

add_filter( 'get_search_form', array( 'fastwp_nord_theme\filters', 'search_form' ), 10 );
add_action( 'wp_footer', array( 'fastwp_nord_theme\filters', 'footer_content' ), 10 );
add_filter( 'comment_form_before', array( 'fastwp_nord_theme\filters', 'before_comment_form' ), 10 );
add_filter( 'comment_form_after', array( 'fastwp_nord_theme\filters', 'after_comment_form' ), 10 );
add_filter( 'comment_reply_link', array( 'fastwp_nord_theme\filters', 'comment_reply_link' ), 10 );
add_action( 'edit_attachment', array( 'fastwp_nord_theme\filters', 'save_attachment_location' ) );
add_filter( 'attachment_fields_to_edit', array( 'fastwp_nord_theme\filters', 'image_attachment_fields_to_edit' ), null, 2);