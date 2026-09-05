<?php get_header(); ?>

<!-- =========================
     MENU NAVIGASI
========================= -->
<nav class="yuri-main-menu">

    <div class="yuri-menu-container">

        <a href="<?php echo esc_url(home_url('/')); ?>" class="active">
            Home
        </a>

        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
            All Products
        </a>

        <a href="<?php echo esc_url(home_url('/promo-special/')); ?>">
            PROMO SPECIAL
        </a>

        <a href="<?php echo esc_url(home_url('/product-category/dee-dee-children/')); ?>">
            Dee-dee Children
        </a>

        <a href="<?php echo esc_url(home_url('/product-category/baby-dee/')); ?>">
            Baby Dee
        </a>

        <a href="<?php echo esc_url(home_url('/product-category/surface-cleaner/')); ?>">
            Surface Cleaner
        </a>

        <a href="#">
            More <span>▼</span>
        </a>

    </div>

</nav>

<!-- =========================
     RECOMMENDED FOR YOU
========================= -->
<section class="recommended-section">

    <div class="recommended-container">

        <div class="recommended-header">

            <div>
                <h2>RECOMMENDED FOR YOU</h2>
                <p>Produk pilihan khusus untuk Anda</p>
            </div>

            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                See All →
            </a>

        </div>


        <div class="recommended-grid">

            <?php

            $recommended_products = new WP_Query(array(
                'post_type'      => 'product',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($recommended_products->have_posts()) :

                while ($recommended_products->have_posts()) :

                    $recommended_products->the_post();

                    global $product;

                    ?>

                    <div class="recommended-card">

                        <!-- PRODUCT IMAGE -->
                        <a
                            href="<?php the_permalink(); ?>"
                            class="recommended-image"
                        >

                            <?php

                            if (has_post_thumbnail()) {

                                the_post_thumbnail(
                                    'woocommerce_thumbnail'
                                );

                            } else {

                                echo wc_placeholder_img(
                                    'woocommerce_thumbnail'
                                );

                            }

                            ?>

                        </a>


                        <!-- PRODUCT INFO -->
                        <div class="recommended-info">

                            <h3>

                                <a href="<?php the_permalink(); ?>">

                                    <?php
                                    the_title();
                                    ?>

                                </a>

                            </h3>


                            <!-- PRICE -->
                            <div class="recommended-price">

                                <?php
                                echo $product->get_price_html();
                                ?>

                            </div>


                            <!-- RATING -->
                            <div class="recommended-rating">

                                <?php

                                echo wc_get_rating_html(
                                    $product->get_average_rating()
                                );

                                ?>

                                <span>
                                    <?php
                                    echo number_format(
                                        $product->get_average_rating(),
                                        1
                                    );
                                    ?>
                                </span>

                                <small>
                                    <?php
                                    echo $product->get_total_sales();
                                    ?>
                                    sold
                                </small>

                            </div>


                            <!-- CART -->
                            <a
                                href="<?php echo esc_url(
                                    $product->add_to_cart_url()
                                ); ?>"
                                class="recommended-cart"
                            >
                                Add to Cart
                            </a>

                        </div>

                    </div>

                    <?php

                endwhile;

                wp_reset_postdata();

            else :

                ?>

                <p>Belum ada produk.</p>

                <?php

            endif;

            ?>

        </div>

    </div>

</section>

<section class="hero-section">

    <div class="hero-container">

        <!-- BANNER BESAR -->
        <div class="hero-main">

            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/banner-main1.jpg"
                alt="Ultimate Spring Sale"
            >

        </div>


        <!-- BANNER KANAN -->
        <div class="hero-side">

            <!-- Banner 1 -->
            <a href="#" class="hero-small">

                <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/banner-main2.jpg"
                    alt="Music Combo"
                >

            </a>


            <!-- Banner 2 -->
            <a href="#" class="hero-small">

                <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/banner-main3.jpg"
                    alt="Mens Slippers"
                >

            </a>

        </div>

    </div>

</section>

<section class="shop-section">

    <div class="shop-container">

        <!-- SIDEBAR CATEGORY -->
        <aside class="category-sidebar">

            <h2>Product Categories</h2>

            <?php
            $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
            ));
            ?>

            <?php if (!empty($categories) && !is_wp_error($categories)) : ?>

                <ul>

                    <?php foreach ($categories as $category) : ?>

                        <li>
                            <a href="<?php echo esc_url(get_term_link($category)); ?>">

                                <?php echo esc_html($category->name); ?>

                                <span>
                                    (<?php echo esc_html($category->count); ?>)
                                </span>

                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php else : ?>

                <p>Belum ada kategori.</p>

            <?php endif; ?>

        </aside>


        <!-- PRODUCT -->
        <div class="product-area">

            <div class="product-header">

                <h2>Semua Produk</h2>

                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                    View All
                </a>

            </div>


            <div class="product-grid">

                <?php
                $products = new WP_Query(array(
                    'post_type'      => 'product',
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                ));
                ?>


                <?php if ($products->have_posts()) : ?>

                    <?php while ($products->have_posts()) : $products->the_post(); ?>

                        <?php
                        global $product;
                        ?>

                        <div class="product-card">

                            <a href="<?php the_permalink(); ?>">

                                <div class="product-image">

                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('woocommerce_thumbnail');
                                    } else {
                                        echo wc_placeholder_img('woocommerce_thumbnail');
                                    }
                                    ?>

                                </div>


                                <h3>
                                    <?php the_title(); ?>
                                </h3>


                                <div class="product-price">

                                    <?php
                                    echo $product->get_price_html();
                                    ?>

                                </div>

                            </a>


                            <a
                                href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                class="add-cart"
                            >
                                Add to Cart
                            </a>

                        </div>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                <?php else : ?>

                    <p>Belum ada produk.</p>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>


<?php get_footer(); ?>