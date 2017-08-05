<?php
/**
 * Functions hooked to custom hook.
 *
 * @package Sorna Commerce
 */
if( !function_exists('sornacommerce_action_top_bar') ):
	/**
	 * Add TopBar content.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_action_top_bar(){
	?>
    <div id="top-bar">
    
        <div class="container clearfix">
            <div class="row">
            	<?php if( get_theme_mod( 'sornacommerce_theme_options_socialheader','0') == 1 ):?>
                <div class="col-sm-6 hidden-xs nobottommargin">
                		
                    
                        <ul  class="social-link">
              			  <?php $social_link = get_theme_mod( 'sornacommerce_theme_options' );?>
                          <?php foreach ($social_link['social'] as $key => $link): 
						  	if( $link != ""):
						  ?>
                            <li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_html($key);?>" target="_blank"></a></li>
                               
                          <?php endif; endforeach;?>
                        </ul>
                   
        
                </div>
                <?php endif;?>
    
                <div class="col-sm-6 col_last pull-right nobottommargin">
    
                    <!-- Top Links
                    ============================================= -->
                    <div class="top-links">
					<?php
                    wp_nav_menu(
						array(
							'theme_location' => is_user_logged_in() ? 'account_after_log' : 'account_before_log',
							'fallback_cb'    => 'sornacommerce_top_default_menu',
							'container' 	 => '',
						)
                    );
					
                    ?>
                    </div>
                   
    
                </div>
            </div>
    
        </div>
    
    </div>
    <?php	
	}
	
	
	/**
	*  Top bar fallback default menu.
	*
	* @since 1.0.0
	*/
	function sornacommerce_top_default_menu(){
		if ( current_user_can( 'edit_theme_options' ) ) {	
	?>
        <ul>                  
           <li><a href="<?php echo esc_url( admin_url('nav-menus.php') ); ?>" style="font-weight:normal;"><?php esc_html_e( 'Add a menu ( Login before, After menu ) ', 'sornacommerce' ); ?></a></li>
        </ul>
	<?php
		}
	}
	
endif;
add_action('sornacommerce_site_header_block','sornacommerce_action_top_bar',10);



if ( ! function_exists( 'sornacommerce_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_site_branding() {
	?>
	 <?php
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			
			the_custom_logo();
		
		}else{
		?>
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
			<?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
		
		<?php }?>   
	<?php
	}

endif;

add_action( 'sornacommerce_site_branding', 'sornacommerce_site_branding' );

