<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Top Class
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

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php comments_number( '0 Comments', '1 Comment', '% Comments' );?>
		</h3>


       <ol class="comment-list">

            <?php
                wp_list_comments( array(
                    'style'       => 'li',
                    'short_ping'  => true,
                    'callback' => 'jwtheme_comment',
                    'avatar_size' => 100
                ) );
            ?>
        </ol><!-- .comment-list -->


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'jwtheme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'jwtheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'jwtheme' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'jwtheme' ); ?></p>
		<?php endif; ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'jwtheme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'jwtheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'jwtheme' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>


	<?php //comment_form(); ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<input id="author" class="form-control" name="author" type="text" placeholder="Name" value="" size="30"' . $aria_req . '/>',
		'email'  => '<input id="email" class="form-control" name="email" type="email" placeholder="Email" value="" size="30"' . $aria_req . '/>',
		'url'  => '<input id="url" class="form-control" name="url" type="url" placeholder="URL" value="">'
		);

	$comments_args = array(
		'fields' =>  $fields,
		'id_form'          			=> 'commentform',
		'title_reply'       		=> __( 'Leave a Comment', 'jwtheme' ),
		'title_reply_to'    		=> __( 'Leave a Comment to %s', 'jwtheme' ),
		'cancel_reply_link' 		=> __( 'Cancel Comment', 'jwtheme' ),
		'label_submit'      		=> __( 'Post Comment', 'jwtheme' ),
		'comment_notes_before'      => '',
		'comment_notes_after' 		=> '',
		'comment_field'             => '<textarea id="comment" class="form-control" name="comment" placeholder="Comment" rows="8" required></textarea>',
		'label_submit'              => 'Post Comment'
		);
	ob_start();
	comment_form( $comments_args);
	//echo str_replace('id="commentform" class="comment-form"',ob_get_clean());
	echo str_replace('class="comment-form btn btn-sm btn-default full-width btn-effect"','class="comment-form row"',ob_get_clean());
	echo str_replace('class="form-submit btn btn-sm btn-default full-width btn-effect"','class="btn btn-sm btn-default full-width btn-effect"',ob_get_clean());	
	?>




</div><!-- #comments -->
