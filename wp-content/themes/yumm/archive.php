<?php
get_header(); ?>
<h1>Category: <?php single_cat_title(); ?></h1>
<?php 
if (have_posts()) {
	while ( have_posts()) {
		the_post(); ?>
		<article>
			<h1><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
			<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('medium'); ?></a>
			<?php } //  has_post_thumbnail ?>
		</article>
	<?php } // while( have_posts )
} // if (have_posts) ?>
<div class="navigation">
	<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
	<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
</div>
<?php get_footer(); ?>