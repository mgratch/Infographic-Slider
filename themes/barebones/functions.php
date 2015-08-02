<?php
/**
 * barebones functions and definitions
 *
 * @package barebones
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280; /* pixels */
}

if ( ! function_exists( 'barebones_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function barebones_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on barebones, use a find and replace
	 * to change 'barebones' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'barebones', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'barebones' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	*/

	/* Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'barebones_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	*/
}
endif; // barebones_setup
add_action( 'after_setup_theme', 'barebones_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 *
function barebones_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'barebones' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'barebones_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function barebones_scripts() {
	wp_enqueue_style( 'barebones-style', get_stylesheet_uri() );

    /*

	wp_enqueue_script( 'barebones-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'barebones-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    */
}
add_action( 'wp_enqueue_scripts', 'barebones_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="rsNoDrag protectQuiet" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . __( "Amy & Lee cherish their privacy and yours.  Please log in using the Password Provided with your Save the Date:" ) . '</p>
    <p><label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" class="col-xs-12 col-sm-9 col-md-9" id="' . $label . '" type="password" placeholder="Enter your password here :)" size="24" maxlength="24" /><input class="col-xs-12 col-sm-3 col-md-3" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" /></p>
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

if (!is_admin()){
    //add_filter( 'wp_redirect', function () { debug_print_backtrace(); exit; },999 );
}

/*
function remove_unlocal_scripts(){
    wp_dequeue_script('jquery_validate');
    wp_deregister_script('jquery_validate');
    wp_register_script('jquery.validate', get_template_directory_uri().'/js/jquery.validate.js','jquery',false,false);
    wp_enqueue_script('jquery.validate');
    wp_dequeue_script('google-maps-js-api');
    wp_deregister_script('google-maps-js-api');
    wp_register_script('google_maps_js_api', get_template_directory_uri().'/js/google-maps-js-api.js','',false,false);
    wp_enqueue_script('google_maps_js_api');


}
get_new_royalslider(1);
var_dump(NewRoyalSliderMain::$sliders_init_code);

add_action('init', 'remove_unlocal_scripts',12);
*/