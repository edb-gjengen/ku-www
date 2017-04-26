<?php
/**
 * ku2015 functions and definitions
 *
 * @package ku2015
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'ku2015_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ku2015_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ku2015, use a find and replace
	 * to change 'ku2015' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ku2015', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ku2015' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	add_post_type_support( 'post', 'excerpt' );
}
endif; // ku2015_setup
add_action( 'after_setup_theme', 'ku2015_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ku2015_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ku2015' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ku2015_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ku2015_scripts() {
	wp_enqueue_style( 'ku2015-fonts', get_template_directory_uri() . '/fonts/avenir.css' );

	wp_enqueue_style( 'ku2015-style', get_stylesheet_uri(), array(), '2016092801' );

    //wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'instafeed', get_template_directory_uri() . '/js/instafeed.min.js', array(), '', true );

	wp_enqueue_script( 'moment', get_template_directory_uri() . '/js/moment.js', array(), '', true );

	wp_enqueue_script( 'moment-nb', get_template_directory_uri() . '/js/moment-nb.js', array(), '', true );

	wp_enqueue_script( 'ku2015-app', get_template_directory_uri() . '/js/app.js', array(), '2016092801', true );

	wp_enqueue_script( 'ku2015-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'ku2015-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ku2015_scripts' );

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
/*require get_template_directory() . '/inc/jetpack.php';*/


function new_excerpt_more( $more ) {
	return ' &hellip;';
	//return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">&hellip;</a>';
	//return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '"> Les mer</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );



function extend_date_archives_flush_rewrite_rules(){
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
add_action('init', 'extend_date_archives_flush_rewrite_rules');

function extend_date_archives_add_rewrite_rules($wp_rewrite){
	$rules = array();
	$structures = array(
		$wp_rewrite->get_category_permastruct() . $wp_rewrite->get_date_permastruct(),
		$wp_rewrite->get_category_permastruct() . $wp_rewrite->get_month_permastruct(),
		$wp_rewrite->get_category_permastruct() . $wp_rewrite->get_year_permastruct(),
	);
	foreach( $structures as $s ){
		$rules += $wp_rewrite->generate_rewrite_rules($s);
	}
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'extend_date_archives_add_rewrite_rules');

function get_archives_for_category ( $link_html ) {
	if ( is_category( 'litteraturblogg' )) {
		$link_html = str_replace("//{$_SERVER['SERVER_NAME']}", "//{$_SERVER['SERVER_NAME']}/kategori/litteraturblogg", $link_html);
	}
	return $link_html;
}
add_filter("get_archives_link", "get_archives_for_category");


/*function change_archives_widget_title ( )

$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );
*/

/* Include person custom post type */
require get_template_directory() . '/inc/post_type_person.php';

function ku_custom_post_types() {
    global $KU_TYPES;
    $KU_TYPES['person'] = new KUPerson();
}
add_action('init', 'ku_custom_post_types', 0);