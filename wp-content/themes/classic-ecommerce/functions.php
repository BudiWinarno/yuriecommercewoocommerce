<?php
/**
 * Classic Ecommerce functions and definitions
 *
 * @package Classic Ecommerce
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'classic_ecommerce_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function classic_ecommerce_setup() {
	global $classic_ecommerce_content_width;
	if ( ! isset( $classic_ecommerce_content_width ) )
		$classic_ecommerce_content_width = 680;

	load_theme_textdomain( 'classic-ecommerce', get_template_directory() . '/languages' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'classic-ecommerce' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );
	
	add_editor_style( 'editor-style.css' );

    // Theme Activation Notice
	global $pagenow;

	if (
		is_admin()
		&&
		('themes.php' == $pagenow)
		// &&
		// isset( $_GET['activated'] )
	) {
		add_action('admin_notices', 'classic_ecommerce_deprecated_hook_admin_notice');
	}
}
endif; // classic_ecommerce_setup
add_action( 'after_setup_theme', 'classic_ecommerce_setup' );

function classic_ecommerce_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' , ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function classic_ecommerce_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'classic-ecommerce' ),
		'description'   => __( 'Appears on blog page sidebar', 'classic-ecommerce' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'classic-ecommerce' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'classic-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'classic-ecommerce' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'classic-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'classic-ecommerce' ),
		'description'   => __( 'Appears on shop page', 'classic-ecommerce' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'classic-ecommerce'),
        'description'   => __('Sidebar for single product pages', 'classic-ecommerce'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));	

	$classic_ecommerce_widget_areas = get_theme_mod('classic_ecommerce_footer_widget_areas', '4');
	for ($classic_ecommerce_i=1; $classic_ecommerce_i<=$classic_ecommerce_widget_areas; $classic_ecommerce_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'classic-ecommerce' ) . $classic_ecommerce_i,
			'id'            => 'footer-' . $classic_ecommerce_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'classic_ecommerce_widgets_init' );

// Change number of products per row to 4
add_filter('loop_shop_columns', 'classic_ecommerce_loop_columns');
if (!function_exists('classic_ecommerce_loop_columns')) {
    function classic_ecommerce_loop_columns() {
        $classic_ecommerce_colm = get_theme_mod('classic_ecommerce_products_per_row', 4); // Default to 4 if not set
        return $classic_ecommerce_colm;
    }
}

// Use the customizer setting to set the number of products per page
function classic_ecommerce_products_per_page($cols) {
    $classic_ecommerce_cols = get_theme_mod('classic_ecommerce_products_per_page', 9); // Default to 9 if not set
    return $classic_ecommerce_cols;
}
add_filter('loop_shop_per_page', 'classic_ecommerce_products_per_page', 9);

function classic_ecommerce_scripts() {
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style( 'classic-ecommerce-style', get_stylesheet_uri() );
	wp_style_add_data('classic-ecommerce-style', 'rtl', 'replace');
	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'classic-ecommerce-responsive', esc_url(get_template_directory_uri())."/css/responsive.css" );
	wp_enqueue_style( 'classic-ecommerce-default', esc_url(get_template_directory_uri())."/css/default.css" );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'classic-ecommerce-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'classic-ecommerce-style',$classic_ecommerce_color_scheme_css );

	// Font family
	$classic_ecommerce_headings_font = esc_html(get_theme_mod('classic_ecommerce_headings_fonts'));
	$classic_ecommerce_body_font = esc_html(get_theme_mod('classic_ecommerce_body_fonts'));

	if ($classic_ecommerce_headings_font) {
	    wp_enqueue_style('classic-ecommerce-headings-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($classic_ecommerce_headings_font));
	} else {
	    wp_enqueue_style('oswald', 'https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700');
	}

	if ($classic_ecommerce_body_font) {
	    wp_enqueue_style('montserrat', 'https://fonts.googleapis.com/css?family=' . urlencode($classic_ecommerce_body_font));
	} else {
	    wp_enqueue_style('classic-ecommerce-source-body', 'https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
	}

}
add_action( 'wp_enqueue_scripts', 'classic_ecommerce_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Theme Info
 */
require get_template_directory() . '/inc/addon.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

// select
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

