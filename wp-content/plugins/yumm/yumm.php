<?php  
/**
 *  Plugin Name: Yumm Plugin
 *  Description: Plugin to accomply yumm theme
 *  Author: Nichole Boseman
 *  Author URI: http://www.newhopefertility.com
 *  Version: 0.9
 */

add_action('widgets_init', 'yumm_widgets');
add_action('init', 'yumm_post_type', 0);
add_action('wp_enqueue_scripts', 'yumm_scripts');

/**
 * Register Wiget
 */
function yumm_widgets() {
    register_widget( 'Yumm_Widget' );
}

/**
 * Create custom taxonomy and recipe post type
 */
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

class Yumm_Widget extends WP_Widget {
	/*
	 * Register Widget with wordpress
	 */
	function __construct() {
		parent::__construct(
				'Yumm Widget', // Base ID
				__('Yumm Recipe Categories', 'text_domain'), // Name
				array( 'description' => __( 'Widget to view Yumm Recipe Categories', 'text_domain' ), ) // Args
				);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo __( 'Category', 'text_domain' );
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

