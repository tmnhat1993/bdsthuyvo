<?php
/**
 * Top Class functions and definitions
 *
 * @package Top Class
 */

global $jwtheme_topclass;
if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/ReduxFramework/ReduxCore/framework.php')) {
    require_once(dirname(__FILE__) . '/ReduxFramework/ReduxCore/framework.php');
}
if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/ReduxFramework/admin.php')) {
    require_once(dirname(__FILE__) . '/ReduxFramework/admin.php');
}




// MCE Buttons
require_once( get_template_directory()  . '/lib/shortcodes/tinymce.button.php');

// Shortcodes
require_once( get_template_directory()  . '/lib/shortcodes.php');


// One Click Demo Importer
require_once( get_template_directory() . '/inc/demo-importer/one-click-demo-import.php' );



define('JWTOPCLASS', wp_get_theme()->get( 'Name' ));

define('JWCSS', get_template_directory_uri().'/assets/css/');

define('JWJS', get_template_directory_uri().'/assets/js/');


// Re Define Meta Box 

define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/lib/meta-box' ) );

define( 'RWMB_DIR', trailingslashit(  get_stylesheet_directory() . '/lib/meta-box' ) );

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

require_once (get_template_directory().'/lib/metabox.php');

//Biz Theme Widgets
require_once( get_template_directory()  . '/lib/widgets.php');

require_once( get_template_directory()  . '/lib/woo-setup.php');


