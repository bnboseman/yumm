<?php get_header() ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			// If this is the front page get all recipes and posts
			if (is_front_page() ) {
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$query = new WP_Query( array(
					'post_type' => array(
						'recipe',
						'post'),
					'orderby' => 'date',
					'order' => 'desc',
					'posts_per_page' => get_option( 'posts_per_page' ),
					'paged' => $paged ) );

			// if we have post start the loop
			if ( $query->have_posts() ) {
				// loop though all posts
				while ( $query->have_posts() ) {
					$query->the_post();
					// load template
					get_template_part( 'templates/content' );
				} //  $query->have_posts()
			} // $query->have_posts()
	} else { // if (is_front_page() )
			while ( have_posts() ) {
				the_post();
				get_template_part( 'templates/content', 'post' );
			}
	} ?>
	<div class="navigation">
		<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
		<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
	</div>
	</main><!-- #main -->
</div><!-- #primary -->

<div class="sidebar">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>