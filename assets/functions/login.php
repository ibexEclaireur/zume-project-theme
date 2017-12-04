<?php
// Calling your own login css so you can style it
function zume_joints_login_css() {
    wp_enqueue_style( 'zume_joints_login_css', get_template_directory_uri() . '/assets/css/login.min.css', array(),
    filemtime( get_template_directory() . '/assets/css/login.min.css' ) );
}

// changing the logo link from wordpress.org to your site
function zume_joints_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function zume_joints_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'zume_joints_login_css', 10 );
add_filter( 'login_headerurl', 'zume_joints_login_url' );
add_filter( 'login_headertitle', 'zume_joints_login_title' );


//set the display name before the user is created/activate
add_filter( "bp_email_recipient_get_name", "zume_get_name_for_email", 10, 3 );
function zume_get_name_for_email($name, $recipient){
    $user = $recipient->get_user();
    $display_name = null;
    if (isset( $user->ID )){
        $id = $user->ID;
        $display_name = xprofile_get_field_data( 1, $id );
    }

    if ($display_name){
        return $display_name;
    } else {
        if (isset( $_POST["field_1"] )){
            return $_POST["field_1"];
        } else {
            return $name;
        }
    }
}


function zume_custom_login_footer() {
    $clear_cookies_path = get_template_directory_uri() . '/clear_cookies.php';
    ?>
    <style>
        .inline-form,
        .login .inline-form {
            margin: 0;
            padding: 0;
            display: inline;
            background: transparent;
            box-shadow: none;
        }
    </style>
    <div class="zume_after_login_message"><p>
        If you experience any issues with logging in,
        <?php /* @codingStandardsIgnoreLine */ ?>
        contact us at <a href="mailto:<?php echo antispambot( "info@zumeproject.com" ); ?>"><?php echo antispambot( "info@zumeproject.com" ); ?></a>.
    </p></div>

    <?php
}
add_action( "login_footer", "zume_custom_login_footer" );
