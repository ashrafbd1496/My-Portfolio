<?php
/**
 * myportfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package myportfolio
 */

require get_template_directory() . '/inc/acf-for-menu.php';
require get_template_directory() . '/inc/acf-options.php';

if (home_url() == 'http://localhost/myportfolio') {

    define('VERSION', time());
} else {
    define('VERSION', wp_get_theme()->get('VERSION'));
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function myportfolio_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on myportfolio, use a find and replace
		* to change 'myportfolio' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'myportfolio', get_template_directory() . '/languages' );

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
			'icon-menu' => esc_html__( 'Icon Menu', 'myportfolio' ),
			
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
			'myportfolio_custom_background_args',
			array(
				'default-color' => 'ffffff',
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
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'myportfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function myportfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'myportfolio_content_width', 640 );
}
add_action( 'after_setup_theme', 'myportfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function myportfolio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'myportfolio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'myportfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'myportfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function myportfolio_scripts() {
	//google font css
		wp_enqueue_style( 'template-google-sans-fonts','//fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700');
		wp_enqueue_style( 'template-google-poppins-fonts','//fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');

		//Template css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css',array(),'all');
	wp_enqueue_style( 'preloader', get_template_directory_uri() .'/assets/css/preloader.min.css','all');
	wp_enqueue_style( 'circle', get_template_directory_uri() .'/assets/css/circle.css','all');
	wp_enqueue_style( 'revealator', get_template_directory_uri() .'/assets/css/fm.revealator.jquery.min.css', array('jquery'),'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css','all');
	wp_enqueue_style( 'skins', get_template_directory_uri() .'/assets/css/skins/yellow.css');
	wp_enqueue_style( 'styleswitcher', get_template_directory_uri() .'/assets/css/styleswitcher.css');
	wp_enqueue_style( 'template-style', get_template_directory_uri() .'/assets/css/style.css',array(),VERSION, 'all');
	wp_style_add_data( 'myportfolio-rtl-style', 'rtl', 'replace' );
	wp_enqueue_style( 'myportfolio-theme-style', get_stylesheet_uri(), array(), VERSION, 'all');



	//scripts
	wp_enqueue_script( 'modernizor', get_template_directory_uri() . '/assets/js/modernizr.custom.js', array(), false );
	wp_enqueue_script( 'styleswitcher', get_template_directory_uri() . '/assets/js/styleswitcher.js', array(), VERSION, true );
	wp_enqueue_script( 'preloader', get_template_directory_uri() . '/assets/js/preloader.min.js', array(), VERSION, true );
	wp_enqueue_script( 'revealator', get_template_directory_uri() . '/assets/js/fm.revealator.jquery.min.js', array('jquery'), true );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array(), VERSION, true );
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array(), VERSION, true );
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/assets/js/classie.js', array(), VERSION, true );
	wp_enqueue_script( 'gridgallery', get_template_directory_uri() . '/assets/js/cbpGridGallery.js', array(), VERSION, true );
	wp_enqueue_script( 'jquery-hoverdir', get_template_directory_uri() . '/assets/js/jquery.hoverdir.js', array('jquery'), VERSION, true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), true );
	wp_enqueue_script( 'myportfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'myportfolio_scripts' );

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
