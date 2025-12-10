<?php
/**
 * behva functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package behva
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function behva_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on behva, use a find and replace
		* to change 'behva' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'behva', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-primary' => esc_html__( 'Primary', 'behva' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'behva_custom_background_args',
			array(
				'default-color' => 'CBC9C6',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_image_size( 'square', 768, 768, true );
	add_image_size( 'banner-background', 1920, 9999, true );
}
add_action( 'after_setup_theme', 'behva_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function behva_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'behva_content_width', 1240 );
}
add_action( 'after_setup_theme', 'behva_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function behva_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'behva' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'behva' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'behva_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function behva_scripts() {
	wp_enqueue_style( 'behva-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'behva-style', 'rtl', 'replace' );

	wp_enqueue_script( 'behva-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'jquery' );
	
	if ( is_page_template('template-home.php') ) {
		wp_enqueue_script( 'template-home-js', get_theme_file_uri( '/assets/js/template-home.js' ), array(), filemtime( get_theme_file_path( '/assets/js/template-home.js' ) ), true );
	}
	wp_enqueue_style(
        'font-awesome',
        get_theme_file_uri( '/assets/font-awesome/css/all.min.css' ),
        array(),
        filemtime( get_theme_file_path( '/assets/font-awesome/css/all.min.css' ) )
    );
	wp_enqueue_script( 'gsap', get_theme_file_uri( '/assets/js/gsap.min.js' ), array(), filemtime( get_theme_file_path( '/assets/js/gsap.min.js' ) ), true );
	wp_enqueue_script( 'scrolltrigger', get_theme_file_uri( '/assets/js/scrolltrigger.min.js' ), array( 'gsap' ), filemtime( get_theme_file_path( '/assets/js/scrolltrigger.min.js' ) ), true );
	wp_enqueue_script( 'splide', get_theme_file_uri( '/assets/js/splide.min.js' ), array(), filemtime( get_theme_file_path( '/assets/js/splide.min.js' ) ), true );
	wp_enqueue_script( 'splide-extension-auto-scroll', get_theme_file_uri( '/assets/js/splide-extension-auto-scroll.min.js' ), array( 'splide' ), filemtime( get_theme_file_path( '/assets/js/splide-extension-auto-scroll.min.js' ) ), true );
	wp_enqueue_script( 'script', get_theme_file_uri( '/assets/js/script.js' ), array(), filemtime( get_theme_file_path( '/assets/js/script.js' ) ), true );

	wp_enqueue_style( 'splide-default', get_theme_file_uri( '/assets/css/splide-default.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/splide-default.min.css' ) ), 'all' );
	wp_enqueue_style( 'unicons-line', get_theme_file_uri( '/assets/css/unicons-line.css' ), array(), filemtime( get_theme_file_path( '/assets/css/unicons-line.css' ) ), 'all' );
	wp_enqueue_style( 'style-theme', get_theme_file_uri( 'style-theme.css' ), array(), filemtime( get_theme_file_path( 'style-theme.css' ) ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'behva_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Web setting',
			'menu_title' => 'Web setting',
			'menu_slug'  => 'web-setting',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'position'   => '2',
			'icon_url'   => 'dashicons-admin-site',
		)
	);
}

/**
 * Function archive_title
 */
add_filter(
	'get_the_archive_title',
	function ( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_tax() ) { //for custom post types
			$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
);


/**
 * Function which set path for save acf json.
 *
 * @param string $path path for save acf json.
 * @return string
 */
function my_acf_json_save_point( $path ) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );