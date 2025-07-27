<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

// Remove default WooCommerce checkout button
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );

// Add custom external checkout button
add_action('woocommerce_proceed_to_checkout', 'custom_external_checkout_button', 20);

function custom_external_checkout_button() {
    if ( ! is_cart() ) return;

    $checkout_url = get_custom_checkout_url();
    if ( $checkout_url ) {
        echo '<a href="' . esc_url( $checkout_url ) . '" class="button alt">External Checkout</a>';
    }
}

function get_custom_checkout_url() {
    if ( ! WC()->cart ) return null;

    $cart = WC()->cart->get_cart();
    $orderData = [];

    foreach ( $cart as $item ) {
        $product = $item['data'];
        $orderData[] = [
            'id'    => $product->get_id(),
            'name'  => $product->get_name(),
            'price' => $product->get_price(),
            'qty'   => $item['quantity']
        ];
    }

    $orderParam = urlencode( base64_encode( json_encode( $orderData ) ) );
    return 'http://localhost:3000/checkout?data=' . $orderParam;
}

// Redirect attempts to WooCommerce's default checkout page
add_action('template_redirect', 'redirect_default_checkout_page');
function redirect_default_checkout_page() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) {
        wp_safe_redirect( wc_get_cart_url() );
        exit;
    }
}

// Custom "thank you" redirect after order (fallback)
add_filter('woocommerce_get_return_url', 'custom_return_url', 10, 2);
function custom_return_url($return_url, $order) {
    return home_url('/checkout-success/');
}

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/confirm-order', array(
        'methods' => 'POST',
        'callback' => 'handle_order_confirmation',
        'permission_callback' => '__return_true',
    ));
});

function handle_order_confirmation($request) {
    $headers = $request->get_headers();
    $auth = $headers['authorization'][0] ?? '';
    $expected_token = 'my_super_secret_checkout_token_2025';

    if ($auth !== "Bearer $expected_token") {
        return new WP_REST_Response(['error' => 'Unauthorized'], 403);
    }

    $params = $request->get_json_params();
    $order_id = sanitize_text_field($params['order_id']);
    $email = sanitize_email($params['email']);
    $status = sanitize_text_field($params['status']);

    // Simulate WooCommerce order creation (minimal)
    $order = wc_create_order();
    $order->add_product(wc_get_product($order_id), 1);
    $order->set_address([
        'email' => $email,
        'first_name' => 'Rafi',
        'last_name' => 'Alam',
        'address_1' => 'Mirpur',
        'city' => 'Dhaka',
        'country' => 'BD',
    ], 'billing');

    $order->set_status($status);
    $order->calculate_totals();
    $order->save();

    return new WP_REST_Response(['message' => 'Order received and created in WordPress'], 200);
}

add_action( 'woocommerce_widget_shopping_cart_buttons', 'custom_mini_cart_buttons', 10 );

function custom_mini_cart_buttons() {
    ?>
    <a href="<?php echo wc_get_cart_url(); ?>" class="button wc-forward">View Cart</a>
    <a href="http://localhost:5000/checkout" class="button checkout wc-forward">Custom Checkout</a>
    <?php
}


// add_action( 'woocommerce_widget_shopping_cart_buttons', 'custom_mini_cart_buttons', 10 );

// function custom_mini_cart_buttons() {
//     ?>
//     <a href="<?php echo wc_get_cart_url(); ?>" class="button wc-forward">View Cart</a>
//     <a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout wc-forward">Proceed to Checkout</a>
//     <?php
// }
