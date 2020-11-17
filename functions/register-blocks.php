<?php
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a About block.
        acf_register_block_type(array(
            'name'              => 'About',
            'title'             => __('About'),
            'description'       => __('A custom about block.'),
            'render_template'   => 'templates/blocks/about.php',
            'category'          => 'formatting',
            'icon'              => 'table-row-after',
            'keywords'          => array( 'about', 'services' ),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a full cover block.
        acf_register_block_type(array(
            'name'              => 'Full cover',
            'title'             => __('Full cover'),
            'description'       => __('A custom Full cover block.'),
            'render_template'   => 'templates/blocks/full-cover.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array( 'cover', 'full' ),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a list cover block.
        acf_register_block_type(array(
            'name'              => 'List cover',
            'title'             => __('List cover'),
            'description'       => __('A custom List cover block.'),
            'render_template'   => 'templates/blocks/list-cover.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array( 'cover', 'full', 'list' ),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a contacts block.
        acf_register_block_type(array(
            'name'              => 'Contacts',
            'title'             => __('Contacts'),
            'description'       => __('A custom contacts block.'),
            'render_template'   => 'templates/blocks/contacts.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array('contacts'),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a presentation block.
        acf_register_block_type(array(
            'name'              => 'Presentation',
            'title'             => __('Presentation'),
            'description'       => __('A custom presentation block.'),
            'render_template'   => 'templates/blocks/presentation.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array('presentation', 'cover'),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a projects block.
        acf_register_block_type(array(
            'name'              => 'Actual projects',
            'title'             => __('Actual projects'),
            'description'       => __('A custom Actual projects block.'),
            'render_template'   => 'templates/blocks/projects.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array('projects'),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a Side list block.
        acf_register_block_type(array(
            'name'              => 'Side list',
            'title'             => __('Side list'),
            'description'       => __('A custom Side list block.'),
            'render_template'   => 'templates/blocks/side-list.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array('list'),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
        // register a Chose list block.
        acf_register_block_type(array(
            'name'              => 'Chose list',
            'title'             => __('Chose list'),
            'description'       => __('A custom Chose list block.'),
            'render_template'   => 'templates/blocks/chose-list.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array('list'),
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'надзаголовок' => 'надзаголовок',
                        'is_preview' => true
                    )
                )
            )
        ));
    }
}