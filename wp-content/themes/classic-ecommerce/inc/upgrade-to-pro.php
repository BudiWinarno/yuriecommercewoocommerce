<?php
/**
 * Upgrade to pro options
 */
function classic_ecommerce_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => esc_html__(CLASSIC_ECOMMERCE_PRO_NAME),
			'priority' => 1,
		)
	);

	class Classic_Ecommerce_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
				    <li><a class="upgrade-to-pro pro-btn" href="<?php echo esc_url( CLASSIC_ECOMMERCE_PREMIUM_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'classic-ecommerce' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CLASSIC_ECOMMERCE_PRO_DEMO ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'classic-ecommerce' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CLASSIC_ECOMMERCE_REVIEW ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'classic-ecommerce' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CLASSIC_ECOMMERCE_SUPPORT ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'classic-ecommerce' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CLASSIC_ECOMMERCE_THEME_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e( 'Theme Page', 'classic-ecommerce' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CLASSIC_ECOMMERCE_THEME_DOCUMENTATION ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'classic-ecommerce' ); ?> </a></li>

				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'classic_ecommerce_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Classic_Ecommerce_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'classic_ecommerce_upgrade_pro_options' );
