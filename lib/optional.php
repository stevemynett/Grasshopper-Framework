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

?>