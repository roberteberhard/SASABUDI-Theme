<?php
/**
 * WP Post-Types
 *
 * @package sasabudi
 */
/* Hook into the 'init' action so that the function
 * Containing our post type registration is not 
 * unnecessarily executed. 
 */
add_action( 'init', 'sasabudi_post_types', 0 );

// Custom columns for the message contact form
add_filter('manage_sasabudi-contact_posts_columns', 'sasabudi_set_contact_columns');
add_action( 'manage_sasabudi-contact_posts_custom_column', 'sasabudi_contact_custom_column', 10, 2 );
add_action( 'add_meta_boxes', 'sasabudi_contact_add_meta_box' );
add_action( 'save_post', 'sasabudi_save_contact_email_data' );

/**
 * Advanced Custom Fields Option Pages.
 */
if( function_exists('acf_add_options_page') ) {
  // Options
  acf_add_options_page(array(
    'menu_title'	=> __( 'Options', 'sasabudi' ),
    'menu_slug' 	=> 'theme-options-settings',
    'page_title' 	=> __( 'Theme Settings', 'sasabudi' ),
    'capability'	=> 'edit_posts', // create_users
    'parent_slug'	=> '',
    'position'		=> 5,
    'icon_url'		=> 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iZm9udHMiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMThweCIgaGVpZ2h0PSIxOHB4IiB2aWV3Qm94PSIwIDAgMTggMTgiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDE4IDE4IiB4bWw6c3BhY2U9InByZXNlcnZlIj48ZyBpZD0ic2FzYWJ1ZGlfMV8iPjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xNC4wMjksNi4xODJjMC4wMDItMC4xMDEsMC4wMDItMC4yMDMsMC4wMDQtMC4zMTFjLTAuMTU4LDAuNDE2LTAuMzA1LDAuNzg1LTAuNTEsMS4yODNoMC41MjNDMTQuMDM2LDYuODIzLDE0LjAyOSw2LjUyMSwxNC4wMjksNi4xODJ6Ii8+PHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTcuNzQ4LDYuMTgyYzAtMC4xMDEsMC0wLjIwMywwLjAwMS0wLjMxMkM3LjU5LDYuMjg4LDcuNDQzLDYuNjU3LDcuMjM5LDcuMTU0aDAuNTI4QzcuNzUzLDYuODIyLDcuNzQ4LDYuNTIxLDcuNzQ4LDYuMTgyeiIvPjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik00Ljk4LDEwLjIwOUg0LjQwOGwtMC4xMTUsMC42NDVoMC41NjFjMC4xNzYsMCwwLjI3NS0wLjEwMywwLjMxNS0wLjMyNGMwLjAyMi0wLjEyNSwwLjAxMy0wLjIxMy0wLjAzLTAuMjY0QzUuMTA3LDEwLjIyOSw1LjA1NSwxMC4yMDksNC45OCwxMC4yMDl6Ii8+PHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTQuNzQzLDExLjU2Mkg0LjE3MUw0LjA0LDEyLjI5N2gwLjU2MmMwLjE4OCwwLDAuMjY1LTAuMDU3LDAuMzItMC4zNjdjMC4wMS0wLjA1NywwLjAxNi0wLjEwNCwwLjAxNi0wLjE1MkM0LjkzOCwxMS42MjYsNC44NzksMTEuNTYyLDQuNzQzLDExLjU2MnoiLz48cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMSwxN2gxNlYxSDFWMTd6IE02LjE3LDEwLjI2OEw2LjEzOSwxMC40NWMtMC4wODIsMC40NzEtMC4yMiwwLjY0Mi0wLjQ1MywwLjc2OGMwLjE1NSwwLjA4MSwwLjI4NSwwLjIxMiwwLjI4NSwwLjUyMmMwLDAuMDg0LTAuMDEsMC4xODItMC4wMzEsMC4yOTVsLTAuMDQ3LDAuMjY4Yy0wLjEwMywwLjU2Ni0wLjUyMywwLjg1NC0xLjI1NCwwLjg1NGgtMS43NWwwLjY3LTMuODAyaDEuNzc0YzAuNTY5LDAsMC44NTgsMC4yMjksMC44NTgsMC42OEM2LjE5MSwxMC4xMTksNi4xODYsMTAuMTkzLDYuMTcsMTAuMjY4eiBNMTMuMjIzLDEwLjYyOWwtMC4yMjEsMS4yNjRjLTAuMTUsMC44NjItMC42NjEsMS4yNjgtMS42MDUsMS4yNjhIOS45MzZsMC42Ny0zLjgwM2gxLjQ0OWMwLjgxOCwwLDEuMiwwLjI5MiwxLjIsMC45MkMxMy4yNTUsMTAuMzgzLDEzLjI0NCwxMC41MDIsMTMuMjIzLDEwLjYyOXogTTE0LjQ2NSwxMy4xNTZoLTEuMDI5bDAuNjctMy44MDNoMS4wMjlMMTQuNDY1LDEzLjE1NnogTTE0Ljk1Myw0Ljg0M2wwLjE5OSwzLjgwNGgtMS4wNTdsLTAuMDIxLTAuNzIyaC0wLjg2MWwtMC4yODksMC43MjJIMTEuOTFsMS41OTYtMy44MDRIMTQuOTUzeiBNOS4yOTUsNy42NjhsMC4wMzQsMC4wMDdjMC4zNCwwLjA3MywwLjY2MiwwLjExLDAuOTU2LDAuMTFjMC40OCwwLDAuNjMxLTAuMDYyLDAuNjY4LTAuMjc4YzAuMDE1LTAuMDg1LDAuMDA4LTAuMTQzLTAuMDIxLTAuMTg0Yy0wLjA1MS0wLjA2OS0wLjE4LTAuMDk5LTAuMzU0LTAuMTIxYy0wLjIzOC0wLjAyOS0wLjU3LTAuMDk5LTAuNzg1LTAuMjA5Yy0wLjIxOS0wLjEwMi0wLjMzLTAuMjg5LTAuMzMtMC41NTRjMC0wLjA5LDAuMDE0LTAuMTc5LDAuMDI3LTAuMjU0bDAuMDMxLTAuMTg4YzAuMjAzLTEuMTUzLDAuOTM3LTEuMjQ5LDEuNzI5LTEuMjQ5YzAuMzYsMCwwLjY2LDAuMDQ1LDAuOTE2LDAuMTM5bDAuMDIyLDAuMDFsLTAuMTYsMC45MjlMMTIsNS44MThjLTAuMzU1LTAuMDc4LTAuNjU4LTAuMTE0LTAuOTUxLTAuMTE0Yy0wLjQyNCwwLTAuNTA2LDAuMDc4LTAuNTQyLDAuMjYzYy0wLjAzLDAuMTgsMC4wMTUsMC4yMjMsMC4xMjQsMC4yNTJjMC4wOSwwLjAyMywwLjIwNSwwLjA0NSwwLjM1MiwwLjA3M2MwLjA4LDAuMDE1LDAuMTcsMC4wMzMsMC4yNzIsMC4wNTRjMC4zMzEsMC4wNjUsMC43NDIsMC4xNDYsMC43NDIsMC42NjhjMCwwLjA4Mi0wLjAwNywwLjE2MS0wLjAyMSwwLjIzN0wxMS45Miw3LjU2M2MtMC4xODksMS4wODctMC45NzksMS4xOC0xLjgzNywxLjE4Yy0wLjM4MywwLTAuNjg4LTAuMDQ0LTAuOTI4LTAuMTM2TDkuMTMsOC41OTdMOS4yOTUsNy42Njh6IE05Ljk0NSw5LjM1NWwtMC40NDIsMi41MDZjLTAuMTg1LDEuMDM5LTAuNjI1LDEuMzkxLTEuNzQ5LDEuMzkxYy0wLjk0MywwLTEuMzEyLTAuMjU1LTEuMzEyLTAuOTA2YzAtMC4xNDUsMC4wMTctMC4zMTEsMC4wNDktMC40OTZsMC40NDEtMi40OTZoMS4wNDVsLTAuNDM4LDIuNDcyYy0wLjAxLDAuMDYyLTAuMDE2LDAuMTIzLTAuMDE2LDAuMTY4YzAsMC4yMDEsMC4wOTksMC4yNjgsMC40MDQsMC4yNjhjMC4zMjgsMCwwLjQ5NS0wLjA2MywwLjU2My0wLjQ0NWwwLjQzNi0yLjQ1OGgxLjAyVjkuMzU1TDkuOTQ1LDkuMzU1eiBNOC42NjksNC44NDNsMC4xOTgsMy44MDRINy44MTJMNy43OTEsNy45MjVINi45M0w2LjYzOSw4LjY0Nkg1LjYyNWwxLjU5Ni0zLjgwNUw4LjY2OSw0Ljg0M0w4LjY2OSw0Ljg0M3ogTTMuMDEyLDcuNjY5bDAuMDMzLDAuMDA3YzAuMzQsMC4wNzMsMC42NjIsMC4xMSwwLjk1NiwwLjExYzAuNDgxLDAsMC42MzEtMC4wNjIsMC42NjgtMC4yNzhjMC4wMTUtMC4wODUsMC4wMDgtMC4xNDMtMC4wMjEtMC4xODRjLTAuMDUxLTAuMDY5LTAuMTgtMC4wOTgtMC4zNTYtMC4xMkM0LjA1NSw3LjE3NSwzLjcyMyw3LjEwNSwzLjUwOCw2Ljk5NUMzLjI5LDYuODkxLDMuMTgsNi43MDQsMy4xOCw2LjQzOWMwLTAuMDksMC4wMTQtMC4xNzksMC4wMjYtMC4yNTRsMC4wMzItMC4xODhDMy40MzksNC44NDQsNC4xNzIsNC43NDksNC45Nyw0Ljc0OWMwLjM2LDAsMC42NiwwLjA0NSwwLjkxNiwwLjE0bDAuMDI2LDAuMDA4bC0wLjE2NCwwLjkzTDUuNzE1LDUuODE4QzUuMzU5LDUuNzQsNS4wNTcsNS43MDQsNC43NjYsNS43MDRjLTAuNDI0LDAtMC41MDcsMC4wNzgtMC41NDMsMC4yNjNDNC4xOTQsNi4xNDcsNC4yMzcsNi4xOSw0LjM0OCw2LjIxOWMwLjA5LDAuMDIzLDAuMjA0LDAuMDQ1LDAuMzUxLDAuMDczQzQuNzgsNi4zMDcsNC44Nyw2LjMyNSw0Ljk3MSw2LjM0NkM1LjMwMSw2LjQxLDUuNzEzLDYuNDksNS43MTMsNy4wMTRjMCwwLjA4LTAuMDA3LDAuMTYtMC4wMjEsMC4yMzZMNS42MzksNy41NjFDNS40NDUsOC42NSw0LjY2LDguNzQxLDMuODAxLDguNzQxYy0wLjM4MywwLTAuNjg2LTAuMDQ0LTAuOTI3LTAuMTM0TDIuODUsOC41OThMMy4wMTIsNy42Njl6Ii8+PHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTExLjkwNiwxMC4yNDZoLTAuNDNsLTAuMzU3LDIuMDJoMC40MTljMC4yNTMsMCwwLjM3Mi0wLjA0OCwwLjQ1Mi0wLjVsMC4xODQtMS4wMzdjMC4wMTYtMC4xMDIsMC4wMjYtMC4xNzYsMC4wMjYtMC4yMzRDMTIuMiwxMC4yODEsMTIuMTA5LDEwLjI0NiwxMS45MDYsMTAuMjQ2eiIvPjwvZz48L3N2Zz4=',
    'redirect'		=> true
  ));
  // General
  acf_add_options_sub_page(array(
    'menu_title'	=> __( 'General', 'sasabudi' ),
    'menu_slug' 	=> 'theme-options-general',
    'page_title' 	=> __( 'General Page Settings', 'sasabudi' ),
    'capability'	=> 'create_users', // create_users
    'parent_slug'	=> 'theme-options-settings',
    'position'		=> false,
    'icon_url'		=> false,
  ));
  // Products
	acf_add_options_sub_page(array(
		'menu_title'	=> __( 'Products', 'sasabudi' ),
		'menu_slug' 	=> 'theme-options-products',
		'page_title' 	=> __( 'Product Settings', 'sasabudi' ),
		'capability'	=> 'create_users',
		'parent_slug'	=> 'theme-options-settings',
		'position'		=> false,
		'icon_url'		=> false,
  ));
  // Promotions
	acf_add_options_sub_page(array(
		'menu_title'	=> __( 'Promotions', 'sasabudi' ),
		'menu_slug' 	=> 'theme-options-promotions',
		'page_title' 	=> __( 'Promotion Settings', 'sasabudi' ),
		'capability'	=> 'create_users',
		'parent_slug'	=> 'theme-options-settings',
		'position'		=> false,
		'icon_url'		=> false,
	));
  // Website Keys
	acf_add_options_sub_page(array(
		'menu_title'	=> __( 'Website Keys', 'sasabudi' ),
		'menu_slug' 	=> 'theme-options-website-keys',
		'page_title' 	=> __( 'Website Keys Settings', 'sasabudi' ),
		'capability'	=> 'create_users',
		'parent_slug'	=> 'theme-options-settings',
		'position'		=> false,
		'icon_url'		=> false,
	));
}