if ( ! function_exists( 'sornacommerce_site_main_menu' ) ) :

	/**
	 * sornacommerce_header_block.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_site_main_menu() {
		
		wp_nav_menu( array(
			'menu'              => 'primary',
			'theme_location'    => 'primary',
			'depth'             => 3,
			'container'       => false, 
			 'items_wrap' => '%3$s',
			'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
			'walker'            => new WP_Bootstrap_Navwalker())
		);
	}
endif;	
add_action( 'sornacommerce_site_main_menu', 'sornacommerce_site_main_menu',10 );



if ( ! function_exists( 'sornacommerce_site_main_menu_responsive' ) ) :

	/**
	 * sornacommerce_header_block.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_site_main_menu_responsive() {
		
		wp_nav_menu( array(
			'menu'              => 'primary',
			'theme_location'    => 'primary',
			'depth'             => 3,
			'container'       => false, 
			'menu_class'        => 'responsive_nav',
			'fallback_cb'       => 'WP_Bootstrap_Navwalker_Responsive::fallback',
			'walker'            => new WP_Bootstrap_Navwalker_Responsive())
		);
		
	}
endif;	
add_action( 'sornacommerce_site_main_menu_responsive', 'sornacommerce_site_main_menu_responsive');

if ( ! function_exists( 'sornacommerce_main_menu_min_cart' ) ) :

	/**
	 * sornacommerce_main_menu_min_cart.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_main_menu_min_cart() {
		
		if ( class_exists( 'WooCommerce' ) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		echo '<li><a class="clearhover toggle-1-button single_add_to_cart_flyer" href="'. esc_url ( wc_get_cart_url() ) .'"><div class="clearfix cart"><i class="fa fa-shopping-cart"></i>Cart (<span class="fly_counter_load">'.WC()->cart->get_cart_contents_count().'</span>)</div></a></li>';
		}
		
	}
endif;	
add_action( 'sornacommerce_site_main_menu', 'sornacommerce_main_menu_min_cart',15 );








if ( ! function_exists( 'sornacommerce_header_block' ) ) :

	/**
	 * Site sornacommerce_header_block.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_header_block() {
	?>
    	<?php if (  is_active_sidebar( 'slider' ) || get_header_image() != "" ) {  ?>
        <header class="absolute-header">
        <?php }else { ?>
        <header>
        <?php } ?>
        <section class="sticky-wrapper">
            <div id="main-menu-2" class="main-menu">
                <div class="container">
                    <div class="row">
                        <nav class="col-md-12">
                            
                            <div id="menu-main">
                                <div class="navbar-left">
                                    <div class="menu-center">
										<?php
                                        /**
                                        * Hook - sorna_action_top_bar.
                                        *
                                        * @hooked sorna_action_top_bar - 10
                                        */
                                        do_action( 'sornacommerce_site_branding' );
                                        ?>
                                    </div>
                                </div>
                                <div class="navbar-right hidden-lg">
                                    <div class="menu-center">
                                        <ul class="nav-pills nav menu-lowerpad"> 
                                            <li><a class="general mobile-menu-toggle"><i class="fa fa-bars"></i></a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="navbar-right visible-lg">
                                    <div class="menu-center">  
                                      <ul class="nav-pills navbar-right nav">      
                                        <?php
										/**
                                        * Hook - sornacommerce_site_main_menu.
                                        *
                                        * @hooked sornacommerce_main_menu - 10
										* @hooked sornacommerce_main_menu_min_cart - 15
										* @hooked sornacommerce_main_menu_search_icon - 20
                                        */
                                        do_action( 'sornacommerce_site_main_menu' );
                                        ?>
                                      </ul>  
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="mobile-menu">
                    <div class="container">
						<?php
                        /**
                        * Hook - sornacommerce_site_main_menu_responsive.
                        *
                        * @hooked sornacommerce_site_main_menu_responsive - 10
                        */
                        do_action( 'sornacommerce_site_main_menu_responsive' );
                        ?>
                    </div>
                </div>
            </div>
        </section>
        </header> 
	<?php
	}

endif;

add_action( 'sornacommerce_site_header_block', 'sornacommerce_header_block',11 );


