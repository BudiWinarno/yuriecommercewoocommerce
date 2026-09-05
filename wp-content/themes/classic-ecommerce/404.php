<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Classic Ecommerce
 */

get_header(); ?>

<div class="feature-header">
  <div class="feature-post-thumbnail">
    <div class="slider-alternate">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/images/banner.png'); ?>">
    </div>
    <h1 class="post-title feature-header-title"><?php esc_html_e(get_the_title()); ?></h1>
  </div>
</div>

<div class="container">
    <div id="content" class="contentsecwrap">
        <section class="site-main page-not-found">
            <header class="page-header">
                <h1 class="entry-title">
                    <?php echo esc_html(get_theme_mod('classic_ecommerce_page_not_found_heading',__('404 Not Found','classic-ecommerce')));?>
                </h1>
            </header>
            <div class="page-content">
                <p>
                    <?php echo esc_html(get_theme_mod('classic_ecommerce_page_not_found_content',__( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'classic-ecommerce' ))); ?>
                </p>
            </div>
        </section>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>