function sasabudi_post_types() {

  /**
   * Registering Banner Post-Type
   */
  $banner_slug = __('banner', 'sasabudi');
  $banner_labels = array(
     'name'                => _x( 'Banners', 'Post Type General Name', 'sasabudi' ),
     'singular_name'       => _x( 'Banner', 'Post Type Singular Name', 'sasabudi' ),
     'menu_name'           => __( 'Banners', 'sasabudi' ),
     'parent_item_colon'   => __( 'Parent Banners', 'sasabudi' ),
     'all_items'           => __( 'All Banners', 'sasabudi' ),
     'view_item'           => __( 'View Banner', 'sasabudi' ),
     'add_new_item'        => __( 'Add New Banners', 'sasabudi' ),
     'add_new'             => __( 'Add New', 'sasabudi' ),
     'edit_item'           => __( 'Edit Banner', 'sasabudi' ),
     'update_item'         => __( 'Update Banner', 'sasabudi' ),
     'search_items'        => __( 'Search Banner', 'sasabudi' ),
     'not_found'           => __( 'Not Found', 'sasabudi' ),
     'not_found_in_trash'  => __( 'Not found in Trash', 'sasabudi' ),
   );
   $banner_args = array(
     'label'               => __( 'Banners', 'sasabudi' ),
     'description'         => __( 'Shop our Banners', 'sasabudi' ),
     'labels'              => $banner_labels,
     'supports'            => array( 'title', 'thumbnail', 'custom-fields' ),
     'hierarchical'        => false,
     'public'              => false,
     'show_ui'             => true,
     'show_in_menu'        => true,
     'show_in_nav_menus'   => true,
     'show_in_admin_bar'   => true,
     'menu_position'       => 6,
     'can_export'          => true,
     'has_archive'         => true,
     'exclude_from_search' => true,
     'publicly_queryable'  => true, // Set to false hides single pages & archive pages
     'menu_icon'           => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9Ikljb24iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPHBhdGggaWQ9IkFydHdvcmsiIGNsYXNzPSJzdDAiIGQ9Ik03LjcsNS42YzAuOCwwLDEuNCwwLjYsMS40LDEuNFM4LjUsOC40LDcuNyw4LjRTNi4zLDcuNyw2LjMsN1M3LDUuNiw3LjcsNS42eiBNNy43LDguNgoJQzYuOCw4LjYsNiw3LjksNiw3czAuNy0xLjYsMS42LTEuNlM5LjQsNi4xLDkuNCw3UzguNiw4LjYsNy43LDguNnogTTcuNyw2Yy0wLjUsMC0xLDAuNS0xLDFzMC41LDEsMSwxczAuOS0wLjUsMC45LTFTOC4zLDYsNy43LDZ6CgkgTTQuMywxNC4zbDMtNC42bDIsMkwxMiw3bDMuNiw3LjNINC4zeiBNMTUuNiwxNC42TDE1LjYsMTQuNkg0LjNjLTAuMSwwLTAuMy0wLjEtMC4zLTAuMmMtMC4xLTAuMS0wLjEtMC4zLDAtMC40bDMtNC42CgljMC4xLTAuMSwwLjItMC4yLDAuMy0wLjJzMC4yLDAsMC4zLDAuMUw5LjMsMTFsMi41LTQuM2MwLjEtMC4xLDAuMi0wLjIsMC4zLTAuMmMwLjEsMCwwLjMsMC4xLDAuMywwLjJsMy42LDcuMkMxNiwxNCwxNiwxNCwxNiwxNC4xCglDMTYsMTQuNSwxNS44LDE0LjYsMTUuNiwxNC42eiBNNSwxMy45aDEwLjFMMTIsNy42bC0yLjQsNC4xYy0wLjEsMC4xLTAuMiwwLjItMC4zLDAuMnMtMC4yLDAtMC4zLTAuMWwtMS42LTEuNkw1LDEzLjl6IE0yLDJ2MTZoMTYKCVYySDJ6IE0xNywxN0gzVjNoMTRWMTd6Ii8+Cjwvc3ZnPgo=',
     'capability_type'     => 'page',
     'rewrite'             => array('slug' => $banner_slug)
   );
   register_post_type( 'banner', $banner_args );
   // remove_rewrite_tag( '%banner%' ); // This line will remove banner rewrite rules for single view


  /**
   * Registering Collections Post-Type
   */
  $collection_slug = __('collections', 'sasabudi');
  $collection_labels = array(
    'name'                => _x( 'Collections', 'Post Type General Name', 'sasabudi' ),
    'singular_name'       => _x( 'Collection', 'Post Type Singular Name', 'sasabudi' ),
    'menu_name'           => __( 'Collections', 'sasabudi' ),
    'parent_item_colon'   => __( 'Parent Collection', 'sasabudi' ),
    'all_items'           => __( 'All Collections', 'sasabudi' ),
    'view_item'           => __( 'View Collection', 'sasabudi' ),
    'add_new_item'        => __( 'Add New Collection', 'sasabudi' ),
    'add_new'             => __( 'Add New', 'sasabudi' ),
    'edit_item'           => __( 'Edit Collection', 'sasabudi' ),
    'update_item'         => __( 'Update Collection', 'sasabudi' ),
    'search_items'        => __( 'Search Collection', 'sasabudi' ),
    'not_found'           => __( 'Not Found', 'sasabudi' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'sasabudi' ),
  );
  $collection_args = array(
    'label'               => __( 'Collections', 'sasabudi' ),
    'description'         => __( 'Shop our Collections', 'sasabudi' ),
    'labels'              => $collection_labels,
    // Features this CPT supports in Post Editor
    // array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    'supports'            => array( 'title', 'author', 'thumbnail', 'custom-fields' ),
    // You can associate this CPT with a taxonomy or custom taxonomy. 
    // 'taxonomies'          => array( 'genres' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */ 
    'hierarchical'        => false,
    'public'              => true,
    'show_in_rest'        => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 7,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true, // Set to false hides single pages & archive pages
    'menu_icon'           => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9Ikljb24iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPHBhdGggY2xhc3M9InN0MCIgZD0iTTIuNSwyaDYuMUM4LjgsMiw5LDIuMSw5LDIuNXY2LjFDOSw4LjgsOC45LDksOC41LDlIMi41QzIuMiw5LDIsOC44LDIsOC40di02QzIuMSwyLjEsMi4yLDIsMi41LDJ6Ii8+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0yLjUsMTFoNi4xQzguOCwxMSw5LDExLjEsOSwxMS41djYuMUM5LDE3LjgsOC45LDE4LDguNSwxOEgyLjVDMi4yLDE4LDIsMTcuOSwyLDE3LjV2LTYuMQoJQzIuMSwxMS4yLDIuMiwxMSwyLjUsMTF6Ii8+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xMS41LDExaDYuMWMwLjMsMCwwLjUsMC4xLDAuNSwwLjV2Ni4xYzAsMC4zLTAuMSwwLjUtMC41LDAuNWgtNi4xYy0wLjMsMC0wLjUtMC4yLTAuNS0wLjZ2LTYKCUMxMS4xLDExLjEsMTEuMiwxMSwxMS41LDExeiIvPgo8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMTcuNCw0LjloLTIuMlYyLjVDMTUsMi4yLDE0LjksMiwxNC41LDJjLTAuNCwwLTAuNiwwLjMtMC42LDAuNnYyLjJoLTIuM0MxMS4yLDUsMTEsNS4xLDExLDUuNQoJYzAsMC40LDAuMywwLjYsMC42LDAuNmgyLjJ2Mi4yYzAsMC40LDAuMywwLjYsMC42LDAuNmMwLjQsMCwwLjYtMC4zLDAuNi0wLjZWNi4xaDIuMmMwLjQsMCwwLjYtMC4zLDAuNi0wLjYKCUMxOCw1LjEsMTcuNyw0LjksMTcuNCw0Ljl6Ii8+Cjwvc3ZnPgo=',
    'capability_type'     => 'page',
    'rewrite'             => array('slug' => $collection_slug)
  );
  register_post_type( 'collections', $collection_args );

  /**
   * Registering Instagram Post-Type
   */
  $instagram_labels = array(
    'name'                => _x( 'Instagram', 'Post Type General Name', 'sasabudi' ),
    'singular_name'       => _x( 'Instagram', 'Post Type Singular Name', 'sasabudi' ),
    'menu_name'           => __( 'Instagram', 'sasabudi' ),
    'parent_item_colon'   => __( 'Parent Instagram', 'sasabudi' ),
    'all_items'           => __( 'All Instagram', 'sasabudi' ),
    'view_item'           => __( 'View Instagram', 'sasabudi' ),
    'add_new_item'        => __( 'Add New Instagram', 'sasabudi' ),
    'add_new'             => __( 'Add New', 'sasabudi' ),
    'edit_item'           => __( 'Edit Instagram', 'sasabudi' ),
    'update_item'         => __( 'Update Instagram', 'sasabudi' ),
    'search_items'        => __( 'Search Instagram', 'sasabudi' ),
    'not_found'           => __( 'Not Found', 'sasabudi' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'sasabudi' ),
  );
  $instagram_args = array(
    'label'               => __( 'Instagram', 'sasabudi' ),
    'description'         => __( 'Shop our Instagram', 'sasabudi' ),
    'labels'              => $instagram_labels,
    // Features this CPT supports in Post Editor
    // array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    'supports'            => array( 'title', 'author', 'thumbnail', 'custom-fields' ),
    // You can associate this CPT with a taxonomy or custom taxonomy. 
    // 'taxonomies'          => array( 'genres' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */ 
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 8,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true, // Set to false hides single pages & archive pages
    'menu_icon'           => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9Imljb24iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAxNSAxNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTUgMTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPHBhdGggaWQ9Imluc3RhZ3JhbSIgY2xhc3M9InN0MCIgZD0iTTcuNSwyLjFjMS43LDAsMS45LDAsMi42LDAuMWMwLjcsMC4xLDEsMC4xLDEuMiwwLjJjMC4zLDAuMSwwLjUsMC4zLDAuOCwwLjUKCWMwLjIsMC4yLDAuNCwwLjQsMC41LDAuOGMwLjEsMC4yLDAuMiwwLjYsMC4yLDEuMmMwLjEsMC43LDAuMSwwLjksMC4xLDIuNnMwLDEuOS0wLjEsMi42cy0wLjEsMS0wLjIsMS4yYy0wLjEsMC4zLTAuMywwLjUtMC41LDAuOAoJYy0wLjIsMC4yLTAuNCwwLjQtMC44LDAuNWMtMC4yLDAuMS0wLjYsMC4yLTEuMiwwLjJjLTAuNywwLjEtMC45LDAuMS0yLjYsMC4xcy0xLjksMC0yLjYtMC4xYy0wLjYtMC4xLTEtMC4xLTEuMi0wLjIKCUMzLjQsMTIuNCwzLjIsMTIuMiwzLDEyYy0wLjItMC4yLTAuNC0wLjQtMC41LTAuOEMyLjQsMTEsMi4yLDEwLjYsMi4yLDEwQzIuMiw5LjMsMi4yLDkuMiwyLjIsNy40czAtMS45LDAuMS0yLjZzMC4xLTEsMC4yLTEuMgoJQzIuNiwzLjMsMi43LDMuMSwzLDIuOWMwLjItMC4yLDAuNC0wLjQsMC44LTAuNWMwLjItMC4xLDAuNi0wLjIsMS4yLTAuMkM1LjUsMi4xLDUuOCwyLjEsNy41LDIuMSBNNy41LDFjLTEuOCwwLTIsMC0yLjcsMC4xCglDNC4xLDEuMSwzLjcsMS4yLDMuMywxLjRTMi41LDEuOCwyLjEsMi4xQzEuOCwyLjUsMS41LDIuOCwxLjQsMy4zUzEuMSw0LjEsMS4xLDQuOFMxLDUuOCwxLDcuNXMwLDIsMC4xLDIuNwoJYzAuMSwwLjcsMC4yLDEuMSwwLjMsMS42YzAuMiwwLjQsMC40LDAuOCwwLjgsMS4xYzAuNCwwLjMsMC43LDAuNiwxLjEsMC44YzAuNCwwLjIsMC45LDAuMywxLjYsMC4zUzUuOCwxNCw3LjUsMTRzMiwwLDIuNy0wLjEKCWMwLjctMC4xLDEuMS0wLjIsMS42LTAuM2MwLjQtMC4yLDAuOC0wLjQsMS4xLTAuOGMwLjMtMC40LDAuNi0wLjcsMC44LTEuMWMwLjItMC40LDAuMy0wLjksMC4zLTEuNlMxNCw5LjIsMTQsNy41czAtMi0wLjEtMi43CgljLTAuMS0wLjctMC4yLTEuMS0wLjMtMS42Yy0wLjItMC40LTAuNC0wLjgtMC44LTEuMWMtMC40LTAuNC0wLjctMC42LTEuMS0wLjhjLTAuNC0wLjItMC45LTAuMy0xLjYtMC4zQzkuNSwxLDkuMywxLDcuNSwxegoJIE03LjUsNC4xYy0xLjgsMC0zLjQsMS41LTMuNCwzLjRzMS41LDMuNCwzLjQsMy40czMuNC0xLjUsMy40LTMuNFM5LjMsNC4xLDcuNSw0LjF6IE03LjUsOS42Yy0xLjIsMC0yLjItMS0yLjItMi4yczEtMi4yLDIuMi0yLjIKCXMyLjIsMSwyLjIsMi4yUzguNyw5LjYsNy41LDkuNnogTTEwLjIsNGMwLDAuNCwwLjMsMC44LDAuOCwwLjhjMC40LDAsMC44LTAuMywwLjgtMC44UzExLjQsMy4yLDExLDMuMkMxMC41LDMuMiwxMC4yLDMuNiwxMC4yLDR6IgoJLz4KPC9zdmc+Cg==',
    'capability_type'     => 'page',
    'rewrite'             => array('slug' => 'instashop')
  );
  register_post_type( 'instagram', $instagram_args );
  remove_rewrite_tag( '%instagram%' ); // This line will remove instagram rewrite rules for single view


  /**
   * Registering Artworks Post-Type
   */
  register_post_type( 'artworks', array(
    'supports' => array('title', 'thumbnail', 'custom-fields'),
    'public' => true,
    'show_ui' => true,
    'labels' => array(
      'name' => __( 'Artworks', 'sasabudi' ),
      'add_new_item' => __( 'Add New Save', 'sasabudi' ),
      'edit_item' => __( 'Edit Save', 'sasabudi' ),
      'all_items' => __( 'All Saves', 'sasabudi' ),
      'singular_name' => __( 'Artworks', 'sasabudi' )
    ),
    'menu_icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9Ikljb24iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPHBhdGggaWQ9IkFydHdvcmsiIGNsYXNzPSJzdDAiIGQ9Ik03LjcsNS42YzAuOCwwLDEuNCwwLjYsMS40LDEuNFM4LjUsOC40LDcuNyw4LjRTNi4zLDcuNyw2LjMsN1M3LDUuNiw3LjcsNS42eiBNNy43LDguNgoJQzYuOCw4LjYsNiw3LjksNiw3czAuNy0xLjYsMS42LTEuNlM5LjQsNi4xLDkuNCw3UzguNiw4LjYsNy43LDguNnogTTcuNyw2Yy0wLjUsMC0xLDAuNS0xLDFzMC41LDEsMSwxczAuOS0wLjUsMC45LTFTOC4zLDYsNy43LDZ6CgkgTTQuMywxNC4zbDMtNC42bDIsMkwxMiw3bDMuNiw3LjNINC4zeiBNMTUuNiwxNC42TDE1LjYsMTQuNkg0LjNjLTAuMSwwLTAuMy0wLjEtMC4zLTAuMmMtMC4xLTAuMS0wLjEtMC4zLDAtMC40bDMtNC42CgljMC4xLTAuMSwwLjItMC4yLDAuMy0wLjJzMC4yLDAsMC4zLDAuMUw5LjMsMTFsMi41LTQuM2MwLjEtMC4xLDAuMi0wLjIsMC4zLTAuMmMwLjEsMCwwLjMsMC4xLDAuMywwLjJsMy42LDcuMkMxNiwxNCwxNiwxNCwxNiwxNC4xCglDMTYsMTQuNSwxNS44LDE0LjYsMTUuNiwxNC42eiBNNSwxMy45aDEwLjFMMTIsNy42bC0yLjQsNC4xYy0wLjEsMC4xLTAuMiwwLjItMC4zLDAuMnMtMC4yLDAtMC4zLTAuMWwtMS42LTEuNkw1LDEzLjl6IE0yLDJ2MTZoMTYKCVYySDJ6IE0xNywxN0gzVjNoMTRWMTd6Ii8+Cjwvc3ZnPgo='
  ));
  remove_rewrite_tag( '%artworks%' ); // This line will remove instagram rewrite rules for single view

  /**
   * Registering Wishlist Post-Type
   */
  register_post_type( 'wishlist', array(
    'supports' => array('title'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => __( 'Wishlist', 'sasabudi' ),
      'add_new_item' => __( 'Add New Save', 'sasabudi' ),
      'edit_item' => __( 'Edit Save', 'sasabudi' ),
      'all_items' => __( 'All Saves', 'sasabudi' ),
      'singular_name' => __( 'Wishlist', 'sasabudi' )
    ),
    'menu_icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9Ikljb24iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPGcgaWQ9IkhlYXJ0Ij4KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xMCwxOGMtMC4xLDAtMC4zLDAtMC40LTAuMkw0LDExLjZjLTAuMS0wLjItMi0yLjItMi00LjdDMiwzLjcsMy42LDIsNi4zLDJDNy45LDIsOS4zLDMuNCwxMCw0LjIKCQlDMTAuNywzLjQsMTIuMSwyLDEzLjcsMkMxNi40LDIsMTgsMy43LDE4LDYuOWMwLDIuNS0yLDQuNy0yLDQuN2wtNS42LDYuM0MxMC4zLDE4LDEwLjEsMTgsMTAsMThMMTAsMTh6Ii8+CjwvZz4KPC9zdmc+Cg=='
  ));
  

  /**
   * Registering Messages Post-Type
   */
  $message_labels = array(
    'name'                => _x( 'Messages', 'Post Type General Name', 'sasabudi' ),
    'singular_name'       => _x( 'Message', 'Post Type Singular Name', 'sasabudi' ),
    'menu_name'           => __( 'Messages', 'sasabudi' ),
    'parent_item_colon'   => __( 'Parent Message', 'sasabudi' ),
    'all_items'           => __( 'All Messages', 'sasabudi' ),
    'view_item'           => __( 'View Message', 'sasabudi' ),
    'add_new_item'        => __( 'Add New Message', 'sasabudi' ),
    'add_new'             => __( 'Add New', 'sasabudi' ),
    'edit_item'           => __( 'Edit Message', 'sasabudi' ),
    'update_item'         => __( 'Update Message', 'sasabudi' ),
    'search_items'        => __( 'Search Message', 'sasabudi' ),
    'not_found'           => __( 'Not Found', 'sasabudi' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'sasabudi' )
  );
  $message_args = array(
    'label'               => __( 'Messages', 'sasabudi' ),
    'description'         => __( 'Contact Form Messages', 'sasabudi' ),
    'labels'              => $message_labels,
    'supports'            => array( 'title', 'editor', 'author' ),
    'hierarchical'        => false,
    'public'              => false,
    'show_in_rest'        => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 26,
    'can_export'          => false,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => false, // Set to false hides single pages & archive pages
    'menu_icon'           => 'dashicons-email-alt',
    'capability_type'     => 'post',
    'rewrite'             => array('slug' => 'messages')
  );
  register_post_type( 'sasabudi-contact', $message_args );
}

