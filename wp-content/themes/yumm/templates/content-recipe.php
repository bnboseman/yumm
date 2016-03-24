<article>
	<div class="recipelisting">
		<?php
		// show thumbnail of image if the recipe has one
		if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
        		</a>
		<?php } ?>
			<div>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php
				$category_count = count(get_the_category());
				echo get_the_term_list( get_the_ID(), 'recipe-category', $category_count == 1 ?
				'<strong>Category: </strong>' :
				'<strong>Categories: </strong>', ', ', ''); ?>
			</div>
		</div>
</article>