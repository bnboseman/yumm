<?php
get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
		<h1><?php echo is_category() ? 'Category' : 'Tag'; ?>: <?php single_cat_title(); ?></h1>
		<?php 
		if (have_posts()) {
			while ( have_posts()) {
				the_post();
				get_template_part( 'templates/content' );
			} // while( have_posts )
		} // if (have_posts) ?>
		<div class="navigation">
			<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
		</div>
    </main>
</div>

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>