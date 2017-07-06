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


//set the display name before the user is created/activate
add_filter("bp_email_recipient_get_name", "get_name_for_email", 10, 3);
function get_name_for_email($name, $recipient){
    $user = $recipient->get_user();
    $display_name = null;
    if (isset($user->ID)){
        $id = $user->ID;
        $display_name =  xprofile_get_field_data(1, $id);
    }

    if ($display_name){
        return $display_name;
    } else {
        if (isset($_POST["field_1"])){
            return $_POST["field_1"];
        } else {
            return $name;
        }
    }
}


function custom_login_footer() {
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
    <div style="width: 550px; max-width: 90%; padding: 20px 0; margin: auto">
        Looking for the old site? Visit
        <a href="https://old.zumeproject.com">old.zumeproject.com</a>.
        <br>
        Some users have experienced issues with the log in process. If you're
        one of them, click this button, and then try to log in again.
        <form action="<?php echo esc_attr($clear_cookies_path) ?>" method="post" class="inline-form">
            <input type=hidden name=redirect_to value="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>">
            <button type=submit>Clear cookies</button>
        </form>
        <br>
        Contact us at <a href="mailto:<?php echo antispambot("info@zumeproject.com"); ?>"><?php echo antispambot("info@zumeproject.com"); ?></a>.
    </div>

    <?php
}
add_action("login_footer", "custom_login_footer");
