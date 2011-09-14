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

//doesn't let people know whether they got their user name or PW wrong on login fail
add_filter('login_errors',create_function('$a', "return null;"));

// trim down the profile page
add_filter('user_contactmethods','hide_profile_fields',10,1);
function hide_profile_fields( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}

// kill the admin nag
if (!current_user_can('edit_users')) {
	add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
	add_filter('pre_option_update_core', create_function('$a', "return null;"));
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

?>