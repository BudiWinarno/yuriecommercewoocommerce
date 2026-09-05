<?php
/**
 * @package Classic Ecommerce
 */
?>

<?php
    $classic_ecommerce_post_date = get_the_date();
    $classic_ecommerce_year = get_the_date('Y');
    $classic_ecommerce_month = get_the_date('m');

    $classic_ecommerce_author_id = get_the_author_meta('ID');
    $classic_ecommerce_author_link = esc_url(get_author_posts_url($classic_ecommerce_author_id));
    $classic_ecommerce_author_name = get_the_author();

    $classic_ecommerce_blog_post_thumb =  get_theme_mod( 'classic_ecommerce_blog_post_thumb', 1 );
    $classic_ecommerce_show_date     = get_theme_mod('classic_ecommerce_metafields_date', true);
    $classic_ecommerce_show_comments = get_theme_mod('classic_ecommerce_metafields_comments', true);
    $classic_ecommerce_show_author   = get_theme_mod('classic_ecommerce_metafields_author', true);
    $classic_ecommerce_show_time     = get_theme_mod('classic_ecommerce_metafields_time', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="listarticle">
        <?php if ($classic_ecommerce_blog_post_thumb == 1 ) {?> 
            <?php if (has_post_thumbnail() ){ ?>
                <div class="post-thumb">
                   <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
            <?php } ?>
        <?php } ?>
        <header class="entry-header">
            <h2 class="single_title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php if ('post' == get_post_type()) : ?>
                <?php if ( $classic_ecommerce_show_date || $classic_ecommerce_show_comments || $classic_ecommerce_show_author || $classic_ecommerce_show_time ) : ?>
                    <div class="postmeta">
                        <?php if ($classic_ecommerce_show_date) : ?>
                            <div class="post-date">
                                <a href="<?php echo esc_url(get_month_link($classic_ecommerce_year, $classic_ecommerce_month)); ?>">
                            <i class="fas fa-calendar-alt"></i> &nbsp;<?php echo esc_html($classic_ecommerce_post_date); ?>
                                    <span class="screen-reader-text"><?php echo esc_html($classic_ecommerce_post_date); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>  
                        <?php if ($classic_ecommerce_show_comments) : ?>  
                            <div class="post-comment">&nbsp; &nbsp;
                                <a href="<?php echo esc_url(get_comments_link()); ?>">
                                <span><?php echo esc_html(get_theme_mod('classic_ecommerce_metabox_seperator', '|'));?></span><i class="fa fa-comment"></i> &nbsp; <?php comments_number(); ?>
                                    <span class="screen-reader-text"><?php comments_number(); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($classic_ecommerce_show_author) : ?>
                            <div class="post-author">&nbsp; &nbsp;
                                <a href="<?php echo $classic_ecommerce_author_link; ?>">
                                <span><?php echo esc_html(get_theme_mod('classic_ecommerce_metabox_seperator', '|'));?></span><i class="fas fa-user"></i> &nbsp; <?php echo esc_html($classic_ecommerce_author_name); ?>
                                    <span class="screen-reader-text"><?php echo esc_html($classic_ecommerce_author_name); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($classic_ecommerce_show_time) : ?>
                            <div class="post-time">&nbsp; &nbsp;
                                <a href="#">
                                <span><?php echo esc_html(get_theme_mod('classic_ecommerce_metabox_seperator', '|'));?></span><i class="fas fa-clock"></i> &nbsp; <?php echo esc_html(get_the_time()); ?>
                                    <span class="screen-reader-text"><?php echo esc_html(get_the_time()); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </header>
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php if(get_theme_mod('classic_ecommerce_blog_post_description_option') == 'Full Content'){ ?>
                <div class="entry-content"><?php
                    $classic_ecommerce_content = get_the_content(); ?>
                    <p><?php echo wpautop($classic_ecommerce_content); ?></p>  
                </div>
             <?php }
            if(get_theme_mod('classic_ecommerce_blog_post_description_option', 'Excerpt Content') == 'Excerpt Content'){ ?>
                <?php if(get_the_excerpt()) { ?>
                    <div class="entry-content"> 
                        <p><?php $classic_ecommerce_excerpt = get_the_excerpt(); echo esc_html($classic_ecommerce_excerpt); ?></p>
                    </div>
                <?php }?>
            <?php }?>     
            <a class="pagemore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','classic-ecommerce'); ?></a>     
        </div>
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'classic-ecommerce' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'classic-ecommerce' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div>
        <?php endif; ?>
        <div class="clear"></div>    
    </div>
</article>