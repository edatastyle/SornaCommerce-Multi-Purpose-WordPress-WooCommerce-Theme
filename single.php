<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sorna_Commerce
 */

get_header(); ?>
<div id="primary" class="content-area col-md-9 subpage subpage-left">
    <main id="main" class="site-main blog_wrp" role="main">

		<?php
        
        while ( have_posts() ) : the_post();
        
          get_template_part( 'template-parts/post/single/content' );
        	
            the_post_navigation();
        
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<aside class="col-md-3 sidebar sidebar-right">
	<?php get_sidebar(); ?>
</aside>
<?php
get_footer();
