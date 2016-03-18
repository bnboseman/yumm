<?php get_header() ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php 
		while ( have_posts() ): 
			the_post();
			$fields =  get_post_custom();
			$keys = array_keys($fields);
		?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php the_title( '<h1 class="title">', '</h1>' ); ?>
					<?php foreach ( $keys as $key):
							if (substr_compare($key, '_', 0, 1) ) {
								echo "<strong>$key: </strong> {$fields[$key][0]}<br />";
							}
							
							endforeach;?>
					<?php echo get_the_term_list( get_the_ID(), 'recipe-category', null, ' '); ?>
				</header>
				<?php the_content() ?>
			</article>
		<?php 	
		endwhile; ?>
		</main>
		
	</div><!-- #primary -->
	
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
