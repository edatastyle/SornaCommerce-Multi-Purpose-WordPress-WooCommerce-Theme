<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sorna_Commerce
 */
$classes = array('blog','blog-grid','single_post');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php
    if ( 'post' === get_post_type() ) : ?>
    <div class="entry-meta">
        <?php sornacommerce_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php
    endif; ?>
	<?php
    /**
     * Hook - sornacommerce_posts_formats_header.
     *
     * @hooked sornacommerce_posts_formats_header - 10
     */
    do_action( 'sornacommerce_posts_formats_header' );
    ?>
	
	


	<div class="entry-content">
   		<?php
		the_content();
			

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'sornacommerce' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
  
	<footer class="entry-footer">
		<?php sornacommerce_entry_footer(); ?>
	</footer><!-- .entry-footer -->
    <div class="clearfix"></div>
</article><!-- #post-## -->
