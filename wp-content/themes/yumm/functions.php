<?php
// Actions; Functions follow.
add_action('after_setup_theme', 'yumm_setup');
add_action('widgets_init', 'yumm_sidebar');

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
function yumm_sidbar() {
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