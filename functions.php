<?php

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

// embed jquery via Google's CDN

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

function excerpt($limit) {
	$excerpt = explode(' ', get_the_content(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*]`','',$excerpt);
	$excerpt = preg_replace("/<img(.*?)>/si", "", $excerpt);
	$excerpt = preg_replace("/<em(.*?)>/si", "", $excerpt);
	return $excerpt;preg_replace('`\[[^\]]*]`','',$excerpt);
	
}

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

function post_meta() {
	include 'meta.php';
}

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

// trim down the profile page
add_filter('user_contactmethods','hide_profile_fields',10,1);
function hide_profile_fields( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}

// kill the admin nag
if ( !current_user_can('administrator') ) {
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

// category id in body and post class
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

// customize admin footer text
function custom_admin_footer() {
	echo '<a href="http://mynettworks.com">Web Development by Mynettworks</a>';
} 
add_filter('admin_footer_text', 'custom_admin_footer');

// remove nofollow from comments
function xwp_dofollow($str) {
	$str = preg_replace(
		'~<a ([^>]*)\s*(["|\']{1}\w*)\s*nofollow([^>]*)>~U',
		'<a ${1}${2}${3}>', $str);
	return str_replace(array(' rel=""', " rel=''"), '', $str);
}

//Removes everything in the restricted array
function remove_menus () {
global $menu;
	$restricted = array(__('Media'), __('Links'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');
remove_filter('pre_comment_content',     'wp_rel_nofollow');
add_filter   ('get_comment_author_link', 'xwp_dofollow');
add_filter   ('post_comments_link',      'xwp_dofollow');
add_filter   ('comment_reply_link',      'xwp_dofollow');
add_filter   ('comment_text',            'xwp_dofollow');


// Some Admin Customization
// CUSTOM ADMIN LOGIN HEADER LOGO

function my_custom_login_logo() {
	//echo '<style  type="text/css"> h1 a {  background-image:url('.get_bloginfo('template_directory').'/images/logo_admin.png)  !important; } </style>';
}
add_action('login_head',  'my_custom_login_logo');

// REMOVE META BOXES FROM WORDPRESS DASHBOARD FOR ALL USERS
function example_remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin	global $wp_meta_boxes;	
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
} 
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );


// Extend the edit comments to include delete and mark as spam
// delete_comment_link(get_comment_ID()); added in comments.php as well 
function delete_comment_link($id) {
	if (current_user_can('edit_post')) {
 		echo '| <a href="'.admin_url("comment.php?action=cdc&c=$id").'">del</a> ';
		echo '| <a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">spam</a>';
  }
}


// This code automatically rejects any request for comment posting coming from a browser (or, more commonly, a bot) that has no referrer in the request. Checking is done with the PHP $_SERVER[] array. If the referrer is not defined or is incorrect, the wp_die function is called and the script stops its execution

function check_referrer() {
	if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == “”) {
		wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, bugger off!') );
	}
}
add_action('check_comment_flood', 'check_referrer');

// adds the browser to the body class function
	add_filter('body_class','browser_body_class');
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

// http://wp.smashingmagazine.com/2009/12/14/advanced-power-tips-for-wordpress-template-developers-reloaded/
// Customizing the Dashboard. Adding some stuff, remove some stuff
// Other options discussed at http://wp.smashingmagazine.com/2011/05/10/new-wordpress-power-tips-for-template-developers-and-consultants/

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	wp_add_dashboard_widget('custom_help_widget', 'Help and Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
	echo '<p>Custom welcome message goes here.</p>';
}

// Changes Posts to Articles
// http://wp.smashingmagazine.com/2011/05/10/new-wordpress-power-tips-for-template-developers-and-consultants/
// left on by default. Comment out to revert back
// Only works in php5
add_filter(  'gettext',  'change_post_to_article'  );
add_filter(  'ngettext',  'change_post_to_article'  );
function change_post_to_article( $translated ) {
	$translated = str_ireplace(  'Post',  'Article',  $translated ); 
	return $translated;
}

// Removes <p> tags from being auto inserted around images
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function replace_excerpt($content) {
    return str_replace('[...]',
    '<div class="more-link"><a href="'. get_permalink() .'">Continue Reading</a></div>',
    $content
    );
}
add_filter('the_excerpt', 'replace_excerpt');

function sm_title() {
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
?>