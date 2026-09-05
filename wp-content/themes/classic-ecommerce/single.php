<?php
/**
 * The Template for displaying all single posts.
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
    <?php
        $classic_ecommerce_single_post_layout_option = get_theme_mod( 'classic_ecommerce_sidebar_single_post_layout','right');
        if($classic_ecommerce_single_post_layout_option == 'right'){ ?>
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <section class="site-main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <?php if(get_theme_mod('classic_ecommerce_single_page_breadcrumb',true) == 1){ ?>
                                <span><?php classic_ecommerce_the_breadcrumb(); ?></span>
                            <?php } ?> 
                        </header>
                        <?php get_template_part( 'template-parts/post/content-single', 'single' ); ?>
                        <?php the_post_navigation(); ?>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                        	comments_template();
                        ?>
                    <?php endwhile; // end of the loop. ?>
                </section>
            </div>
            <div class="col-lg-3 col-md-3">
                <?php get_sidebar();?>
            </div>
        </div>
        <?php } elseif($classic_ecommerce_single_post_layout_option == 'left'){ ?>
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <?php get_sidebar();?>
            </div>
            <div class="col-lg-9 col-md-9">
                <section class="site-main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <?php if(get_theme_mod('classic_ecommerce_single_page_breadcrumb',true) == 1){ ?>
                                <span><?php classic_ecommerce_the_breadcrumb(); ?></span>
                            <?php } ?> 
                        </header>
                        <?php get_template_part( 'template-parts/post/content-single', 'single' ); ?>
                        <?php the_post_navigation(); ?>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                        	comments_template();
                        ?>
                    <?php endwhile; // end of the loop. ?>
                </section>
            </div>
        </div>
        <?php } else { ?>
            <section class="site-main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <header class="page-header">
                        <?php if(get_theme_mod('classic_ecommerce_single_page_breadcrumb',true) == 1){ ?>
                            <span><?php classic_ecommerce_the_breadcrumb(); ?></span>
                        <?php } ?> 
                    </header>
                    <?php get_template_part( 'template-parts/post/content-single', 'single' ); ?>
                    <?php the_post_navigation(); ?>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                    ?>
                <?php endwhile; // end of the loop. ?>
            </section>
        <?php } ?> 
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>