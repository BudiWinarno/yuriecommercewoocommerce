<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Classic Ecommerce
 */
?>
<div id="footer">
	<?php 
    $classic_ecommerce_footer_widget_enabled = get_theme_mod('classic_ecommerce_footer_widget', true);
    
    if ($classic_ecommerce_footer_widget_enabled !== false && $classic_ecommerce_footer_widget_enabled !== '') { ?>

    <?php 
        $classic_ecommerce_widget_areas = get_theme_mod('classic_ecommerce_footer_widget_areas', '4');
        if ($classic_ecommerce_widget_areas == '3') {
            $classic_ecommerce_cols = 'col-lg-4 col-md-6';
        } elseif ($classic_ecommerce_widget_areas == '4') {
            $classic_ecommerce_cols = 'col-lg-3 col-md-6';
        } elseif ($classic_ecommerce_widget_areas == '2') {
            $classic_ecommerce_cols = 'col-lg-6 col-md-6';
        } else {
            $classic_ecommerce_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($classic_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'classic-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'classic-ecommerce'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($classic_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'classic-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'classic-ecommerce'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($classic_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'classic-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'classic-ecommerce'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($classic_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'classic-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'classic-ecommerce'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

    <?php } ?>
    <div class="clear"></div>

    <div class="copywrap <?php if( get_theme_mod( 'classic_ecommerce_sticky_copyright_enable', false) == 1) { ?> sticky-copyright<?php } else { ?>close-sticky <?php } ?>">
    	<?php $classic_ecommerce_social_links_present = get_theme_mod('classic_ecommerce_footer_facebook_link') || get_theme_mod('classic_ecommerce_footer_instagram_link') || get_theme_mod('classic_ecommerce_footer_pinterest_link') || get_theme_mod('classic_ecommerce_footer_twitter_link') || get_theme_mod('classic_ecommerce_footer_dribbble_link') || get_theme_mod('classic_ecommerce_footer_youtube_link'); ?>
        <div class="container copywrap-info <?php echo $classic_ecommerce_social_links_present ? '' : 'center-content'; ?>">
        <p>
        <a href="<?php 
            $classic_ecommerce_copyright_link = get_theme_mod('classic_ecommerce_copyright_link', '');
            if (empty($classic_ecommerce_copyright_link)) {
                echo esc_url(CLASSIC_ECOMMERCE_FOOTER_LINK);
            } else {
                echo esc_url($classic_ecommerce_copyright_link);
            } ?>" target="_blank">
            <?php echo esc_html(get_theme_mod('classic_ecommerce_copyright_line', __('Ecommerce WordPress Theme', 'classic-ecommerce'))); ?>
        </a> 
        <?php echo esc_html('By Classic Templates', 'classic-ecommerce'); ?>
        </p>
        <?php if ( $classic_ecommerce_social_links_present ) { ?>
            <div class="footer-social d-flex gap-3">
                <?php if ( get_theme_mod('classic_ecommerce_footer_facebook_link') ) { ?>
                    <a title="<?php echo esc_attr('facebook', 'classic-ecommerce'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_ecommerce_footer_facebook_link')); ?>"><i class="fab fa-facebook-f"></i></a> 
                <?php } ?>
                <?php if ( get_theme_mod('classic_ecommerce_footer_twitter_link') ) { ?> 
                    <a title="<?php echo esc_attr('twitter', 'classic-ecommerce'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_ecommerce_footer_twitter_link')); ?>"><i class="fab fa-twitter"></i></a>
                <?php } ?>
                <?php if ( get_theme_mod('classic_ecommerce_footer_linkedin_link') ) { ?>
                    <a title="<?php echo esc_attr('linkedin', 'classic-ecommerce'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_ecommerce_footer_linkedin_link')); ?>"><i class="fab fa-linkedin"></i></a>
                <?php } ?>
                <?php if ( get_theme_mod('classic_ecommerce_footer_instagram_link') ) { ?> 
                    <a title="<?php echo esc_attr('instagram', 'classic-ecommerce'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_ecommerce_footer_instagram_link')); ?>"><i class="fab fa-instagram"></i></a>
                <?php } ?>
                <?php if ( get_theme_mod('classic_ecommerce_footer_youtube_link') ) { ?>
                    <a title="<?php echo esc_attr('youtube', 'classic-ecommerce'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_ecommerce_footer_youtube_link')); ?>"><i class="fab fa-youtube"></i></a>
                <?php } ?>
            </div>
        <?php } ?>
      </div>
    </div>
</div>

<?php if(get_theme_mod('classic_ecommerce_scroll_hide',true)){ ?>
    <a id="button"><?php echo esc_html( get_theme_mod('classic_ecommerce_scroll_text',__('TOP', 'classic-ecommerce' )) ); ?></a>
<?php } ?>
<?php if(get_theme_mod('classic_ecommerce_progress_bar', false)){ ?>
    <div id="progress-bar"></div>
<?php } ?> 
<?php wp_footer(); ?>
</body>
</html>