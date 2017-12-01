<?php

function zume_theme_enqueue_script( $handle, $rel_src, $deps = array(), $in_footer = false ) {
    wp_enqueue_script( $handle, get_template_directory_uri() . "/$rel_src", $deps, filemtime( get_template_directory() . "/$rel_src" ), $in_footer );
}

function zume_theme_enqueue_style( $handle, $rel_src, $deps, $media = 'all' ) {
    wp_enqueue_style( $handle, get_template_directory_uri() . "/$rel_src", $deps, filemtime( get_template_directory() . "/$rel_src" ), $media );
}

function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Load What-Input files in footer
    zume_theme_enqueue_script( 'what-input', 'dependencies/what-input/dist/what-input.min.js', array(), true );

    // Load fitvids script https://github.com/rosszurowski/fitvids
    zume_theme_enqueue_script('fitvids', 'assets/js/fitvids.min.js', array(), false);

    // Adding Foundation scripts file in the footer
    zume_theme_enqueue_script( 'foundation-js', 'assets/js/foundation.min.js', array( 'jquery' ), true );

    // Adding scripts file in the footer
    zume_theme_enqueue_script( 'site-js', 'assets/js/scripts.min.js', array( 'jquery' ), true );

    zume_theme_enqueue_style( 'buddypress-css', 'assets/css/buddypress.css', array(), 'all' );

    // Register main stylesheet
    zume_theme_enqueue_style( 'site-css', 'assets/css/style.min.css', array(), 'all' );

    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      zume_theme_enqueue_script( 'comment-reply' );
    }


    $stats = Zume_Stats::instance();
    $url_path = trim( parse_url( add_query_arg( array() ), PHP_URL_PATH ), '/' );
    if ("stats" ===  $url_path){
        wp_enqueue_script( 'google-charts', 'https://www.gstatic.com/charts/loader.js', array(),  false );
        wp_enqueue_script('stats',   get_template_directory_uri() . '/assets/js/stats.js', array('jquery', 'google-charts'), '', false );
        wp_localize_script(
            "stats", "wpApiSettings", array(
                "test" => "test1",
                "locations" => $stats->get_group_locations(),
                "sizes" => $stats->get_group_sizes()
            )
        );

    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);
