<?php

/*  ******************************************
    Custom Excerpt
******************************************* */

function custom_excerpt($length='',$more_txt='Read More') {
    $default_length = 30;
    if (empty($length)) {
        $excerpt_length = $default_length;
    } else {
        $excerpt_length = $length;
    }
    $excerpt = excerpt($excerpt_length);
    $link = '<a href="'.get_permalink($post->ID).'" class="more_link">'.$more_txt.'</a>';
    $output = "$excerpt $link";
    echo wpautop($output, true);
}


/*  ******************************************
    Remove all the junk from the head
******************************************* */

function disable_version() { return ''; }
add_filter('the_generator','disable_version');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


/*  ******************************************
    category id in body and post class
******************************************* */

function category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category)
        $classes [] = 'cat-' . $category->cat_ID . '-id';
        return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

/*  ******************************************
    adds the browser to the body class function
******************************************* */

function browser_body_class($classes) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) $classes[] = 'ie';
    else $classes[] = 'unknown';
    if($is_iphone) $classes[] = 'iphone';
    return $classes;
}
add_filter('body_class','browser_body_class');

/*  ******************************************
    remove nofollow from comments
******************************************* */

function xwp_dofollow($str) {
    $str = preg_replace(
    '~<a ([^>]*)\s*(["|\']{1}\w*)\s*nofollow([^>]*)>~U',
    '<a ${1}${2}${3}>', $str);
    return str_replace(array(' rel=""', " rel=''"), '', $str);
}

remove_filter( 'pre_comment_content', 'wp_rel_nofollow' );
add_filter( 'get_comment_author_link', 'xwp_dofollow' );
add_filter( 'post_comments_link',      'xwp_dofollow' );
add_filter( 'comment_reply_link',      'xwp_dofollow' );
add_filter( 'comment_text',            'xwp_dofollow' );


/*  ******************************************
    Extend the edit comments to include delete and mark as spam
    delete_comment_link(get_comment_ID()); added in comments.php as well
******************************************* */

function delete_comment_link($id) {
    if (current_user_can('edit_post')) {
        echo '| <a href="'.admin_url("comment.php?action=cdc&c=$id").'">del</a> ';
        echo '| <a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">spam</a>';
    }
}


/*  ******************************************
    This code automatically rejects any request for comment posting coming from a browser 
    (or, more commonly, a bot) that has no referrer in the request. Checking is done with the 
    PHP $_SERVER[] array. If the referrer is not defined or is incorrect, the wp_die function 
    is called and the script stops its execution
******************************************* */

function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == “”) {
        wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, bugger off!') );
    }
}
add_action('check_comment_flood', 'check_referrer');


/*  ******************************************
    Remove P tags from imgs
******************************************* */
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


/*  ******************************************
    remove extra css that recent comments widget injects
******************************************* */
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');


/*  ******************************************
    add feed links to header
******************************************* */



/*  ******************************************
    no more jumping for read more link to header
******************************************* */

function no_more_jumping($post) {
    return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
}
add_filter('excerpt_more', 'no_more_jumping');


?>