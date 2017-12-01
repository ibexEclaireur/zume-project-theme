<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $zume_cookies = explode( '; ', $_SERVER['HTTP_COOKIE'] );
    foreach ($zume_cookies as $zume_cookie) {
        $zume_parts = explode( "=", $zume_cookie, 2 );
        $zume_name = $zume_parts[0];
        if (preg_match( "/^wordpress_/", $zume_name )) {
            setcookie( $zume_name, "", time() -1000 );
            setcookie( $zume_name, "", time() -1000, "/" );
        }
    }
    if (isset( $_POST['redirect_to'] ) && preg_match( "/^\//", $_POST["redirect_to"] )) {
        header( "Location: $_POST[redirect_to]" );
    } else {
        header( "Location: /wp-login.php" );
    }
}
else {
    ?>

    <p>
        Some users have experienced issues with the log in process. If you're
        one of them, click this button, and then try to log in again.
    </p>

    <form action="" method="post">
        <button type="submit">Clear cookies</button>
    </form>
    <?php
}
