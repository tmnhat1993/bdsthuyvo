<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Top Class
 */

if ( ! function_exists( 'jwtheme_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function jwtheme_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'jwtheme' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'jwtheme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'jwtheme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'jwtheme_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function jwtheme_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'jwtheme' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) {
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'jwtheme' ) );
			}
			else { ?>
				<div class="prev">
					<?php previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span><span class="nav-icon"><i class="fa fa-angle-double-left"></i></span>%title', 'jwtheme' ) );	?>
				</div>
				<div class="next"> 
					<?php next_post_link( '%link', __( '<span class="meta-nav">Next Post</span><span class="nav-icon"><i class="fa fa-angle-double-right"></i></span>%title', 'jwtheme' ) );?>
				</div>
			<?php } ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	
	<?php
}
endif;

if ( ! function_exists( 'jwtheme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function jwtheme_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'jwtheme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'jwtheme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'jwtheme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jwtheme_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'jwtheme' ) );
		if ( $categories_list && jwtheme_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'jwtheme' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'jwtheme' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tag"></i>' . __( ' %1$s', 'jwtheme' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '  <span class="comments-link">  <i class="fa fa-comment-o"></i>';
		comments_popup_link( __( ' Leave a comment', 'jwtheme' ), __( '1 Comment', 'jwtheme' ), __( '% Comments', 'jwtheme' ) );
		echo '</span>';
	}

	edit_post_link( __( ' Edit', 'jwtheme' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function jwtheme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'jwtheme_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'jwtheme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so jwtheme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so jwtheme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in jwtheme_categorized_blog.
 */
function jwtheme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'jwtheme_categories' );
}
add_action( 'edit_category', 'jwtheme_category_transient_flusher' );
add_action( 'save_post',     'jwtheme_category_transient_flusher' );


/*-------------------------------------------------------
 *				Top Class Comments
 *-------------------------------------------------------*/

if(!function_exists('jwtheme_comment')):

	function jwtheme_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
			// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'jwtheme' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
		break;
		default :

		global $post;
		?>

		<li class="comment parent" id="li-comment-<?php comment_ID(); ?>">

			<div id="submited-commnet" class="comment">
				<ol class="commentlist children">
					<li  class="comment">

						<article class="comment-body">
							<div class="comment-meta">
								<div class="comment-author vcard">
									<?php echo get_avatar( $comment, 100 ); ?>
								</div><!-- /.comment-author -->
							</div><!-- /.comment-meta -->

							<div class="comment-metadata">
								<?php printf( '<h5 class="comment-author">%1$s</h5>', get_comment_author_link()); ?>

								
								<time datetime="<?php the_time( 'c' ); ?>"> at <?php echo get_comment_time()?></time>

								<span class="reply pull-right">
									<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'jwtheme' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
								</span><!-- /.reply -->
							</div><!-- /.comment-metadata -->

							<div class="comment-content">
								<?php comment_text(); ?>
							</div><!-- .comment-content -->

							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jwtheme' ); ?></p>
							<?php endif; ?>

						</article><!-- /.comment-body -->


					</li>
				</ol>
					<?php //echo jwtheme_post_nav();?>
			</div>


			<?php
			break;
			endswitch; 
		}

		endif;

if ( ! function_exists( 'topclass_social' ) ){
function topclass_social() { ?>

	<div class="social-share pull-right">
			<span>Share:</span>
			<a href="https://twitter.com/home?status=<?php the_permalink();?>" class="twitter-btn"><i class="fa fa-twitter"></i></a>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" class="facebook-btn"><i class="fa fa-facebook"></i></a> 
			<a href="https://pinterest.com/pin/create/button/?url=&amp;media=&amp;description=<?php the_permalink();?>" class="pinterest-btn"><i class="fa fa-pinterest"></i></a>
			<a href="https://plus.google.com/share?url=<?php the_permalink();?>" class="google-plus-btn"><i class="fa fa-google-plus"></i></a> 
	</div>	

<?php } }
	








// Demo Import Options
function topclass_import_files() {
    return array(

        array(
            'import_file_name'           => 'Home',
            'categories'                 => array( 'Home Variations' ),
            'import_file_url'            => get_template_directory_uri() . '/inc/demo-importer/contents/demo-content.xml',
            'import_widget_file_url'     => get_template_directory_uri() . '/inc/demo-importer/contents/widgets.json',
            //'import_customizer_file_url' => get_template_directory_uri() . '/inc/demo-importer/contents/customizer.dat',
            'import_redux'               => array(
                array(
                    'file_url'    => get_template_directory_uri() . '/inc/demo-importer/contents/theme_options.json',
                    'option_name' => 'jwtheme_topclass',
                ),
            ),
            'import_preview_image_url'   => get_template_directory_uri() . '/inc/demo-importer/images/home-1.png',
            'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'jwtheme' ),
        ),





    );
}
add_filter( 'pt-ocdi/import_files', 'topclass_import_files' );


function topclass_after_import_setup() {
    // Assign menus to their locations.
    $top_menu     = get_term_by( 'name', 'Home Page Menu', 'nav_menu' );
    $sidebar_menu = get_term_by( 'name', 'Blog Menu', 'nav_menu' );


    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $top_menu->term_id,
            'secondary' => $sidebar_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'topclass_after_import_setup' );



function topclass_before_widgets_import( $selected_import ) {
    echo "Add your code here that will be executed before the widgets get imported!";
}
add_action( 'pt-ocdi/before_widgets_import', 'topclass_before_widgets_import' );


function topclass_plugin_intro_text( $default_text ) {
    $default_text .= '<div class="ocdi__intro-text"><strong>Demo Importing will take few minutes depending on your Hosting Server.</strong></div><br>';

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'topclass_plugin_intro_text' );


add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );


function topclass_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'jwtheme' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'jwtheme' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'topclass_plugin_page_setup' );


function topclass_confirmation_dialog_options ( $options ) {
    return array_merge( $options, array(
        'width'       => 300,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ) );
}
add_filter( 'pt-ocdi/confirmation_dialog_options', 'topclass_confirmation_dialog_options', 10, 1 );	