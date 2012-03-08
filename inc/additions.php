<?php

/*  ******************************************
    Calls the custom meta file
******************************************* */

function post_meta() {
	include TEMPLATEPATH.'/meta.php';
}

/*  ******************************************
    The best title function I've found so far
******************************************* */

function my_title() {
    if (function_exists('is_tag') && is_tag()) {
        echo 'Tag Archive for &quot;'.$tag.'&quot; - ';
    } elseif (is_archive()) {
         wp_title(''); echo ' Archive - ';
    } elseif (is_search()) {
        echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
    } elseif (!(is_404()) && (is_single()) || (is_page() && ! is_front_page())) {
        wp_title(''); echo ' - ';
    } elseif (is_404()) { 
        echo 'Not Found - ';
    } if (is_front_page()) {
        bloginfo('name'); echo ' - '; bloginfo('description'); 
    } else {
        bloginfo('name');
    }
}

/*  ******************************************
    If it is a child of a page, or the page itself
******************************************* */
function is_tree($pid) {     
    global $post;         
    if(is_page()&&($post->post_parent==$pid||is_page($pid)))
        return true;  
    else
        return false; 
};


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