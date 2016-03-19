<?php get_header() ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) {
			the_post();
			$fields =  get_post_custom();
			$keys = array_keys($fields); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php the_title( '<h1 class="title">', '</h1>' ); 
					if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('medium'); ?>
						</a>
					<?php } 
					$category_count = count(get_the_category());
					?>
					<p><strong><?php echo ($category_count > 1) ? 'Categories: ' :'Category: '?></strong><?php echo get_the_category_list(' '); ?></p>
					<?php echo get_the_tag_list('<p><strong>Tags:</strong> ',', ','</p>'); ?>
					<p><strong>Posted: </strong><?php the_date(); ?> by <strong><?php the_author_link(); ?></strong> </p>
					<p><strong>Status:</strong> <?php echo ucfirst(get_post_status( )) ; ?></p>
				</header>

				<?php the_content() ?>
			</article>
		<?php } //while ( have_posts() )  ?>
	</main>
</div><!-- #primary -->

<div class="sidebar">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>