if ( ! function_exists( 'sornacommerce_site_slider_widgets' ) ) :

	/**
	 * Site sornacommerce_site_slider_widgets.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_site_slider_widgets() {
	?>
		<?php if ( is_front_page() ): ?>   
            <?php if (  is_active_sidebar( 'slider' ) ) { ?>
            <div class="col-md-12">
                 <?php dynamic_sidebar( 'slider' ); ?>
            </div>
            <?php }else{?>
            	<?php if( get_header_image() != "" ): ?>
                 <img src="<?php header_image(); ?>" class="responsive" />
               
                 <?php endif;?>
            <?php } ?> 
        <?php
        endif;
		
	}

endif;

add_action( 'sornacommerce_site_slider_widgets', 'sornacommerce_site_slider_widgets' );


if ( ! function_exists( 'sornacommerce_title_in_custom_header' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_title_in_custom_header() {

		if ( is_home() ) {
			if( get_option( 'page_for_posts' ) ){
				echo '<h1 class="title">';
				echo get_the_title( get_option( 'page_for_posts' ) );
				echo '</h1>';
			}
		}else if ( function_exists('is_shop') && apply_filters( 'woocommerce_show_page_title', true ) && is_shop() ){
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				echo '<h1 class="title">';
				echo woocommerce_page_title();
				echo '</h1>';
			}
		} elseif ( is_singular() ) {
			echo '<h1 class="title">';
			echo single_post_title( '', false );
			echo '</h1>';
		} elseif ( is_archive() ) {
			the_archive_title( '<h1 class="title">', '</h1>' );
		} elseif ( is_search() ) {
			echo '<h1 class="title">';
			printf( esc_html__( 'Search Results for: %s', 'sornacommerce' ),  get_search_query() );
			echo '</h1>';
		} elseif ( is_404() ) {
			echo '<h1 class="title">';
			esc_html_e( '404 Error', 'sornacommerce' );
			echo '</h1>';
		}

	}

endif;
add_action( 'sornacommerce_title_in_custom_header', 'sornacommerce_title_in_custom_header' );

if ( ! function_exists( 'sornacommerce_sub_title_in_custom_header' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_sub_title_in_custom_header() {

		echo '<div class="subtitle">';

		if ( is_archive() ) {
			?>
              <?php the_archive_description( '<div class="subtitle">', '</div>' );?>
            <?php
		}else{
			?>
             <?php if ( function_exists( 'the_subtitle' ) ) { ?>
                 <div class="subtitle"><?php  the_subtitle() ;?></div>  
              <?php }?>
             
            <?php
			
		}

		echo '</div>';

	}

endif;
add_action( 'sornacommerce_sub_title_in_custom_header', 'sornacommerce_sub_title_in_custom_header' );

if ( ! function_exists( 'sornacommerce_page_section_header' ) ) :

	/**
	 * Site sornacommerce_page_section_header.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_page_section_header() {
		if ( !is_front_page() ): 
	?>

        <section class="section-page-header">
            <div class="container">
                <div class="row">
        
                    <!-- Page Title -->
                    <div class="col-md-6">
                    	<?php do_action( 'sornacommerce_title_in_custom_header' ); ?>
                        <?php do_action( 'sornacommerce_sub_title_in_custom_header' ); ?>
                    </div>
                    <!-- /Page Title -->
                    <div class="col-md-6 breadcrumbs">
                       <?php do_action( 'sornacommerce_breadcrumb' ); ?>
                    </div>
                </div>
            </div>
        </section>
    
    <?Php
		endif;
	}
endif;
add_action( 'sornacommerce_page_section_header', 'sornacommerce_page_section_header' );



if ( ! function_exists( 'sornacommerce_breadcrumb' ) ) :

	/**
	 * Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			get_template_part( 'vendors/breadcrumbs/breadcrumbs' );
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		echo '<div id="breadcrumb">';
		breadcrumb_trail( $breadcrumb_args );
		echo '</div><!-- #breadcrumb -->';
		

	}

endif;
add_action( 'sornacommerce_breadcrumb', 'sornacommerce_breadcrumb' );


if ( ! function_exists( 'sornacommerce_site_footer_block' ) ) :

	/**
	 * sornacommerce_site_footer_block.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_site_footer_block() {
	  ?>
      
        <footer id="footer">
            <section class="footer footer-margin">
                <div class="container">
                    <?php if ( is_active_sidebar( 'footer' ) ) : ?>
                        <div class="row">
                            <?php dynamic_sidebar( 'footer' ); ?>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="center">
                                <p class="footer"><?php
								 $options = get_theme_mod( 'sornacommerce_theme_options' );
								 if( isset( $options['footer']['copyright'] ) ){
								 echo esc_html( $options['footer']['copyright'] );
								 
								 }?>  <br/>
                          
                         
                            <a href="<?php /* translators:straing */ echo esc_url(  'https://wordpress.org/' ); ?>"><?php /* translators:straing */  printf( esc_html__( 'Proudly powered by %s', 'sornacommerce' ),esc_html__( 'WordPress', 'sornacommerce' ) ); ?></a>
                            | 
                        <?php
                        printf(  /* translators: %s: edatastyle */ esc_html__( 'Theme: %1$s by %2$s.', 'sornacommerce' ), 'SornaCommerce', '<a href="' . esc_url('https://edatastyle.com' ) . '" target="_blank">' . esc_html__( 'eDataStyle', 'sornacommerce' ) . '</a>' ); ?>
                        </p>
                        <!-- /Copyright -->
        
                            </div>
                           <?php if( get_theme_mod( 'sornacommerce_theme_options_socialfooter','0') == 1 ):?>
                            <ul class="social-link">
                               <?php $social_link = get_theme_mod( 'sornacommerce_theme_options' );?>
                          <?php foreach ($social_link['social'] as $key => $link):
						  	if( $link != ""):
							?>
                            <li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_html($key);?>" target="_blank"></a></li>
                          <?php endif; endforeach;?>
                            </ul>
                            <?php endif;?>
                            
                        </div>
                    </div>
                </div>
            </section>
         
        </footer>
        
        <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>

      <?php

	}

endif;
add_action( 'sornacommerce_site_footer_block', 'sornacommerce_site_footer_block' );


