<?php get_header() ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) {
		the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php
				the_title( '<h1 class="title">', '</h1>' );
				$fields =  get_post_custom();
				$keys = array_keys($fields);
				foreach ( $keys as $key) {
					if (substr_compare($key, '_', 0, 1) ) {
						echo "<strong>$key: </strong> {$fields[$key][0]}<br />";
					}
				} // foreach ( $keys as $key) ?>
				<?php echo get_the_term_list( get_the_ID(), 'recipe-category', null, ' '); ?>
			</header>
			<?php the_content(); ?>
		</article>
		<?php
	} // while ( have_posts() ) ?>
	</main>

	</div><!-- #primary -->

	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
