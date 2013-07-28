<?php
/**
 * cbarnes_dev functions and definitions
 *
 * @package cbarnes_dev
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'cbarnes_dev_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function cbarnes_dev_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on cbarnes_dev, use a find and replace
	 * to change 'cbarnes_dev' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cbarnes_dev', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cbarnes_dev' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'cbarnes_dev_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // cbarnes_dev_setup
add_action( 'after_setup_theme', 'cbarnes_dev_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cbarnes_dev_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cbarnes_dev' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'cbarnes_dev_widgets_init' );

/**
 * Main Nav
  */

function cbarnes_dev_main_nav() {

    wp_nav_menu( 
    	array( 
    		'menu' => 'primary', /* menu name */
    		'menu_class' => 'nav navbar-nav',
    		'theme_location' => 'primary', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
    		'depth' => '2',
    		'walker' => new description_walker()
    	)
    );
}

// Change password protected form output

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . __( "This post is password protected. To view it please enter your password below:" ) . '
	<div class="input-group"><input name="post_password" id="' . $label . '" placeholder="' . esc_attr__( "Password" ) . '" type="password" size="20" /><span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-default" />Go</button></span></div>
	</form>
	';
	return $o;
}

/**
 * Enqueue scripts and styles
 */
function cbarnes_dev_scripts() {
	wp_enqueue_style( 'cbarnes_dev-style', get_template_directory_uri() . '/inc/css/bootstrap.css' );

	wp_enqueue_script( 'cbarnes_dev-bootstrap', get_template_directory_uri() . '/inc/js/bootstrap.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'cbarnes_dev-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'cbarnes_dev-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cbarnes_dev-keyboard-image-navigation', get_template_directory_uri() . '/inc/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'cbarnes_dev_scripts' );

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Load custom walker for bootstrap nav
*/
require get_template_directory() . '/inc/walker.php';