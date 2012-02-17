<?php

/*  ******************************************
    Calls the custom meta file
******************************************* */

function post_meta() {
	include 'meta.php';
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








?>