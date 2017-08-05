<?php
/**
 * Functions hooked to post page.
 *
 * @package Sorna Commerce
 *
 */
 
 if ( ! function_exists( 'sornacommerce_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_posts_formats_thumbnail() {
		$formats = get_post_format(get_the_ID());
	?>
	
        <?php if ( has_post_thumbnail() ) :?>
          
           		<?php if ( is_singular() ) :?>
                    <div class="post-thumbnail ">
                   	 <?php the_post_thumbnail('full');?>
                    </div>
                <?php else: ?>
                 <div class="post-thumbnail isotope-info">
                	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link <?php echo $formats;?>">
                    	<?php the_post_thumbnail('full');?>
                    </a>
                 </div>  
                <?php endif;?>
                </a>
           
         
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'sornacommerce_posts_formats_thumbnail', 'sornacommerce_posts_formats_thumbnail' );


if ( ! function_exists( 'sornacommerce_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_posts_formats_video() {
		$content = apply_filters( 'the_content', get_the_content() );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		if ( ! is_single() ) :
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</div>';
				}
			endif;
		
		endif;
	 }

endif;
add_action( 'sornacommerce_posts_formats_video', 'sornacommerce_posts_formats_video' ); 


if ( ! function_exists( 'sornacommerce_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		if ( ! is_single() ) :
	
				// If not a single post, highlight the audio file.
				if ( ! empty( $audio ) ) :
					foreach ( $audio as $audio_html ) {
						echo '<div class="entry-audio embed-responsive embed-responsive-16by9">';
							echo $audio_html;
						echo '</div><!-- .entry-audio -->';
					}
				endif;
	
		endif;
	 }

endif;
add_action( 'sornacommerce_posts_formats_audio', 'sornacommerce_posts_formats_audio' ); 


if ( ! function_exists( 'sornacommerce_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_posts_formats_gallery() {
		if ( get_post_gallery() && ! is_single() ) :
			echo '<div class="entry-gallery">';
				echo get_post_gallery();
			echo '</div>';
		endif;
	 }

endif;
add_action( 'sornacommerce_posts_formats_gallery', 'sornacommerce_posts_formats_gallery' ); 


if ( ! function_exists( 'sornacommerce_posts_formats_header' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function sornacommerce_posts_formats_header() {
		$formats = get_post_format(get_the_ID());
		
		switch ($formats) {
			default:
				do_action('sornacommerce_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('sornacommerce_posts_formats_gallery');
			break;
			case 'audio':
				do_action('sornacommerce_posts_formats_audio');
			break;
			case 'video':
				do_action('sornacommerce_posts_formats_video');
			break;
		
		} 
		
	 }

endif;
add_action( 'sornacommerce_posts_formats_header', 'sornacommerce_posts_formats_header' ); 