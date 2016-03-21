<?php get_header() ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
    <h1>Search Results for: <?php echo get_search_query(); ?></h1>
        <?php 
        if ( have_posts() ) {
        	while ( have_posts() ) {
        		the_post();
        		// load template
        		get_template_part( 'templates/content' );
        	} //  $query->have_posts()
        } // $query->have_posts() ?>
        <div class="navigation">
			<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
		</div>
    </main>
</div><!-- #primary -->

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>