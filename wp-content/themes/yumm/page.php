<?php get_header() ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) { 
        		the_post();  ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php  the_title( '<h1>', '</h1>' ); ?>
                    <?php the_content(); ?>
                    <?php edit_post_link(); ?>
				</article>
        <?php } // end while ( have_posts() ) ?>
    </main><!-- #main -->
</div><!-- #primary -->

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>