<article>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <strong>Posted: </strong><?php the_date(); ?>
    <div class="snippet-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
        <?php the_excerpt(); ?>
    </div>
    
    <div class="fulltext-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
        <?php  the_content(); ?>
    </div>
</article>