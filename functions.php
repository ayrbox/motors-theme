<?php
/**
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package beans-theme
 * @subpackage motors-theme
 * @since 0.0.1
 */





define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/images');
define ('SCRIPTS', THEMEROOT . '/js');
define('FRAMEWORK', get_template_directory() . '/framework');





/**
 * TODO: Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}






if(!function_exists('theme_setup')) {
	function theme_setup() {
		/**
		 * Make theme available for translation */
		$lang_dir = THEMEROOT . '/languages';		
		load_theme_textdomain( 'beans' , $lang_dir );



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


		add_image_size( 'beans-featured-image', 2000, 1200, true );
		add_image_size( 'beans-thumbnail-avatar', 100, 100, true );



		// Set the default content width.
		$GLOBALS['content_width'] = 800;



		/**
		 * Register nav menu. Uses wp_nav_menu()
		 */
		register_nav_menus( array(
			'primary'    => __( 'Primary Menu', 'beans' ),
			'social' => __( 'Social Links Menu', 'beans' ),
			'footer' => __('Footer Menu', 'beans')
		));

		
		
		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );




		/*
		* Enable support for Post Formats.
		*
		* See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 250,
			'height'      => 250,
			'flex-width'  => true,
		) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		/*
		* This theme styles the visual editor to resemble the theme style,
		* specifically font, colors, and column width.
		*/
		add_editor_style( array( 'assets/css/editor-style.css', beans_fonts_url() ) );


		/**
		 * Define starter content for the theme 
		 */
		if(function_exists('starter_content')) {
			starter_content();			
		}
	}

	add_action( 'after_setup_theme', 'theme_setup' );

}




//TODO: Change starter content as required by beans theme
if(!function_exists('starter_content')) {
	function starter_content() {
		// Define and register starter content to showcase the theme on new sites.
			$starter_content = array(
				'widgets' => array(
					// Place three core-defined widgets in the sidebar area.
					'sidebar-1' => array(
						'text_business_info',
						'search',
						'text_about',
					),

					// Add the core-defined business info widget to the footer 1 area.
					'sidebar-2' => array(
						'text_business_info',
					),

					// Put two core-defined widgets in the footer 2 area.
					'sidebar-3' => array(
						'text_about',
						'search',
					),
				),

				// Specify the core-defined pages to create and add custom thumbnails to some of them.
				'posts' => array(
					'home',
					'about' => array(
						'thumbnail' => '{{image-sandwich}}',
					),
					'contact' => array(
						'thumbnail' => '{{image-espresso}}',
					),
					'blog' => array(
						'thumbnail' => '{{image-coffee}}',
					),
					'homepage-section' => array(
						'thumbnail' => '{{image-espresso}}',
					),
				),


				// Create the custom image attachments used as post thumbnails for pages.
				'attachments' => array(
					'image-espresso' => array(
						'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
						'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
					),
					'image-sandwich' => array(
						'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
						'file' => 'assets/images/sandwich.jpg',
					),
					'image-coffee' => array(
						'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
						'file' => 'assets/images/coffee.jpg',
					),
				),




				// Default to a static front page and assign the front and posts pages.
				'options' => array(
					'show_on_front' => 'page',
					'page_on_front' => '{{home}}',
					'page_for_posts' => '{{blog}}',
				),

				// Set the front page section theme mods to the IDs of the core-registered pages.
				'theme_mods' => array(
					'panel_1' => '{{homepage-section}}',
					'panel_2' => '{{about}}',
					'panel_3' => '{{blog}}',
					'panel_4' => '{{contact}}',
				),

				// Set up nav menus for each of the two areas registered in the theme.
				'nav_menus' => array(
					// Assign a menu to the "top" location.
					'top' => array(
						'name' => __( 'Top Menu', 'twentyseventeen' ),
						'items' => array(
							'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
							'page_about',
							'page_blog',
							'page_contact',
						),
					),

					// Assign a menu to the "social" location.
					'social' => array(
						'name' => __( 'Social Links Menu', 'twentyseventeen' ),
						'items' => array(
							'link_yelp',
							'link_facebook',
							'link_twitter',
							'link_instagram',
							'link_email',
						),
					),
				),
			);

			/**
			* Filters Twenty Seventeen array of starter content.
			*
			* @since Twenty Seventeen 1.1
			*
			* @param array $starter_content Array of starter content.
			*/
			$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );
			add_theme_support( 'starter-content', $starter_content );
	}
}









