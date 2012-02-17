<?php

/* Used to store functions that I don't always use on every project but often enough to store. */


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
    If using widgets in sidebar, this removes default ones
******************************************* */
// unregister all default WP Widgets
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);


/*  ******************************************
    Customizing the Footer Message
******************************************* */

function custom_admin_footer() {
    echo '<a href="http://mynettworks.com">Web Development by Mynettworks</a>';
} 
add_filter('admin_footer_text', 'custom_admin_footer');


/*  ******************************************
    Custom Login Logo
******************************************* */

function my_custom_login_logo() {
    echo '<style type="text/css"> h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo_admin.png)  !important; } </style>';
}
add_action('login_head',  'my_custom_login_logo');


/*  ******************************************
    REMOVE META BOXES FROM WORDPRESS DASHBOARD FOR ALL USERS
******************************************* */
function example_remove_dashboard_widgets() {
    //Globalize the metaboxes array, this holds all the widgets for wp-admin	global $wp_meta_boxes;	
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
} 
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );


/*  ******************************************
    Change Post to whatever you want
******************************************* */

function change_post_to_article( $translated ) {
    $translated = str_ireplace(  'Post',  'Article',  $translated ); 
    return $translated;
}
add_filter(  'gettext',  'change_post_to_article'  );
add_filter(  'ngettext',  'change_post_to_article'  );


/*  ******************************************
    Remove Meta Boxes from Default POSTS Screen
******************************************* */
function remove_default_post_screen_metaboxes() {
    remove_meta_box( 'postcustom','post','normal' );           // Custom Fields Metabox
    remove_meta_box( 'postexcerpt','post','normal' );          // Excerpt Metabox
    remove_meta_box( 'commentstatusdiv','post','normal' );     // Comments Metabox
    remove_meta_box( 'trackbacksdiv','post','normal' );        // Talkback Metabox
    remove_meta_box( 'slugdiv','post','normal' );              // Slug Metabox
    remove_meta_box( 'authordiv','post','normal' );            // Author Metabox
}
add_action('admin_menu','remove_default_post_screen_metaboxes');


/*  ******************************************
   Remove Meta Boxes from Default PAGES Screen
******************************************* */   
function remove_default_page_screen_metaboxes() {
    remove_meta_box( 'postcustom','post','normal' );           // Custom Fields Metabox
    remove_meta_box( 'postexcerpt','post','normal' );          // Excerpt Metabox
    remove_meta_box( 'commentstatusdiv','post','normal' );     // Comments Metabox
    remove_meta_box( 'trackbacksdiv','post','normal' );        // Talkback Metabox
    remove_meta_box( 'slugdiv','post','normal' );              // Slug Metabox
    remove_meta_box( 'authordiv','post','normal' );            // Author Metabox
}
add_action('admin_menu','remove_default_page_screen_metaboxes');

/*  ******************************************
   Adds Excerpt boxes for pages
******************************************* */
if ( function_exists('add_post_type_support')) {
    add_action('init', 'add_page_excerpts');
        function add_page_excerpts() {        
            add_post_type_support( 'page', 'excerpt' );
        }
    }



?>