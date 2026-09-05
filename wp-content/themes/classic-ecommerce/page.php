<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
         $classic_ecommerce_layout_option = get_theme_mod( 'classic_ecommerce_sidebar_page_layout','right');
         if($classic_ecommerce_layout_option == 'right'){ ?>
        <div class="row">
            <div class="col-lg-9 col-md-8">
            	<section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header"> 
                            <span class="gap-3 align-items-center"><?php classic_ecommerce_the_breadcrumb(); ?></span>
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
            <div class="col-lg-3 col-md-4" id="sidebar">
               <?php dynamic_sidebar('sidebar-2');?>
            </div>
        </div>
        <div class="clear"></div>
        <?php }else if($classic_ecommerce_layout_option == 'left'){ ?>
        <div class="row">
            <div class="col-lg-3 col-md-4" id="sidebar">
               <?php dynamic_sidebar('sidebar-2');?>
            </div>
            <div class="col-lg-9 col-md-8">
            	<section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <span class="gap-3 align-items-center"><?php classic_ecommerce_the_breadcrumb(); ?></span>
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
        </div>
        <?php }else if($classic_ecommerce_layout_option == 'full'){ ?>
            <div class="full">
                <section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header"> 
                            <span class="gap-3 align-items-center"><?php classic_ecommerce_the_breadcrumb(); ?></span>
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
        <?php }else {?> 
        <div class="row">
            <div class="col-lg-9 col-md-9">
            	<section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <span class="gap-3 align-items-center"><?php classic_ecommerce_the_breadcrumb(); ?></span>
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
            <div class="col-lg-3 col-md-4" id="sidebar">
               <?php dynamic_sidebar('sidebar-2');?>
            </div>
        </div>
        <?php } ?>    
    </div>
 </div>

<?php get_footer(); ?>