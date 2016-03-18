<?php
get_header();
if (have_posts()):
	while (have_posts()) {
		the_post();
?>
		<article>
			<h1><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
			<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('medium'); ?></a>
			<?php endif; //  has_post_thumbnail ?>
		</article>
	<?php } // while( have_posts )
} // if (have_posts) ?>
<?php get_footer(); ?>