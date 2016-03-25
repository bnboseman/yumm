<article>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <strong>Posted: </strong><?php the_date(); ?>
    <div class="article-text">
	    <span class="snippet-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
	        <?php the_excerpt(); ?>
	    </span>
	    
	    <span class="fulltext-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
	        <?php  the_content(); ?>
	    </span>
    </div>
</article>