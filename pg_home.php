<?php 
/*
	Template Name: Home Page
*/

get_header(); ?>

	<section id="main">
		<section id="main_content">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h2><?php the_title(); ?></h2>
				<?php the_content();?>
				<?php endwhile; endif; ?>
			</article>
		</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
