<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sorna_Commerce
 */
$classes = array('blog','blog-margin-top');
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
   	 <?php the_excerpt(); ?>
	</div><!-- .entry-content -->
    <footer>
         <a href="<?php echo esc_url( get_permalink()); ?>" class="button-2 button-xsmall"><?php esc_html_e('READ MORE', 'sornacommerce'); ?></a>
    </footer>
	
    <div class="clearfix"></div>
</article><!-- #post-## -->
