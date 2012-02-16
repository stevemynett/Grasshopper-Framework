<?php

/*  ******************************************
    Does anyone use AIM or Jabber anymore?
******************************************* */

function hide_profile_fields( $contactmethods ) {
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    return $contactmethods;
}
add_filter('user_contactmethods','hide_profile_fields',10,1);


/*  ******************************************
    Kill the Admin Nag
******************************************* */

if ( !current_user_can('administrator') ) {
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

/*  ******************************************
    Removes everything in the restricted array in the menu
******************************************* */
function remove_menus () {
    global $menu;
    $restricted = array(__('Media'), __('Links'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }
}


?>