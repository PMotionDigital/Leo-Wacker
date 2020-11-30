<?php 

add_action( 'rest_api_init', 'objects_route' );

function objects_route () {
    register_rest_route( 'objects-list/v1', '/objects/(?P<loc>\d+)', array(
        'methods' => 'GET',
        'callback' => 'my_awesome_func',
        'permission_callback' =>  '__return_true'
    ) );
    // register_rest_route( 'objects-list/v1', '/objects/(?P<id>\d+)', array(
    //     'methods' => 'GET',
    //     'callback' => 'get_object',
    //     'permission_callback' =>  '__return_true'
    // ) );
}
function get_object() {
    
}
function my_awesome_func ($data) {
    $loc = $data['loc'];
    $langs = array(
        1 => 'ru',
        2 => 'en',
        3 => 'de'
    );
    $lang = '';
    
    if($loc){
        $lang = $langs[$loc];
    }
    $args = array(
        'post_type' => 'object',
        'numberposts' => -1,
        'lang' => $lang
    );

    $posts = get_posts($args);
    $objects = array();
    $areas = get_field('area_-_translations', 'options');
    global $post;
    foreach($posts as $post): setup_postdata($post);
        $object = array();
        $object['id'] = get_the_ID();
        $object['lang'] = $lang;
        $object['name'] = get_the_title();
        $object['price'] = get_field('price');
        //
        foreach($areas as $area){
            if($area['slug'] == get_field('area')){
                $object['area'] = $area[$lang];
            }
        }
       
        $object['room'] = get_field('room');
        $object['living_space'] = get_field('living_space');
        $terms = wp_get_post_terms(  $object['id'], 'object_type');
        foreach($terms as $term){
            $object['type_name'][] = $term->name;
        }   
        //$object['type_name'] = wp_get_post_terms(  $object['id'], 'object_type')[0]->name;
        //$object['type_id'] = wp_get_post_terms(  $object['id'], 'object_type')[0]->term_id;
        if(get_the_post_thumbnail_url()):
            $object['thumbnail'] = get_the_post_thumbnail_url();
        else: 
            $object['thumbnail'] = get_field('image_-_placeholder', 'option');
        endif;
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