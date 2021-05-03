<?php
/**
 * Theme Setup
 *
 * @package sasabudi
 */

if ( ! isset( $content_width ) ) {
  $content_width = 900;
}

/**
 * Theme Setup
 */
function sasabudi_theme_setup() {

  $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

  // Textdomain
  load_theme_textdomain( 'sasabudi', get_template_directory() . '/languages' );

  // Support
  add_theme_support( 'title-tag' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'customize-selective-refresh-widgets' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'woocommerce');

  // Woocommerce
  add_theme_support( 'wc-product-gallery-slider' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'woocommerce', array('gallery_thumbnail_image_width' => 180));
  add_theme_support( 'woocommerce', array(
    'product_grid'      => array(
      'default_rows'    => get_option('woocommerce_catalog_rows', 4),
      'min_rows'        => 2,
      'max_rows'        => '',
      'default_columns' => get_option('woocommerce_catalog_columns', 4),
      'min_columns'     => 1,
      'max_columns'     => 4,
    ))
  );

  //	Woocommerce thumb size for product gallery (single)
  add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
    return 'thumbnail';
  } );

  // Gutenberg
  add_theme_support( 'align-wide' );
  add_theme_support( 'editor-styles' );
  add_theme_support( 'editor-style-block' );
  add_theme_support( 'responsive-embeds' );

  // Editor
  add_editor_style( 'css/admin/editor-style'.$suffix.'.css' );
  add_editor_style( 'css/admin/editor-style-block'.$suffix.'.css' );

  // Excerpt
  add_post_type_support( 'page', 'excerpt' );

  // Post Types
  add_post_type_support( 'instagram', 'thumbnail' );
  add_post_type_support( 'artwork', 'thumbnail' );

  // Menus
  register_nav_menus( array(
    'primary'   => esc_html__( 'Desktop Navigation', 'sasabudi' ),
    'mobile'    => esc_html__( 'Mobile Navigation', 'sasabudi' )
  ));
}
add_action( 'after_setup_theme', 'sasabudi_theme_setup' );

/**
 * SASABUDI Widgets
 */
function sasabudi_widgets_init() {

  // Footer #1
  register_sidebar( array(
    'name'          => esc_html__( 'Footer #1', 'sasabudi' ),
    'id'            => 'sidebar-1',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    'before_widget' => '<div class="%2$s"><div class="widget-content">',
    'after_widget'  => '</div></div>',
  ));

  // Footer #2
  register_sidebar( array(
    'name'          => esc_html__( 'Footer #2', 'sasabudi' ),
    'id'            => 'sidebar-2',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    'before_widget' => '<div class="%2$s"><div class="widget-content">',
    'after_widget'  => '</div></div>',
  ));

  // Footer #3
  register_sidebar( array(
    'name'          => esc_html__( 'Footer #3', 'sasabudi' ),
    'id'            => 'sidebar-3',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    'before_widget' => '<div class="%2$s"><div class="widget-content">',
    'after_widget'  => '</div></div>',
  ));

  // Left Offset Product Filters
  register_sidebar( array(
    'name'          => esc_html__( 'Left Offset Product Filters', 'sasabudi' ),
    'id'            => 'sidebar-filters',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  // Right Offset Mini Cart
  register_sidebar( array(
    'name'          => esc_html__( 'Right Offset Mini Cart', 'sasabudi' ),
    'id'            => 'sidebar-cart',
    'before_widget' => '<aside class="offset-right__cart">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));

  // Filter bar layered navigation
  register_sidebar( array(
    'name'          => esc_html__( 'Layered Filter Navigation', 'sasabudi' ),
    'id'            => 'layered-navigation',
    'before_widget' => '<div id="%1$s" class="filter-tags">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => '',
  ));

	/**
	 * Register custom sasabudi Layered Widget
	 * instead of original (Adds background color to color filter, etc.)
	 */
  if( class_exists( 'WC_Widget_Layered_Nav' ) ) {
		// unregister
		unregister_widget( 'WC_Widget_Layered_Nav' );
		// register custom widget for it
		include_once( get_template_directory() . '/inc/widgets/widget-layered-nav.php' );
		register_widget( 'SASA_Widget_Layered_Nav' );
	}
}
add_action( 'widgets_init', 'sasabudi_widgets_init' );

/**
 * Favicon
 */
function sasabudi_favicon(){
	if (has_site_icon() == false) {
    echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/favicon.png" />';
  }
}
add_action( 'wp_head', 'sasabudi_favicon' );