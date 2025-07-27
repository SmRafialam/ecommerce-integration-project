<?php
require get_template_directory() . '/demo-import/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function wp_fashion_storefront_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'Woocommerce', 'wp-fashion-storefront' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => true,
			'force_activation' => false,
		),
		array(
            'name'             => __( 'GTranslate', 'wp-fashion-storefront' ),
            'slug'             => 'gtranslate',
			'source'           => '',
            'required'         => true,
			'force_activation' => false,
        ),
		array(
			'name'             => __( 'FOX – Currency Switcher Professional for WooCommerce', 'wp-fashion-storefront' ),
			'slug'             => 'woocommerce-currency-switcher',
			'source'           => '',
			'required'         => true,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'wp-fashion-storefront' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'         => true,
			'force_activation' => false,
		)
	);
	$wp_fashion_storefront_config = array();
	tgmpa( $plugins, $wp_fashion_storefront_config );
}
add_action( 'tgmpa_register', 'wp_fashion_storefront_register_recommended_plugins_set' );
