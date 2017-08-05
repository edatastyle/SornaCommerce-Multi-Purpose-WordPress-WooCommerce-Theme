<?php
/**
 * Theme Uses functions
 *
 * @package Sorna Commerce
 */


function sorna_commerce_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <li <?php comment_class( empty( $args['has_children'] ) ? 'comment shift' : 'comment' ) ?> id="comment-<?php comment_ID() ?>">
     <div class="infobox-2">
    	<div class="infobox-text-5">
        	<h6><cite class="fn"><?php echo get_comment_author_link();?></cite> <span class="says"><?php echo esc_html__( 'says :' , 'sornacommerce' ) ;?></span></h6> 
            <div class="reply">
             <span><a href="<?php echo esc_html( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        /* translators: 1: date, 2: time */
        printf( esc_html__('%1$s at %2$s', 'sornacommerce' ), get_comment_date(),  get_comment_time() ); ?></a> -  <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
        </div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'sornacommerce'  ); ?></em>
        <br />
        <?php endif; ?>
        <p><?php comment_text(); ?></p>
         
         <?php edit_comment_link( esc_html__( '(Edit)' , 'sornacommerce' ), '  ', '' );?>    
        </div>
     </div>
 
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>

   </li>
    <?php
}











if ( ! function_exists( 'sornacommerce_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function sornacommerce_implement_excerpt_length( $length ) {

		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = 40;
		$excerpt_length = apply_filters( 'sornacommerce_filter_excerpt_length', $excerpt_length );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return $length;

	}

endif;

add_filter( 'excerpt_length', 'sornacommerce_implement_excerpt_length', 999 );


