<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Sorna_Commerce
 */

get_header();

 ?>
<!-- ========= END ========= -->

<section class="section section-margin">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="full-width center">
                    <span class="header"><?php esc_html_e( '404', 'sornacommerce' ); ?></span>
                    <span class="info"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'sornacommerce' ); ?></span>
                   
                    	
                    <div class="callout-button2">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'GO TO HOMEPAGE', 'sornacommerce' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========= END ========= -->


<?php
get_footer();
