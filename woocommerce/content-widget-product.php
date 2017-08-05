<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="col-md-3">
        <span class="whitefade">
        <?php echo $product->get_image(); ?>
        </span>
	</a>
    <div class="shop-item-label col-md-9">
        <h6 class="product-title"><a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html($product->get_name()); ?></a></h6>
        <span><?php echo $product->get_price_html(); ?></span>
        <?php if ( ! empty( $show_rating ) ) : ?>
            <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
        <?php endif; ?>
    </div>
	<div class="clearfix"></div>
</li>