if ( ! function_exists( 'jwtheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jwtheme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Top Class, use a find and replace
	 * to change 'jwtheme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'jwtheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'blog-thumb', '750', '260', true );

	add_image_size( 'team-thumb', '250', '325', true );

	add_image_size( 'gallery-thumb', '750', '260', true );

	add_image_size( 'portfolio-thumb', '390', '260', true );

	add_image_size( 'portfolio-gallery', '750', '535', true );

	add_image_size( 'client-logo', "206", "999", false);

	add_image_size( 'home-blog-thumb', "336", "999");

	add_image_size( 'products', "400", "300");

	add_theme_support( 'html5', array( 'search-form' ) );

	add_theme_support('widget-customizer');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Home Page Menu', 'jwtheme' ),
		'secondary' => __( 'Blog Menu', 'jwtheme' ),
		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('aside','audio','chat','gallery','image','link','quote','status','video') );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'jwtheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		) ) );

	add_editor_style('');

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	update_option('jwtheme_sections', jwtheme_get_enabled_sections());

}
endif; // jwtheme_setup
add_action( 'after_setup_theme', 'jwtheme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function jwtheme_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Right Sidebar', 'jwtheme' ),
			'id'            => 'blog-sidebar',
			'description'   =>  __( 'Default Blog sidebar.', 'jwtheme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			)
		);

		register_sidebar( array(
			'name'          => __( 'Forum Sidebar', 'jwtheme' ),
			'id'            => 'forum-sidebar',
			'description'   =>  __( 'Forum sidebar.', 'jwtheme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			)
		);

		register_sidebar( array(
			'name'          => __( 'Footer Sidebar', 'jwtheme' ),
			'id'            => 'footer-sidebar',
			'description'   =>  __( 'Footer sidebar.', 'jwtheme' ),
			'before_widget' => '<div id="%1$s" class="col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			)
		);


}
add_action( 'widgets_init', 'jwtheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jwtheme_scripts() {

	if (!is_admin()){

	global $jwtheme_topclass;
	wp_enqueue_style( 'jwtheme-style', get_stylesheet_uri() );
	wp_enqueue_script("jquery");

	if(!isset($jwtheme_topclass['jwtheme_color'])) $jwtheme_topclass['jwtheme_color']=0;
    switch($jwtheme_topclass['jwtheme_color']){
                    case 1: //Default
                    $jwtheme_topclass_color = "#1fb5ac";
                    break;
                    case 2: //Green
                    $jwtheme_topclass_color = "#1fb538";
                    break;
                    case 3: //Dark Green
                    $jwtheme_topclass_color = "#8e44ad";
                    break;
                    case 4: //Violet
                    $jwtheme_topclass_color = "#e12444";
                    break;
                    case 5: //Red
                    $jwtheme_topclass_color = "#f39c12";
                    break;
                    case 6: //turquoise
                    $jwtheme_topclass_color = $jwtheme_topclass['jwtheme_custom_color'];
                    break;
                    default:
                    $jwtheme_topclass_color = "#1fb5ac";
                    break;
                }

	if(is_admin()){
		wp_enqueue_style( 'dashicons' );	
	}

	if (is_page() && basename(get_page_template()) == "landing-page.php") {

	    	//Landing Page

	    	wp_enqueue_style( 'bootstrap', JWCSS . 'bootstrap.min.css');
	    	wp_enqueue_style( 'font-awesome', JWCSS . 'font-awesome.min.css');	    	
	    	wp_enqueue_style( 'lineicons', JWCSS . 'linecons-font-style.css');	
	    	wp_enqueue_style( 'boxer', JWCSS . 'jquery.fs.boxer.css');	
	    	wp_enqueue_style( 'carousel', JWCSS . 'owl.carousel.css');
	    	wp_enqueue_style( 'animate', JWCSS . 'animate.css');
	    	wp_enqueue_style( 'jw-theme', JWCSS . 'theme.css', null, "12.0");
	    	wp_enqueue_style( 'responsive', JWCSS . 'responsive.css');	    	 
	    	wp_enqueue_style( 'woocommerce', JWCSS . 'woocommerce.css');	    	 


	    	wp_enqueue_script( 'plugins', JWJS . 'plugins.js', array(), '', true );
	    	wp_enqueue_script( 'functions', JWJS . 'functions.js', array(), '', true );
	    	wp_enqueue_script( 'parallax', JWJS . 'jquery.parallax.js', array(), '', true );
	    	wp_enqueue_script( 'wow', JWJS . 'wow.min.js', array(), '', true );
	    	wp_enqueue_script( 'mousewheel', JWJS . 'jquery.mousewheel.js', array(), '', true );
	    	wp_enqueue_script( 'maps', 'http://maps.google.com/maps/api/js?sensor=true', array(), '', true );
	    	wp_enqueue_script('html5shiv',JWJS .'html5shiv.js', array(), '1', true);
	    	wp_enqueue_script('gmap3', JWJS ."gmap3.js", array("jquery"), '1', true);

	    	wp_enqueue_script( 'jwtheme-navigation', JWJS . 'navigation.js', array(), '20120206', true );
	    	wp_enqueue_script( 'jwtheme-skip-link-focus-fix', JWJS . 'skip-link-focus-fix.js', array(), '20130115', true );


	    } else {
	    	
	    	// Blog

	    	wp_enqueue_style( 'bootstrap', JWCSS . 'bootstrap.min.css');
	    	wp_enqueue_style( 'font-awesome', JWCSS . 'font-awesome.min.css');	    	
	    	wp_enqueue_style( 'lineicons', JWCSS . 'linecons-font-style.css');	
	    	wp_enqueue_style( 'jw-theme', JWCSS . 'theme.css', null, "12.0");
	    	wp_enqueue_style( 'responsive', JWCSS . 'responsive.css');
	    	wp_enqueue_style( 'carousel', JWCSS . 'owl.carousel.css');
	    	wp_enqueue_style( 'woocommerce', JWCSS . 'woocommerce.css');
        	wp_deregister_style( 'WOOCOMMERCE_USE_CSS' );
        	 	
	    	wp_enqueue_script( 'plugins', JWJS . 'plugins.js', array(), '', true );
	    	wp_enqueue_script( 'functions', JWJS . 'functions.js', array(), '', true );
	    	wp_enqueue_script( 'parallax', JWJS . 'jquery.parallax.js', array(), '', true );
	    	wp_enqueue_script( 'fitvids', JWJS . 'jquery.fitvids.js', array(), '', true );
	    	wp_enqueue_script('html5shiv',JWJS .'html5shiv.js', array(), '1', true);

	    	wp_enqueue_script( 'jwtheme-navigation', JWJS . 'navigation.js', array(), '20120206', true );
	    	wp_enqueue_script( 'jwtheme-skip-link-focus-fix', JWJS . 'skip-link-focus-fix.js', array(), '20130115', true );

	    }
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'jwtheme_scripts' );



/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//Theme Functions
require_once( get_template_directory()  . '/lib/theme-functions.php');

require get_template_directory() . '/lib/animation-classes.php';

require get_template_directory() . '/lib/linecons-font.php';

require get_template_directory() . '/lib/TwitterAPIExchange.php';

require get_template_directory() . '/lib/quick-style.php';



// Initialize the metabox class
add_action('init', 'topclass_initialize_cmb_meta_boxes', 9999);
function topclass_initialize_cmb_meta_boxes()
{
    if (!class_exists('cmb_Meta_Box')) {
        require_once('lib/cmb/init.php');
    }
}


// Post Meta Show/Hide 
if(!function_exists('jwtheme_post_format_meta_script')){

	function jwtheme_post_format_meta_script()
	{
		if(is_admin())
		{
			wp_register_script('jwthemepostmeta', get_template_directory_uri() .'/lib/adminjs/jw-post-meta.js');
			wp_enqueue_script('jwthemepostmeta');
		}
	}

	add_action('admin_enqueue_scripts','jwtheme_post_format_meta_script');

}



/*-------------------------------------------------------
 *			JW Theme TopClass Pagination
 *-------------------------------------------------------*/

if(!function_exists('jwtheme_pagination')):

	function jwtheme_pagination($pages = '', $range = 2)
{  
	$showitems = ($range * 1)+1;  

	global $paged;

	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if(!$pages)
		{
			$pages = 1;
		}
	}   

	if(1 != $pages)
	{
		echo '<nav class="paging-navigation" role="page-navigation">';

		if($paged > 2 && $paged > $range+1 && $showitems < $pages){
			echo '<a href="'.get_pagenum_link(1).'" class="page-numbers">&laquo;</a>';
		}

		// if($paged > 1 && $showitems < $pages){ 
		// 	echo '<a href="' . previous_posts_link("Previous") . '" class="prev page-numbers pull-left" title="Previous"><i class="fa fa-chevron-left"></i></a>';
		// }

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<a href='#' class='page-numbers active'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='page-numbers'>".$i."</a>";
			}
		}

		// if ($paged < $pages && $showitems < $pages){
		// 	echo '<a href="' . next_posts_link("Next") . '" class="next page-numbers pull-right" title="Next"><i class="fa fa-chevron-right"></i></a>';

		// }

		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
			echo '<a href="'.get_pagenum_link($pages).'" class="page-numbers">&raquo;</a>';
		}

		echo '</nav>';

	}
}

