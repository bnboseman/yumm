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
add_action('admin_init', 'yumm_initialize_options');

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
	// crerate new taxonomy for the recipe category
    register_taxonomy('recipe-category', 'recipe', array(
         'label' => 'Categories',
        'singular_name' => 'Category',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'hierarchical' => true,
    ));
    
	// Set up arguments for recipe post type
    $args = array(
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
            'editor',
            'author',
            'thumbnail',
            'custom-fields',
        ),
    );
    
    
    // Check to see if comments are enabled for recipes; if enabled allow comments
    $comments_setting = get_option( 'yumm_recipe_comments');
    if ($comments_setting == "1") {
    	array_push($args['supports'], 'comments');
    }
    
    // register recipe post type
    register_post_type('recipe', $args);
}

/**
 * Register Options
 */
function yumm_initialize_options() {
	// Register new setting to dissussion page
	register_setting(
			'discussion',							// option group
			'yumm_recipe_comments');				// option name
	
	// Create the setting field for the page
	add_settings_field(
			'yumm_recipe_comment', 				// id
			__('Recipe Comments'),					// title
			'yumm_comments_input',					//callback
			'discussion',							// page;
			'default');							// settings section
}

/**
 * Funtion to show the checkbox for if to allow comments or not
 */
function yumm_comments_input() {
	$setting = get_option( 'yumm_recipe_comments');
	?>
	<div>
		<label for="yumm_recipe_comments">
		<input name="yumm_recipe_comments" type="checkbox" id="yumm_recipe_comments" value="1" <?php echo $setting == '1' ? 'checked="checked"':'' ; ?>">
		Allow Comments on Recipes</label>
	</div>	
<?php }


/**
 * Widget to show all recipe categories 
 * @author nboseman
 *
 */
class Yumm_Widget extends WP_Widget {
	/**
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
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['yumm_widget_title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['yumm_widget_title'] ). $args['after_title'];
		}
		echo '<h2>' . __( 'Recipes', 'text_domain' ) . '</h2>';
		echo '<ul>';
		wp_list_categories( ['taxonomy' => 'recipe-category','title_li' => null] );
		echo '</ul>';
		echo $args['after_widget'];
	}
	/**
	 * Sanitize widget form values as they are saved.
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['yumm_widget_title'] = ( ! empty( $new_instance['yumm_widget_title'] ) ) ? strip_tags( $new_instance['yumm_widget_title'] ) : '';
		return $instance;
	}
}
