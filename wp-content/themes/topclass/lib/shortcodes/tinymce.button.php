<?php


#-----------------------------------------------------------------#
# Register TinyMCE Shortcode Buttons
#-----------------------------------------------------------------#
function jwtheme_tinymce_js() {

    //make sure the user has correct permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
        return;
    }
    
    //only add to visual mode
    if ( get_user_option('rich_editing') == 'true' ) {
        add_filter( 'mce_external_plugins', 'add_js_plugin' );
        add_filter( 'mce_buttons', 'register_jwtheme_tinymce_button' );
    }

}

add_action('init', 'jwtheme_tinymce_js');


function add_js_plugin( $plugin_array ) {
    $plugin_array['jwtheme_buttons'] = get_template_directory_uri() . '/lib/shortcodes/jwtheme.tinymce.js';
    return $plugin_array;
}

#-----------------------------------------------------------------
# Create Button
#-----------------------------------------------------------------
function register_jwtheme_tinymce_button( $buttons ) {
    array_push( $buttons, "jwthemescgenerator" );  // "jwthemescgenerator"  from tinymce.js
    return $buttons; 
}

