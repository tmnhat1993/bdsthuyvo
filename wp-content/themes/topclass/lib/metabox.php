<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'jwtheme_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function jwtheme_register_meta_boxes( $meta_boxes )
{
	global $animation;
	global $linecons;
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = '_jwtheme_';

	
	// 1st meta box
	$meta_boxes[] = array(
		'id' => 'post-meta-quote',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Quote Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Qoute Text', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => __( 'Write Your Qoute Here', 'jwtheme' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Qoute Author', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => __( 'Write Qoute Author or Source', 'jwtheme' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-chat',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Chat Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Chat Message', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}chat_text",
				'type' => 'wysiwyg',
				'raw'  => false,
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => false,
					'media_buttons' => false,
				)
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Link Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Link Text', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link_text",
				'desc'  => __( 'Link Text', 'jwtheme' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Link URL', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => __( 'Write Your Link', 'jwtheme' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-audio',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Audio Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Audio Embed Code', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}audio_code",
				'desc'  => __( 'Write Your Audio Embed Code Here', 'jwtheme' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-status',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Status Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Status URL', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}status_url",
				'desc'  => __( 'Write Facebook, Twitter etc status link', 'jwtheme' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-video',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Video Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Video ID', 'jwtheme' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => __( 'Write Your Vedio ID Only', 'jwtheme' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'     => __( 'Select Vedio Type/Source', 'jwtheme' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => __( 'Embed Code', 'jwtheme' ),
					'2' => __( 'YouTube', 'jwtheme' ),
					'3' => __( 'Vimeo', 'jwtheme' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '1'
			),
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Gallery Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Gallery Image Upload', 'jwtheme' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 5,
			)			
		)
	);


	$meta_boxes[] = array(
		'id' => 'slider-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Slider Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'slider'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Heading 1', 'jwtheme' ),
				'id'               => "{$prefix}heading1",
				'type'             => 'text',
				'desc'  		   => __( 'Use <span> tag for Text Color.', 'jwtheme' ),
			),
			array(
				'name'             => __( 'Heading 1 Animation', 'jwtheme' ),
				'id'               => "{$prefix}heading1_anim",
				'type'             => 'select',
				'desc'  		   => __( 'Select Animation Type.', 'jwtheme' ),
				'options'  		   => 	$animation,
				'multiple'    	   => false,
				'std'              => ''
			),


			array(
				'name'             => __( 'Heading 2', 'jwtheme' ),
				'id'               => "{$prefix}heading2",
				'type'             => 'text',
			),
			array(
				'name'             => __( 'Heading 2 Animation', 'jwtheme' ),
				'id'               => "{$prefix}heading2_anim",
				'type'             => 'select',
				'desc'  		   => __( 'Select Animation Type.', 'jwtheme' ),
				'options'  		   => 	$animation,
				'multiple'         => false,
				'std'              => ''
			),


			array(
				'name'             => __( 'Heading 3', 'jwtheme' ),
				'id'               => "{$prefix}heading3",
				'type'             => 'text',
			),
			array(
				'name'             => __( 'Heading 3 Animation', 'jwtheme' ),
				'id'               => "{$prefix}heading3_anim",
				'type'             => 'select',
				'desc'  		   => __( 'Select Animation Type.', 'jwtheme' ),
				'options'  		   => 	$animation,
				'multiple'         => false,
				'std'              => ''
			),

			array(
				'name'             => __( 'Slider Text', 'jwtheme' ),
				'id'               => "{$prefix}slider_more_text",
				'type'             => 'text',
				'desc'  		   => __( 'Slider Button More Text.', 'jwtheme' ),
				'std'              => 'Get Started'
			),
			array(
				'name'             => __( 'Slider More URL', 'jwtheme' ),
				'id'               => "{$prefix}slider_text_url",
				'type'             => 'text',
				'desc'  		   => __( 'URl of Slider More Button.', 'jwtheme' ),
				'std'   => '#'
			),
		)
	);


	$meta_boxes[] = array(
		'id' => 'team-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Team Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'team'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name' 		=> __( 'Name', 'jwtheme' ),
				'id' 		=> "{$prefix}team_member_name",
				'type' 		=> 'text',
				), 
			array(
				'name' 		=> __( 'Designation', 'jwtheme' ),
				'id' 		=> "{$prefix}team_member_designation",
				'type' 		=> 'text'
				),  
			array(
				'name' 		=> __( 'Short Description', 'jwtheme' ),
				'id' 		=> "{$prefix}team_desc",
				'type' 		=> 'textarea',
				),            
			array(
				'name' 		=> __('Twitter URL',"jwtheme"),
				'id' 		=> "{$prefix}social_twitter",
				'type'      => 'text',
				'std'       =>''
				),
			array(
				'name'      => __('Facebook URL',"jwtheme"),
				'id'        => "{$prefix}social_facebook",
				'type'      => 'text',
				'std'       =>''
				),
			array(
				'name'      => __('Dribbble URL',"jwtheme"),
				'id'        => "{$prefix}social_dribbble",
				'type'      => 'text',
				'std'       =>''
				),
			array(
				'name'      => __('Google Plus URL',"jwtheme"),
				'id'        => "{$prefix}social_google_plus",
				'type'      => 'text',
				'std'       =>''
				),
			array(
				'name'      => __('Linkedin URL',"jwtheme"),
				'id'        => "{$prefix}social_linkedin",
				'type'      => 'text',
				'std'       =>''
				),			
			array(
				'name'      => __('Animation Type',"jwtheme"),
				'id'        => "{$prefix}team_animation",
				'type'      => 'select',
				'options'  	=> 	$animation,
				'std'		=>'bounceInUp',
				'multiple'  => false,
				),
		)
	);


	$meta_boxes[] = array(
		'id' => 'service-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Team Settings', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'service'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
 
			array(
				'name' 		=> __( 'Service Title', 'jwtheme' ),
				'id' 		=> "{$prefix}service_title",
				'type' 		=> 'text'
				),  
			array(
				'name' 		=> __('Service Description',"jwtheme"),
				'id' 		=> "{$prefix}service_desc",
				'type'      => 'textarea',
				'std'       =>''
				),          
			array(
				'name' 		=> __( 'Service Icon', 'jwtheme' ),
				'id' 		=> "{$prefix}service_icon",
				'type' 		=> 'select',
				'desc'  	=> __( "Select Icons. <a href='http://designmodo.com/linecons-free/'' target='_blank'>More Details</a>", "jwtheme" ),
				'options'  	=> 	$linecons,
				), 


		)
	);

	$meta_boxes[] = array(
		'id' => 'post-type-portfolio',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Portfolio Sceenshots', 'jwtheme' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'portfolio'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Portfolio Image Upload', 'jwtheme' ),
				'id'               => "{$prefix}portfolio_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 5,
			),			
			array(
				'name'             => __( 'Client Name', 'jwtheme' ),
				'id'               => "{$prefix}portfolio_client_name",
				'type'             => 'text',
			),
			array(
				'name'             => __( 'Project End Date', 'jwtheme' ),
				'id'               => "{$prefix}portfolio_date",
				'type'             => 'date',
			),
			array(
				'name'             => __( 'Project URL', 'jwtheme' ),
				'id'               => "{$prefix}portfolio_url",
				'type'             => 'text',
			),




		)
	);

	return $meta_boxes;
}