endif;



/*===================================================================================
 * Add Author Links
 * =================================================================================*/
function jwtheme_add_to_author_profile( $contactmethods ) {
	
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';	
	$contactmethods['google_profile'] = 'Google Profile URL';		
	$contactmethods['dribbble_profile'] = 'Dribbble Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';

	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'jwtheme_add_to_author_profile', 10, 1);



function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');


//Excerp Length
function jwtheme_excerpt_length($length) {    
    global $jwtheme_topclass;
    return $jwtheme_topclass['blog_excerpt_length'];
}
add_filter('excerpt_length', 'jwtheme_excerpt_length');


//Search Form
add_filter('get_search_form', 'jwtheme_search_form');

function jwtheme_search_form($form) {
	$form = '<form role="search" class="search-form" method="get" action="' . esc_url( home_url( '/' ) ) . '" >
		<input class="search-field" type="text" name="s" id="s" value="' . esc_attr( get_search_query() ) . '" placeholder="Search" required>
		<button class="btn" type="submit"><i class="fa fa-search"></i></button>
	</form>';

return $form;
}

// Sections
function jwtheme_get_enabled_sections(){
	
	global $jwtheme_topclass;    
	
	$sections = array();   

	if(isset($jwtheme_topclass['section_aboutus_display'])) $sections['section-aboutus'] = "About Us";
	if(isset($jwtheme_topclass['section_team_display'])) $sections['section-team'] = "Team";
	if(isset($jwtheme_topclass['section_services_display'])) $sections['section-services'] = "Services";
	if(isset($jwtheme_topclass['section_pricing_display'])) $sections['section-pricing'] = "Pricing";
	if(isset($jwtheme_topclass['section_testimonial_display'])) $sections['section-testimonial'] = "Testimonial";
	if(isset($jwtheme_topclass['section_portfolio_display'])) $sections['section-portfolio'] = "Portfolio";	
	if(isset($jwtheme_topclass['section_blog_display'])) $sections['section-blog'] = "Blog";	
	if(isset($jwtheme_topclass['section_contact_display'])) $sections['section-contact'] = "Contact";
	
	return ($sections);
}


