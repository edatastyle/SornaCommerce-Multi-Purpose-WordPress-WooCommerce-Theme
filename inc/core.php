<?php
/**
 * Functions hooked to core hooks.
 *
 * @package Sorna Commerce
 */
if ( ! function_exists( 'sornacommerce_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sornacommerce_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sorna Commerce, use a find and replace
	 * to change 'sornacommerce' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sornacommerce', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sornacommerce_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary / Main Menu', 'sornacommerce' ),
		'account_after_log' => esc_html__( 'My Account After Login', 'sornacommerce' ),
		'account_before_log' => esc_html__( 'My Account Before Login', 'sornacommerce' ),
		
	) );
	
	// Set up Custom Header feature.
	add_theme_support( 'custom-header', apply_filters( 'sornacommerce_custom_header_args', array(
			'default-image' => get_template_directory_uri() . '/assets/images/custom-header.jpg',
			'width'         => 1920,
			'height'        => 500,
			'flex-height'   => false,
			'header-text'   => false,
	) ) );
	
	
	register_default_headers( array(
		'default-image' => array(
		'url' => '%s/assets/images/custom-header.jpg',
		'thumbnail_url' => '%s/assets/images/custom-header.jpg',
		'description' => esc_html__( 'Default Header Image', 'sornacommerce' ),
		),
	));
		
	// Enable support for custom logo.
	add_theme_support( 'custom-logo' );
	
	// Declare WooCommerce support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	// Add theme post-formats.
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'video',
	) );
}
add_action( 'after_setup_theme', 'sornacommerce_setup' );
endif;




if ( ! function_exists( 'sornacommerce_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see sornacommerce_custom_header_setup().
 */
function sornacommerce_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sornacommerce_key_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sornacommerce_key_content_width', 640 );
}
add_action( 'after_setup_theme', 'sornacommerce_key_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function sornacommerce_scripts() {
	wp_enqueue_style( 'Raleway', '//fonts.googleapis.com/css?family=Raleway:400,600');
	wp_enqueue_style( 'Montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700');
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.css' ), array(), '3.3.7' );
	
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome.css' ), '4.7.0' );
	
	wp_enqueue_style( 'sornacommerce-style', get_stylesheet_uri() );
	

		
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array('jquery'), '3.3.4', true );

	wp_enqueue_script( 'sornacommerce-js', get_theme_file_uri( '/assets/js/sornacommerce-js.js' ), '1.0.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} 
add_action( 'wp_enqueue_scripts', 'sornacommerce_scripts' );




/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sornacommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sornacommerce' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sornacommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Slider', 'sornacommerce' ),
		'id'            => 'slider',
		'description'   => esc_html__( 'Add slider widgets here.', 'sornacommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'sornacommerce' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'sornacommerce' ),
		'before_widget' => ' <div id="%1$s"class="col-lg-3 col-sm-3 col-xs-12"> <div id="%1$s" class="widget la-hover %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'sornacommerce_widgets_init' );

/**
 * Registers an editor stylesheet for the theme.
 */
function eds_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'eds_theme_add_editor_styles' );



                          