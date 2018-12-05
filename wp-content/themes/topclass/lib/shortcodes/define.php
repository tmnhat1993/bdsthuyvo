<?php
#-----------------------------------------------------------------
# Columns
#-----------------------------------------------------------------

$jwtheme_shortcodes = array();


//Post Types
$jwtheme_shortcodes['header_4'] = array( 
    'type'=>'heading', 
    'title'=>__('Post Types', 'jwtheme'),

    
    );

// Portfolio
$jwtheme_shortcodes['portfolio'] = array( 
    'type'=>'radios', 
    'title'=>__('Portfolio', 'jwtheme'), 
    );



// Pricing Table
$terms = array(__('Select Table Name', 'jwtheme'));
$args = array ( 'post_type' => 'pricing' );

// The Query
$query = new WP_Query( $args );

// The Loop
while ( $query->have_posts() ) { $query->the_post(); {
    $terms[get_the_ID()] = get_the_title();  
}
}

// pricing table
$jwtheme_shortcodes['pricing'] = array( 
    'type'=>'radios', 
    'title'=>__('Pricing Table', 'jwtheme' ),
    'attr'=>array(
        'id'=>array(
            'type'=>'select', 
            'title'=> __('Table Name', 'jwtheme'), 
            'values'=>  $terms
            ),
        ) 
    );


// Slider
$jwtheme_shortcodes['slider'] = array( 
    'type'=>'radios', 
    'title'=>__('Slider', 'jwtheme' ),
    'attr'=>array(
        'slidesno'=>array(
            'type'=>'text', 
            'title'=> __('No. Of Slides', 'jwtheme'), 
            ), 
        )
            
    );


// Team
$jwtheme_shortcodes['team'] = array( 
    'type'=>'radios', 
    'title'=>__('Team', 'jwtheme'),
    );


// Testimonial
$jwtheme_shortcodes['testimonial'] = array( 
    'type'=>'radios', 
    'title'=>__('Testimonial', 'jwtheme' )
    );


// service
$jwtheme_shortcodes['service'] = array( 
    'type'=>'radios', 
    'title'=>__('Service', 'jwtheme' )
    );
