<?php get_header() ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
	<?php while ( have_posts() ) {
		the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php
				// Show title
				the_title( '<h1 class="title">', '</h1>' ); ?>
				<p><strong>Posted: </strong><?php the_date(); ?> by <strong><?php the_author_link(); ?></strong> </p>
				
				<?php 
				// Print Categories
				$category_count = count(get_the_category());
				echo get_the_term_list( get_the_ID(), 'recipe-category', $category_count == 1 ?'<p><strong>Category: </strong>' : '<p><strong>Categories: </strong>', ', ', '</p>'); ?>
				<?php 
				// Show any custom fields
				$fields =  get_post_custom();
				$keys = array_keys($fields);
				foreach ( $keys as $key) {
					if (substr_compare($key, '_', 0, 1) ) {
						echo "<!-- <p><strong>$key: </strong> {$fields[$key][0]}</p>-->";
					}
				} // foreach ( $keys as $key) ?>
			</header>
			<?php 
			// Show image
			if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
			<?php } ?>

			<?php the_content(); ?>
		</article>
		<?php
	} // while ( have_posts() )
	// If comments are allowed show comments template
	if ( get_option( 'yumm_recipe_comments') == 1 && (comments_open() || get_comments_number() ) ) {
		comments_template();
	} // comments_open() || get_comments_number()
		?>
	<div class="navigation"></div>
	</main>

</div><!-- #primary -->

<div class="sidebar">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>