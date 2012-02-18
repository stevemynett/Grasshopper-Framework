<?php get_header(); ?>

<section id="main">
    <section id="main_content" role="main">
        <h2>Search results</h2>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <?php post_meta(); ?>
                <?php custom_excerpt(45, "More Info"); ?>
            </article>
          <?php endwhile; else: ?>
              <p>Sorry, no posts matched your criteria. Please try another keyword.</p>
          <?php endif; ?>
    </section>
<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>
