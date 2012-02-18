<?php get_header(); ?>
<section id="main">
    <section id="main_content" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <?php post_meta(); ?>
                <?php the_content();?>
                <?php edit_post_link(); ?>
                <nav class="post-navigation">
                    <div class="navigation-previous"><?php previous_post_link('&laquo; %link') ?></div>
                    <div class="navigation-next"><?php next_post_link('%link &raquo;') ?></div>
                </nav>
            </article>
        <?php comments_template(); ?>
        <?php endwhile; endif; ?>
    </section>
<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>

