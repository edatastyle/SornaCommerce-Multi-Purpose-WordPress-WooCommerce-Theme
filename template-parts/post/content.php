<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sorna_Commerce
 */
$classes = array('blog','blog-grid');

?>
<div class="col-lg-12 blog-margin-top">
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <?php
    /**
     * Hook - sornacommerce_posts_formats_header.
     *
     * @hooked sornacommerce_posts_formats_header - 10
     */
    do_action( 'sornacommerce_posts_formats_header' );
    ?>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php sornacommerce_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <?php if( get_theme_mod( 'sornacommerce_theme_options_blog_list_content','excerpt') == 'excerpt' ):
   			the_excerpt();
		  else:
		  	the_content();
		  endif;	
	?>
	</div><!-- .entry-content -->
    <footer>
        <a href="<?php echo esc_url( get_permalink()); ?>" class="button-2 button-xsmall"><?php esc_html_e('READ MORE', 'sornacommerce'); ?></a>
    </footer>
	<footer class="entry-footer">
		<?php sornacommerce_entry_footer(); ?>
	</footer><!-- .entry-footer -->
    <div class="clearfix"></div>
</article><!-- #post-## -->
</div>