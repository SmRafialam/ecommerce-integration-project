<?php
/**
 * WP Fashion Storefront functions and definitions
 *
 * @package WP Fashion Storefront
 */

if ( ! defined( 'WP_FASHION_STOREFRONT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'WP_FASHION_STOREFRONT_VERSION', '1.0.0' );
}

function wp_fashion_storefront_setup() {

	load_theme_textdomain( 'wp-fashion-storefront', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wp-fashion-storefront' ),
			'social-menu' => esc_html__('Social Menu', 'wp-fashion-storefront'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'wp_fashion_storefront_custom_background_args',
			array(
				'default-color' => '#fafafa',
				'default-image' => '',
			)
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support( 'post-formats', array(
        'image',
        'video',
        'gallery',
        'audio', 
    ));
	
}
add_action( 'after_setup_theme', 'wp_fashion_storefront_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $wp_fashion_storefront_content_width
 */
function wp_fashion_storefront_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_fashion_storefront_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_fashion_storefront_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_fashion_storefront_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp-fashion-storefront' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-fashion-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'wp-fashion-storefront' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-fashion-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'wp-fashion-storefront' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'wp-fashion-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'wp-fashion-storefront' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'wp-fashion-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_fashion_storefront_widgets_init' );


function wp_fashion_storefront_social_menu()
    {
        if (has_nav_menu('social-menu')) :
            wp_nav_menu(array(
                'theme_location' => 'social-menu',
                'container' => 'ul',
                'menu_class' => 'social-menu menu',
                'menu_id'  => 'menu-social',
            ));
        endif;
    }

/**
 * Enqueue scripts and styles.
 */
function wp_fashion_storefront_scripts() {

	// Load fonts locally
	require_once get_theme_file_path('revolution/inc/wptt-webfont-loader.php');

	$wp_fashion_storefront_font_families = array(
		'Abril Fatface',
		'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	);
	
	$wp_fashion_storefront_fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $wp_fashion_storefront_font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	wp_enqueue_style('wp-fashion-storefront-google-fonts', wptt_get_webfont_url(esc_url_raw($wp_fashion_storefront_fonts_url)), array(), '1.0.0');
	
	// Font Awesome CSS
	wp_enqueue_style('font-awesome-5', get_template_directory_uri() . '/revolution/assets/vendors/font-awesome-5/css/all.min.css', array());

	wp_enqueue_style('owl.carousel.style', get_template_directory_uri() . '/revolution/assets/css/owl.carousel.css', array());
	
	wp_enqueue_style( 'wp-fashion-storefront-style', get_stylesheet_uri(), array(), WP_FASHION_STOREFRONT_VERSION );

	require get_parent_theme_file_path( '/custom-style.php' );
	wp_add_inline_style( 'wp-fashion-storefront-style',$wp_fashion_storefront_custom_css );

	wp_style_add_data('wp-fashion-storefront-style', 'rtl', 'replace');

	wp_enqueue_script( 'wp-fashion-storefront-navigation', get_template_directory_uri() . '/js/navigation.js', array(), WP_FASHION_STOREFRONT_VERSION, true );

	wp_enqueue_script( 'owl.carousel.jquery', get_template_directory_uri() . '/revolution/assets/js/owl.carousel.js', array(), WP_FASHION_STOREFRONT_VERSION, true );

	wp_enqueue_script( 'wp-fashion-storefront-custom-js', get_template_directory_uri() . '/revolution/assets/js/custom.js', array('jquery'), WP_FASHION_STOREFRONT_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_fashion_storefront_scripts' );

if (!function_exists('wp_fashion_storefront_related_post')) :
    /**
     * Display related posts from same category
     *
     */

    function wp_fashion_storefront_related_post($post_id){        
        $wp_fashion_storefront_categories = get_the_category($post_id);
        if ($wp_fashion_storefront_categories) {
            $wp_fashion_storefront_category_ids = array();
            $wp_fashion_storefront_category = get_category($wp_fashion_storefront_category_ids);
            $wp_fashion_storefront_categories = get_the_category($post_id);
            foreach ($wp_fashion_storefront_categories as $wp_fashion_storefront_category) {
                $wp_fashion_storefront_category_ids[] = $wp_fashion_storefront_category->term_id;
            }
            $wp_fashion_storefront_count = $wp_fashion_storefront_category->category_count;
            if ($wp_fashion_storefront_count > 1) { ?>

         	<?php
		$wp_fashion_storefront_related_post_wrap = absint(get_theme_mod('wp_fashion_storefront_enable_related_post', 1));
		if($wp_fashion_storefront_related_post_wrap == 1){ ?>
                <div class="related-post">
                    
                    <h2 class="post-title"><?php esc_html_e(get_theme_mod('wp_fashion_storefront_related_post_text', __('Related Post', 'wp-fashion-storefront'))); ?></h2>
                    <?php
                    $wp_fashion_storefront_cat_post_args = array(
                        'category__in' => $wp_fashion_storefront_category_ids,
                        'post__not_in' => array($post_id),
                        'post_type' => 'post',
                        'posts_per_page' =>  get_theme_mod( 'wp_fashion_storefront_related_post_count', '3' ),
                        'post_status' => 'publish',
						'orderby'           => 'rand',
                        'ignore_sticky_posts' => true
                    );
                    $wp_fashion_storefront_featured_query = new WP_Query($wp_fashion_storefront_cat_post_args);
                    ?>
                    <div class="rel-post-wrap">
                        <?php
                        if ($wp_fashion_storefront_featured_query->have_posts()) :

                        while ($wp_fashion_storefront_featured_query->have_posts()) : $wp_fashion_storefront_featured_query->the_post();
                            ?>
							<div class="card-item rel-card-item">
								<div class="card-content">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="card-media">
											<?php wp_fashion_storefront_post_thumbnail(); ?>
										</div>
									<?php } else {
										// Fallback default image
										$wp_fashion_storefront_default_post_thumbnail = get_template_directory_uri() . '/revolution/assets/images/Smartwatch-with-Health-Tracker.png';
										echo '<img class="default-post-img" src="' . esc_url( $wp_fashion_storefront_default_post_thumbnail ) . '" alt="' . esc_attr( get_the_title() ) . '">';
									} ?>
									<div class="entry-title">
										<h3>
											<a href="<?php the_permalink() ?>">
												<?php the_title(); ?>
											</a>
										</h3>
									</div>
									<div class="entry-meta">
										<?php
										wp_fashion_storefront_posted_on();
										wp_fashion_storefront_posted_by();
										?>
									</div>
								</div>
							</div>
                        <?php
                        endwhile;
                        ?>
                <?php
                endif;
                wp_reset_postdata();
                ?>
                </div>
                <?php } ?>
                <?php
            }
        }
    }
endif;
add_action('wp_fashion_storefront_related_posts', 'wp_fashion_storefront_related_post', 10, 1);

//Excerpt 
function wp_fashion_storefront_excerpt_function($wp_fashion_storefront_excerpt_count = 35) {
    $wp_fashion_storefront_excerpt = get_the_excerpt();
    $wp_fashion_storefront_text_excerpt = wp_strip_all_tags($wp_fashion_storefront_excerpt);
    $wp_fashion_storefront_excerpt_limit = (int) get_theme_mod('wp_fashion_storefront_excerpt_limit', $wp_fashion_storefront_excerpt_count);
    $wp_fashion_storefront_words = preg_split('/\s+/', $wp_fashion_storefront_text_excerpt); 
    $wp_fashion_storefront_trimmed_words = array_slice($wp_fashion_storefront_words, 0, $wp_fashion_storefront_excerpt_limit);
    $wp_fashion_storefront_theme_excerpt = implode(' ', $wp_fashion_storefront_trimmed_words);

    return $wp_fashion_storefront_theme_excerpt;
}

// Add admin notice
function wp_fashion_storefront_admin_notice() { 
    global $pagenow;
    $wp_fashion_storefront_theme_args      = wp_get_theme();
    $wp_fashion_storefront_meta            = get_option( 'wp_fashion_storefront_admin_notice' );
    $name            = $wp_fashion_storefront_theme_args->__get( 'Name' );
    $wp_fashion_storefront_current_screen  = get_current_screen();

    if( !$wp_fashion_storefront_meta ){
	    if( is_network_admin() ){
	        return;
	    }

	    if( ! current_user_can( 'manage_options' ) ){
	        return;
	    } 
		
		if($wp_fashion_storefront_current_screen->base != 'appearance_page_wp_fashion_storefront_guide' ) { ?>
			<div class="notice notice-success">
				<h2><?php esc_html_e('Hey, Thank you for installing WP Fashion Storefront Theme!', 'wp-fashion-storefront'); ?><span><a class="info-link" href="<?php echo esc_url( admin_url( 'themes.php?page=wp-fashion-storefront-getstart-page' ) ); ?>"><?php esc_html_e('Click Here for more Details', 'wp-fashion-storefront'); ?></a></span></h2>
				<p class="dismiss-link"><strong><a href="?wp_fashion_storefront_admin_notice=1"><?php esc_html_e( 'Dismiss', 'wp-fashion-storefront' ); ?></a></strong></p>
			</div>
			<?php
		}
	}
}

add_action( 'admin_notices', 'wp_fashion_storefront_admin_notice' );

if( ! function_exists( 'wp_fashion_storefront_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function wp_fashion_storefront_update_admin_notice(){
    if ( isset( $_GET['wp_fashion_storefront_admin_notice'] ) && $_GET['wp_fashion_storefront_admin_notice'] = '1' ) {
        update_option( 'wp_fashion_storefront_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'wp_fashion_storefront_update_admin_notice' );


add_action('after_switch_theme', 'wp_fashion_storefront_setup_options');
function wp_fashion_storefront_setup_options () {
    update_option('wp_fashion_storefront_admin_notice', FALSE );
}


/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$wp_fashion_storefront_checked`
 * as a boolean value, either TRUE or FALSE.
 */
function wp_fashion_storefront_sanitize_checkbox($wp_fashion_storefront_checked)
{
    // Boolean check.
    return ((isset($wp_fashion_storefront_checked) && true == $wp_fashion_storefront_checked) ? true : false);
}

function wp_fashion_storefront_sanitize_choices( $wp_fashion_storefront_input, $wp_fashion_storefront_setting ) {
    global $wp_customize; 
    $wp_fashion_storefront_control = $wp_customize->get_control( $wp_fashion_storefront_setting->id ); 
    if ( array_key_exists( $wp_fashion_storefront_input, $wp_fashion_storefront_control->choices ) ) {
        return $wp_fashion_storefront_input;
    } else {
        return $wp_fashion_storefront_setting->default;
    }
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/revolution/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/revolution/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/revolution/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/revolution/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/revolution/inc/jetpack.php';

}

/**
 * Breadcrumb File.
 */
require get_template_directory() . '/revolution/inc/breadcrumbs.php';

//////////////////////////////////////////////   Function for Translation Error   //////////////////////////////////////////////////////
function wp_fashion_storefront_enqueue_function() {

	/**
	* GET START.
	*/
	require get_template_directory() . '/getstarted/wp_fashion_storefront_about_page.php';

	/**
	* DEMO IMPORT.
	*/
	require get_template_directory() . '/demo-import/wp_fashion_storefront_config_file.php';

	define('WP_FASHION_STOREFRONT_FREE_SUPPORT',__('https://wordpress.org/support/theme/wp-fashion-storefront/','wp-fashion-storefront'));
	define('WP_FASHION_STOREFRONT_PRO_SUPPORT',__('https://www.revolutionwp.com/pages/community/','wp-fashion-storefront'));
	define('WP_FASHION_STOREFRONT_REVIEW',__('https://wordpress.org/support/theme/wp-fashion-storefront/reviews/#new-post','wp-fashion-storefront'));
	define('WP_FASHION_STOREFRONT_BUY_NOW',__('https://www.revolutionwp.com/products/fashion-storefront-wordpress-theme','wp-fashion-storefront'));
	define('WP_FASHION_STOREFRONT_LIVE_DEMO',__('https://demo.revolutionwp.com/fashion-storefront-pro/','wp-fashion-storefront'));
	define('WP_FASHION_STOREFRONT_PRO_DOC',__('https://demo.revolutionwp.com/wpdocs/fashion-storefront-pro/','wp-fashion-storefront'));
	define('WP_FASHION_STOREFRONT_LITE_DOC',__('https://demo.revolutionwp.com/wpdocs/fashion-storefront-free','wp-fashion-storefront'));
	
}
add_action( 'after_setup_theme', 'wp_fashion_storefront_enqueue_function' );

function wp_fashion_storefront_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'wp_fashion_storefront_remove_customize_register', 11 );


/**
 * WooCommerce custom filters
 */
add_filter('loop_shop_columns', 'wp_fashion_storefront_loop_columns');

if (!function_exists('wp_fashion_storefront_loop_columns')) {

	function wp_fashion_storefront_loop_columns() {

		$wp_fashion_storefront_columns = get_theme_mod( 'wp_fashion_storefront_per_columns', 3 );

		return $wp_fashion_storefront_columns;
	}
}

/************************************************************************************/

add_filter( 'loop_shop_per_page', 'wp_fashion_storefront_per_page', 20 );

function wp_fashion_storefront_per_page( $wp_fashion_storefront_cols ) {

  	$wp_fashion_storefront_cols = get_theme_mod( 'wp_fashion_storefront_product_per_page', 9 );

	return $wp_fashion_storefront_cols;
}

/************************************************************************************/

add_filter( 'woocommerce_output_related_products_args', 'wp_fashion_storefront_products_args' );

function wp_fashion_storefront_products_args( $wp_fashion_storefront_args ) {

    $wp_fashion_storefront_args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );

    $wp_fashion_storefront_args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );

    return $wp_fashion_storefront_args;
}

/************************************************************************************/

/**
 * Custom logo
 */

function wp_fashion_storefront_custom_css() {
?>
	<style type="text/css" id="custom-theme-colors" >
        :root {
           
            --wp_fashion_storefront_logo_width: <?php echo absint(get_theme_mod('wp_fashion_storefront_logo_width')); ?> ;   
        }
        .head-1 .site-branding {
            max-width:<?php echo esc_html(get_theme_mod('wp_fashion_storefront_logo_width')); ?>px ;    
        }         
	</style>
<?php
}
add_action( 'wp_head', 'wp_fashion_storefront_custom_css' );

function wp_fashion_storefront_woocommerce_sale_flash_percentage( $html, $post, $product ) {

	$found = preg_match( '#(<span.*?>)(.*?)(</span>)#', $html, $wp_fashion_storefront_matches );

	if ( ! $found ) {
		return $html;
	}

	$wp_fashion_storefront_tag_open      = $wp_fashion_storefront_matches[1];
	$wp_fashion_storefront_tag_close     = $wp_fashion_storefront_matches[3];
	$wp_fashion_storefront_original_text = $wp_fashion_storefront_matches[2];

	$wp_fashion_storefront_percentages = wp_fashion_storefront_woocommerce_get_product_sale_percentages( $product );
	$wp_fashion_storefront_label       = wp_fashion_storefront_woocommerce_get_product_sale_percentage_label( $wp_fashion_storefront_percentages, $wp_fashion_storefront_original_text );

	$html = $wp_fashion_storefront_tag_open . $wp_fashion_storefront_label . $wp_fashion_storefront_tag_close;

	return $html;
}

function wp_fashion_storefront_woocommerce_get_product_sale_percentages( $product ) {
	$wp_fashion_storefront_percentages = array(
		'min' => false,
		'max' => false,
	);

	switch ( $product->get_type() ) {
		case 'grouped':
			$children = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

			foreach ( $children as $child ) {
				if ( $child->is_purchasable() && ! $child->is_type( 'grouped' ) && $child->is_on_sale() ) {
					$wp_fashion_storefront_child_percentage = wp_fashion_storefront_woocommerce_get_product_sale_percentages( $child );

					$wp_fashion_storefront_percentages['min'] = false !== $wp_fashion_storefront_percentages['min'] ? $wp_fashion_storefront_percentages['min'] : $wp_fashion_storefront_child_percentage['min'];
					$wp_fashion_storefront_percentages['max'] = false !== $wp_fashion_storefront_percentages['max'] ? $wp_fashion_storefront_percentages['max'] : $wp_fashion_storefront_child_percentage['max'];

					if ( $wp_fashion_storefront_child_percentage['min'] < $wp_fashion_storefront_percentages['min'] ) {
						$wp_fashion_storefront_percentages['min'] = $wp_fashion_storefront_child_percentage['min'];
					}

					if ( $wp_fashion_storefront_child_percentage['max'] > $wp_fashion_storefront_percentages['max'] ) {
						$wp_fashion_storefront_percentages['max'] = $wp_fashion_storefront_child_percentage['max'];
					}
				}
			}

			break;

		case 'variable':
			$wp_fashion_storefront_prices = $product->get_variation_prices();

			foreach ( $wp_fashion_storefront_prices['price'] as $variation_id => $price ) {
				$wp_fashion_storefront_regular_price = (float) $wp_fashion_storefront_prices['regular_price'][ $variation_id ];
				$wp_fashion_storefront_sale_price    = (float) $wp_fashion_storefront_prices['sale_price'][ $variation_id ];

				if ( $wp_fashion_storefront_sale_price < $wp_fashion_storefront_regular_price ) {
					$wp_fashion_storefront_variation_percentage = ( ( $wp_fashion_storefront_regular_price - $wp_fashion_storefront_sale_price ) / $wp_fashion_storefront_regular_price ) * 100;

					$wp_fashion_storefront_percentages['min'] = false !== $wp_fashion_storefront_percentages['min'] ? $wp_fashion_storefront_percentages['min'] : $wp_fashion_storefront_variation_percentage;
					$wp_fashion_storefront_percentages['max'] = false !== $wp_fashion_storefront_percentages['max'] ? $wp_fashion_storefront_percentages['max'] : $wp_fashion_storefront_variation_percentage;

					if ( $wp_fashion_storefront_variation_percentage < $wp_fashion_storefront_percentages['min'] ) {
						$wp_fashion_storefront_percentages['min'] = $wp_fashion_storefront_variation_percentage;
					}

					if ( $wp_fashion_storefront_variation_percentage > $wp_fashion_storefront_percentages['max'] ) {
						$wp_fashion_storefront_percentages['max'] = $wp_fashion_storefront_variation_percentage;
					}
				}
			}
			break;

		case 'external':
		case 'variation':
		case 'simple':
		default:
			$wp_fashion_storefront_regular_price = (float) $product->get_regular_price();
			$wp_fashion_storefront_sale_price    = (float) $product->get_sale_price();

			if ( $wp_fashion_storefront_sale_price < $wp_fashion_storefront_regular_price ) {
				$wp_fashion_storefront_percentages['max'] = ( ( $wp_fashion_storefront_regular_price - $wp_fashion_storefront_sale_price ) / $wp_fashion_storefront_regular_price ) * 100;
			}
	}
	return $wp_fashion_storefront_percentages;
}

function wp_fashion_storefront_woocommerce_get_product_sale_percentage_label( $wp_fashion_storefront_percentages, $original_label ) {
	$wp_fashion_storefront_label = '';

	$rounded_percentages = $wp_fashion_storefront_percentages;
	$rounded_percentages = array_map( 'round', $wp_fashion_storefront_percentages );
	$rounded_percentages = array_map( 'intval', $rounded_percentages );

	if ( ( empty( $wp_fashion_storefront_percentages['min'] ) || empty( $wp_fashion_storefront_percentages['max'] ) ) || ( $wp_fashion_storefront_percentages['min'] === $wp_fashion_storefront_percentages['max'] ) ) {
		/* translators: 1: Percentage. */
		$wp_fashion_storefront_label = sprintf( _x( '-%1$d%%', 'product discount', 'wp-fashion-storefront' ), max( $rounded_percentages ) );
	} else {
		/* translators: 1: Percentage. */
		$wp_fashion_storefront_label = sprintf( _x( '-%1$d%% / -%2$d%%', 'product discount', 'wp-fashion-storefront' ), $rounded_percentages['min'], $rounded_percentages['max'] );
	}

	$wp_fashion_storefront_label = apply_filters( 'wp_fashion_storefront_woocommerce_sale_flash_percentage_label', $wp_fashion_storefront_label, $rounded_percentages, $wp_fashion_storefront_percentages, $original_label );

	return $wp_fashion_storefront_label;
}

function get_changelog_from_readme() {
	$wp_fashion_storefront_file_path = get_template_directory() . '/readme.txt'; // Adjust path if necessary

	if (file_exists($wp_fashion_storefront_file_path)) {
		$wp_fashion_storefront_content = file_get_contents($wp_fashion_storefront_file_path);

		// Extract changelog section
		$wp_fashion_storefront_changelog_start = strpos($wp_fashion_storefront_content, "== Changelog ==");
		$wp_fashion_storefront_changelog = substr($wp_fashion_storefront_content, $wp_fashion_storefront_changelog_start);

		// Split changelog into versions
		preg_match_all('/\*\s([\d\.]+)\s-\s(.+?)\n((?:\t-\s.+?\n)+)/', $wp_fashion_storefront_changelog, $wp_fashion_storefront_matches, PREG_SET_ORDER);
		
		return $wp_fashion_storefront_matches;
	}
	return [];
}

function wp_fashion_storefront_customize_scss() {
    // Retrieve the two colors from the customizer settings.
    $wp_fashion_storefront_color1 = get_theme_mod('wp_fashion_storefront_primary_color', '#2188FB'); // Default start color

    // Generate the gradient.
    $wp_fashion_storefront_gradient = "linear-gradient(to right, $wp_fashion_storefront_color1 , #0469D9)";
	
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html($wp_fashion_storefront_color1); ?>; /* Fallback color (color1) */
            --primary-gradient: <?php echo esc_html($wp_fashion_storefront_gradient); ?>; /* Dynamically generated gradient */
        }
    </style>
    <?php
}
add_action('wp_head', 'wp_fashion_storefront_customize_scss');

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );