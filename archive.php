<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sorna_Commerce
 */

get_header(); ?>

	
     
<div id="primary" class="content-area col-md-9">
    <main id="main" class="site-main blog_wrp" role="main">

    <?php
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) : ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?> Sa</h1>
            </header>

        <?php
        endif;

        /* Start the Loop */
        while ( have_posts() ) : the_post();

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
          
            get_template_part( 'template-parts/post/content');
          

        endwhile;

        the_posts_navigation();

    else :
      
        get_template_part( 'template-parts/content', 'none' );
       
    endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<aside class="col-md-3 sidebar sidebar-right">
	<?php get_sidebar(); ?>
</aside>
<?php
get_footer();
