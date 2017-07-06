<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cookies = explode('; ', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode("=", $cookie, 2);
        $name = $parts[0];
        if (preg_match("/^wordpress_/", $name)) {
            setcookie($name, "", time()-1000);
            setcookie($name, "", time()-1000, "/");
        }
    }
    if (isset($_POST['redirect_to']) && preg_match("/^\//", $_POST["redirect_to"])) {
        header("Location: $_POST[redirect_to]");
    } else {
        header("Location: /wp-login.php");
    }
}
