<?php 
	$wp_fashion_storefront_custom_css ='';

/*----------------Related Product show/hide -------------------*/

$wp_fashion_storefront_enable_related_product = get_theme_mod('wp_fashion_storefront_enable_related_product',1);

	if($wp_fashion_storefront_enable_related_product == 0){
		$wp_fashion_storefront_custom_css .='.related.products{';
			$wp_fashion_storefront_custom_css .='display: none;';
		$wp_fashion_storefront_custom_css .='}';
	}

/*----------------blog post content alignment -------------------*/

$wp_fashion_storefront_blog_Post_content_layout = get_theme_mod( 'wp_fashion_storefront_blog_Post_content_layout','Left');
    if($wp_fashion_storefront_blog_Post_content_layout == 'Left'){
		$wp_fashion_storefront_custom_css .='.ct-post-wrapper .card-item {';
			$wp_fashion_storefront_custom_css .='text-align:start;';
		$wp_fashion_storefront_custom_css .='}';
	}else if($wp_fashion_storefront_blog_Post_content_layout == 'Center'){
		$wp_fashion_storefront_custom_css .='.ct-post-wrapper .card-item {';
			$wp_fashion_storefront_custom_css .='text-align:center;';
		$wp_fashion_storefront_custom_css .='}';
	}else if($wp_fashion_storefront_blog_Post_content_layout == 'Right'){
		$wp_fashion_storefront_custom_css .='.ct-post-wrapper .card-item {';
			$wp_fashion_storefront_custom_css .='text-align:end;';
		$wp_fashion_storefront_custom_css .='}';
	}

	/*--------------------------- Footer background image -------------------*/

    $wp_fashion_storefront_footer_bg_image = get_theme_mod('wp_fashion_storefront_footer_bg_image');
    if($wp_fashion_storefront_footer_bg_image != false){
        $wp_fashion_storefront_custom_css .='.footer-top{';
            $wp_fashion_storefront_custom_css .='background: url('.esc_attr($wp_fashion_storefront_footer_bg_image).');';
        $wp_fashion_storefront_custom_css .='}';
    }

	/*--------------------------- Go to top positions -------------------*/

    $wp_fashion_storefront_go_to_top_position = get_theme_mod( 'wp_fashion_storefront_go_to_top_position','Right');
    if($wp_fashion_storefront_go_to_top_position == 'Right'){
        $wp_fashion_storefront_custom_css .='.footer-go-to-top{';
            $wp_fashion_storefront_custom_css .='right: 20px;';
        $wp_fashion_storefront_custom_css .='}';
    }else if($wp_fashion_storefront_go_to_top_position == 'Left'){
        $wp_fashion_storefront_custom_css .='.footer-go-to-top{';
            $wp_fashion_storefront_custom_css .='left: 20px;';
        $wp_fashion_storefront_custom_css .='}';
    }else if($wp_fashion_storefront_go_to_top_position == 'Center'){
        $wp_fashion_storefront_custom_css .='.footer-go-to-top{';
            $wp_fashion_storefront_custom_css .='right: 50%;left: 50%;';
        $wp_fashion_storefront_custom_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $wp_fashion_storefront_product_sale = get_theme_mod( 'wp_fashion_storefront_woocommerce_product_sale','Right');
    if($wp_fashion_storefront_product_sale == 'Right'){
        $wp_fashion_storefront_custom_css .='.woocommerce ul.products li.product .onsale{';
            $wp_fashion_storefront_custom_css .='left: auto; ';
        $wp_fashion_storefront_custom_css .='}';
    }else if($wp_fashion_storefront_product_sale == 'Left'){
        $wp_fashion_storefront_custom_css .='.woocommerce ul.products li.product .onsale{';
            $wp_fashion_storefront_custom_css .='right: auto;left:0;';
        $wp_fashion_storefront_custom_css .='}';
    }else if($wp_fashion_storefront_product_sale == 'Center'){
        $wp_fashion_storefront_custom_css .='.woocommerce ul.products li.product .onsale{';
            $wp_fashion_storefront_custom_css .='right: 50%; left: 50%; ';
        $wp_fashion_storefront_custom_css .='}';
    }

    /*-------------------- Primary Color -------------------*/

	$wp_fashion_storefront_primary_color = get_theme_mod('wp_fashion_storefront_primary_color', '#2188FB'); // Add a fallback if the color isn't set

	if ($wp_fashion_storefront_primary_color) {
		$wp_fashion_storefront_custom_css .= ':root {';
		$wp_fashion_storefront_custom_css .= '--primary-color: ' . esc_attr($wp_fashion_storefront_primary_color) . ';';
		$wp_fashion_storefront_custom_css .= '}';
	}

    /*----------------Enable/Disable Breadcrumbs -------------------*/

    $wp_fashion_storefront_enable_breadcrumbs = get_theme_mod('wp_fashion_storefront_enable_breadcrumbs',1);

    if($wp_fashion_storefront_enable_breadcrumbs == 0){
        $wp_fashion_storefront_custom_css .='.wp-fashion-storefront-breadcrumbs, nav.woocommerce-breadcrumb{';
            $wp_fashion_storefront_custom_css .='display: none;';
        $wp_fashion_storefront_custom_css .='}';
    }