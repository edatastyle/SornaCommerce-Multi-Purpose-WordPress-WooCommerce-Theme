<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Sorna_Commerce
 */

get_header();  ?>

	<div id="primary" class="content-area col-md-9">
		<main id="main" class="site-main" role="main">
			<?php
            if ( have_posts() ) : 
            /* Start the Loop */
            while ( have_posts() ) : the_post();
            
                /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
               get_template_part( 'template-parts/content', 'search' );
            	
            endwhile;
            
            the_posts_navigation();
            
            else :
            
           ?>
           <h4><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sornacommerce' ); ?></h4>
           <?php
            
            endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<aside class="col-md-3 sidebar sidebar-right">
	<?php get_sidebar(); ?>
</aside>
<?php

get_footer();

