<?php get_header(); ?>

	<section id="main">
		<section id="main_content">
			<h2>Search results</h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<ul class="post_meta">
						<li class="date"><?php echo get_the_date(); ?></li>
						<li class="category"><?php the_category(', ') ?></li>
						<?php
						$post_tags = wp_get_post_tags($post->ID);
							if(!empty($post_tags)) { ?>
								<li class="tags"><?php the_tags('',', ',''); ?></li>
							<?php }
						?>
					</ul>
					<?php custom_excerpt(45, "More Info"); ?>
				</article>
			  <?php endwhile; else: ?>
			  <p>Sorry, no posts matched your criteria. Please try another keyword.</p>
			  <?php endif; ?>
		</section>

<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>
