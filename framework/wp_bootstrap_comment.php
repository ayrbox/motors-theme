<?php 
/**
 * ----------------------------------------------------------------------------------------
 * 12.0 - Bootstrap comment box
 * ----------------------------------------------------------------------------------------
 */
class BootstrapComment {



    public function form_fields( $fields ) {
        $commenter = wp_get_current_commenter();
        
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
        
        $fields   =  array(
            'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                        '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
            'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                        '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                        '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
        );
        
        return $fields;
    }



    public function comment_box( $args ) {
        $args['comment_field'] = '<div class="form-group comment-form-comment">
                <label for="comment">' . _x( 'Comment', 'noun' ) . '</label> 
                <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
            </div>';
        return $args;
    }


    public function comment_button() {
        echo '<button class="btn btn-default" type="submit">' . __( 'Submit' ) . '</button>';
    }


}

$bsComment = new BootstrapComment();
add_filter( 'comment_form_default_fields', array($bsComment, 'form_fields' ));
add_filter( 'comment_form_defaults', array($bsComment, 'comment_box' ));
add_action( 'comment_form', array($bsComment, 'comment_button' ));


?>