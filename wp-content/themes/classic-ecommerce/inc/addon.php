<?php
/*
 * @package Classic Ecommerce
 */


 function classic_ecommerce_admin_enqueue_scripts() {
    wp_enqueue_style( 'classic-ecommerce-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'classic_ecommerce_admin_enqueue_scripts' );

function classic_ecommerce_theme_info_menu_link() {

    $classic_ecommerce_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s', 'classic-ecommerce' ), $classic_ecommerce_theme->get( 'Name' )),
        esc_html__( 'Theme Demo Import', 'classic-ecommerce' ),
        'edit_theme_options',
        'classic-ecommerce',
        'classic_ecommerce_theme_info_page'
    );
}
add_action( 'admin_menu', 'classic_ecommerce_theme_info_menu_link' );

function classic_ecommerce_theme_info_page() {

    $classic_ecommerce_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s', 'classic-ecommerce' ), esc_html($classic_ecommerce_theme->get( 'Name' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'classic-ecommerce' ); ?>
    </p>
    <div class="columns-wrapper clearfix theme-demo">
        <div class="column column-quarter clearfix start-box"> 
            <div class="demo-import">
                <div class="theme-name">
                    <h2><?php echo esc_html( $classic_ecommerce_theme->get( 'Name' ) ); ?></h2>
                    <p class="version"><?php esc_html_e( 'Version', 'classic-ecommerce' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></p>	
                </div>
                <?php
                    $classic_ecommerce_demo_content_file = apply_filters(
                        'classic_ecommerce_demo_content_path',
                        get_parent_theme_file_path( '/inc/demo-content.php' )
                    );
                    require $classic_ecommerce_demo_content_file;             
                ?>               
                <div id="demo-import-loader">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/status.gif'); ?>" alt="<?php echo esc_attr( 'Loading...', 'classic-ecommerce'); ?>" />
                </div>
            </div>
        </div>
        <div class="column column-first clearfix">
            <div class="important-link">
                <div class="main-box columns-wrapper clearfix">
                    <div class="themelink column column-third clearfix">
                        <p><strong><?php esc_html_e( 'Pro version of our theme', 'classic-ecommerce' ); ?></strong></p>
                        <p><?php esc_html_e( 'Are you excited for our theme? Then we will proceed for pro version of theme.', 'classic-ecommerce' ); ?></p>
                        <a class="get-premium" href="<?php echo esc_url( CLASSIC_ECOMMERCE_PREMIUM_PAGE ); ?>" target="_blank">
                        <?php esc_html_e( 'Go To Premium', 'classic-ecommerce' ); ?>
                        </a>
                    </div>

                    <div class="themelink column column-third clearfix">
                        <p><strong><?php esc_html_e( 'Need Help?', 'classic-ecommerce' ); ?></strong></p>
                        <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'classic-ecommerce' ); ?></p>
                        <a href="<?php echo esc_url( CLASSIC_ECOMMERCE_SUPPORT ); ?>" target="_blank">
                        <?php esc_html_e( 'Contact Us', 'classic-ecommerce' ); ?>
                        </a>
                    </div>

                    <div class="themelink column column-third clearfix">
                        <p><strong><?php esc_html_e( 'Check Our Demo', 'classic-ecommerce' ); ?></strong></p>
                        <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium theme.', 'classic-ecommerce' ); ?></p>
                        <a href="<?php echo esc_url( CLASSIC_ECOMMERCE_PRO_DEMO ); ?>" target="_blank">
                        <?php esc_html_e( 'Premium Demo', 'classic-ecommerce' ); ?>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="main-box columns-wrapper clearfix">
                    <div class="themelink column column-third clearfix">
                        <p><strong><?php esc_html_e( 'Check all classic features', 'classic-ecommerce' ); ?></strong></p>
                        <p><?php esc_html_e( 'Explore all our 90+ Premium Themes Collections', 'classic-ecommerce' ); ?></p>
                        <a href="<?php echo esc_url( CLASSIC_ECOMMERCE_THEME_PAGE ); ?>" target="_blank">
                        <?php esc_html_e( 'Theme Page', 'classic-ecommerce' ); ?>
                        </a>
                    </div>

                    <div class="themelink column column-third clearfix">
                        <p><strong><?php esc_html_e( 'Leave us a review', 'classic-ecommerce' ); ?></strong></p>
                        <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'classic-ecommerce' ); ?></p>
                        <a href="<?php echo esc_url( CLASSIC_ECOMMERCE_REVIEW ); ?>" target="_blank">
                        <?php esc_html_e( 'Rate This Theme', 'classic-ecommerce' ); ?>
                        </a>
                    </div>

                    <div class="themelink column column-third clearfix">
                        <p><strong><?php esc_html_e( 'Theme Documentation', 'classic-ecommerce' ); ?></strong></p>
                        <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'classic-ecommerce' ); ?></p>
                        <a href="<?php echo esc_url( CLASSIC_ECOMMERCE_THEME_DOCUMENTATION ); ?>" target="_blank">
                        <?php esc_html_e( 'Documentation', 'classic-ecommerce' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="getting-started">
        <div class="section">
            <h3><?php printf( esc_html__( 'Getting started with %s', 'classic-ecommerce' ),
            esc_html($classic_ecommerce_theme->get( 'Name' ))); ?></h3>
            <div class="columns-wrapper clearfix">
                <div class="column column-half clearfix">
                    <div class="section themelink">
                        <div class="">
                            <a class="" href="<?php echo esc_url( CLASSIC_ECOMMERCE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Get Premium', 'classic-ecommerce' ); ?></a>
                            <a href="<?php echo esc_url( CLASSIC_ECOMMERCE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'View Demo', 'classic-ecommerce' ); ?></a>
                            <a class="get-premium" href="<?php echo esc_url( CLASSIC_ECOMMERCE_BUNDLE_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Bundle of 90+ Themes at $99', 'classic-ecommerce' ); ?></a>
                        </div>
                        <div class="theme-description-1"><?php echo esc_html($classic_ecommerce_theme->get( 'Description' )); ?></div>
                    </div>
                </div>
                <div class="column column-half clearfix">
                    <img src="<?php echo esc_url( $classic_ecommerce_theme->get_screenshot() ); ?>" alt=""/>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'classic-ecommerce' ),
            esc_html($classic_ecommerce_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'classic-ecommerce' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url(CLASSIC_ECOMMERCE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'classic-ecommerce' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'classic-ecommerce' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}
?>