function jwtheme_get_all_sections(){    
	
	$sections = array();    

	$sections['section-aboutus'] = "About Us";
	$sections['section-team'] = "Team";
	$sections['section-services'] = "Services";
	$sections['section-pricing'] = "Pricing";
	$sections['section-testimonial'] = "Testimonial";
	$sections['section-portfolio'] = "Portfolio";	
	$sections['section-blog'] = "Blog";	
	$sections['section-contact'] = "Contact";

	return $sections;
}



function topclass_get_custom_posts($type, $limit = 20, $order = "DESC")
{
    //wp_reset_postdata();
    $args = array(
        "posts_per_page" => $limit,
        "post_type" => $type,
        "orderby" => "ID",
        "order" => $order,
    );
    $custom_posts = get_posts($args);
    return $custom_posts;
}

function topclass_get_custom_posts_by_custom_order($type, $limit = 20, $meta_order_key = "_topclass_section_order", $order = "ASC")
{
    $args = array(
        "posts_per_page" => $limit,
        "post_type" => $type,
        "orderby" => "meta_value_num",
        "order" => "ASC",
        "meta_key" => $meta_order_key
    );
    $custom_posts = get_posts($args);
    return $custom_posts;
}


function topclass_get_blog_link(){
    $blog_post = get_option("page_for_posts");
    if($blog_post){
        $permalink = get_permalink($blog_post);
    }
    else
        $permalink = site_url();
    return $permalink;
}


/*-------------------------------------------------------
*			Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');


/**
 * TGMA
 */
add_action( 'tgmpa_register', 'topclass_register_required_plugins' );

function topclass_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name, slug and required.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'                  => 'All Around Content Slider', // The plugin name
            'slug'                  => 'all_around', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/lib/plugins/all_around.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => false, // If set, overrides default API URL and points to an external URL
        ),        
        array(
        	'name'     				=> esc_html__( 'Revolution Slider', 'jwtheme' ),
        	'slug'     				=> esc_html__( 'revslider', 'jwtheme' ),
        	'source'   				=> esc_url_raw( 'http://demos.jeweltheme.com/plugin-downloads/revslider.zip' ),
        	'required' 				=> true,
        	'version' 			 	=> '5.4',
        ),        
        array(
        	'name'     				=> esc_html__( 'Envato Market', 'jwtheme' ),
        	'slug'     				=> esc_html__( 'wp-envato-market', 'jwtheme' ),
        	'source'   				=> esc_url_raw( 'http://envato.github.io/wp-envato-market/dist/envato-market.zip' ),
        	'required' 				=> true,
        	'version' 			 	=> '',
        ),
        array(
        	'name'      			=> 'MailChimp for WordPress',
        	'slug'      			=> 'mailchimp-for-wp',
        	'required'  			=> true,
        	),
        array(
        	'name'      			=> 'Contact Form 7',
        	'slug'      			=> 'contact-form-7',
        	'required'  			=> true,
        ),
        array(
        	'name'      			=> 'WP Awesome FAQ Plugin',
        	'slug'      			=> 'wp-awesome-faq',
        	'required'  			=> true,
        ),
        array(
        	'name'      			=> 'WooComerce',
        	'slug'      			=> 'woocommerce',
        	'required'  			=> true,
        )

    );

    // Change this to your theme text domain, used for internationalising strings
    //'jwtheme' = 'jwtheme';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'jwtheme',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'jwtheme' ),
            'menu_title'                                => __( 'Install Plugins', 'jwtheme' ),
            'installing'                                => __( 'Installing Plugin: %s', 'jwtheme' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'jwtheme' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'jwtheme' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'jwtheme' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'jwtheme' ) // %1$s = dashboard link
        )
    );

    tgmpa( $plugins, $config );

}

