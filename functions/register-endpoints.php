<?php 

add_action( 'rest_api_init', 'objects_route' );

function objects_route () {
    register_rest_route( 'objects-list/v1', '/objects', array(
        'methods' => 'GET',
        'callback' => 'my_awesome_func',
        'permission_callback' =>  '__return_true'
    ) );
}
function my_awesome_func () {
    $args = array(
        'post_type' => 'object',
        'numberposts' => -1
    );

    $posts = get_posts($args);
    $objects = array();
    global $post;
    foreach($posts as $post): setup_postdata($post);
        $object = array();
        $object['id'] = get_the_ID();
        $object['name'] = get_the_title();
        $object['price'] = get_field('price');
        $object['area'] = get_field('area');
        $object['room'] = get_field('room');
        $object['living_space'] = get_field('living_space');
        $object['type_name'] = wp_get_post_terms(  $object['id'], 'object_type')[0]->name;
        $object['type_id'] = wp_get_post_terms(  $object['id'], 'object_type')[0]->term_id;
        $object['thumbnail'] = get_the_post_thumbnail_url();
        $object['coords'] = array(
            'lng' => get_field('longitude'),
            'lat' => get_field('latitude')
        );
        $objects[] = $object;
    endforeach;

    wp_reset_postdata(); 
    return $objects;
    die;
}