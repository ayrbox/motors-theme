<?php
/**
 * Twenty Seventeen: Customizer
 *
 * @package Beans Theme
 * @subpackage Motors Theme
 * @since 1.0
 */
















/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $customizer Theme Customizer object.
 */
function register_theme_customer( $customizer ) {

	require THEMEDIR.'/inc/customizer-controls.php';


	$customizer->get_setting( 'blogname' )->transport          = 'postMessage';
	$customizer->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$customizer->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$customizer->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'twentyseventeen_customize_partial_blogname',
	) );
	$customizer->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'twentyseventeen_customize_partial_blogdescription',
	) );

	/**
	 * Custom colors.
	 */
	$customizer->add_setting( 'colorscheme', array(
		'default'           => 'light',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'twentyseventeen_sanitize_colorscheme',
	) );

	$customizer->add_setting( 'colorscheme_hue', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );

	$customizer->add_control( 'colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Color Scheme', 'twentyseventeen' ),
		'choices'  => array(
			'light'  => __( 'Light', 'twentyseventeen' ),
			'dark'   => __( 'Dark', 'twentyseventeen' ),
			'custom' => __( 'Custom', 'twentyseventeen' ),
		),
		'section'  => 'colors',
		'priority' => 5,
	) );

	$customizer->add_control( new WP_Customize_Color_Control( $customizer, 'colorscheme_hue', array(
		'mode' => 'hue',
		'section'  => 'colors',
		'priority' => 6,
	) ) );

	/**
	 * Theme options.
	 */
	$customizer->add_section( 'theme_options', array(
		'title'    => __( 'Theme Options', 'twentyseventeen' ),
		'priority' => 130, // Before Additional CSS.
	) );

	$customizer->add_setting( 'page_layout', array(
		'default'           => 'two-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_page_layout',
		'transport'         => 'postMessage',
	) );

	$customizer->add_control( 'page_layout', array(
		'label'       => __( 'Page Layoutsss', 'twentyseventeen' ),
		'section'     => 'theme_options',
		'type'        => 'radio',
		'description' => __( 'When the two column layout is assigned, the page title is in one column and content is in the other.', 'twentyseventeen' ),
		'choices'     => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
		'active_callback' => 'twentyseventeen_is_view_with_layout_option',
	) );

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$customizer->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );

		$customizer->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'twentyseventeen' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'twentyseventeen' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'twentyseventeen_is_static_front_page',
		) );

		$customizer->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'twentyseventeen_front_page_section',
			'container_inclusive' => true,
		) );
	}


	/** 
	 * Section:About 
	 */	
	$customizer->add_panel('theme_section_about', array(
		'priority' => 130,
		'title' => esc_html__('Section: About', 'theme'),
		'description' => 'About Section for the template',
		'active_callback' => 'is_frontpage_template'
	));

	/* Section:About:Settings */
	$customizer->add_section('theme_section_about_settings', array(
		'title' => __('Section Settings', 'theme'),
		'priority' => 1,			
		'panel' => 'theme_section_about'
	));

	//Disable
	$customizer->add_setting('theme_section_about_disable', array(
		'sanitize_callback' => 'sanitize_checkbox',
		'default'=> '0'
	));
	$customizer->add_control('theme_section_about_disable', array(
		'type'=>'checkbox',
		'label' => esc_html__('Disable section?', 'theme'),
		'section' => 'theme_section_about_settings',
		'description' => esc_html__('Check this box to disable/hide about section', 'theme')
	));
	
	//Section ID
	$customizer->add_setting('theme_section_about_id', array(
		'sanitize_callback' => 'theme_sanitize_text',
		'default' => __('about', 'theme')
	));
	$customizer->add_control('theme_section_about_id', array(
		'label'=> __('Section ID:', 'theme'),
		'section' => 'theme_section_about_settings',
		'description' => __('Hash id for the section.', 'theme')
	));
	//Title
	$customizer->add_setting('theme_section_about_title', array( 
		'sanitize_callback' => 'sanitize_text_field',
		'default' => __('About Us', 'theme')
	));
	$customizer->add_control('theme_section_about_title', array(
		'label' => __('Section Title', 'theme'),
		'section' => 'theme_section_about_settings',
		'description' => __('Title for the about section', 'theme')
	));
	//Sub Title
	$customizer->add_setting('theme_section_about_subtitle', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => __('About Us Subtitle', 'theme')
	));
	$customizer->add_control('theme_section_about_subtitle', array(
		'label' => __('Section Sub Title', 'theme'),
		'section' => 'theme_section_about_settings',
		'description' => __('Sub Title for about section', 'theme')
	));
	//Description
	$customizer->add_setting('theme_section_about_description', array(
		'sanitize_text' => 'theme_sanitize_text',
		'default' => ''
	));

	$customizer->add_control('theme_section_about_description', array(
		'type' => 'textarea',
		'label' => __('Description', 'theme'),
		'section'=> 'theme_section_about_settings'		
	));







	//Section: About: Content
	$customizer->add_section('theme_section_about_content', array(
		'title' => __('Section Content', 'theme'),
		'priority' => 2,		
		'panel' => 'theme_section_about'
	));	
	// $customizer->add_setting('theme_section_about_post', array(
	// 	'sanitize_text' => 'theme_sanitize_text',
	// 	'default' => ''
	// ));
	// $customizer->add_control('theme_section_about_post', array(
	// 	'type'=>'textarea',
	// 	'label' => __('Posts', 'theme'),
	// 	'section' => 'theme_section_about_content'
	// ));
	// $customizer->add_setting('theme_test_icon', array());
	// $customizer->add_control('theme_test_icon', array(
	// 	'type' => 'icon',
	// 	'label'=> __('Testing Icons', 'theme'),
	// 	'section' => 'theme_section_about_content'
	// ));
	

	$customizer->add_setting('theme_section_about_pages', array(
		'sanitize_callback' => 'theme_sanitize_pages',
		'transport' => 'refresh'		//refresh or postMessage
	));
	$customizer->add_control(
		new Theme_Pages_Selector_Control(
			$customizer,
			'theme_section_about_pages',	//name of settings
			array(
				'label' => __('About Content Page', 'theme'),
				'description' => '',
				'section' => 'theme_section_about_content',
				'fields' => array(
					'content_page' => array(
						'title' => __('Select a page', 'theme'),
						'type' => 'select',
						'options' => array('tst'=>'Testing')
						// 'options' => $option_pages,  //todo: define the variable
					),
					'hide_title' => array(
						'title' => __('Remove title', 'theme'),
						'type'=>'checkbox',						
					),
					'enable_link' => array(
						'title' => __('Link to single page', 'theme'),
						'type' => 'checkbox'
					)
				)
			)
		));

}

