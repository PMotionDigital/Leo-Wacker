<?php

add_action('wp_ajax_formular', 'get_formular');
add_action('wp_ajax_nopriv_formular', 'get_formular');

function get_formular() {
    $type = $_GET['type'];
    echo $type;
    die;
}