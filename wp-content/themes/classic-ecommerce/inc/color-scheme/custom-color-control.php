<?php 

$classic_ecommerce_color_scheme_one = get_theme_mod('classic_ecommerce_color_scheme_one');
$classic_ecommerce_color_scheme_css = "";

/*------------------ Global First Color -----------*/

if ($classic_ecommerce_color_scheme_one) {
    $classic_ecommerce_color_scheme_css .= ':root {';
    $classic_ecommerce_color_scheme_css .= '--first-theme-color: ' . esc_attr($classic_ecommerce_color_scheme_one) . ' !important;';
    $classic_ecommerce_color_scheme_css .= '} ';
}
  
//---------------------------------Logo-Max-height--------- 
$classic_ecommerce_logo_width = get_theme_mod('classic_ecommerce_logo_width');

if($classic_ecommerce_logo_width != false){

$classic_ecommerce_color_scheme_css .='.logo img{';

    $classic_ecommerce_color_scheme_css .='width: '.esc_html($classic_ecommerce_logo_width).'px;';

$classic_ecommerce_color_scheme_css .='}';
}

/*---------------------------Slider Height ------------*/

$classic_ecommerce_slider_img_height = get_theme_mod('classic_ecommerce_slider_img_height');
if($classic_ecommerce_slider_img_height != false){
    $classic_ecommerce_color_scheme_css .='.slidesection img{';
        $classic_ecommerce_color_scheme_css .='height: '.esc_attr($classic_ecommerce_slider_img_height).' !important;';
    $classic_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$classic_ecommerce_footer_bg_image = get_theme_mod('classic_ecommerce_footer_bg_image');
if($classic_ecommerce_footer_bg_image != false){
    $classic_ecommerce_color_scheme_css .='#footer{';
        $classic_ecommerce_color_scheme_css .='background: url('.esc_attr($classic_ecommerce_footer_bg_image).');';
    $classic_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Footer image position -------------------*/

$classic_ecommerce_footer_img_position = get_theme_mod('classic_ecommerce_footer_img_position','center center');
if($classic_ecommerce_footer_img_position != false){
    $classic_ecommerce_color_scheme_css .='#footer{';
        $classic_ecommerce_color_scheme_css .='background-position: '.esc_attr($classic_ecommerce_footer_img_position).';';
    $classic_ecommerce_color_scheme_css .='}';
}	

/*--------------------------- Scroll to top positions -------------------*/

$classic_ecommerce_scroll_position = get_theme_mod( 'classic_ecommerce_scroll_position','Right');
if($classic_ecommerce_scroll_position == 'Right'){
    $classic_ecommerce_color_scheme_css .='#button{';
        $classic_ecommerce_color_scheme_css .='right: 20px;';
    $classic_ecommerce_color_scheme_css .='}';
}else if($classic_ecommerce_scroll_position == 'Left'){
    $classic_ecommerce_color_scheme_css .='#button{';
        $classic_ecommerce_color_scheme_css .='left: 20px;';
    $classic_ecommerce_color_scheme_css .='}';
}else if($classic_ecommerce_scroll_position == 'Center'){
    $classic_ecommerce_color_scheme_css .='#button{';
        $classic_ecommerce_color_scheme_css .='right: 50%;left: 50%;';
    $classic_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$classic_ecommerce_blog_post_page_image_box_shadow = get_theme_mod('classic_ecommerce_blog_post_page_image_box_shadow',0);
if($classic_ecommerce_blog_post_page_image_box_shadow != false){
    $classic_ecommerce_color_scheme_css .='.post-thumb img{';
        $classic_ecommerce_color_scheme_css .='box-shadow: '.esc_attr($classic_ecommerce_blog_post_page_image_box_shadow).'px '.esc_attr($classic_ecommerce_blog_post_page_image_box_shadow).'px '.esc_attr($classic_ecommerce_blog_post_page_image_box_shadow).'px #cccccc;';
    $classic_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$classic_ecommerce_woo_product_img_border_radius = get_theme_mod('classic_ecommerce_woo_product_img_border_radius');
if($classic_ecommerce_woo_product_img_border_radius != false){
    $classic_ecommerce_color_scheme_css .='.woocommerce ul.products li.product a img{';
        $classic_ecommerce_color_scheme_css .='border-radius: '.esc_attr($classic_ecommerce_woo_product_img_border_radius).'px;';
    $classic_ecommerce_color_scheme_css .='}';
}


/*--------------------------- Shop page pagination -------------------*/

$classic_ecommerce_wooproducts_nav = get_theme_mod('classic_ecommerce_wooproducts_nav', 'Yes');
if($classic_ecommerce_wooproducts_nav == 'No'){
  $classic_ecommerce_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $classic_ecommerce_color_scheme_css .='display: none;';
  $classic_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Related Product -------------------*/

$classic_ecommerce_related_product_enable = get_theme_mod('classic_ecommerce_related_product_enable',true);
if($classic_ecommerce_related_product_enable == false){
  $classic_ecommerce_color_scheme_css .='.related.products{';
    $classic_ecommerce_color_scheme_css .='display: none;';
  $classic_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Sale Position -------------------*/    

$classic_ecommerce_product_sale_position = get_theme_mod( 'classic_ecommerce_product_sale_position','Left');
if($classic_ecommerce_product_sale_position == 'Right'){
    $classic_ecommerce_color_scheme_css .='.woocommerce ul.products li.product .onsale{';
        $classic_ecommerce_color_scheme_css .='left:auto !important; right:.5em !important;';
    $classic_ecommerce_color_scheme_css .='}';
}else if($classic_ecommerce_product_sale_position == 'Left'){
    $classic_ecommerce_color_scheme_css .='.woocommerce ul.products li.product .onsale {';
        $classic_ecommerce_color_scheme_css .='right:auto !important; left:.5em !important;';
    $classic_ecommerce_color_scheme_css .='}';
} 

/*--------------------------- Scroll to Top Button Shape -------------------*/

$classic_ecommerce_scroll_top_shape = get_theme_mod('classic_ecommerce_scroll_top_shape', 'circle');
if($classic_ecommerce_scroll_top_shape == 'box' ){
    $classic_ecommerce_color_scheme_css .='#button{';
        $classic_ecommerce_color_scheme_css .=' border-radius: 0%';
    $classic_ecommerce_color_scheme_css .='}';
}elseif($classic_ecommerce_scroll_top_shape == 'curved' ){
    $classic_ecommerce_color_scheme_css .='#button{';
        $classic_ecommerce_color_scheme_css .=' border-radius: 20%';
    $classic_ecommerce_color_scheme_css .='}';
}elseif($classic_ecommerce_scroll_top_shape == 'circle' ){
    $classic_ecommerce_color_scheme_css .='#button{';
        $classic_ecommerce_color_scheme_css .=' border-radius: 50%;';
    $classic_ecommerce_color_scheme_css .='}';
}