function classic_ecommerce_setup_theme() {
	if ( ! defined( 'CLASSIC_ECOMMERCE_PRO_NAME' ) ) {
		define( 'CLASSIC_ECOMMERCE_PRO_NAME', __( 'About Classic Ecommerce', 'classic-ecommerce' ));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_THEME_PAGE' ) ) {
	define('CLASSIC_ECOMMERCE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','classic-ecommerce'));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_SUPPORT' ) ) {
	define('CLASSIC_ECOMMERCE_SUPPORT',__('https://wordpress.org/support/theme/classic-ecommerce','classic-ecommerce'));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_REVIEW' ) ) {
	define('CLASSIC_ECOMMERCE_REVIEW',__('https://wordpress.org/support/theme/classic-ecommerce/reviews/','classic-ecommerce'));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_PRO_DEMO' ) ) {
	define('CLASSIC_ECOMMERCE_PRO_DEMO',__('https://live.theclassictemplates.com/demo/classic-ecommerce','classic-ecommerce'));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_PREMIUM_PAGE' ) ) {
	define('CLASSIC_ECOMMERCE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/wordpress-ecommerce-template','classic-ecommerce'));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_THEME_DOCUMENTATION' ) ) {
	define('CLASSIC_ECOMMERCE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/classic-ecommerce-free/','classic-ecommerce'));
	}
	if ( ! defined( 'CLASSIC_ECOMMERCE_BUNDLE_PAGE' ) ) {
		define('CLASSIC_ECOMMERCE_BUNDLE_PAGE',__('https://www.theclassictemplates.com/products/wordpress-theme-bundle','classic-ecommerce'));
	}
	// Footer Link
	define('CLASSIC_ECOMMERCE_FOOTER_LINK',__('https://www.theclassictemplates.com/products/free-wordpress-ecommerce-template','classic-ecommerce'));

}
add_action( 'after_setup_theme', 'classic_ecommerce_setup_theme' );

/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array(
				'categories',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'meta',
			),
			'footer-4' => array(
				'search',
			),
		),
    ));

if ( ! function_exists( 'classic_ecommerce_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function classic_ecommerce_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/*radio button sanitization*/
function classic_ecommerce_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

if ( ! function_exists( 'classic_ecommerce_sanitize_integer' ) ) {
	function classic_ecommerce_sanitize_integer( $input ) {
		return (int) $input;
	}
}

$classic_ecommerce_woocommerce_sidebar = get_theme_mod( 'classic_ecommerce_woocommerce_sidebar_product' );
	if ( 'false' == $classic_ecommerce_woocommerce_sidebar ) {
$classic_ecommerce_woo_product_column = 'col-lg-12 col-md-12';
	} else {
$classic_ecommerce_woo_product_column = 'col-lg-9 col-md-9';
}

$classic_ecommerce_woocommerce_shop_sidebar = get_theme_mod( 'classic_ecommerce_woocommerce_sidebar_shop' );
	if ( 'false' == $classic_ecommerce_woocommerce_shop_sidebar ) {
$classic_ecommerce_woo_shop_column = 'col-lg-12 col-md-12';
	} else {
$classic_ecommerce_woo_shop_column = 'col-lg-9 col-md-9';
}

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

/* Activation Notice */
function classic_ecommerce_deprecated_hook_admin_notice() {
	$classic_ecommerce_theme = wp_get_theme();
	$classic_ecommerce_meta = get_option( 'classic_ecommerce_admin_notice' );

	if (!$classic_ecommerce_meta) {
    ?>
        <div id="classic-ecommerce-welcome-notice" class="getstrat updated notice notice-success welcome-notice is-dismissible notice-get-started-class">
            <div class="admin-image">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
            <div class="admin-content" >
                <h1><?php 
				/* translators: 1: Theme name, 2: Theme version. */
				printf( esc_html__( 'Welcome to %1$s %2$s', 'classic-ecommerce' ), esc_html($classic_ecommerce_theme->get( 'Name' )), esc_html($classic_ecommerce_theme->get( 'Version' ))); ?>
                </h1>
                <p><?php _e('Get Started With Theme By Clicking On Getting Started.', 'classic-ecommerce'); ?></p>
                <div style="display: grid;">
                    <a class="admin-notice-btn button button-hero upgrade-pro" target="_blank" href="<?php echo esc_url( CLASSIC_ECOMMERCE_PREMIUM_PAGE ); ?>"><?php esc_html_e('Upgrade Pro', 'classic-ecommerce') ?><i class="dashicons dashicons-cart"></i></a>
                    <a class="admin-notice-btn button button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=classic-ecommerce' )); ?>"><?php esc_html_e( 'Get started', 'classic-ecommerce' ) ?><i class="dashicons dashicons-backup"></i></a>
                    <a class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( CLASSIC_ECOMMERCE_THEME_DOCUMENTATION ); ?>"><?php esc_html_e('Free Doc', 'classic-ecommerce') ?><i class="dashicons dashicons-visibility"></i></a>
                    <a  class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( CLASSIC_ECOMMERCE_PRO_DEMO ); ?>"><?php esc_html_e('View Demo', 'classic-ecommerce') ?><i class="dashicons dashicons-awards"></i></a>
                </div>
            </div>
			<div class="admin-bundle-image">
				<a href="<?php echo esc_url( CLASSIC_ECOMMERCE_BUNDLE_PAGE ); ?>" target="_blank"><img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/images/image_1.webp'; ?>" /></a>
			</div>
        </div>
	<?php
    }
}
// Admin notice code START
function classic_ecommerce_dismissed_notice() {
	update_option( 'classic_ecommerce_admin_notice', true );
}
add_action( 'wp_ajax_classic_ecommerce_dismissed_notice', 'classic_ecommerce_dismissed_notice' );


//After Switch theme function
add_action('after_switch_theme', 'classic_ecommerce_getstart_setup_options');
function classic_ecommerce_getstart_setup_options () {
    update_option('classic_ecommerce_admin_notice', false );
}
// Admin notice code END