<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class SornaCommerceCustomize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {


		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/section-pro.php' );

		
		/*
		Start sornacommerce Options
		=====================================================
		*/
		$manager->add_section( 'sornacommerce_options', array(
			 'title'    => esc_html__( 'Lite Theme Options', 'sornacommerce' ),
			 'priority' => 0,
		) );
		
		/*
		Show social on header
		*/
		$manager->add_setting('sornacommerce_theme_options_socialheader', array(
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'sornacommerce_sanitize_checkbox')
		) );
		
		$manager->add_control('sornacommerce_theme_options_socialheader', array(
			'label'      => esc_html__( 'Show Social Buttons on Header', 'sornacommerce' ),
			'section'    => 'sornacommerce_options',
			'settings'   => 'sornacommerce_theme_options_socialheader',
			'type'       => 'checkbox',
		) );
		
		/*
		Show social on footer
		*/
		$manager->add_setting('sornacommerce_theme_options_socialfooter', array(
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'sornacommerce_sanitize_checkbox')
		) );
		
		$manager->add_control('sornacommerce_theme_options_socialfooter', array(
			'label'      => esc_html__( 'Show Social Buttons on Footer', 'sornacommerce' ),
			'section'    => 'sornacommerce_options',
			'settings'   => 'sornacommerce_theme_options_socialfooter',
			'type'       => 'checkbox',
		) );
		
		
		
		/*
		Show full post or excerpt
		=====================================================
		*/
		$manager->add_setting('sornacommerce_theme_options_blog_list_content', array(
			'default'    => 'excerpt',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => array( $this,'sornacommerce_sanitize_select')
		) );
		
		$manager->add_control('sornacommerce_theme_options_postshow', array(
			'label'      => esc_html__( 'Blog List Content Type', 'sornacommerce' ),
			'section'    => 'sornacommerce_options',
			'settings'   => 'sornacommerce_theme_options_blog_list_content',
			'type'       => 'select',
			'choices' => array(
				'excerpt' => esc_html__( 'excerpt', 'sornacommerce'),
				'full' => esc_html__( 'full post', 'sornacommerce'),
				
			),
		) );
		
		$sornacommerce_options=array();
		
		
		/*
		Social media
		*/
		$sornacommerce_options['social']['fa-facebook']= array(
			'label' => esc_html__('Facebook URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-twitter']= array(
			'label' => esc_html__('Twitter URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-linkedin']= array(
			'label' => esc_html__('Linkedin URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-google-plus']= array(
			'label' => esc_html__('Google-plus URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-pinterest']= array(
			'label' => esc_html__('pinterest URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-youtube']= array(
			'label' => esc_html__('Youtube URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-instagram']= array(
			'label' => esc_html__('Instagram URL', 'sornacommerce')
		);
		$sornacommerce_options['social']['fa-reddit']= array(
			'label' => esc_html__('Reddit URL', 'sornacommerce')
		);
		
		
		
		foreach( $sornacommerce_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
				$manager->add_setting('sornacommerce_theme_options['.$key .']['. $k .']',
					array(
						'capability'     => 'edit_theme_options',
						'sanitize_callback' => 'esc_url_raw',
						'type'     => 'theme_mod',
					)
				);
				// CONTROLS
				$manager->add_control('sornacommerce_theme_options_text_field_' . $k , 
					array(
						'label' => $val['label'], 
						'section'    => 'sornacommerce_options',
						'settings' =>'sornacommerce_theme_options['.$key .']['. $k .']',
					)
				);
				}
			
			endforeach;
		endforeach;
		/*
		Copyright Right
		*/
		$manager->add_setting('sornacommerce_theme_options[footer][copyright]',
			array(
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'type'     => 'theme_mod',
			)
		);
		// CONTROLS
		$manager->add_control('sornacommerce_theme_options_text_field_copyright', 
			array(
				'label' => esc_html__('Copyright Text', 'sornacommerce'), 
				'section'    => 'sornacommerce_options',
				'settings' =>'sornacommerce_theme_options[footer][copyright]',
			)
		);

		// Register custom section types.
		$manager->register_section_type( 'SornaCommerceCustomize_Section_Pro' );
		// Register sections.
		$manager->add_section(
			new SornaCommerceCustomize_Section_Pro(
				$manager,
				'sornacommerce_pro',
				array(
					'title'    => esc_html__( 'SornaCommerce Pro', 'sornacommerce' ),
					'pro_text' => esc_html__( 'Go Pro',         'sornacommerce' ),
					'pro_url'  => esc_url_raw('https://edatastyle.com/product/sornacommerce-multi-purpose-woocommerce-wordpress-theme/')
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'example-1-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'example-1-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customize-controls.css' );
	}
	
	public function sornacommerce_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	function sornacommerce_sanitize_select( $input ) {
		return wp_filter_nohtml_kses( $input );
	}
}

// Doing this customizer thang!
SornaCommerceCustomize::get_instance();