/**
 * TODO: Modify the function to match the requirement
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

 if(!function_exists('beans_content_width')) {

	function beans_content_width() {

		$content_width = $GLOBALS['content_width'];

		// Get layout.
		$page_layout = get_theme_mod( 'page_layout' );


		// Check if layout is one column.
		if ( 'one-column' === $page_layout ) {
			if ( twentyseventeen_is_frontpage() ) {
				$content_width = 644;
			} elseif ( is_page() ) {
				$content_width = 740;
			}
		}

		// Check if is single post and there is no sidebar.
		if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 740;
		}

		/**
		* Filter Twenty Seventeen content width of the theme.
		*
		* @since Twenty Seventeen 1.0
		*
		* @param $content_width integer
		*/
		$GLOBALS['content_width'] = apply_filters( 'beans_content_width', $content_width );
	}

  add_action( 'template_redirect', 'beans_content_width', 0 );
}













/**
 * Register custom fonts
 */
function beans_fonts_url() {
	$fonts_url = '';
	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$motor_font = _x( 'on', 'Motor font: on or off', 'beans' );


	if ( 'off' !== $motor_font ) {
		$font_families = array();

		$font_families[] = 'Roboto:300,300i,400,400i,600,600i,900,900i';
		$font_families[] = 'Raleway:400,400i,600,600i,900,900i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}









/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function beans_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'beans-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'beans_resource_hints', 10, 2 );




/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if(!function_exists('beans_widgets_init')){
	function beans_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'beans' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'beans' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 1', 'beans' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'beans' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 2', 'beans' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'beans' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	add_action( 'widgets_init', 'beans_widgets_init' );
}






/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function theme_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'beans-fonts', beans_fonts_url(), array(), null );


	

	// Theme stylesheet.
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
	
	wp_enqueue_style('theme-libs-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	wp_enqueue_style('theme-libs-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	wp_enqueue_style('theme-libs-owlcarousel', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css');

	wp_enqueue_style('beans-theme-style', get_theme_file_uri('/assets/css/motors-theme.css', array('theme-style'), '1.0'));


	


	// Load the dark colorscheme.
	//TODO: Wordpress Loading different theme style (dark, light, blue, green) 
	// if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
	// 	wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	// }




	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	//TODO: Bootstrap does not supports IE9. required to remove the related CSS files
	// if ( is_customize_preview() ) {
	// 	wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
	// 	wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	// }

	// // Load the Internet Explorer 8 specific stylesheet.
	// wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	// wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );




	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );




	//TODO: Skip link for the front page
	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	


	//TODO: Add support for svg icons 
	// $twentyseventeen_l10n = array(
	// 	'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	// );



	// TODO: Check for menu and add script on condition
	// if ( has_nav_menu( 'top' ) ) {
	// 	wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0', true );
	// 	$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
	// 	$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
	// 	$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	// }

	//TODO: Global script and other scripts
	// wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
	// wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_enqueue_script('js-lib-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('js-lib-owlcarousel', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js', array(), '1.0', true);
	wp_enqueue_script('js-lib-theme', get_theme_file_uri('/assets/js/motors-theme.js'), array('jquery'), '1.0', true);



	// TODO: Study localization script
	// wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );








/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function theme_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'theme_content_image_sizes_attr', 10, 2 );








/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function theme_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'theme_header_image_tag', 10, 3 );





/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function theme_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'theme_post_thumbnail_sizes_attr', 10, 3 );







/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function theme_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'theme_front_page_template' );






/**
 * Load framework */
require_once (FRAMEWORK . '/init.php');




/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
