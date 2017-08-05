<?php


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/core.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/default/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/default/extras.php';

/**
 * Implement WP Bootstrap Navwalker
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * Load breadcrumbs Plugins
 */
require get_template_directory() . '/plugins/breadcrumbs/breadcrumbs.php';

/**
 * Load Post Related Hooks And Function
 */
require get_template_directory() . '/inc/post_hooks.php';


/**
 * Load Post Related Hooks And Function
 */
require get_template_directory() . '/inc/theme-functions.php';


/**
 * Load Theme Hooks
 */
require get_template_directory() . '/inc/theme-hooks.php';


/**
 * Load WooCommerce
 */
require get_template_directory() . '/inc/woocommerce-hook.php';


/**
 * Load customizer
 */
require get_template_directory() . '/inc/customizer/class-customize.php';


/**
 * Load Pro Content
 */
require get_template_directory() . '/inc/pro.php';


/**
 * TGM
 */

require_once get_template_directory() . '/inc/tgm/plugins_recommeded.php';