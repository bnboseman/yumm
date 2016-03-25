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
add_action('add_meta_boxes', 'yumm_add_recipe_meta_box');
add_action( 'save_post', 'yumm_save_recipe_meta_box' );
add_filter( 'the_content', 'yumm_recipe_content_update' );

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

// Prep time meta box
function yumm_add_recipe_meta_box() {
	add_meta_box('yumm_recipe_meta', 'Recipe Options', 'yumm_recipe_meta_box', 'recipe', 'normal', 'high' );
}

function yumm_recipe_meta_box() {
	global $post;

	echo '
		<input type="hidden" name="yumm_nonce" id="yumm_nonce" value="'. wp_create_nonce() . '" />
		<label for="yumm_prep_time">Prep Time: </label>
		<input class="widefat" type="text" name="yumm_prep_time" value="' . get_post_meta($post->ID, 'prep_time', true ) . '" />
		<label for="yumm_ready_in">Ready In: </label>
		<input class="widefat" type="text" name="yumm_ready_in" value="' . get_post_meta($post->ID, 'ready_in', true ) . '" />
        <label for="yumm_calories">Calories per serving: </label>
		<input class="widefat" type="text" name="yumm_calories" value="' . get_post_meta($post->ID, 'calories', true ) . '" />
		<label for="yumm_servings">Servings: </label>
		<input class="widefat" type="text" name="yumm_servings" value="' . get_post_meta($post->ID, 'servings', true ) . '" />
		';

}

function yumm_recipe_content_update($content) {
	if ($GLOBALS['post']->post_type == 'recipe') {
		$id = $GLOBALS['post']->ID;

		$prep_time = get_post_meta($id, 'prep_time', true );
		$ready_in = get_post_meta($id, 'ready_in', true );
		$calories = get_post_meta($id, 'calories', true );
		$servings = get_post_meta($id, 'servings', true ) ;
		$add_on_data = '';
		if(!empty($prep_time) ) {
			$add_on_data  .= '<strong>Prep Time: </strong>' . $prep_time . '<br />';
		}

		if (!empty($ready_in) ) {
			$add_on_data  .= '<strong>Ready In: </strong>' . $ready_in . '<br />';
		}

		if(!empty($servings) ) {
			$add_on_data  .= '<strong>Servings: </strong>' . $servings . '<br />';
		}

		if (!empty($calories) ) {
			$add_on_data  .= '<strong>Calories per serving: </strong>' . $calories . '<br />';
		}

		if (!empty($add_on_data)) {
			if (strpos($content, '[recipe-info]') !== false) {
				return str_replace('[recipe-info]', "<div class=\"recipe_info\">$add_on_data</div>", $content);
			}
			return "<div class=\"recipe_info\">$add_on_data</div>$content";
		}
	}

	return $content;
}

function yumm_save_recipe_meta_box($post_id) {
	if ( 'recipe' == $_POST['post_type'] ) {
		if ( ! wp_verify_nonce($_POST['yumm_nonce']) ) {
			return $post_id;
		}
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check permissions to edit pages and/or posts
		if ( !current_user_can( 'edit_page', $post_id ) || !current_user_can( 'edit_post', $post_id ))
			return $post_id;

		$prep_time = $_POST['yumm_prep_time'];
		$servings = $_POST['yumm_servings'];
		$ready_in = $_POST['yumm_ready_in'];
		$calories = $_POST['yumm_calories'];

		update_post_meta($post_id, 'prep_time', $prep_time);
		update_post_meta($post_id, 'servings', $servings);
		update_post_meta($post_id, 'calories', $calories);
		update_post_meta($post_id, 'ready_in', $ready_in);
	}
}

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
				'yumm_widget', // Base ID
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
		echo '<h2>' . __( 'Recipes', 'text_domain' ) . '</h2>';
		echo '<ul>';
		wp_list_categories( ['taxonomy' => 'recipe-category','title_li' => null] );
		echo '</ul>';
		echo $args['after_widget'];
	}
}
