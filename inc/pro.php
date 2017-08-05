<?php

/*Add theme menu page*/
 
add_action('admin_menu', 'sornacommerce_admin_menu');

function sornacommerce_admin_menu() {
	
	$sornacommerce_page_title = esc_html__("SornaCommerce Premium",'sornacommerce');
	
	$sornacommerce_menu_title = esc_html__("SornaCommerce Premium",'sornacommerce');
	
	add_theme_page($sornacommerce_page_title, $sornacommerce_menu_title, 'edit_theme_options', 'sornacommerce_pro', 'sornacommerce_pro_page');
	
}

/*
**
** Premium Theme Feature Page
**
*/

function sornacommerce_pro_page(){
	if ( is_admin() ) {
		get_template_part('/inc/premium-screen/index');
		
	} 
}

function sornacommerce_admin_script($sornacommerce_hook){
	
	if($sornacommerce_hook != 'appearance_page_sornacommerce_pro') {
		return;
	} 
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );
	wp_enqueue_style( 'sornacommerce-custom-css', get_template_directory_uri() .'/inc/premium-screen/pro-custom.css',array(),'1.0' );

}

add_action( 'admin_enqueue_scripts', 'sornacommerce_admin_script' );



