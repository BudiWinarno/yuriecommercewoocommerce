<?php
/**
 * Classic Ecommerce Theme Customizer
 *
 * @package Classic Ecommerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function classic_ecommerce_customize_register( $wp_customize ) {

	function classic_ecommerce_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	function classic_ecommerce_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );
		
		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}

	wp_enqueue_style('classic-ecommerce-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Enable / Disable Logo
	$wp_customize->add_setting('classic_ecommerce_logo_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_logo_enable', array(
	   'settings' => 'classic_ecommerce_logo_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Logo','classic-ecommerce'),
	   'type'      => 'checkbox'
	));

	//Logo
    $wp_customize->add_setting('classic_ecommerce_logo_width',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'classic_ecommerce_sanitize_integer'
	));
	$wp_customize->add_control(new Classic_Ecommerce_Slider_Custom_Control( $wp_customize, 'classic_ecommerce_logo_width',array(
		'label'	=> esc_html__('Logo Width','classic-ecommerce'),
		'section'=> 'title_tagline',
		'settings'=>'classic_ecommerce_logo_width',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 300,
        ),
	)));

	$wp_customize->add_setting('classic_ecommerce_title_enable',array(
		'default' => false,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_title_enable', array(
	   'settings' => 'classic_ecommerce_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','classic-ecommerce'),
	   'type'      => 'checkbox'
	));

	// site title color 
	$wp_customize->add_setting('classic_ecommerce_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_sitetitle_color', array(
	   'settings' => 'classic_ecommerce_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_ecommerce_tagline_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_tagline_enable', array(
	   'settings' => 'classic_ecommerce_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','classic-ecommerce'),
	   'type'      => 'checkbox'
	));

	// site Tagline color
	$wp_customize->add_setting('classic_ecommerce_siteTagline_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_siteTagline_color', array(
	   'settings' => 'classic_ecommerce_siteTagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// woocommerce section
	$wp_customize->add_section('classic_ecommerce_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'classic-ecommerce'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('classic_ecommerce_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_ecommerce_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','classic-ecommerce'),
		'section' => 'classic_ecommerce_woocommerce_page_settings',
	));

    // shop page sidebar alignment
    $wp_customize->add_setting('classic_ecommerce_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'classic_ecommerce_sanitize_choices',
	));
	$wp_customize->add_control('classic_ecommerce_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'classic-ecommerce'),
		'section'        => 'classic_ecommerce_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'classic-ecommerce'),
			'Right Sidebar' => __('Right Sidebar', 'classic-ecommerce'),
		),
	));	 

	$wp_customize->add_setting('classic_ecommerce_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','classic-ecommerce'),
		'choices' => array(
			 'Yes' => __('Yes','classic-ecommerce'),
			 'No' => __('No','classic-ecommerce'),
		 ),
		'section' => 'classic_ecommerce_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'classic_ecommerce_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
    ) );
    $wp_customize->add_control('classic_ecommerce_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','classic-ecommerce'),
		'section' => 'classic_ecommerce_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('classic_ecommerce_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'classic_ecommerce_sanitize_choices',
	));
	$wp_customize->add_control('classic_ecommerce_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'classic-ecommerce'),
		'section'        => 'classic_ecommerce_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'classic-ecommerce'),
			'Right Sidebar' => __('Right Sidebar', 'classic-ecommerce'),
		),
	));

	$wp_customize->add_setting('classic_ecommerce_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_ecommerce_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','classic-ecommerce'),
		'section' => 'classic_ecommerce_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'classic_ecommerce_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'classic_ecommerce_sanitize_integer'
    ) );
    $wp_customize->add_control(new Classic_Ecommerce_Slider_Custom_Control( $wp_customize, 'classic_ecommerce_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Woo Product Img Border Radius','classic-ecommerce'),
		'section'=> 'classic_ecommerce_woocommerce_page_settings',
		'settings'=>'classic_ecommerce_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
    // Add a setting for number of products per row
    $wp_customize->add_setting('classic_ecommerce_products_per_row', array(
	  'default'   => '4',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'classic_ecommerce_sanitize_integer'
    ));
    $wp_customize->add_control('classic_ecommerce_products_per_row', array(
	  'label'    => __('Woo Products Per Row', 'classic-ecommerce'),
	  'section'  => 'classic_ecommerce_woocommerce_page_settings',
	  'settings' => 'classic_ecommerce_products_per_row',
	  'type'     => 'select',
	  'choices'  => array(
		  '2' => '2',
		  '3' => '3',
		  '4' => '4',
	  ),
    ));

    // Add a setting for the number of products per page
    $wp_customize->add_setting('classic_ecommerce_products_per_page', array(
	  'default'   => '9',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'classic_ecommerce_sanitize_integer'
    ));
    $wp_customize->add_control('classic_ecommerce_products_per_page', array(
	  'label'    => __('Woo Products Per Page', 'classic-ecommerce'),
	  'section'  => 'classic_ecommerce_woocommerce_page_settings',
	  'settings' => 'classic_ecommerce_products_per_page',
	  'type'     => 'number',
	  'input_attrs' => array(
		 'min'  => 1,
		 'step' => 1,
	  ),
    ));

    $wp_customize->add_setting('classic_ecommerce_product_sale_position',array(
        'default' => 'Left',
        'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_product_sale_position',array(
        'type' => 'radio',
        'label' => __('Product Sale Position','classic-ecommerce'),
        'section' => 'classic_ecommerce_woocommerce_page_settings',
        'choices' => array(
            'Left' => __('Left','classic-ecommerce'),
            'Right' => __('Right','classic-ecommerce'),
        ),
	) );	

	//Theme Options
	$wp_customize->add_panel( 'classic_ecommerce_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'classic-ecommerce' ),
	) );
	
	//Site Layout Section
	$wp_customize->add_section('classic_ecommerce_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section','classic-ecommerce'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','classic-ecommerce'),
		'priority'	=> 1,
		'panel' => 'classic_ecommerce_panel_area',
	));		

	$wp_customize->add_setting('classic_ecommerce_preloader',array(
		'default' => false,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'classic_ecommerce_preloader', array(
	   'section'   => 'classic_ecommerce_site_layoutsec',
	   'label'	=> __('Check to show Preloader','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_ecommerce_top_bar',array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'classic_ecommerce_top_bar', array(
	   'section'   => 'classic_ecommerce_site_layoutsec',
	   'label'	=> __('Check to show top bar','classic-ecommerce'),
	   'type'      => 'checkbox'
 	)); 

 	$wp_customize->add_setting('classic_ecommerce_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_stickyheader', array(
	   'section'   => 'classic_ecommerce_site_layoutsec',
	   'label'	=> __('Check To Show Sticky Header','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_ecommerce_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'classic_ecommerce_box_layout', array(
	   'section'   => 'classic_ecommerce_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));	

    // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('classic_ecommerce_sidebar_page_layout',array(
	  'default' => 'right',
	  'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'classic-ecommerce'),
		'section' => 'classic_ecommerce_site_layoutsec',
		'choices' => array(
			'full' => __('Full','classic-ecommerce'),
			'left' => __('Left','classic-ecommerce'),
			'right' => __('Right','classic-ecommerce'),
	),
	) );	

	$wp_customize->add_setting( 'classic_ecommerce_layout_settings_upgraded_features',array(
	   'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_layout_settings_upgraded_features', array(
	   'type'=> 'hidden',
	   'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	      <a target='_blank' href='". esc_url(CLASSIC_ECOMMERCE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
	   'section' => 'classic_ecommerce_site_layoutsec'
	));		

	//Global Color
	$wp_customize->add_section('classic_ecommerce_global_color', array(
		'title'    => __('Manage Global Color Section', 'classic-ecommerce'),
		'panel'    => 'classic_ecommerce_panel_area',
	));	

	$wp_customize->add_setting('classic_ecommerce_color_scheme_one',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
    $wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'classic_ecommerce_color_scheme_one', 
	    array(
	        'label'      => __( 'Color Scheme 1', 'classic-ecommerce' ),
	        'section'    => 'classic_ecommerce_global_color',
	        'settings'   => 'classic_ecommerce_color_scheme_one',
	    ) ) 
	);

	$wp_customize->add_setting( 'classic_ecommerce_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	 ));
	 $wp_customize->add_control('classic_ecommerce_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(CLASSIC_ECOMMERCE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_global_color'
	 ));		

 	// Header Section
	$wp_customize->add_section('classic_ecommerce_header_section', array(
        'title' => __('Manage Header Section', 'classic-ecommerce'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','classic-ecommerce'),
        'priority' => null,
		'panel' => 'classic_ecommerce_panel_area',
 	));

	$wp_customize->add_setting('classic_ecommerce_offer_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_offer_text', array(
	   'settings' => 'classic_ecommerce_offer_text',
	   'section'   => 'classic_ecommerce_header_section',
	   'label' => __('Add Offer Text', 'classic-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_ecommerce_category_text',array(
		'default' => 'ALL CATEGORIES',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_category_text', array(
	   'settings' => 'classic_ecommerce_category_text',
	   'section'   => 'classic_ecommerce_header_section',
	   'label' => __('Add Category Text', 'classic-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_ecommerce_product_category_number',array(
		'default' => '',
		'sanitize_callback' => 'classic_ecommerce_sanitize_number_absint',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_product_category_number', array(
	   'settings' => 'classic_ecommerce_product_category_number',
	   'section'   => 'classic_ecommerce_header_section',
	   'label' => __('Add Category Limit', 'classic-ecommerce'),
	   'type'      => 'number'
	));

	// header bg color
	$wp_customize->add_setting('classic_ecommerce_headerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_headerbg_color', array(
	   'settings' => 'classic_ecommerce_headerbg_color',
	   'section'   => 'classic_ecommerce_header_section',
	   'label' => __('Header BG Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'classic_ecommerce_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_ECOMMERCE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_header_section'
	));	

	// Social media Section
	$wp_customize->add_section('classic_ecommerce_social_media_section', array(
        'title' => __('Manage Social media Section', 'classic-ecommerce'),
		'description' => __('<p class="sec-title">Manage Social media Section</p>','classic-ecommerce'),
        'priority' => null,
		'panel' => 'classic_ecommerce_panel_area',
 	));

	$wp_customize->add_setting('classic_ecommerce_fb_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_fb_link', array(
	   'settings' => 'classic_ecommerce_fb_link',
	   'section'   => 'classic_ecommerce_social_media_section',
	   'label' => __('Facebook Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_twitt_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_twitt_link', array(
	   'settings' => 'classic_ecommerce_twitt_link',
	   'section'   => 'classic_ecommerce_social_media_section',
	   'label' => __('Twitter Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_linked_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_linked_link', array(
	   'settings' => 'classic_ecommerce_linked_link',
	   'section'   => 'classic_ecommerce_social_media_section',
	   'label' => __('Linkdin Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_insta_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_insta_link', array(
	   'settings' => 'classic_ecommerce_insta_link',
	   'section'   => 'classic_ecommerce_social_media_section',
	   'label' => __('Instagram Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_youtube_link', array(
	   'settings' => 'classic_ecommerce_youtube_link',
	   'section'   => 'classic_ecommerce_social_media_section',
	   'label' => __('Youtube Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	// top header bg color
	$wp_customize->add_setting('classic_ecommerce_topheaderbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_topheaderbg_color', array(
	   'settings' => 'classic_ecommerce_topheaderbg_color',
	   'section'   => 'classic_ecommerce_social_media_section',
	   'label' => __('Social Icon Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'classic_ecommerce_social_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_social_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(CLASSIC_ECOMMERCE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_social_media_section'
	));		

	// Home Category Dropdown Section
	$wp_customize->add_section('classic_ecommerce_one_cols_section',array(
		'title'	=> __('Manage Slider Section','classic-ecommerce'),
		'description'	=> __('<p class="sec-title">Manage Slider Section</p> Select Category from the Dropdowns for slider, Also use the given image dimension (1400 x 550).','classic-ecommerce'),
		'priority'	=> null,
		'panel' => 'classic_ecommerce_panel_area'
	));

	//Hide Section
	$wp_customize->add_setting('classic_ecommerce_hide_categorysec',array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	$wp_customize->add_control( 'classic_ecommerce_hide_categorysec', array(
	   'settings' => 'classic_ecommerce_hide_categorysec',
	   'section'   => 'classic_ecommerce_one_cols_section',
	   'label'     => __('Check To Enable This Section','classic-ecommerce'),
	   'type'      => 'checkbox'
	));

	// Add a category dropdown Slider Coloumn
	$wp_customize->add_setting( 'classic_ecommerce_slidersection', array(
		'default'	=> '0',	
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( new Classic_Ecommerce_Category_Dropdown_Custom_Control( $wp_customize, 'classic_ecommerce_slidersection', array(
		'section' => 'classic_ecommerce_one_cols_section',
	   'label' => __('Select Category to display Slider', 'classic-ecommerce'),
		'settings'   => 'classic_ecommerce_slidersection',
	) ) );

	$wp_customize->add_setting('classic_ecommerce_button_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_button_text', array(
	   'settings' => 'classic_ecommerce_button_text',
	   'section'   => 'classic_ecommerce_one_cols_section',
	   'label' => __('Add Button Text', 'classic-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_ecommerce_button_link_slider',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('classic_ecommerce_button_link_slider',array(
        'label' => esc_html__('Add Button Link','classic-ecommerce'),
        'section'=> 'classic_ecommerce_one_cols_section',
        'type'=> 'url'
    ));

    //Slider height
    $wp_customize->add_setting('classic_ecommerce_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('classic_ecommerce_slider_img_height',array(
        'label' => __('Slider Image Height','classic-ecommerce'),
        'description'   => __('Add the slider image height here (eg. 600px)','classic-ecommerce'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'classic-ecommerce' ),
        ),
        'section'=> 'classic_ecommerce_one_cols_section',
        'type'=> 'text'
    ));

    $wp_customize->add_setting( 'classic_ecommerce_slider_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_slider_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
	    'section' => 'classic_ecommerce_one_cols_section'
	));

	// Product Section
	$wp_customize->add_section('classic_ecommerce_two_cols_section',array(
		'title'	=> __('Manage Recent product Section','classic-ecommerce'),
		'description'	=> __('<p class="sec-title">Manage Recent product Section</p> Add the below section title, Then use given shortcodes to show products. [products limit="4" columns="2" visibility="featured" ], [products limit="3" columns="3" best_selling="true" ], 
	[products limit="8" columns="4" category="hoodies" cat_operator="AND"]','classic-ecommerce'),
		'priority'	=> null,
		'panel' => 'classic_ecommerce_panel_area'
	));

	$wp_customize->add_setting('classic_ecommerce_hidcatproduct',array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_hidcatproduct', array(
	   'section'   => 'classic_ecommerce_two_cols_section',
	   'label'	=> __('Check To Show Product Section','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));
	
	$wp_customize->add_setting('classic_ecommerce_recent_product_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_recent_product_title', array(
	   'settings' => 'classic_ecommerce_recent_product_title',
	   'section'   => 'classic_ecommerce_two_cols_section',
	   'label'     => __('Add Section Title','classic-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting( 'classic_ecommerce_secondsec_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_secondsec_settings_upgraded_features', array(
	  'type'=> 'hidden',
	  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	      <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
	  'section' => 'classic_ecommerce_two_cols_section'
	));

	//Blog post
	$wp_customize->add_section('classic_ecommerce_blog_post_settings',array(
        'title' => __('Manage Post Section', 'classic-ecommerce'),
        'priority' => 998,
        'panel' => 'classic_ecommerce_panel_area'
    ) );

	$wp_customize->add_setting('classic_ecommerce_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_ecommerce_metafields_date', array(
	    'settings' => 'classic_ecommerce_metafields_date', 
	    'section'   => 'classic_ecommerce_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'classic-ecommerce'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('classic_ecommerce_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));	
	$wp_customize->add_control('classic_ecommerce_metafields_comments', array(
		'settings' => 'classic_ecommerce_metafields_comments',
		'section'  => 'classic_ecommerce_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'classic-ecommerce'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('classic_ecommerce_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_ecommerce_metafields_author', array(
		'settings' => 'classic_ecommerce_metafields_author',
		'section'  => 'classic_ecommerce_blog_post_settings',
		'label'    => __('Check to Enable Author', 'classic-ecommerce'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('classic_ecommerce_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_ecommerce_metafields_time', array(
		'settings' => 'classic_ecommerce_metafields_time',
		'section'  => 'classic_ecommerce_blog_post_settings',
		'label'    => __('Check to Enable Time', 'classic-ecommerce'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('classic_ecommerce_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','classic-ecommerce'),
		'description' => __('Ex: "/", "|", "-", ...','classic-ecommerce'),
		'section' => 'classic_ecommerce_blog_post_settings'
	)); 

   // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('classic_ecommerce_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'classic-ecommerce'),
		'description'   => __('This option work for blog page, archive page and search page.', 'classic-ecommerce'),
		'section' => 'classic_ecommerce_blog_post_settings',
		'choices' => array(
			'full' => __('Full','classic-ecommerce'),
			'left' => __('Left','classic-ecommerce'),
			'right' => __('Right','classic-ecommerce'),
			'three-column' => __('Three Columns','classic-ecommerce'),
			'four-column' => __('Four Columns','classic-ecommerce'),
			'grid' => __('Grid Layout','classic-ecommerce')
     ),
	) );

	$wp_customize->add_setting('classic_ecommerce_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','classic-ecommerce'),
        'section' => 'classic_ecommerce_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','classic-ecommerce'),
            'Excerpt Content' => __('Excerpt Content','classic-ecommerce'),
            'Full Content' => __('Full Content','classic-ecommerce'),
        ),
	) );

	$wp_customize->add_setting('classic_ecommerce_blog_post_thumb',array(
        'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('classic_ecommerce_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'classic-ecommerce'),
        'section'     => 'classic_ecommerce_blog_post_settings',
    ));

    $wp_customize->add_setting( 'classic_ecommerce_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'classic_ecommerce_sanitize_integer'
    ) );
    $wp_customize->add_control(new classic_ecommerce_Slider_Custom_Control( $wp_customize, 'classic_ecommerce_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','classic-ecommerce'),
		'section'=> 'classic_ecommerce_blog_post_settings',
		'settings'=>'classic_ecommerce_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'classic_ecommerce_blog_post_page_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_blog_post_page_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_blog_post_settings'
	));	

	//Single Post Settings
	$wp_customize->add_section('classic_ecommerce_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'classic-ecommerce'),
		'priority' => null,
		'panel' => 'classic_ecommerce_panel_area'
	));

	$wp_customize->add_setting( 'classic_ecommerce_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_ecommerce_single_page_breadcrumb',array(
       'section' => 'classic_ecommerce_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','classic-ecommerce' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('classic_ecommerce_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_ecommerce_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','classic-ecommerce'),
		'section' => 'classic_ecommerce_single_post_settings'
	));	

	$wp_customize->add_setting('classic_ecommerce_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_ecommerce_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','classic-ecommerce'),
		'section' => 'classic_ecommerce_single_post_settings'
	));

	$wp_customize->add_setting('classic_ecommerce_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_ecommerce_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','classic-ecommerce'),
		'section' => 'classic_ecommerce_single_post_settings'
	));	

	$wp_customize->add_setting('classic_ecommerce_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_ecommerce_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','classic-ecommerce'),
		'section' => 'classic_ecommerce_single_post_settings'
	));	

	$wp_customize->add_setting('classic_ecommerce_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','classic-ecommerce'),
		'description' => __('Ex: "/", "|", "-", ...','classic-ecommerce'),
		'section' => 'classic_ecommerce_single_post_settings'
	)); 

	$wp_customize->add_setting('classic_ecommerce_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'classic-ecommerce'),
     	'section' => 'classic_ecommerce_single_post_settings',
     	'choices' => array(
			'full' => __('Full','classic-ecommerce'),
			'left' => __('Left','classic-ecommerce'),
			'right' => __('Right','classic-ecommerce'),
     ),
	));

	$wp_customize->add_setting( 'classic_ecommerce_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_single_post_settings'
	)); 

	//Page Settings
	$wp_customize->add_section('classic_ecommerce_page_settings',array(
		'title' => __('Manage Page Section', 'classic-ecommerce'),
		'priority' => null,
		'panel' => 'classic_ecommerce_panel_area'
	));

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('classic_ecommerce_sidebar_page_layout',array(
		'default' => 'full',
			'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'classic-ecommerce'),
		'section' => 'classic_ecommerce_page_settings',
		'choices' => array(
			'left' => __('Left','classic-ecommerce'),
			'right' => __('Right','classic-ecommerce'),
			'full' => __('No Sidebar','classic-ecommerce')
		),
	));	

	// 404 Page Settings
	$wp_customize->add_section('classic_ecommerce_page_not_found', array(
		'title'	=> __('Manage 404 Page Section','classic-ecommerce'),
		'priority'	=> null,
		'panel' => 'classic_ecommerce_panel_area',
	));
	
	$wp_customize->add_setting('classic_ecommerce_page_not_found_heading',array(
		'default'=> __('404 Not Found','classic-ecommerce'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_page_not_found_heading',array(
		'label'	=> __('404 Heading','classic-ecommerce'),
		'section'=> 'classic_ecommerce_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('classic_ecommerce_page_not_found_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('classic_ecommerce_page_not_found_content',array(
		'label'	=> __('404 Text','classic-ecommerce'),
		'input_attrs' => array(
			'placeholder' => __( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'classic-ecommerce' ),
		),
		'section'=> 'classic_ecommerce_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'classic_ecommerce_page_not_found_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_page_not_found_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_page_not_found'
	));

	// Footer Section 
	$wp_customize->add_section('classic_ecommerce_footer', array(
		'title'	=> __('Mange Footer Section','classic-ecommerce'),
        'description' => __('<p class="sec-title">Manage Footer Section</p>','classic-ecommerce'),
		'priority'	=> 999,
		'panel' => 'classic_ecommerce_panel_area',
	));

	$wp_customize->add_setting('classic_ecommerce_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_ecommerce_footer_widget', array(
	    'settings' => 'classic_ecommerce_footer_widget', // Corrected setting name
	    'section'   => 'classic_ecommerce_footer',
	    'label'     => __('Check to Enable Footer Widget', 'classic-ecommerce'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('classic_ecommerce_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'classic_ecommerce_footer_bg_image',array(
        'label' => __('Footer Background Image','classic-ecommerce'),
        'section' => 'classic_ecommerce_footer',
    )));

	$wp_customize->add_setting('classic_ecommerce_footer_img_position',array(
		'default' => 'center center',
		'transport' => 'refresh',
		'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('classic_ecommerce_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','classic-ecommerce'),
		'section' => 'classic_ecommerce_footer',
		'choices' 	=> array(
			'center center'   => esc_html__( 'Center', 'classic-ecommerce' ),
			'center top'   => esc_html__( 'Top', 'classic-ecommerce' ),
			'left center'   => esc_html__( 'Left', 'classic-ecommerce' ),
			'right center'   => esc_html__( 'Right', 'classic-ecommerce' ),
			'center bottom'   => esc_html__( 'Bottom', 'classic-ecommerce' ),
		),
	));	

	$wp_customize->add_setting('classic_ecommerce_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_ecommerce_copyright_line', array(
	   'section' 	=> 'classic_ecommerce_footer',
	   'label'	 	=> __('Copyright Line','classic-ecommerce'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    $wp_customize->add_setting('classic_ecommerce_copyright_link',array(
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'classic_ecommerce_copyright_link', array(
	   'section' 	=> 'classic_ecommerce_footer',
	   'label'	 	=> __('Copyright Link','classic-ecommerce'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	// footer bg col
	$wp_customize->add_setting('classic_ecommerce_footer_bg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_bg_col', array(
		'settings' => 'classic_ecommerce_footer_bg_col',
		'section'   => 'classic_ecommerce_footer',
		'label' => __('BG Color', 'classic-ecommerce'),
		'type'      => 'color'
	));

	// footer coypright col
	$wp_customize->add_setting('classic_ecommerce_footer_coypright_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_coypright_col', array(
	   'settings' => 'classic_ecommerce_footer_coypright_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('Copyright Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// footer coyprighthover col
	$wp_customize->add_setting('classic_ecommerce_footer_coyprighthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_coyprighthover_col', array(
	   'settings' => 'classic_ecommerce_footer_coyprighthover_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('Copyright Hover Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// footer coyprightbg col
	$wp_customize->add_setting('classic_ecommerce_footer_coyprightbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_coyprightbg_col', array(
	   'settings' => 'classic_ecommerce_footer_coyprightbg_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('Copyright BG Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// footer heading col
	$wp_customize->add_setting('classic_ecommerce_footer_heading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_heading_col', array(
	   'settings' => 'classic_ecommerce_footer_heading_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('Heading Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// footer text col
	$wp_customize->add_setting('classic_ecommerce_footer_text_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_text_col', array(
	   'settings' => 'classic_ecommerce_footer_text_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('Text Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// footer list col
	$wp_customize->add_setting('classic_ecommerce_footer_list_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_list_col', array(
	   'settings' => 'classic_ecommerce_footer_list_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('List Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

	// footer listhover col
	$wp_customize->add_setting('classic_ecommerce_footer_listhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_listhover_col', array(
	   'settings' => 'classic_ecommerce_footer_listhover_col',
	   'section'   => 'classic_ecommerce_footer',
	   'label' => __('List Hover Color', 'classic-ecommerce'),
	   'type'      => 'color'
	));

    $wp_customize->add_setting('classic_ecommerce_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'classic_ecommerce_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'classic-ecommerce' ),
        'section'        => 'classic_ecommerce_footer',
        'settings'       => 'classic_ecommerce_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('classic_ecommerce_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'classic_ecommerce_sanitize_choices'
    ));
    $wp_customize->add_control('classic_ecommerce_scroll_position',array(
        'type' => 'radio',
        'section' => 'classic_ecommerce_footer',
        'label'	 	=> __('Scroll To Top Positions','classic-ecommerce'),
        'choices' => array(
            'Right' => __('Right','classic-ecommerce'),
            'Left' => __('Left','classic-ecommerce'),
            'Center' => __('Center','classic-ecommerce')
        ),
    ) );

	$wp_customize->add_setting('classic_ecommerce_scroll_text',array(
		'default'	=> __('TOP','classic-ecommerce'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('classic_ecommerce_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','classic-ecommerce'),
		'section'	=> 'classic_ecommerce_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'classic_ecommerce_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'classic_ecommerce_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'classic-ecommerce' ),
		'section'  => 'classic_ecommerce_footer',
		'settings' => 'classic_ecommerce_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'classic-ecommerce' ),
			'curved' => __( 'Curved', 'classic-ecommerce'),
			'circle'     => __( 'Circle', 'classic-ecommerce' ),
		),
	));

	$wp_customize->add_setting('classic_ecommerce_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'classic_ecommerce_sanitize_choices',
	));
	$wp_customize->add_control('classic_ecommerce_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'classic_ecommerce_footer',
		'label'       => __('Footer widget area', 'classic-ecommerce'),
		'choices' => array(
		   '1'     => __('One', 'classic-ecommerce'),
		   '2'     => __('Two', 'classic-ecommerce'),
		   '3'     => __('Three', 'classic-ecommerce'),
		   '4'     => __('Four', 'classic-ecommerce')
		),
	));
    // Progress Bar
	$wp_customize->add_setting('classic_ecommerce_progress_bar', array(
		'default' => false,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'classic_ecommerce_progress_bar',
			array(
				'label' => __('Check To Show Progress Bar', 'classic-ecommerce'),
				'section' => 'classic_ecommerce_footer',
				'settings' => 'classic_ecommerce_progress_bar',
				'type' => 'checkbox',
			)
		)
	);
    // Sticky Copyright Enable / Disable
	$wp_customize->add_setting('classic_ecommerce_sticky_copyright_enable',array(
		'default' => false,
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_sticky_copyright_enable', array(
	   'section'   => 'classic_ecommerce_footer',
	   'label'	=> __('Check To Show Sticky Copyright','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));
    $wp_customize->add_setting( 'classic_ecommerce_footer_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_footer_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
	    'section' => 'classic_ecommerce_footer'
	));

	// Footer Social Section
	$wp_customize->add_section('classic_ecommerce_footer_social_icons', array(
		'title'	=> __('Manage Footer Social Section','classic-ecommerce'),
		'description'	=> __('<p class="sec-title">Manage Footer Social Section</p>','classic-ecommerce'),
		'priority'	=> 999,
		'panel' => 'classic_ecommerce_panel_area',
	));

	$wp_customize->add_setting('classic_ecommerce_footer_facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_facebook_link', array(
	   'settings' => 'classic_ecommerce_footer_facebook_link',
	   'section'   => 'classic_ecommerce_footer_social_icons',
	   'label' => __('Facebook Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_footer_twitter_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_twitter_link', array(
	   'settings' => 'classic_ecommerce_footer_twitter_link',
	   'section'   => 'classic_ecommerce_footer_social_icons',
	   'label' => __('Twitter Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_footer_linkedin_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_linkedin_link', array(
	   'settings' => 'classic_ecommerce_footer_linkedin_link',
	   'section'   => 'classic_ecommerce_footer_social_icons',
	   'label' => __('Linkedin Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_footer_instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_instagram_link', array(
	   'settings' => 'classic_ecommerce_footer_instagram_link',
	   'section'   => 'classic_ecommerce_footer_social_icons',
	   'label' => __('Instagram Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_ecommerce_footer_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_ecommerce_footer_youtube_link', array(
	   'settings' => 'classic_ecommerce_footer_youtube_link',
	   'section'   => 'classic_ecommerce_footer_social_icons',
	   'label' => __('Youtube Link', 'classic-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting( 'classic_ecommerce_footer_social_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_ecommerce_footer_social_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-template') ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_ecommerce_footer_social_icons'
	));

    // Google Fonts
    $wp_customize->add_section( 'classic_ecommerce_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'classic-ecommerce' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'' => 'No Fonts',
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i:' => 'Montserrat',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'classic_ecommerce_headings_fonts', array(
		'sanitize_callback' => 'classic_ecommerce_sanitize_fonts',
	));
	$wp_customize->add_control( 'classic_ecommerce_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'classic-ecommerce'),
		'section' => 'classic_ecommerce_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'classic_ecommerce_body_fonts', array(
		'sanitize_callback' => 'classic_ecommerce_sanitize_fonts'
	));
	$wp_customize->add_control( 'classic_ecommerce_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'classic-ecommerce' ),
		'section' => 'classic_ecommerce_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting('classic_ecommerce_woocommerce_sidebar_shop',array(
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_woocommerce_sidebar_shop', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from shop page.','classic-ecommerce'),
	   'label'	=> __('Shop Page Sidebar layout','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_ecommerce_woocommerce_sidebar_product',array(
		'sanitize_callback' => 'classic_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_ecommerce_woocommerce_sidebar_product', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from product page.','classic-ecommerce'),
	   'label'	=> __('Product Page Sidebar layout','classic-ecommerce'),
	   'type'      => 'checkbox'
 	));
}
add_action( 'customize_register', 'classic_ecommerce_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function classic_ecommerce_customize_preview_js() {
	wp_enqueue_script( 'classic_ecommerce_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'classic_ecommerce_customize_preview_js' );