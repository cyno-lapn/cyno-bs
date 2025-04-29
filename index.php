<?php get_header(); ?>

<div class="row">
    <div class="col-md-8">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
                    <header class="entry-header">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail mb-3">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                            </div>
                        <?php endif; ?>

                        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>

                        <div class="entry-meta text-muted small mb-2">
                            <?php
                            printf(
                                /* translators: %1$s: Post date, %2$s: Post author */
                                esc_html__('Posted on %1$s by %2$s', 'cyno-bs'),
                                get_the_date(),
                                get_the_author()
                            );
                            ?>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>

                    <footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                            <?php esc_html_e('Read More', 'cyno-bs'); ?>
                        </a>
                    </footer>
                </article>
            <?php endwhile; ?>

            <nav class="pagination justify-content-center">
                <?php
                echo paginate_links(array(
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'type'      => 'list',
                    'class'     => 'pagination',
                ));
                ?>
            </nav>

        <?php else : ?>
            <p><?php esc_html_e('No posts found.', 'cyno-bs'); ?></p>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?> 