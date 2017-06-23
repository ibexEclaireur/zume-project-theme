<?php
// Calling your own login css so you can style it
function joints_login_css() {
	wp_enqueue_style( 'joints_login_css', get_template_directory_uri() . '/assets/css/login.min.css', false );
}

// changing the logo link from wordpress.org to your site
function joints_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function joints_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'joints_login_css', 10 );
add_filter('login_headerurl', 'joints_login_url');
add_filter('login_headertitle', 'joints_login_title');


function action_bp_signup_pre_validate(){
    if(isset($_POST['signup_email']) && !empty($_POST['signup_email'])){
        $_POST['signup_username'] = md5($_POST['signup_email']);
    }
}
add_action( 'bp_signup_pre_validate', 'action_bp_signup_pre_validate', 10, 0 );


//Remove error for username, only show error for email only.
add_filter('registration_errors', 'remove_username_empty_error', 10, 3);

function remove_username_empty_error($wp_error, $sanitized_user_login, $user_email){

    if(isset($wp_error->errors['empty_username'])){
        $wp_error->remove('empty_username');
    }
    if(isset($wp_error->errors['username_exists'])){
        $wp_error->remove('username_exists');
    }
    return $wp_error;
}

/**
 * New user registrations should have display_name set to 'firstname lastname'
 * Best used on 'user_register'
 * @param int $user_id The user ID
 * @return void
 * @uses get_userdata()
 * @uses wp_update_user()
 */
function set_default_display_name( $user_id ) {
    if (isset($_POST["field_1"])){
        $name =  $_POST["field_1"];
        $args = array(
            'ID' => $user_id,
            'display_name' => $name,
            'nickname' => $name
        );
        wp_update_user( $args );
    }
}
add_action( 'user_register', 'set_default_display_name' );


function default_display_name($name) {
    if ( isset( $_POST['field_1'] ) ) {
        $name = sanitize_text_field( $_POST['field_1'] );
    }
    return $name;
}
add_filter('pre_user_display_name','default_display_name');