/*
 * Manage custom contact columns
 */
function sasabudi_set_contact_columns( $columns ) {
  $newColumns = array();
  $newColumns['title'] = __( 'Full Name', 'sasabudi' );
  $newColumns['message'] = __( 'Message', 'sasabudi' );
  $newColumns['email'] = __( 'Email', 'sasabudi' );
  $newColumns['date'] = __( 'Date', 'sasabudi' );
  return $newColumns;
}
function sasabudi_contact_custom_column( $columns, $post_id ) {
  switch( $columns ) {
    case 'message' :
      echo get_the_excerpt();
      break;
    case 'email' :
      $email = get_post_meta( $post_id, '_contact_email_value_key', true );
      echo '<a href="mailto:' . $email . '">' . $email . '</a>';
      break;
  }
}

/* Manage custom contact meta boxes */
function sasabudi_contact_add_meta_box() {
  add_meta_box( 'contact_email', 'User Email', 'sasabudi_contact_email_callback', 'sasabudi-contact', 'side', 'high', null );
}

function sasabudi_contact_email_callback( $post ) {
  wp_nonce_field( 'sasabudi_save_contact_email_data', 'sasabudi_contact_email_meta_box_nonce' );
  $value = get_post_meta( $post->ID, '_contact_email_value_key', true );
  echo '<label for="sasabudi_contact_email_field">User Email Address: </label>';
  echo '<input type="email" id="sasabudi_contact_email_field" name="sasabudi_contact_email_field" value="' . esc_attr( $value ). '" size="25" />';
}

function sasabudi_save_contact_email_data( $post_id ) {
  if( ! isset( $_POST['sasabudi_contact_email_meta_box_nonce'] ) ) {
    return;
  }
  if( ! wp_verify_nonce( $_POST['sasabudi_contact_email_meta_box_nonce'], 'sasabudi_save_contact_email_data' ) ) {
    return;
  }
  if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
    return;
  }
  if( ! current_user_can('edit_post', $post_edit) ) {
    return;
  }
  if( ! isset( $_POST['sasabudi_contact_email_field'] ) ) {
    return;
  }
  $my_data = sanitize_text_field($_POST['sasabudi_contact_email_field']);
  update_post_meta($post_id, '_contact_email_value_key', $my_data);
}