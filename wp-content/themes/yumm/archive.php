<?php get_header(); ?>
<?php 
if (have_posts()):
	while ( have_posts() ):
		the_post();
?>
<article>
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php
// show thumbnail of image if the recipe has one
if ( has_post_thumbnail() ): ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <?php the_post_thumbnail('medium'); ?>
    </a>
<?php endif; //  has_post_thumbnail ?>
</article> 
<?php endwhile; // have_posts ?>
<?php endif; //have_posts?>
<?php get_footer(); ?>