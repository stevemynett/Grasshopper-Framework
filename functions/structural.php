<?php

/*  ******************************************
    Default Customization for the Sidebars *
******************************************* */

if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'sidebar1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
));
    register_sidebar(array('name'=>'sidebar2',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
));


/*  ******************************************
    Load up Google's jQuery 
******************************************* */

$url = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'; // the URL to check against
$test_url = @fopen($url,'r'); // test parameters
if($test_url !== false) { // test if the URL exists
    function load_external_jQuery() { // load external file
        wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'); // register the external file
        wp_enqueue_script('jquery'); // enqueue the external file
    }
	add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function
} else {
    function load_local_jQuery() {
        wp_deregister_script('jquery'); // initiate the function
        wp_register_script('jquery', bloginfo('template_url').'/js/jquery.js', __FILE__, false, '1.7.1', true); // register the local file
        wp_enqueue_script('jquery'); // enqueue the local file
    }
add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function
}






?>