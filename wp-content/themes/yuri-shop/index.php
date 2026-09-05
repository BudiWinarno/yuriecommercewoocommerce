<?php get_header(); ?>

<div class="container">

    <h1>Yuri Shop</h1>

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <article>

                <h2>
                    <?php the_title(); ?>
                </h2>

                <?php the_content(); ?>

            </article>

        <?php endwhile; ?>

    <?php else : ?>

        <p>Belum ada konten.</p>

    <?php endif; ?>

</div>

<?php get_footer(); ?>