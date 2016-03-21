<?php
// Actions; Functions follow.
add_action('after_setup_theme', 'yumm_setup');
add_action('widgets_init', 'yumm_sidebar');
add_action('wp_enqueue_scripts', 'yumm_scripts');

/**
 * Add Theme supports for thunbnails and title
 */
function yumm_setup() {
	// Add theme support for title and featured image
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
}

/**
 * Register sidebar
 */
function yumm_sidebar() {
	register_sidebar(array(
		'name' => esc_html__('Sidebar', 'yumm'),
		'id' => 'sidebar-1',
		'description' => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}

/**
 * Update jQuery and register script for page expand
 */
function yumm_scripts() {
	if (!is_admin()) {
		// load latest jquery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '1.11.3');
		wp_enqueue_script('jquery');
		wp_enqueue_script('yumm_script', get_template_directory_uri() . '/js/script.js', ['jquery']);
	}
}