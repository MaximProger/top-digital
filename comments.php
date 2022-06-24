<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments my-4">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        ?>
        <h3 class="mb-5">Комментарии:</h3>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'walker'            => new Bootstrap_Walker_Comment(),
                    'max_depth'         => 2,
                    'style'             => 'ol',
                    'callback'          => null,
                    'end-callback'      => null,
                    'type'              => 'comment',
                    'reply_text'        => __('Ответить <i class="fa fa-reply"></i>'),
                    'per_page'          => 10,
                    'avatar_size'       => 80,
                    'reverse_top_level' => true,
                    'reverse_children'  => true,
                    'format'            => 'html5', // или xhtml, если HTML5 не поддерживается темой
                    'short_ping'        => true,    // С версии 3.6,
                    'echo'              => true,     // true или false
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'test-theme' ); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    $defaults = [
        'fields'               => [
            'author' => '
        <div class="col-lg-6">
            <div class="form-group mb-3">
			    <input id="author" name="author" type="text" size="30" class="form-control" placeholder="Имя" />
            </div>
        </div>',
            'email'  => '       
       <div class="col-lg-6">
            <div class="form-group mb-4">
			    <input id="email" name="email"  size="30" aria-describedby="email-notes" type="email" class="form-control" placeholder="Email" />
            </div>
        </div>',
            'cookies' => ''
        ],
        'comment_field'        => '
        <div class="col-lg-12">
            <div class="form-group mb-3">
		    <textarea id="comment" name="comment" cols="30" rows="6" class="form-control"  placeholder="Комментарий"  aria-required="true" required="required"></textarea>
            </div>
        </div>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_container'      => 'mt-5 mb-3',
        'class_form'           => 'row',
        'class_submit'         => 'submit',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a Reply' ),
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="mt-5 mb-2">',
        'title_reply_after'    => '</h3><p class="mb-4">Ваш E-mail защищен от спама</p>',
        'cancel_reply_before'  => ' <small>',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<div class="col-lg-12"><button type="submit" id="%2$s" class="btn btn-hero btn-circled">%4$s</button></div>',
        'submit_field'         => '%1$s %2$s',
        'format'               => 'xhtml',
    ];

    comment_form( $defaults );
    ?>

</div><!-- #comments -->