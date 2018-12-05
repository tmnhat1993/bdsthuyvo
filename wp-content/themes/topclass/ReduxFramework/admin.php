<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit http://reduxframework.com/docs/
 **/


/**
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be overridden if needed.
 **/
$args = array();

// For use with a tab example below
$tabs = array();

ob_start();

$ct = wp_get_theme();
$theme_data = $ct;
$item_name = $theme_data->get('Name');
$tags = $ct->Tags;
$screenshot = $ct->get_screenshot();
$class = $screenshot ? 'has-screenshot' : '';

$customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'topclass-admin'), $ct->display('Name'));

?>
<div id="current-theme" class="<?php echo esc_attr($class); ?>">
    <?php if ($screenshot) : ?>
        <?php if (current_user_can('edit_theme_options')) : ?>
            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
               title="<?php echo esc_attr($customize_title); ?>">
               <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>"/>
           </a>
       <?php endif; ?>
       <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>"
       alt="<?php esc_attr_e('Current theme preview'); ?>"/>
   <?php endif; ?>

   <h4>
    <?php echo $ct->display('Name'); ?>
</h4>

<div>
    <ul class="theme-info">
        <li><?php printf(__('By %s', 'topclass-admin'), $ct->display('Author')); ?></li>
        <li><?php printf(__('Version %s', 'topclass-admin'), $ct->display('Version')); ?></li>
        <li><?php echo '<strong>' . __('Tags', 'topclass-admin') . ':</strong> '; ?><?php printf($ct->display('Tags')); ?></li>
    </ul>
    <p class="theme-description"><?php echo $ct->display('Description'); ?></p>
    <?php if ($ct->parent()) {
        printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>',
            __('http://codex.wordpress.org/Child_Themes', 'topclass-admin'),
            $ct->parent()->display('Name'));
        } ?>

    </div>

</div>

<?php
$item_info = ob_get_contents();

ob_end_clean();

$args['dev_mode'] = false;
$args['dev_mode_icon_class'] = 'icon-large';
$args['opt_name'] = 'jwtheme_topclass';
$theme = wp_get_theme();

$args['display_name'] = $theme->get('Name');
$args['display_version'] = $theme->get('Version');


$args['import_icon_class'] = 'icon-large';

/**
 * Set default icon class for all sections and tabs
 * @since 3.0.9
 */
$args['default_icon_class'] = 'icon-large';


// Set a custom menu icon.
$args['menu_icon'] = get_template_directory_uri() . "/images/menuicon/setting.png";

// Set a custom title for the options page.
// Default: Options
$args['menu_title'] = __('Top Class Settings', 'topclass-admin');

// Set a custom page title for the options page.
// Default: Options
$args['page_title'] = __('Top Class Settings', 'topclass-admin');

// Set a custom page slug for options page (wp-admin/themes.php?page=***).
// Default: redux_options
$args['page_slug'] = 'topclass_options';

$args['default_show'] = true;
$args['default_mark'] = '*';


if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace("-", "_", $args['opt_name']);
    }
} else {
}

$sections = array();

//Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
$sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
$sample_patterns = array();

