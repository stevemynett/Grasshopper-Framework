<?php get_header(); ?>

	<section id="main">
		<section id="main_content">
	
		<?php if (have_posts()) : ?>
	
			<?php $post = $posts[0]; ?>
		
			<?php if (is_category()) { ?>				
				<h2><?php echo single_cat_title(); ?></h2>
			
			<?php } elseif( is_tag() ) { ?>
				<h2>Posts Tagged: <?php single_tag_title(); ?></h2>
			
			<?php }elseif (is_day()) { ?>
				<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
			
			<?php }elseif (is_month()) { ?>
				<h2>Archive for <?php the_time('F, Y'); ?></h2>
			
			<?php }elseif (is_year()) { ?>
				<h2>Archive for <?php the_time('Y'); ?></h2>
			
			<?php } elseif (is_search()) { ?>
				<h2>Search Results</h2>
			
			<?php } elseif (is_author()) { ?>
				<h2>Author Archive</h2>
			
			<?php }elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2>Blog Archives</h2>
			
			<?php } ?>
	
		<?php while (have_posts()) : the_post(); ?>
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		    	<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php post_meta(); ?>
			 	<?php custom_excerpt(100, "More Info"); ?>
			</article>
	
		  <?php endwhile; else: ?>
		
		  <p>Sorry, seems like there aren't any posts.</p>
	
		  <?php endif; ?>

	</section>  
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>