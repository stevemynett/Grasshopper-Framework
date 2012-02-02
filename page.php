<?php get_header(); ?>

<section id="main">
    <section id="main_content">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content();?>
                <?php edit_post_link(); ?>
            <?php endwhile; endif; ?>
        </article>
    </section>
    <?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>
