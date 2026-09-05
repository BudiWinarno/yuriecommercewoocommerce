<?php
/**
 * @package Classic Ecommerce
 * Setup the WordPress core custom header feature.
 *
 * @uses classic_ecommerce_header_style()
 */
function classic_ecommerce_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'classic_ecommerce_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 2000,
		'height'                 => 280,
		'wp-head-callback'       => 'classic_ecommerce_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'classic_ecommerce_custom_header_setup' );

if ( ! function_exists( 'classic_ecommerce_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see classic_ecommerce_custom_header_setup().
 */
function classic_ecommerce_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat !important;
			background-position: center top;
			background-size:cover !important;
		}
	<?php endif; ?>	

	.header .site-title a {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_sitetitle_color')); ?>;
	}

	.header .site-description {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_siteTagline_color')); ?>;
	}

	.header {
		background: <?php echo esc_attr(get_theme_mod('classic_ecommerce_headerbg_color')); ?> !important;
	}

	.social-icons i {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_topheaderbg_color')); ?> !important;
	}
	.copywrap, .copywrap p, .copywrap p a, #footer .copywrap a{
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_coypright_col')); ?> !important;
	}

	#footer .copywrap a:hover, .copywrap p:hover, .copywrap:hover{
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_coyprighthover_col')); ?> !important;
	}

	#footer .copywrap {
		background-color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_coyprightbg_col')); ?>;
	}

	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_bg_col')); ?> !important;
	}

	#footer h1,#footer h2,#footer h3,#footer h4,#footer h5,#footer h6, .footer-block .widget-title {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_heading_col')); ?> !important;
	}

	#footer p {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_text_col')); ?>;
	}

	#footer li a {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_list_col')); ?>;
	}

	#footer li a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_ecommerce_footer_listhover_col')); ?>;
	}

	</style>
	<?php
}
endif;