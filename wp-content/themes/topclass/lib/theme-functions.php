<?php
/*
* Theme Option Functions
*/

// Favicon Image
if (!function_exists("jwtheme_favicon")) {
    function jwtheme_favicon(){
        global $jwtheme_topclass;        
        if( $jwtheme_topclass['show_favicon'] ){
            echo '<link rel="shortcut icon" href="' . $jwtheme_topclass['favicon_icon']['url'] .'" >';            
        } else {
            echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.png" >';
        }
    }
}



// Custom Admin Logo Login
if(!function_exists('jwtheme_admin_logo_login')){
    function jwtheme_admin_logo_login(){
        global $jwtheme_topclass;
        if( $jwtheme_topclass['admin_logo']['url'] ){
            ?>
            <style type="text/css">
                body.login div#login h1 a {
                    background-image: url("<?php echo $jwtheme_topclass['admin_logo']['url'];?>");
                    padding-bottom: 30px;
                }
            </style>

            <?php } else { ?>

            <style type="text/css">
                body.login div#login h1 a {
                    background-image: url('<?php echo admin_url('/images/wordpress-logo.png');?>');
                    padding-bottom: 30px;
                }
            </style>

            <?php }
        }
        add_action( 'login_enqueue_scripts', 'jwtheme_admin_logo_login' );
    }


// Logo Login URL changed from wordpress.org to Site URL
if(!function_exists('jwtheme_logo_login_url')){
    function jwtheme_logo_login_url(){
        return site_url();
    }
    add_filter( 'login_headerurl', 'jwtheme_logo_login_url' );
}