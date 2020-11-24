<?php

add_theme_support('post-thumbnails');

// settings site

if (function_exists('acf_add_options_page')) {

    $option_page = acf_add_options_page(
        array(
            'page_title' => 'Настройки сайта',
            'menu_title' => 'Настройки сайта',
            'menu_slug'  => 'options',
            'capability' => 'edit_posts',
            'redirect'   => false
        )
    );
}

// includes 

include 'functions/register-blocks.php';
include 'functions/register-post-types.php';
include 'functions/register-endpoints.php';




function my_acf_google_map_api( $api ){
    $api_key = 'AIzaSyDPvFMTg4kMp4G8FJOJMQAgJrkSaG1wls0';
	$api['key'] = $api_key; // Ваш ключ Google API
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// автообновление версии файлов

function my_theme_load_resources() {

    $theme_uri = get_template_directory_uri();
    $theme_styles = $theme_uri.'/dist/css/style.bundle.css';
    $theme_scripts = $theme_uri.'/dist/js/bundle.js';


    // global style connected
  
    wp_register_style('my-theme-style', $theme_styles , false, filemtime(get_stylesheet_directory() .'/dist/css/style.bundle.css'));
    wp_enqueue_style('my-theme-style');
        
    // scripts connected
        
    wp_register_script('my_theme_functions', $theme_scripts , array('jquery'), filemtime(get_stylesheet_directory() .'/dist/css/style.bundle.css'), true);
    wp_enqueue_script('my_theme_functions'); 
  }

  add_action('wp_enqueue_scripts', 'my_theme_load_resources');
