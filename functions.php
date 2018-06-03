<?php
/**
 * hipp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hipp
 */

if ( ! function_exists( 'hipp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hipp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hipp, use a find and replace
		 * to change 'hipp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hipp', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hipp' ),
		) );

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
		add_theme_support( 'custom-background', apply_filters( 'hipp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		// Add Gutenberg align-wide and align-full support.
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'hipp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hipp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hipp_content_width', 640 );
}
add_action( 'after_setup_theme', 'hipp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hipp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hipp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hipp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hipp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hipp_scripts() {
	// Check for SCRIPT_DEBUG
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$version = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? time() : wp_get_theme()->get( 'Version' );
	
	wp_enqueue_style( 'hipp-style', get_template_directory_uri() . '/style' . $suffix . '.css', [], $version );
	
	wp_enqueue_script( 'hipp-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', [], $version, true );
	
	wp_enqueue_script( 'hipp-menu-magic', get_template_directory_uri() . '/assets/js/menu-magic' . $suffix . '.js', [], $version, true );
	
	wp_enqueue_script( 'hipp-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hipp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Allow more mime types through WordPress Media Uploader
 *
 * @param $mimes 
 */
function hipp_mime_types( $mimes ) {
	// add SVG support to WordPress
	$mimes['svg'] = 'image/svg+xml';
	
	return $mimes;
}
add_filter( 'upload_mimes', 'hipp_mime_types' );

/**
 * Customize custom logo output.
 */
function hipp_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo_filetype = get_post_mime_type( $custom_logo_id );
	// Output SVG code inline.
	if ( strpos( $custom_logo_filetype, 'svg' ) ) {
		$html = file_get_contents( wp_get_attachment_url( $custom_logo_id ) );
	} 
	// Output img-elemt with site logo.
	else {
		$html = wp_get_attachment_image( $custom_logo_id, 'full', false, [
			'class' => 'custom-logo'
		] );
	}
	
	return $html;
}
add_filter( 'get_custom_logo', 'hipp_custom_logo' );