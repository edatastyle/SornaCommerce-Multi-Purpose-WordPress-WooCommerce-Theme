<?php
/**
 * Woocommerce Hooks
 *
 * @package Sorna Commerce
 */
 

// remove hooked woocommerce_breadcrumb - 20
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',20 );

// remove hooked woocommerce_template_loop_add_to_cart - 20
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart',10 );

add_action( 'sornacommerce_woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );


// Change number or products per row to 3
add_filter('loop_shop_columns', 'sornacommerce_loop_columns');
if (!function_exists('sornacommerce_loop_columns')) {
	function sornacommerce_loop_columns() {
		return 3; // 3 products per row
	}
}

/**
 * woocommerce_single_product_summary hook.
 *
 * @remove hooked woocommerce_template_single_rating - 10
 * @remove hooked woocommerce_template_single_price - 10
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',10 );
 
/**
* Reorder woocommerce_single_product_summary.
*
* @since 1.0.0
*/
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',10 );

/**
 * woocommerce_single_product_summary hook.
 *
 * @remove hooked woocommerce_template_single_rating - 10
 * @remove hooked woocommerce_template_single_price - 10
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );