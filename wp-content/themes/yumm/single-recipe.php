<?php get_header() ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) {
		the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php
				the_title( '<h1 class="title">', '</h1>' ); ?>
				<p><strong>Posted: </strong><?php the_date(); ?> by <strong><?php the_author_link(); ?></strong> </p>
				
                <?php 
                $category_count = count(get_the_category());
                echo get_the_term_list( get_the_ID(), 'recipe-category', $category_count == 1 ?'<p><strong>Category: </strong>' : '<p><strong>Categories: </strong>', ', ', '</p>'); ?>
                <?php 
                $fields =  get_post_custom();
				$keys = array_keys($fields);
				foreach ( $keys as $key) {
					if (substr_compare($key, '_', 0, 1) ) {
						echo "<p><strong>$key: </strong> {$fields[$key][0]}</p>";
					}
				} // foreach ( $keys as $key) ?>
			</header>
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
			<?php } ?>

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