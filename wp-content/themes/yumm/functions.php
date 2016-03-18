<?php

// Actions; Functions follow.
add_action('after_setup_theme', 'yumm_setup');
add_action('widgets_init', 'yumm_widgets');
add_action('init', 'yumm_post_type', 0);
add_action('wp_enqueue_scripts', 'yumm_scripts');

// Functions
function yumm_setup()
{
    // Add theme support for title and featured image
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

// Register a sidebar
function yumm_widgets()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'yumm'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
function yumm_post_type()
{
    register_taxonomy('recipe-category', 'recipe', array(
         'label' => 'Categories',
        'singular_name' => 'Category',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'hierarchical' => true,
    ));
    register_post_type('recipe', array(
         'labels' => array(
             'name' => __('Recipes'),
            'singular_name' => __('Recipe'),
        ),
        'public' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'taxonomies' => array(
             'recipe-category',
        ),
        'show_in_rest' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'capability_type' => 'post',
        'supports' => array(
             'title',
            'excerpt',
            'editor',
            'author',
            'thumbnail',
            'comments',
            'revisions',
            'custom-fields',
        ),
    ));
}

function yumm_scripts() {
	if (!is_admin()) {
		// load latest jquery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '1.11.3');
		wp_enqueue_script('jquery');
		wp_enqueue_script('yumm_script', get_template_directory_uri() . '/js/script.js', ['jquery']);
	}
}
