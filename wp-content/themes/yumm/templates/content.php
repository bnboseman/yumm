<?php if ( get_post_type() == 'post') { 
// if the post is a post
	get_template_part( 'templates/content', 'post' );
// if the post is a recipe
} elseif ( post_type_exists('recipe') && get_post_type() == 'recipe') { 
    get_template_part( 'templates/content', 'recipe' );
} // get_post_type() == 'recipe'