<?php
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
		<h1>
	        <?php
			if (is_tag()) {
				echo "Tag: ";
			} elseif (is_category()) {
				echo "Category: ";
			} elseif (is_date()) {
				echo "Date Archive";
			} elseif (is_tax('recipe-category')) {
				echo "Category: ";
			}
			single_cat_title();
		?></h1>
		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				get_template_part('templates/content');
			} // while( have_posts )
		} // if (have_posts) 
		?>
		<div class="navigation">
			<div class="nav-previous alignleft">
				<?php next_posts_link('Older posts');?>
			</div>
			<div class="nav-next alignright">
				<?php previous_posts_link('Newer posts'); ?>
			</div>
		</div>
    </main>
</div>

<div class="sidebar">
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>