if (is_dir($sample_patterns_path)) :

    if ($sample_patterns_dir = opendir($sample_patterns_path)) :
        $sample_patterns = array();

    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
            $name = explode(".", $sample_patterns_file);
            $name = str_replace('.' . end($name), '', $sample_patterns_file);
            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
        }
    }
    endif;
    endif;

    global $jwtheme_topclass;

    global $animation;

    $sections[] = array(
        'title' => __('Global Management', 'topclass-admin'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-globe',
        'fields' => array(
            $fields = array(
                'id' => 'jwtheme_sections_order',
                'type' => 'sortable',
                'title' => __('Sort Sections', 'topclass-admin'),
                'subtitle' => __('Define and reorder these sections however you want.', 'topclass-admin'),
                'mode' => 'text',
                'options' => get_option("jwtheme_sections"),
                ),
            array(
                'id' => 'jwtheme_color',
                'type' => 'image_select',
                'title' => __('Color Scheme', 'topclass-admin'),
                'subtitle' => __('Select Predefined Color Schemes or your Own', 'topclass-admin'),
                'options' => array(

                 '1' => array(
                    'alt' => 'Blue',
                    'img' => get_template_directory_uri() . '/images/presets/preset1.png'
                    ),
                 '2' => array(
                    'alt' => 'Dark Green',
                    'img' => get_template_directory_uri() . '/images/presets/preset2.png'
                    ),
                 '3' => array(
                    'alt' => 'Violet',
                    'img' => get_template_directory_uri() . '/images/presets/preset3.png'
                    ),
                 '4' => array(
                    'alt' => 'Red',
                    'img' => get_template_directory_uri() . '/images/presets/preset4.png'
                    ),
                 '5' => array(
                    'alt' => 'Orange',
                    'img' => get_template_directory_uri() . '/images/presets/preset5.png'
                    ),                  

                 '6' => array(
                    'alt' => 'Choose Your One',
                    'img' => get_template_directory_uri() . '/images/presets/preset0.png'
                    )

                 ),
'default' => '1'
),
array(
    'id' => 'jwtheme_custom_color',
    'type' => 'color',
    'title' => __('Your Own Theme Color', 'topclass-admin'),
    'subtitle' => __('Pick a custom color', 'topclass-admin'),
    'default' => '#3498db',
    'validate' => 'color',
    'required' => array("jwtheme_color", "=", "6")
    ),
array(
    'id' => 'custom_css',
    'type' => 'ace_editor',
    'title' => __('Custom CSS', 'topclass-admin'),
    'description' => 'Write your custom CSS code inside &lt;style> &lt;/style> block'
    ),

array(
    'id' => 'custom_ga',
    'type' => 'ace_editor',
    'title' => __('Google Analytics Code', 'topclass-admin'),
    'description' => 'Write your custom google analytics code inside &lt;script> &lt;/script> block'

    ),

array(
    'id' => 'custom_main_body_fonts',
    'type' => 'typography',
    'title' => __('Google Font', 'topclass-admin'),
    'google'      => true,
    'color' => false,
    'word-spacing'=>false,
    'text-align'=>false,
    'update-weekly'=>false,
    'line-height'=>false,
    'subsets'=>false,
    'letter-spacing'=>false,
    'font-style'=>false,
    'font-backup' => false,
    'font-size'=>false,
    'font-weight'=>true,
    'output'      => array('body'),
    'units'       =>'px',
    'default'     => array(
        'font-family' => 'Raleway',
        'google'      => true,
        ),
    ),

)
        ); //global

$sections[] = array(
    'title' => __('Customizable Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-cogs',
    'fields' => array(

        array(
            'id' => 'section_header_logo_type',
            'type' => 'switch',
            'title' => __('Main Logo', 'topclass-admin'),
            'default' => 1
            ),  
        array(
            'id' => 'section_header_logo_image',
            'type' => 'switch',
            'title' => __('Show Image Logo', 'topclass-admin'),
            'default' => 0,
            'required' => array('section_header_logo_type', '=', '1')
            ),                            
        array(
            'id' => 'section_header_nav_logo',
            'type' => 'media',
            'title' => __('Logo Image', 'topclass-admin'),
            'default' => array("url" => get_template_directory_uri() . "/images/logo.png"),
            'preview' => true,
            "url" => true,
            'required' => array('section_header_logo_image', '=', '1')
            ),
        array(
            'id' => 'section_header_logo_text',
            'type' => 'switch',
            'title' => __('Show Logo Text', 'topclass-admin'),
            'default' => 1,
            'required' => array('section_header_logo_type', '=', '1')
            ),  

        array(
            'id' => 'logo_text',
            'type' => 'text',
            'title' => __('Logo Text', 'topclass-admin'),
            'default' => "<span>Top</span>Class",  
            'required' => array('section_header_logo_text', '=', '1')              
            ),

        array(
            'id' => 'show_favicon',
            'type' => 'switch',
            'title' => __('Show Favicon', 'topclass-admin'),
            'default' => 1,
            ),

        array(
            'id' => 'favicon_icon',
            'type' => 'media',
            'title' => __('Favicon Icon', 'topclass-admin'),
            'default' => array("url" => get_template_directory_uri() . "/favicon.png"),
            'preview' => true,
            "url" => true,
            'required' => array('show_favicon', '=', '1')
            ),

        array(
            'id' => 'admin_logo',
            'type' => 'media',
            'title' => __('Admin Logo', 'topclass-admin'),
            'default' => array("url" => get_template_directory_uri() . "/images/logo.png"),
            'preview' => true,
            "url" => true
            ),


        )
    ); //header

$sections[] = array(
    'title' => __('Slider Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-website',
    'fields' => array(

        array(
            'id' => 'section_slider_display',
            'type' => 'switch',
            'title' => __('Display Slider Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_slider_display_menu',
            'type' => 'switch',
            'title' => __('Display Slider In Menubar', 'topclass-admin'),
            'default' => 0,
            ),
        array(
            'id' => 'section_slider_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Slider",
            'required' => array('section_slider_display_menu', '=', '1')
            ),

        array(
            'id' => 'section_revolution_slider_display',
            'type' => 'switch',
            'title' => __('Revolution Slider', 'topclass-admin'),
            'default' => 1,
            'description'  => 'Select Revolution Slider as a Default Slider',    
            ),
        array(
            'id' => 'section_slider_alias',
            'type' => 'text',
            'title' => __('Slider Alias', 'topclass-admin'),
            'default' => "topclass-Slider",
            'required' => array('section_revolution_slider_display', '=', '1')
            ),

        array(
            'id' => 'section_topclass_slider_display',
            'type' => 'switch',
            'title' => __('TopClass Slider', 'topclass-admin'),
            'required' => array('section_slider_display', '=', '1'),
            'description'  => 'Select TopClass Slider as a if You don\'t want to show Revolution Slider',  
            'default' => 0,
            ),

        array(
            'id' => 'section_slider_count',
            'type' => 'text',
            'title' => __('Slider Count', 'topclass-admin'),
            'default' => "5",
            'required' => array('section_topclass_slider_display', '=', '1')
            ),
        array(
            'id' => "section_slider_bg_image",
            'type' => 'media',
            'title' => __('Slider Background Image', 'topclass-admin'),
            'required' => array('section_topclass_slider_display', '=', '1'),            
            'default' => array("url" => get_template_directory_uri() . "/images/background/top-section-bg.jpg"),
            'preview' => true,
            "url" => true
            ),
        array(
            'id' => 'section_slider_info',
            'type' => 'info',
            'title' => __('Create new content for Slider section from <a href="'.site_url().'/wp-admin/post-new.php?post_type=slider">here</a>', 'topclass-admin'),
            'required' => array('section_topclass_slider_display', '=', '1')
            ),




        )
    ); //Slider



$sections[] = array(
    'title' => __('About Us Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-user',
    'fields' => array(

        array(
            'id' => 'section_aboutus_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_aboutus_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_aboutus_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "About",
            'required' => array('section_aboutus_display', '=', '1')
            ),
        array(
            'id' => "section_aboutus_image",
            'type' => 'media',
            'title' => __('Section Image', 'topclass-admin'),
            'required' => array('section_aboutus_display', '=', '1'),            
            'default' => array("url" => get_template_directory_uri() . "/images/section-content/about-us.jpg"),
            'preview' => true,
            "url" => true
            ),
        array(
            'id' => "section_aboutus_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "<span>About</span> Us",
            'required' => array('section_aboutus_display', '=', '1')
            ),
        array(
            'id' => "section_aboutus_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam",
            'required' => array('section_aboutus_display', '=', '1')
            ),
        array(
            'id' => "section_aboutus_posttitle",
            'type' => 'text',
            'title' => __('Post Title', 'topclass-admin'),
            'default' => "WE ARE TOP CLASS",
            'required' => array('section_aboutus_display', '=', '1')
            ), 
        array(
            'id' => "section_aboutus_text",
            'type' => 'editor',
            'title' => __('Section Text', 'topclass-admin'),
            'required' => array('section_aboutus_display', '=', '1'),
            'default' => '<p>
            <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam voluptate, accusamus </strong>
        </p>
        <p>
            Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi.
        </p>',
        ), 
        array(
            'id' => 'section_show_counter_display',
            'type' => 'switch',
            'title' => __('Display Counter Section', 'topclass-admin'),
            'default' => 0,
            ),
        array(
            'id' => 'section_about_us_review_counter',
            'type' => 'multi_text',
            'title' => __('Icon, Counter & Text', 'topclass-admin'),
            'description'  => 'Example with Comma\'s: 4, Members',            
            'required' => array('section_show_counter_display', '=', '1')
            ),

        array(
            'id' => 'section_video_parallax_display',
            'type' => 'switch',
            'title' => __('Display Video Parallax Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_video_title',
            'type' => 'text',
            'title' => __('Video Button Title', 'topclass-admin'),
            'description'  => 'Play Video',            
            'default'  => 'Play Video',            
            'required' => array('section_video_parallax_display', '=', '1')
            ),      
        array(
            'id' => 'section_video_url',
            'type' => 'text',
            'title' => __('Video URL', 'topclass-admin'),
            'description'  => 'http://player.vimeo.com/video/21969942',            
            'default'  => 'http://player.vimeo.com/video/21969942',            
            'required' => array('section_video_parallax_display', '=', '1')
            ),
        array(
            'id' => "section_video_bg_image",
            'type' => 'media',
            'title' => __('Video Parallax Image', 'topclass-admin'),
            'required' => array('section_video_parallax_display', '=', '1'),            
            'default' => array("url" => get_template_directory_uri() . "/images/background/video-section-bg.jpg"),
            'preview' => true,
            "url" => true
            ),        
        array(
            'id' => "section_video_image",
            'type' => 'media',
            'title' => __('Section Video Image', 'topclass-admin'),
            'required' => array('section_video_parallax_display', '=', '1'),            
            'default' => array("url" => get_template_directory_uri() . "/assets/images/video-play.png"),
            'preview' => true,
            "url" => true
            ),


        )
); //about Us


//Team Section
$sections[] = array(
    'title' => __('Team Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-group',
    'fields' => array(
        array(
            'id' => 'section_team_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_team_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_team_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Team",
            'required' => array('section_team_display_menu', '=', '1')
            ),
        array(
            'id' => "section_team_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "<span>Our</span> Team",
            'required' => array('section_team_display', '=', '1')
            ),
        array(
            'id' => "section_team_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam",
            'required' => array('section_team_display', '=', '1')
            ),

        array(
            'id' => "section_team_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam",
            'required' => array('section_team_display', '=', '1')
            ),

        array(
            'id' => 'section_team_info',
            'type' => 'info',
            'title' => __('Create new Services for this section from <a href="'.site_url().'/wp-admin/post-new.php?post_type=team">here</a>', 'topclass-admin'),
            'required' => array('section_team_display', '=', '1')
            ),

        array(
            'id' => 'section_show_team_skills',
            'type' => 'switch',
            'title' => __('Display Team Skills', 'topclass-admin'),
            'default' => 0,
            ),
        array(
            'id' => 'section_team_skills_title',
            'type' => 'text',
            'title' => __('Skills Title', 'topclass-admin'),
            'default' => 'Our top Skills',
            'required' => array('section_show_team_skills', '=', '1')
            ),
        array(
            'id' => 'section_team_skills',
            'type' => 'multi_text',
            'title' => __('Left Side Skills ', 'topclass-admin'),
            'description'  => 'Example with Comma\'s: Adobe Phototshop, 95, fadeInRight, 0.1',            
            'required' => array('section_show_team_skills', '=', '1')
            ),           
        array(
            'id' => 'section_team_skills_right',
            'type' => 'multi_text',
            'title' => __('Right Side Skills ', 'topclass-admin'),
            'description'  => 'Example with Comma\'s: 4, Members',            
            'required' => array('section_show_team_skills', '=', '1')
            ),  

        
        //Parallax Section
        array(
            'id' => 'section_show_team_parallax',
            'type' => 'switch',
            'title' => __('Display Team Parallax', 'topclass-admin'),
            'default' => 1,
            ),  
        array(
            'id' => 'section_team_parallax_title',
            'type' => 'text',
            'title' => __('Parallax Title', 'topclass-admin'),
            'default' => 'We Value Quality Over Quantity',
            'required' => array('section_show_team_parallax', '=', '1')
            ),        
        array(
            'id' => 'section_team_parallax_desc',
            'type' => 'text',
            'title' => __('Parallax Description', 'topclass-admin'),
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate officiis corporis, distinctio vitae iusto libero et amet tenetur quae deleniti cum error dolorem eligendi, praesentium reiciendis unde accusamus repellat similique.',
            'required' => array('section_show_team_parallax', '=', '1')
            ),   
        array(
            'id' => 'section_team_parallax_btn',
            'type' => 'text',
            'title' => __('Parallax Button', 'topclass-admin'),
            'default' => 'Purchase Now',
            'required' => array('section_show_team_parallax', '=', '1')
            ),    
        array(
            'id' => 'section_team_parallax_url',
            'type' => 'text',
            'title' => __('Parallax Button URL', 'topclass-admin'),
            'default' => '#',
            'required' => array('section_show_team_parallax', '=', '1')
            ),           
        array(
            'id' => 'section_team_parallax_banner',
            'type' => 'media',
            'title' => __('Banner Image', 'topclass-admin'),
            'required' => array('section_show_team_parallax', '=', '1'),
            'default' => array("url" => get_template_directory_uri() . "/images/quality/quality.png")
            ),           
        array(
            'id' => 'section_team_parallax_image',
            'type' => 'media',
            'title' => __('Parallax Image', 'topclass-admin'),
            'required' => array('section_show_team_parallax', '=', '1'),
            'default' => array("url" => get_template_directory_uri() . "/images/background/quality-bg.jpg")
            ),    

        )
); //team



$sections[] = array(
    'title' => __('Services Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-wrench-alt',
    'fields' => array(
        array(
            'id' => 'section_services_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_services_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_service_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Service",
            'required' => array('section_services_display_menu', '=', '1')

            ),

        array(
            'id' => "section_service_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "<span>What</span> We Do",
            ),
        array(
            'id' => "section_service_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam.",
            ),
        array(
            'id' => 'section_service_info',
            'type' => 'info',
            'title' => __('Create new content for this section from <a href="'.site_url().'/wp-admin/post-new.php?post_type=service">here</a>', 'topclass-admin'),
            ),

        )
); //services



$sections[] = array(
    'title' => __('Pricing Table Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-th-list',
    'fields' => array(
        array(
            'id' => 'section_pricing_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_pricing_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_pricing_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Pricing",
            'required' => array('section_pricing_display_menu', '=', '1')
            ),

        array(
            'id' => "section_pricing_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "Pricing",
            ),

        )
); //pricing



$sections[] = array(
    'title' => __('Portfolio Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-th-large',
    'fields' => array(
        array(
            'id' => 'section_portfolio_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_portfolio_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_portfolio_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Portfolio",
            'required' => array('section_portfolio_display_menu', '=', '1')
            ),       
        array(
            'id' => 'settings_portfolio_parallax_image',
            'type' => 'media',
            'title' => __('Portfolio Parallax Banner', 'topclass-admin'),
            'url'=>'true',
            'preview'=>'true',
            'default' => array("url" => get_template_directory_uri() . "/images/background/page-name-bg.jpg"),
            ),

        array(
            'id' => "section_portfolio_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "<span>Our</span> Works",
            ),
        array(
            'id' => "section_portfolio_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam",
            ),
        // array(
        //     'id' => 'section_portfolio_info',
        //     'type' => 'info',
        //     'title' => __('Create new content for this section from <a href="'.site_url().'/wp-admin/post-new.php?post_type=portfolio">here</a>', 'topclass-admin'),
        //     ),

        //Clients Section
        array(
            'id' => 'section_our_clients',
            'type' => 'switch',
            'title' => __('Display Our Client Section', 'topclass-admin'),
            'default' => 0,
            ),
        array(
            'id' => 'section_our_clients_title',
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => 'Our Clients',
            'required' => array('section_our_clients', '=', '1')
            ),
        array(
            'id' => 'section_client_gallery',
            'type' => 'gallery',
            'title' => __('Add Clients Logo', 'topclass-admin'),
            'required' => array('section_our_clients', '=', '1')
            ),
        
        //Parallax Section
        array(
            'id' => 'section_parallax_client_display',
            'type' => 'switch',
            'title' => __('Parallax Section', 'biz-admin'),
            'default' => 1,
            ),
        array(
            'id' => "section_parallax_client_desc",
            'type' => 'editor',
            'title' => __('Section Description', 'biz-admin'),
            'default' => '<p class="quote-description">
            It is art if can not be explained. It is fashion if no one asks for an 
            explanation. It is design if it does not need explanation.
        </p>
        <p class="quote-author">
            Wouter Stokkel
        </p>',
        'required' => array('section_parallax_client_display', '=', '1')
        ),
        array(
            'id' => 'section_parallax_client_bg',
            'type' => 'media',
            'title' => __('Parallax3 Background', 'biz-admin'),
            'default' => array("url" => get_template_directory_uri() . "/images/background/page-name-bg.jpg"),
            'preview' => true,
            "url" => true,
            'required' => array('section_parallax_client_display', '=', '1')

            ),


        )
); //portfolio





$sections[] = array(
    'title' => __('Blog Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-comment-alt',
    'fields' => array(
        array(
            'id' => 'section_blog_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_blog_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_blog_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Blog",
            'required' => array('section_blog_display_menu', '=', '1')
            ),
        array(
            'id' => "section_blog_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "<span>Our</span> Blog",
            ),
        array(
            'id' => "section_blog_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam.",
            ),
        array(
            'id' => "section_blog_view_all_posts",
            'type' => 'text',
            'title' => __('View All Posts', 'topclass-admin'),
            'default' => "View All Posts",
            ),
        array(
            'id' => "blog_excerpt_length",
            'type' => 'text',
            'title' => __('Excerpt Length', 'topclass-admin'),
            'default' => 20,
            ),
        array(
            'id' => 'section_blog_bg',
            'type' => 'media',
            'title' => __('Blog Parallax Banner', 'topclass-admin'),
            'url'=>'true',
            'preview'=>'true',
            'default' => array("url" => get_template_directory_uri() . "/images/background/page-name-bg.jpg"),
            )
        )
); //blog




$sections[] = array(
    'title' => __('Twitter & Subscribe', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-twitter',
    'fields' => array(

        //Twitter Section
        array(
            'id' => 'section_twitter_display',
            'type' => 'switch',
            'title' => __('Display Twitter Section', 'topclass-admin'),
            'default' => 0,
            ),        
        array(
            'id' => 'section_twitter_username',
            'type' => 'text',
            'title' => __('Twitter Username', 'topclass-admin'),
            'default' => 'jwthemeltd',
            'required' => array('section_twitter_display', '=', '1')            
            ),
        array(
            'id' => "section_twitter_consumer_key",
            'type' => 'text',
            'title' => __('API Key', 'topclass-admin'),
            'default' => '',
            'required' => array('section_twitter_display', '=', '1')
            ),
        array(
            'id' => 'section_twitter_consumer_secret',
            'type' => 'text',
            'title' => __('API secret', 'topclass-admin'),
            'default' => '',
            'required' => array('section_twitter_display', '=', '1')
            ),

        array(
            'id' => "section_twitter_access_token",
            'type' => 'text',
            'title' => __('Access token', 'topclass-admin'),
            'default' => '',
            'required' => array('section_twitter_display', '=', '1')
            ),
        array(
            'id' => "section_twitter_oauth_access_token_secret",
            'type' => 'text',
            'title' => __('Auth Access Token Secret', 'topclass-admin'),
            'default' => '',
            'required' => array('section_twitter_display', '=', '1')
            ),
        array(
            'id' => 'section_twitter_info',
            'type' => 'info',
            'title' => __("Create a twitter app on the twitter developer site from <a href='https://apps.twitter.com' target='_blank'>Developer Site</a>", "topclass-admin"),

            'required' => array('section_twitter_display', '=', '1')
            ),

        //Subscribe Section
        array(
            'id' => 'section_subscribe_display',
            'type' => 'switch',
            'title' => __('Display Subscriber Section', 'topclass-admin'),
            'default' => 0,
            ),
        array(
            'id' => "section_subscribe_title",
            'type' => 'text',
            'title' => __('Subscriber Title', 'topclass-admin'),
            'default' => 'Subscribe Our Newsletter',
            'required' => array('section_subscribe_display', '=', '1')
            ),
        array(
            'id' => 'section_subscribe_subtitle',
            'type' => 'text',
            'title' => __('Subscriber Subtitles', 'topclass-admin'),
            'default' => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.',
            'required' => array('section_subscribe_display', '=', '1')
            ),

        array(
            'id' => "section_select_subscribe_page",
            'type' => 'select',
            'title' => __('Select Subscriber Page', 'topclass-admin'),
            'default' => '',            
            'data' => 'pages',
            'args' => array('post_type' => 'page'),
            'multi'    => false,
            'required' => array('section_subscribe_display', '=', '1'),
            'desc' => __('Or create one Contact Page from <a href="' . site_url() . '/wp-admin/post-new.php?post_type=page">here</a>', 'topclass-admin'),
            ),
        array(
            'id' => "section_subscribe_bg",
            'type' => 'media',
            'title' => __('Parallax Background', 'topclass-admin'),
            'url'=>'true',
            'preview'=>'true',
            'default' => array("url" => get_template_directory_uri() . "/images/background/subscribe-bg.jpg"),
            'required' => array('section_subscribe_display', '=', '1')
            )

        )
); //blog




$sections[] = array(
    'title' => __('Testimonial Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-certificate',
    'fields' => array(
        array(
            'id' => 'section_testimonial_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_testimonial_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_testimonial_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Testimonial",
            'required' => array('section_testimonial_display_menu', '=', '1')
            ),      
        array(
            'id' => "section_testimonial_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "HAPPY CUSTOMERS",
            'required' => array('section_testimonial_display_menu', '=', '1')
            ),
        array(
            'id' => 'section_testimonial_page',
            'type' => 'select',
            'title' => __('Select Testimonial Page', 'topclass-admin'),
            'data' => 'pages',
            'args' => array('post_type' => 'page'),
            'multi'    => false,
            'desc' => __('Or create one Testimonial Page from <a href="' . site_url() . '/wp-admin/post-new.php?post_type=page">here</a>', 'topclass-admin'),
            'required' => array('section_testimonial_display_menu', '=', '1')
            ),
        array(
            'id' => 'section_testimonial_bg_image',
            'type' => 'media',
            'title' => __('Testimonial section background Parallax', 'topclass-admin'),
            'default' => array("url" => get_template_directory_uri() . "/images/background/testimonial-bg.jpg"),
            'required' => array('section_testimonial_display_menu', '=', '1')            
            )

        )
); //testimonial


$sections[] = array(
    'title' => __('Contact Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-phone-alt',
    'fields' => array(
        array(
            'id' => 'section_contact_display',
            'type' => 'switch',
            'title' => __('Display Section', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_contact_display_menu',
            'type' => 'switch',
            'title' => __('Display In Menubar', 'topclass-admin'),
            'default' => 1,
            ),
        array(
            'id' => 'section_contact_menu_text',
            'type' => 'text',
            'title' => __('Section Title in Menubar', 'topclass-admin'),
            'default' => "Contact",
            'required' => array('section_contact_display_menu', '=', '1')
            ),

        array(
            'id' => "section_contact_title",
            'type' => 'text',
            'title' => __('Section Title', 'topclass-admin'),
            'default' => "<span>Get In</span> Touch",
            ),
        array(
            'id' => "section_contact_subtitle",
            'type' => 'text',
            'title' => __('Section Subtitle', 'topclass-admin'),
            'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam.",
            ),
        array(
            'id' => "section_select_contact_page",
            'type' => 'select',
            'title' => __('Select Contact Page', 'topclass-admin'),
            'default' => '',            
            'data' => 'pages',
            'args' => array('post_type' => 'page'),
            'multi'    => false,            
            'desc' => __('Or create one Contact Page from <a href="' . site_url() . '/wp-admin/post-new.php?post_type=page">here</a>', 'topclass-admin'),
            ),

        array(
            'id' => 'section_contact_info_display',
            'type' => 'switch',
            'title' => __('Display Contact Info Section', 'topclass-admin'),
            'default' => 0,
            ),        
        array(
            'id' => 'section_contact_details_title',
            'type' => 'text',
            'title' => __('Display Contact Info Section', 'topclass-admin'),
            'default' => 'Contact Details',
            'required' => array('section_contact_info_display', '=', '1'),
            ),
        array(
            'id' => 'section_contact_info_icon_text',
            'type' => 'multi_text',
            'title' => __('Icon and Text', 'topclass-admin'),            
            'required' => array('section_contact_info_display', '=', '1'),
            'default' => "li_location, Address, Inner Circular Road, Broker <br>
            Sector Rang Plaza, UK",
            'desc' => "Icon Class Details: <a href='http://designmodo.com/linecons-free' target='_blank'>Click Here</a> Example with Comma: li_location, +123(00)-456789",
            ),


        )
); //contact

$sections[] = array(
    'title' => __('Footer Section', 'topclass-admin'),
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-edit',
    'fields' => array(

        array(
            'id' => 'section_display_google_map',
            'type' => 'switch',
            'title' => __('Display Google Map', 'topclass-admin'),
            'default' => 1,
            ),  

        array(
            'id' => 'section_contact_description',
            'type' => 'text',
            'title' => __('Marker Details', 'topclass-admin'),
            'default'=>'Local Address , Heritage Site.',
            'required' => array('section_display_google_map', '=', '1')
            ),        
        array(
            'id' => 'jwtheme_google_map_lattitude',
            'type' => 'text',
            'title' => __('Latitude', 'topclass-admin'),
            'default' => "-37.8171097",
            'required' => array('section_display_google_map', '=', '1')
            ),
        array(
            'id' => 'jwtheme_google_map_longitude',
            'type' => 'text',
            'title' => __('Longitude', 'topclass-admin'),
            'default' => "144.9554672",
            'required' => array('section_display_google_map', '=', '1')
            ), 
        array(
            'id' => 'google_map_marker_icon',
            'type' => 'media',
            'title' => __('Marker Icon', 'topclass-admin'),
            'required' => array('section_display_google_map', '=', '1'),
            'default' => array("url" => get_template_directory_uri() . "/assets/images/mapicon.png"),
            'preview' => true,
            "url" => true
            ),

        array(
            'id' => 'section_footer_parallax_image',
            'type' => 'media',
            'title' => __('Footer Parallax Image', 'topclass-admin'),
            'default' => array("url" => get_template_directory_uri() . "/images/background/footer-bg.jpg"),
            'preview' => true,
            "url" => true
            ),
    //Social Section
        array(
            'id' => 'section_display_social_section',
            'type' => 'switch',
            'title' => __('Display Social Section', 'topclass-admin'),
            'default' => 1,
            ),  
        array(
            'id' => 'section_social_facebook',
            'type' => 'text',
            'title' => __('Facebook', 'topclass-admin'),
            'default' => "#",
            'required' => array('section_display_social_section', '=', '1')            
            ),
        array(
            'id' => 'section_social_twitter',
            'type' => 'text',
            'title' => __('Twitter', 'topclass-admin'),
            'default' => "#",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_linkedin',
            'type' => 'text',
            'title' => __('Linked In', 'topclass-admin'),
            'default' => "#",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_google',
            'type' => 'text',
            'title' => __('Google Plus', 'topclass-admin'),
            'default' => "#",
            'required' => array('section_display_social_section', '=', '1')
            ),        
        array(
            'id' => 'section_social_youtube',
            'type' => 'text',
            'title' => __('You Tube', 'topclass-admin'),
            'default' => "#",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_dribbble',
            'type' => 'text',
            'title' => __('Dribbble', 'topclass-admin'),
            'default' => "",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_flickr',
            'type' => 'text',
            'title' => __('Flickr', 'topclass-admin'),
            'default' => "",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_instagram',
            'type' => 'text',
            'title' => __('Instagram', 'topclass-admin'),
            'default' => "",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_pinterest',
            'type' => 'text',
            'title' => __('Pinterest', 'topclass-admin'),
            'default' => "",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_github',
            'type' => 'text',
            'title' => __('Github', 'topclass-admin'),
            'default' => "",
            'required' => array('section_display_social_section', '=', '1')
            ),
        array(
            'id' => 'section_social_rss',
            'type' => 'text',
            'title' => __('RSS', 'topclass-admin'),
            'default' => "",
            'required' => array('section_display_social_section', '=', '1')
            ),


        array(
            'id' => 'jwtheme_copyright_text',
            'type' => 'textarea',
            'title' => __('Copyright Text', 'topclass-admin'),
            'default' => "&copy; <a href='http://topclasswp.jeweltheme.com/'>TopClass</a>  " . date_i18n('Y') . " - Developed by <a href='https://jeweltheme.com/' rel='nofollow'>Jewel Theme</a>"
            )
        )
); //footer

$sections[] = array(
    'icon' => 'el-icon-cogs',
    'icon_class' => 'icon-large',
    'title' => __('404 Settings', 'topclass-admin'),
    'fields' => array(
        array(
            'id' => 'settings_404_parallax_image',
            'type' => 'media',
            'title' => __('404 Parallax Image', 'topclass-admin'),
            'default' => array("url" => get_template_directory_uri() . "/images/background/page-name-bg.jpg")
            ),    

        array(
            'id'=>'settings_404_heading',
            'type' => 'text',
            'title' => __('404  Title', 'topclass-admin'),
            'default'=>'Whoops'
            ),
        array(
            'id'=>'settings_404_subheading',
            'type' => 'text',
            'title' => __('404 Sub Title', 'topclass-admin'),
            'default'=>'The page you are looking for is not available here. Please navigate to the other page or search below!'
            )
        )
); //404

global $ReduxFramework;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);