add_action('customize_register', 'register_theme_customer');





function is_frontpage_template() {
	return is_page_template('template-frontpage.php');
}






/**
 * Sanitization function 
 *--------------------------------------------------------------------------*/
function sanitize_checkbox($input) {
	return ($input == 1)?1:0;
}

function theme_sanitize_text($input) {
	return wp_kses_post(balanceTags($input));
}


function theme_sanitize_pages($input, $setting) {
	
	$control = $setting->manager->get_control($setting->id);

	$data = wp_parse_args(json_decode($input, true), array());
	if(!is_array($data)) return false;
	if(!isset($data['_fields'])) return false;

	$data = $data['_fields'];

	$sanitized_data = array();

	foreach($data as $index => $key_value) {
		foreach($key_value as $key => $value) {			
			switch(strtolower($control->page_fields[$key]['type'])) {
				case 'text':
					$sanitized_data[$index][$key] = sanitize_text_field($value);
					break;				
				case 'checkbox': 
					$sanitized_data[$index][$key] = sanitize_checkbox($value);
					break;
				case 'select':
					$sanitized_data[$index][$key] = $value;
					break;
				default:
					$sanitized_data[$index][$key] = wp_kses_post($value);
			}			
		}
	}
	return $sanitized_data;	
}
/*--------------------------------------------------------------------------*/

















/**
 * Sanitize the page layout options.
 */
function twentyseventeen_sanitize_page_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'twentyseventeen' ),
		'two-column' => __( 'Two Column', 'twentyseventeen' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Sanitize the colorscheme.
 */
function twentyseventeen_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Seventeen 1.0
 * @see twentyseventeen_customize_register()
 *
 * @return void
 */
function twentyseventeen_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Seventeen 1.0
 * @see twentyseventeen_customize_register()
 *
 * @return void
 */
function twentyseventeen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function twentyseventeen_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function twentyseventeen_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function twentyseventeen_customize_preview_js() {
	wp_enqueue_script( 'twentyseventeen-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'twentyseventeen_customize_preview_js' );





/**
 * Load dynamic logic for the customizer controls area.
 */
function theme_panels_js() {
	wp_enqueue_script( 'theme-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'theme_panels_js' );