function jwtheme_custom_post_types()
{
	$labels = array( 
		'name'                	=> _x( 'Sliders', 'Sliders', 'jwtheme' ),
		'singular_name'       	=> _x( 'Slider', 'Slider', 'jwtheme' ),
		'menu_name'           	=> __( 'Sliders', 'jwtheme' ),
		'parent_item_colon'   	=> __( 'Parent Slider:', 'jwtheme' ),
		'all_items'           	=> __( 'All Sliders', 'jwtheme' ),
		'view_item'           	=> __( 'View Slider', 'jwtheme' ),
		'add_new_item'        	=> __( 'Add New Slider', 'jwtheme' ),
		'add_new'             	=> __( 'New Slider', 'jwtheme' ),
		'edit_item'           	=> __( 'Edit Slider', 'jwtheme' ),
		'update_item'         	=> __( 'Update Slider', 'jwtheme' ),
		'search_items'        	=> __( 'Search Slider', 'jwtheme' ),
		'not_found'           	=> __( 'No Slider found', 'jwtheme' ),
		'not_found_in_trash'  	=> __( 'No Slider found in Trash', 'jwtheme' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_ui'            	=> true,
		'show_in_menu'       	=> true,
		'query_var'          	=> true,
		'rewrite' 				=> true,
		'capability_type'    	=> 'post',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> true,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'supports'           	=> array( 'title'),		
		'menu_icon' 			=> get_template_directory_uri() . '/images/menuicon/featuredposts.png',
		);

	register_post_type('slider',$args);


	$labels2 = array(
        'name' => _x('Team members', 'Post Type General Name', 'jwtheme'),
        'singular_name' => _x('Team member', 'Post Type Singular Name', 'jwtheme'),
        'menu_name' => __('Teams', 'jwtheme'),
        'parent_item_colon' => __('Parent Team member:', 'jwtheme'),
        'all_items' => __('All Team members', 'jwtheme'),
        'view_item' => __('View Team member', 'jwtheme'),
        'add_new_item' => __('Add New Team member', 'jwtheme'),
        'add_new' => __('New Team member', 'jwtheme'),
        'edit_item' => __('Edit Team member', 'jwtheme'),
        'update_item' => __('Update Team member', 'jwtheme'),
        'search_items' => __('Search Team members', 'jwtheme'),
        'not_found' => __('No team member found', 'jwtheme'),
        'not_found_in_trash' => __('No team members found in Trash', 'jwtheme'),
    );
    $args2 = array(
        'label' => __('Team member', 'jwtheme'),
        'description' => __('Team member', 'jwtheme'),
        'labels' => $labels2,
        'supports' => array('title','thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/images/menuicon/teammember.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('team', $args2);

    $labels3 = array(
        'name' => _x('Portfolios', 'Post Type General Name', 'jwtheme'),
        'singular_name' => _x('Portfolio', 'Post Type Singular Name', 'jwtheme'),
        'menu_name' => __('Portfolios', 'jwtheme'),
        'parent_item_colon' => __('Parent Portfolio:', 'jwtheme'),
        'all_items' => __('All Portfolios', 'jwtheme'),
        'view_item' => __('View Portfolio', 'jwtheme'),
        'add_new_item' => __('Add New Portfolio', 'jwtheme'),
        'add_new' => __('New Portfolio', 'jwtheme'),
        'edit_item' => __('Edit Portfolio', 'jwtheme'),
        'update_item' => __('Update Portfolio', 'jwtheme'),
        'search_items' => __('Search Portfolios', 'jwtheme'),
        'not_found' => __('No portfolio found', 'jwtheme'),
        'not_found_in_trash' => __('No portfolios found in Trash', 'jwtheme'),
    );
    $args3 = array(
        'label' => __('Portfolio', 'jwtheme'),
        'description' => __('Portfolio', 'jwtheme'),
        'labels' => $labels3,
        'supports' => array('title', 'thumbnail', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/images/menuicon/portfolio.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('portfolio', $args3);


  // Portfolio Category taxonomy,
  $labels8 = array(
    'name' => _x( 'Category', 'taxonomy general name', 'jwtheme'),
    'singular_name' => _x( 'Category', 'taxonomy singular name', 'jwtheme'),
    'search_items' =>  __( 'Search Category', 'jwtheme'),
    'popular_items' => __( 'Popular Category', 'jwtheme'),
    'all_items' => __( 'All Category\'s' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Category', 'jwtheme'),
    'update_item' => __( 'Update Category', 'jwtheme'),
    'add_new_item' => __( 'Add New Category', 'jwtheme'),
    'new_item_name' => __( 'New Category Name', 'jwtheme'),
    'separate_items_with_commas' => __( 'Separate Category with commas', 'jwtheme'),
    'add_or_remove_items' => __( 'Add or remove Category', 'jwtheme'),
    'choose_from_most_used' => __( 'Choose from the most used Category', 'jwtheme'),
    'menu_name' => __( 'Category', 'jwtheme'),
  ); 
    //Register Taxonomy
    register_taxonomy('portfolio','portfolio',array(
    'hierarchical' => true,
    'labels' => $labels8,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio' ),
  ));


    $labels6 = array(
        'name' => _x('Services', 'Post Type General Name', 'jwtheme'),
        'singular_name' => _x('Service', 'Post Type Singular Name', 'jwtheme'),
        'menu_name' => __('Services', 'jwtheme'),
        'parent_item_colon' => __('Parent Service:', 'jwtheme'),
        'all_items' => __('All Services', 'jwtheme'),
        'view_item' => __('View Service', 'jwtheme'),
        'add_new_item' => __('Add New Service', 'jwtheme'),
        'add_new' => __('New Service', 'jwtheme'),
        'edit_item' => __('Edit Service', 'jwtheme'),
        'update_item' => __('Update Service', 'jwtheme'),
        'search_items' => __('Search Services', 'jwtheme'),
        'not_found' => __('No service found', 'jwtheme'),
        'not_found_in_trash' => __('No services found in Trash', 'jwtheme'),
    );
    $args6 = array(
        'label' => __('Service', 'jwtheme'),
        'description' => __('Service', 'jwtheme'),
        'labels' => $labels6,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/images/menuicon/service.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('service', $args6);


    $labels7 = array(
        'name' => _x('Pricing tables', 'Post Type General Name', 'jwtheme'),
        'singular_name' => _x('Pricing table', 'Post Type Singular Name', 'jwtheme'),
        'menu_name' => __('Pricing tables', 'jwtheme'),
        'parent_item_colon' => __('Parent Pricing table:', 'jwtheme'),
        'all_items' => __('All Pricing tables', 'jwtheme'),
        'view_item' => __('View Pricing table', 'jwtheme'),
        'add_new_item' => __('Add New Pricing table', 'jwtheme'),
        'add_new' => __('New Pricing table', 'jwtheme'),
        'edit_item' => __('Edit Pricing table', 'jwtheme'),
        'update_item' => __('Update Pricing table', 'jwtheme'),
        'search_items' => __('Search Pricing tables', 'jwtheme'),
        'not_found' => __('No Pricing table found', 'jwtheme'),
        'not_found_in_trash' => __('No Pricing tables found in Trash', 'jwtheme'),
    );
    $args7 = array(
        'label' => __('Pricing table', 'jwtheme'),
        'description' => __('Pricing table', 'jwtheme'),
        'labels' => $labels7,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri().'/images/menuicon/pricingtable.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('pricing', $args7);

}

add_action('init','jwtheme_custom_post_types');


add_filter('cmb_meta_boxes', 'topclass_metaboxes');

function topclass_metaboxes()
{
    $prefix = "_jwtheme_";

    $meta_boxes[] = array(
        'id' => 'pricingtable',
        'title' => 'Pricing Table',
        'pages' => array('pricing'), // post type
        'context' => 'advanced',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Currency',
                'id' => $prefix . 'pricing_currency',
                'type' => 'text_medium',
                'std'=>"$"
            ),
            array(
                'name' => 'Price',
                'id' => $prefix . 'pricing_price',
                'type' => 'text_medium',
            ),            

            array(
                'name' => 'Fraction Price',
                'id' => $prefix . 'pricing_price_fraction',
                'type' => 'text_medium',
                'std'=>".00"
            ),
            array(
                'name' => 'Duration',
                'id' => $prefix . 'pricing_price_dur',
                'type' => 'select',
                'options'=>array(
                    array("name"=>"Hour","value"=>'hour'),
                    array("name"=>"Day","value"=>'day'),
                    array("name"=>"Week","value"=>'week'),
                    array("name"=>"Month","value"=>'month'),
                    array("name"=>"Year","value"=>'year')

                )
            ),

            array(
                'name' => 'Table Elements (One in each line)',
                'id' => $prefix . 'pricing_elements',
                'type' => 'textarea',
            ),
            array(
                'name' => 'Button text',
                'id' => $prefix . 'pricing_button',
                'type' => 'text_medium',
                'std'=>"Sign Up"

            ),
            array(
                'name' => 'Button link',
                'id' => $prefix . 'pricing_button_link',
                'type' => 'text_medium',
                'std'=>"#"
            ),
            array(
                'name' => 'Table Style',
                'id' => $prefix . 'pricing_bg_color',
                'type' => 'select',
                'options'=>array(
                    array("name"=>"Default","value"=>'default'), 
                    array("name"=>"Light Yellow","value"=>'light-yellow'), 
                    array("name"=>"Light Red","value"=>'light-red'), 
                    array("name"=>"Light Green","value"=>'light-green'),
                )
            ),
            array(
                'name' => 'Animation Style',
                'id' => $prefix . 'pricing_animation',
                'type' => 'select',
                'options'=>array(
                    array("name"=>"No Animation","value"=>''),
                    array("name"=>"Bounce In Up","value"=>'bounceInUp'),
                    array("name"=>"Bounce In Down","value"=>'bounceInDown'),
                    array("name"=>"Bounce In Right","value"=>'bounceInRight'),
                    array("name"=>"Bounce In Left","value"=>'bounceInLeft'),
	                array("name"=>"Animate from left","value"=>'slideInLeft'),
                    array("name"=>"Animate from right","value"=>'slideInRight'),
                    array("name"=>"Animate from top","value"=>'slideInUp'),
                    array("name"=>"Animate from bottom","value"=>'slideInDown'),
                    array("name"=>"Fade In","value"=>'fadeIn'),
                    array("name"=>"Fade from left","value"=>'fadeInLeft'),
                    array("name"=>"Fade from right","value"=>'fadeInRight'),
                    array("name"=>"Fade from top","value"=>'fadeInUp'),
                    array("name"=>"Fade from bottom","value"=>'fadeInDown'),

                )
            )
        )
    );

    return $meta_boxes;
}



//Show Post count
function jwtheme_topclass_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}


function jwtheme_topclass_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}



add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
	}
}
