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

add_filter("bp_email_recipient_get_name", "get_name_for_email", 10, 3);
function get_name_for_email($name, $recipient){
    $id = $recipient->user_oject->ID;
    return  xprofile_get_field_data(1, $id);
}
