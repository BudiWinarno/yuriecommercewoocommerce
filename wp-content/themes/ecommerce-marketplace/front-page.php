<?php
/**
 * Front Page
 *
 * @package Ecommerce Marketplace
 */

get_header();
?>

<div id="content">

    <!-- BANNER -->
    <?php
    $slider_category = get_theme_mod('classic_ecommerce_slidersection');

    if ($slider_category) :
    ?>

        <section id="catsliderarea">
            <div class="catwrapslider">
                <div class="owl-carousel">

                    <?php
                    $slider_query = new WP_Query(array(
                        'cat'            => absint($slider_category),
                        'posts_per_page' => -1,
                    ));

                    if ($slider_query->have_posts()) :

                        while ($slider_query->have_posts()) :
                            $slider_query->the_post();
                    ?>

                        <div class="slidesection">

                            <?php if (has_post_thumbnail()) : ?>

                                <?php the_post_thumbnail('full'); ?>

                            <?php endif; ?>

                            <div class="slider-box">

                                <?php if (get_theme_mod('ecommerce_marketplace_slider_discount_text')) : ?>

                                    <p class="discount-text">
                                        <?php
                                        echo esc_html(
                                            get_theme_mod(
                                                'ecommerce_marketplace_slider_discount_text'
                                            )
                                        );
                                        ?>
                                    </p>

                                <?php endif; ?>

                                <?php if (get_theme_mod('ecommerce_marketplace_slider_subhead_text')) : ?>

                                    <strong class="subhead-text">
                                        <?php
                                        echo esc_html(
                                            get_theme_mod(
                                                'ecommerce_marketplace_slider_subhead_text'
                                            )
                                        );
                                        ?>
                                    </strong>

                                <?php endif; ?>

                                <h1>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h1>

                                <div class="shop-now">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        echo esc_html(
                                            get_theme_mod(
                                                'classic_ecommerce_button_text',
                                                'SHOP NOW'
                                            )
                                        );
                                        ?>
                                    </a>
                                </div>

                            </div>

                        </div>

                    <?php
                        endwhile;

                        wp_reset_postdata();

                    endif;
                    ?>

                </div>
            </div>
        </section>

    <?php endif; ?>


    <!-- PRODUK -->
    <section id="all-products">

        <div class="container">

            <div id="recent-product">
                <h2>Semua Produk</h2>
            </div>

            <?php
            $products = new WP_Query(array(
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 16,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($products->have_posts()) :
            ?>

                <div class="woocommerce">

                    <ul class="products columns-4">

                        <?php
                        while ($products->have_posts()) :
                            $products->the_post();

                            wc_get_template_part(
                                'content',
                                'product'
                            );

                        endwhile;
                        ?>

                    </ul>

                </div>

            <?php else : ?>

                <p>Belum ada produk WooCommerce.</p>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </div>

    </section>

</div>

<?php get_footer(); ?>