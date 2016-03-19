<?php get_header() ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <h1>Search Results for: <?php echo get_search_query(); ?></h1>
        <?php 
        if ( have_posts() ) {
        	while ( have_posts() ) {
        		the_post();
        		// load template
        		get_template_part( 'templates/content' );
        	} //  $query->have_posts()
        } // $query->have_posts() ?>
    </main>
</div><!-- #primary -->

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>