<?php
/**
 * Template Name: Home Page
 */

get_header();
?>

<main id="primary">
    <?php 
    $wp_fashion_storefront_main_slider_wrap = absint(get_theme_mod('wp_fashion_storefront_enable_slider', 0));
    if($wp_fashion_storefront_main_slider_wrap == 1){ 
    ?>
    <section id="main-slider-wrap" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/revolution/assets/images/sliderbg.png' ); ?>" alt="revolutionsliderbg">
        <div class="owl-carousel">
            <?php for ($wp_fashion_storefront_i=1; $wp_fashion_storefront_i <= 3; $wp_fashion_storefront_i++) { ?>
                <div class="main-slider-inner-box">
                <svg id="Group_1" data-name="Group 1" class="custom-svg" xmlns="http://www.w3.org/2000/svg" width="1920.45" height="674.92" viewBox="0 0 1920.45 674.92" preserveAspectRatio="xMidYMid slice">
                    <path id="Path_1" data-name="Path 1" d="M1350.45,0h570V774h-324C1095.65,618.8,1223.78,193.333,1350.45,0Z" fill="#2188FB"/>
                    <path id="Path_2" data-name="Path 2" d="M70.5,600.921c-19-69-49.667-72.167-70.5-67.5v241.5H218c-26-54.5-75.5-103-109.5-118.5C87,646.619,77.5,617.921,70.5,600.921Z" fill="#2188FB"/>
                </svg>
                    <?php if ( get_theme_mod('wp_fashion_storefront_slider_image'.$wp_fashion_storefront_i) ) : ?>
                        <img src="<?php echo esc_url( get_theme_mod('wp_fashion_storefront_slider_image'.$wp_fashion_storefront_i) ); ?>">
                        <div class="main-slider-content-box">
                            <?php if ( get_theme_mod('wp_fashion_storefront_slider_xtra_heading'.$wp_fashion_storefront_i) ) : ?><p class="xtra-head"><?php echo esc_html( get_theme_mod('wp_fashion_storefront_slider_xtra_heading'.$wp_fashion_storefront_i) ); ?></p><?php endif; ?>
                            <?php if ( get_theme_mod('wp_fashion_storefront_slider_heading'.$wp_fashion_storefront_i) ) : ?><h3><?php echo esc_html( get_theme_mod('wp_fashion_storefront_slider_heading'.$wp_fashion_storefront_i) ); ?></h3><?php endif; ?>
                            <?php if ( get_theme_mod('wp_fashion_storefront_slider_text'.$wp_fashion_storefront_i) ) : ?><p><?php echo esc_html( get_theme_mod('wp_fashion_storefront_slider_text'.$wp_fashion_storefront_i) ); ?></p><?php endif; ?>
                            <div class="main-slider-button">
                                <?php if ( get_theme_mod('wp_fashion_storefront_slider_button1_link'.$wp_fashion_storefront_i) ||  get_theme_mod('wp_fashion_storefront_slider_button1_text'.$wp_fashion_storefront_i )) : ?><a class="btn-1" href="<?php echo esc_url( get_theme_mod('wp_fashion_storefront_slider_button1_link'.$wp_fashion_storefront_i) ); ?>"><?php echo esc_html( get_theme_mod('wp_fashion_storefront_slider_button1_text'.$wp_fashion_storefront_i) ); ?></a><?php endif; ?>
                                <?php if ( get_theme_mod('wp_fashion_storefront_slider_button2_link'.$wp_fashion_storefront_i) ||  get_theme_mod('wp_fashion_storefront_slider_button2_text'.$wp_fashion_storefront_i )) : ?><a class="btn-2" href="<?php echo esc_url( get_theme_mod('wp_fashion_storefront_slider_button2_link'.$wp_fashion_storefront_i) ); ?>"><?php echo esc_html( get_theme_mod('wp_fashion_storefront_slider_button2_text'.$wp_fashion_storefront_i) ); ?></a><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php } ?>
        </div>
            <?php 
            $wp_fashion_storefront_top_header_social = absint(get_theme_mod('wp_fashion_storefront_enable_top_social_menu', 0));
            if($wp_fashion_storefront_top_header_social == 1){ 
            ?>
            <div class="social-links">
                <?php
                    wp_fashion_storefront_social_menu();
                ?>
            </div>
            <?php } ?>
    </section>
    <?php } ?>
    <?php 
    $wp_fashion_storefront_main_expert_wrap = absint(get_theme_mod('wp_fashion_storefront_enable_product', 0));
    if($wp_fashion_storefront_main_expert_wrap == 1){ 
    ?>
    <section id="product-sec" class="product-section">
        <div class="container">
            <div class="heading-expert-wrap">
                <?php if ( get_theme_mod('wp_fashion_storefront_event_text') ) : ?><p><?php echo esc_html( get_theme_mod('wp_fashion_storefront_event_text') ); ?></p><?php endif; ?>
                <?php if ( get_theme_mod('wp_fashion_storefront_event_heading') ) : ?><h5><?php echo esc_html( get_theme_mod('wp_fashion_storefront_event_heading') ); ?></h5><?php endif; ?>
            </div>
            <div class="flex-row">
              <?php if ( class_exists( 'WooCommerce' ) ) {
                $args = array( 
                  'post_type' => 'product',
                  'product_cat' => get_theme_mod('wp_fashion_storefront_best_product_category'),
                  'order' => 'ASC',
                  'posts_per_page' => '10'
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>         
                <div class="product-box">  
                      <div class="product-box-content">
                        <div class="product-image">
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
                                } else {
                                    echo '<img src="' . esc_url(woocommerce_placeholder_img_src()) . '" alt="Placeholder" />';
                                }
                            ?>
                            <span class="discount_amt">
                              <?php $wp_fashion_storefront_percentages = wp_fashion_storefront_woocommerce_get_product_sale_percentages( $product );
                                $wp_fashion_storefront_label       = wp_fashion_storefront_woocommerce_get_product_sale_percentage_label( $wp_fashion_storefront_percentages, '' );
                                echo $wp_fashion_storefront_label;
                              ?>
                            </span>
                             <!-- <div class="pro-icons">
                              <div class="d-flex align-items-center justify-content-center">
                                <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','wp-fashion-storefront' ); ?>"><i class="fas fa-shopping-basket"></i><span class="screen-reader-text"><?php esc_html_e( 'shopping cart','wp-fashion-storefront' );?></span></a>
                                <?php if(defined('YITH_WCWL')){ ?>
                                    <a class="wishlist_view ms-2 d-flex" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" title="<?php esc_attr_e('Wishlist','wp-fashion-storefront'); ?>"><i class="far fa-heart"></i>
                                    </a>
                              <?php }?>  
                              </div>
                            </div> -->
                            <div class="pro-icons">
                            <div class="d-flex align-items-center justify-content-center">
                              <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_add_to_cart( $loop->post, $product ); } ?>
                              <?php if(defined('YITH_WCWL')){ ?>
                              <a class="wishlist_view ms-2 d-flex" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" title="<?php esc_attr_e('Wishlist','wp-fashion-storefront'); ?>"><i class="far fa-heart"></i>
                              </a>
                            <?php }?>  
                            </div>
                        </div>
                        </div>
                        <h6 class="product-heading-text"><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h6>
                        <p class="product-rating d-flex <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
                      </div>
                </div> 
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } ?>
            </div> 
        </div>
    </section>
    <?php } ?>
</main>
<?php
get_footer();