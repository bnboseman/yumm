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
					// if the post is an actual post
					if ( get_post_type() == 'post'){ ?>
						<article>
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<strong>Posted: </strong><?php the_date(); ?>
							<div class="snippet-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
								<?php the_excerpt(); ?>
							</div>

							<div class="fulltext-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
								<?php  the_content(); ?>
							</div>
						</article>
						<?php
						// if the post is a recipe
					} elseif ( get_post_type() == 'recipe') { ?>
						<article>
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<div><?php echo get_the_term_list( get_the_ID(), 'recipe-category', null, ' '); ?></div>
							<?php
							// show thumbnail of image if the recipe has one
							if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('medium'); ?>
								</a>
							<?php
							} ?>
						</article>
					<?php } // get_post_type() == 'recipe'
				} //  $query->have_posts()
			} // $query->have_posts()
	} else { // if (is_front_page() )
			while ( have_posts() ) {
				the_post();

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