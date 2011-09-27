<?php get_header(); ?>

	<section id="main">
		<section id="main_content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2><?php the_title(); ?></h2>
						<?php post_meta(); ?>
					</header>
					<span class="content"><?php the_content();?></span>
														
					<nav class="post-navigation">
						<div class="navigation-previous"><?php previous_post_link('&laquo; %link') ?></div>
						<div class="navigation-next"><?php next_post_link('%link &raquo;') ?></div>
					</nav>
				</article>

	  			<?php comments_template(); ?>
	
	  		<?php endwhile; endif; ?>
		</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

