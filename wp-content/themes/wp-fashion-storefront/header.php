<?php
/**
 * The header for our theme
 *
 * @package WP Fashion Storefront
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-fashion-storefront' ); ?></a>

	<?php
		$wp_fashion_storefront_preloader_wrap = absint(get_theme_mod('wp_fashion_storefront_enable_preloader', 0));
		if($wp_fashion_storefront_preloader_wrap == 1){ ?>
			<div id="loader">
				<div class="loader-container">
					<div id="preloader" class="loader-2">
						<div class="dot"></div>
					</div>
				</div>
			</div>
	<?php } ?>

	<header id="masthead" class="site-header">
		<?php $wp_fashion_storefront_has_header_image = has_header_image(); ?>
		<div class="main-header-wrap">
			<div class="top-box">
				<div class="container">
					<div class="flex-row">
						<div class="nav-box-header-left">
						<?php if ( get_theme_mod('wp_fashion_storefront_header_info_phone','+00 123 456 7890') ) : ?><p><i class="fas fa-phone-alt"></i> <?php echo esc_html( get_theme_mod('wp_fashion_storefront_header_info_phone','+00 123 456 7890') ); ?></p><?php endif; ?>
						<?php if ( get_theme_mod('wp_fashion_storefront_header_info_email','xyz123@example.com') ) : ?><p><i class="fas fa-envelope"></i> <?php echo esc_html( get_theme_mod('wp_fashion_storefront_header_info_email','xyz123@example.com') ); ?></p><?php endif; ?>
						</div>
						<div class="nav-box-header-right">
							<?php if ( get_theme_mod('wp_fashion_storefront_header_topbar_text','Summer Sale Live Now! Get Upto 50% OFF! Use Code: Summer50') ) : ?><p><?php echo esc_html( get_theme_mod('wp_fashion_storefront_header_topbar_text','Summer Sale Live Now! Get Upto 50% OFF! Use Code: Summer50') ); ?></p><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-info-box" <?php if (!empty($wp_fashion_storefront_has_header_image)) { ?> style="background-image: url(<?php echo header_image(); ?>);" <?php } ?> >
			<div class="container <?php echo esc_attr( get_theme_mod( 'wp_fashion_storefront_enable_sticky_header', false ) ? 'sticky-header' : '' ); ?>">
				<div class="flex-row header-space">
					<div class="head-1">
						<div class="site-branding">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
								?>
								<?php if( get_theme_mod('wp_fashion_storefront_site_title_text',true)){ ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php } ?>
								<?php
							else :
								?>
								<?php if( get_theme_mod('wp_fashion_storefront_site_title_text',true)){ ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php } ?>
								<?php
							endif; ?>
							<?php $wp_fashion_storefront_description = get_bloginfo( 'description', 'display' );
								if ( $wp_fashion_storefront_description || is_customize_preview() ) :
								?>
								<?php if( get_theme_mod('wp_fashion_storefront_site_tagline_text',false)){ ?>
									<p class="site-description"><?php echo $wp_fashion_storefront_description; ?></p>
								<?php } ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="head-2">
						<div class="nav-box-header-lefto">
							<nav id="site-navigation" class="main-navigation">
								<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'primary-menu',
										)
									);
								?>
							</nav>
						</div>
					</div>
					<div class="head-3">
						<div class="switcher">
							<?php if(class_exists('WOOCS')){ ?>
							<?php if( get_theme_mod( 'wp_fashion_storefront_enable_currency_switcher') != '1') { ?><?php if(class_exists('woocommerce')){ ?><div class="currency-box"><?php echo do_shortcode( '[woocs]' );?></div><?php } ?><?php }?>
							<?php }?>
						</div>
						<div class="g-translate">
							<?php if( get_theme_mod( 'wp_fashion_storefront_enable_google_translator') != '1') { ?><div class="translate-lang"><?php echo do_shortcode( '[gtranslate]' );?></div><?php } ?>
						</div>
					</div>
					<div class="head-4">
						<?php if(class_exists('woocommerce')){ ?>
		               	<span class="wishlist-box">
			                <?php if(defined('YITH_WCWL')){ ?>
			                  	<a class="wishlist_view position-relative" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>"><i class="far fa-heart"></i>
			                  	<?php $wp_fashion_storefront_wishlist_count = YITH_WCWL()->count_products(); ?>
			                  	<span class="wishlist-counter"><?php echo $wp_fashion_storefront_wishlist_count; ?></span></a>
			                <?php }?>
		              	</span> 
						<span class="cart-no-box">
			                <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','wp-fashion-storefront' ); ?>"><i class="fas fa-shopping-basket"></i><span class="screen-reader-text"><?php esc_html_e( 'shopping cart','wp-fashion-storefront' );?></span></a>
			                <span class="cart-value"> <?php echo esc_html(wp_kses_data( WC()->cart->get_cart_contents_count() ));?></span>
		              	</span>
		              	<?php }?>
		              	<span class="phone-box flex-row">
							<?php if ( get_theme_mod('wp_fashion_storefront_phone_number_option','012345678') ) : ?><div class="phone-icon"><i class="fas fa-comments"></i></div><div class="phone-content"><h6><?php echo esc_html(get_theme_mod('wp_fashion_storefront_phone_number_text', 'Need Help Ordering?')); ?></h6><p><?php echo esc_html(get_theme_mod('wp_fashion_storefront_phone_number_option','012345678', '')); ?></p></div><?php endif; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</header>