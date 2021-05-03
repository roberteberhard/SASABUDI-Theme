<?php
/**
 * The template functions used for displaying the 'hooks' definitions.
 *
 * @package WordPress
 * @subpackage SASABUDI
 * @since 1.0.0
 */

/**
 * HEADER :: DEVICE MODES
 * @see sasabudi_header_device_toggle()
 * @see sasabudi_header_device_logo()
 * @see sasabudi_header_device_search()
 * @see sasabudi_header_device_wishlist()
 * @see sasabudi_header_device_cart()
 */
add_action( 'sasabudi_header_device_navigation', 'sasabudi_header_device_toggle', 10 );
add_action( 'sasabudi_header_device_navigation', 'sasabudi_header_device_logo', 20 );
add_action( 'sasabudi_header_device_navigation', 'sasabudi_header_device_search', 30 );
add_action( 'sasabudi_header_device_navigation', 'sasabudi_header_device_wishlist', 40 );
add_action( 'sasabudi_header_device_navigation', 'sasabudi_header_device_cart', 50 );

/**
 * HEADER :: DEVICE prompt
 * @see sasabudi_header_device_note
 * @see sasabudi_header_device_promotion()
 */
add_action( 'sasabudi_header_device_note', 'sasabudi_header_device_note', 10 );
add_action( 'sasabudi_header_device_note', 'sasabudi_header_device_promotion', 20 );

/**
 * HEADER :: CHECKOUT :: DEVICE prompt
 * @see sasabudi_header_device_note
 */
 add_action( 'sasabudi_checkout_header_device_note', 'sasabudi_header_device_note', 10 );

/**
 * HEADER :: DESKTOP MODES
 * @see sasabudi_header_desktop_note()
 * @see sasabudi_header_desktop_logo()
 * @see sasabudi_header_desktop_menu()
 * @see sasabudi_header_desktop_search()
 * @see sasabudi_header_desktop_support()
 * @see sasabudi_header_desktop_wishlist()
 * @see sasabudi_header_desktop_account()
 * @see sasabudi_header_desktop_cart()
 */
add_action( 'sasabudi_header_desktop_note', 'sasabudi_header_desktop_note', 10 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_logo', 10 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_menu', 20 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_search', 30 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_support', 40 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_wishlist', 50 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_account', 60 );
add_action( 'sasabudi_header_desktop_navigation', 'sasabudi_header_desktop_cart', 70 );

/**
 * HEADER :: CHECKOUT :: DESKTOP MODES
 * @see sasabudi_header_desktop_note()
 * @see sasabudi_header_desktop_logo()
 * @see sasabudi_header_desktop_search()
 * @see sasabudi_header_desktop_support()
 * @see sasabudi_header_desktop_wishlist()
 * @see sasabudi_header_desktop_account()
 * @see sasabudi_header_desktop_cart()
 */
 add_action( 'sasabudi_header_desktop_note', 'sasabudi_header_desktop_note', 10 );
 add_action( 'sasabudi_checkout_header_desktop_navigation', 'sasabudi_header_desktop_logo', 10 );
 add_action( 'sasabudi_checkout_header_desktop_navigation', 'sasabudi_header_desktop_search', 20 );
 add_action( 'sasabudi_checkout_header_desktop_navigation', 'sasabudi_header_desktop_support', 30 );
 add_action( 'sasabudi_checkout_header_desktop_navigation', 'sasabudi_header_desktop_wishlist', 40 );
 add_action( 'sasabudi_checkout_header_desktop_navigation', 'sasabudi_header_desktop_account', 50 );
 add_action( 'sasabudi_checkout_header_desktop_navigation', 'sasabudi_header_desktop_cart', 60 );

/**
 * HOMEPAGE :: SECTION MODES
 * @see sasabudi_home_products_banner()
 * @see sasabudi_home_products_statement()
 * @see sasabudi_home_products_categories()
 * @see sasabudi_home_products_collection()
 * @see sasabudi_home_products_trending()
 * @see sasabudi_home_artist_blog()
 * @see sasabudi_home_instagram_feed()
 */
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_products_banner', 10 );
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_products_statement', 20 );
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_products_categories', 30 );
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_products_collection', 40 );
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_products_trending', 50 );
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_artist_blog', 60 );
add_action( 'sasabudi_render_homepage_sections', 'sasabudi_home_instagram_feed', 70 );


/**
 * HOMEPAGE :: SECTION MODES (custom categories style)
 * @see sasabudi_home_products_banner()
 * @see sasabudi_home_products_statement()
 * @see sasabudi_home_products_custom_categories()
 * @see sasabudi_home_products_collection()
 * @see sasabudi_home_products_trending()
 * @see sasabudi_home_artist_blog()
 * @see sasabudi_home_instagram_feed()
 */
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_products_banner', 10 );
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_products_statement', 20 );
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_products_custom_categories', 30 );
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_products_collection', 40 );
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_products_trending', 50 );
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_artist_blog', 60 );
add_action( 'sasabudi_render_homepage_sections_custom_categories', 'sasabudi_home_instagram_feed', 70 );





/**
 * ABOUT PAGE MODES
 * @see sasabudi_products_catalog_featuring()
 * @see sasabudi_home_products_statement()
 */
add_action( 'sasabudi_render_about_page', 'sasabudi_products_catalog_featuring', 10 );
add_action( 'sasabudi_render_about_page', 'sasabudi_home_products_statement', 20 );

/**
 * HELP PAGE MODES
 * @see sasabudi_home_products_statement()
 */
add_action( 'sasabudi_render_help_page', 'sasabudi_product_single_recently_viewed', 10 );
add_action( 'sasabudi_render_help_page', 'sasabudi_home_products_statement', 20 );

/**
 * POLICY PAGE MODES
 * @see sasabudi_home_products_statement()
 */
add_action( 'sasabudi_render_policy_page', 'sasabudi_home_products_statement', 10 );

/**
 * ACCOUNT PAGE MODES
 * @see sasabudi_home_products_statement()
 */
 add_action( 'sasabudi_render_account_page', 'sasabudi_home_products_statement', 10 );

/**
 * CART PAGE MODES
 * @see sasabudi_cart_continue_shopping()         [cart totals]
 * @see sasabudi_products_catalog_best_sellers()  [cart page]
 */
add_action( 'sasabudi_render_continue_shopping', 'sasabudi_cart_continue_shopping', 10 );
add_action( 'sasabudi_render_cart_page', 'sasabudi_home_products_statement', 10 );

/**
 * 404 PAGE MODES
 * @see sasabudi_products_catalog_best_sellers()
 */
add_action( 'sasabudi_render_page_not_found', 'sasabudi_products_catalog_best_sellers', 10 );

/**
 * BLOG PAGE MODES
 * @see sasabudi_products_catalog_best_sellers()
 */
add_action( 'sasabudi_render_posts_sections', 'sasabudi_blog_post_section', 10 );

/**
 * SITEMAP PAGE MODES
 * @see sasabudi_render_sitemap_page()
 */
add_action( 'sasabudi_render_sitemap_page', 'sasabudi_home_products_statement', 10 );

 


/**
 * ARCHIVE :: COLLECTIONS MODES
 * @see sasabudi_page_collection_archive()
 */
add_action( 'sasabudi_render_collections_archive', 'sasabudi_page_collections_archive', 10 );
add_action( 'sasabudi_render_collections_single', 'sasabudi_page_collection_single', 10 );

/**
 * ARCHIVE :: INSTAGRAM MODES
 * @see sasabudi_page_instagram_archive()
 */
add_action( 'sasabudi_render_instagram_archive', 'sasabudi_page_instagram_archive', 10 );

/**
 * FOOTER :: CONTENT MODES
 * @see sasabudi_footer_section_scrolltop()
 * @see sasabudi_footer_section_widgets()
 * @see sasabudi_footer_section_newsletter()
 */
add_action( 'sasabudi_footer_section_content', 'sasabudi_footer_section_scrolltop', 10 );
add_action( 'sasabudi_footer_section_content', 'sasabudi_footer_section_widgets', 20 );
add_action( 'sasabudi_footer_section_content', 'sasabudi_footer_section_newsletter', 30 );

/**
 * FOOTER :: MIDDLE MODES
 * @see sasabudi_footer_section_social()
 * @see sasabudi_footer_section_payment()
 */
add_action( 'sasabudi_footer_section_middle', 'sasabudi_footer_section_social', 10 );
add_action( 'sasabudi_footer_section_middle', 'sasabudi_footer_section_payment', 20 );

/**
 * FOOTER :: BOTTOM MODES
 * @see sasabudi_footer_section_disclaimer()
 */
add_action( 'sasabudi_footer_section_bottom', 'sasabudi_footer_section_disclaimer', 10 );

/**
 * FOOTER :: MODULES MODES
 * @see sasabudi_footer_app_search()
 * @see sasabudi_footer_app_notice()
 * @see sasabudi_footer_app_wishlist()
 * @see sasabudi_footer_app_storeselection()
 * @see sasabudi_footer_app_subscription()
 */
add_action( 'sasabudi_footer_section_modules', 'sasabudi_footer_app_search', 10 );
add_action( 'sasabudi_footer_section_modules', 'sasabudi_footer_app_notice', 20 );
add_action( 'sasabudi_footer_section_modules', 'sasabudi_footer_app_wishlist', 30 );
add_action( 'sasabudi_footer_section_modules', 'sasabudi_footer_app_storeselection', 40 );
add_action( 'sasabudi_footer_section_modules', 'sasabudi_footer_app_subscription', 50 );

/**
 * OFFSET :: MODES
 * @see sasabudi_offset_menu()
 * @see sasabudi_offset_filters()
 * @see sasabudi_offset_cart()
 */
add_action( 'sasabudi_offset_left', 'sasabudi_offset_menu', 10 );
add_action( 'sasabudi_offset_left', 'sasabudi_offset_filters', 20 );
add_action( 'sasabudi_offset_right', 'sasabudi_offset_cart', 10 );


/**
 * WOOCOMMERCE :: CONTENT PRODUCT MODES
 * 
 * [Remove Action]
 * woocommerce_show_product_loop_sale_flash()
 * woocommerce_template_loop_product_thumbnail()
 * woocommerce_template_loop_product_title()
 * woocommerce_template_loop_rating()
 * woocommerce_template_loop_price()
 * woocommerce_template_loop_add_to_cart()
 * 
 * [Add Action]
 * @see sasabudi_template_loop_product_thumbnail()
 * @see sasabudi_template_loop_product_save_item()
 * @see sasabudi_template_loop_product_new_item()
 * @see sasabudi_template_loop_product_sale_item()
 * @see sasabudi_template_loop_product_sizes()
 * @see sasabudi_template_loop_product_colors()
 * @see sasabudi_template_loop_product_title()
 * @see sasabudi_template_loop_product_price()
 * @see sasabudi_template_loop_product_admin_edit()
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'sasabudi_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'sasabudi_template_loop_product_save_item', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'sasabudi_template_loop_product_new_item', 30 );
add_action( 'woocommerce_before_shop_loop_item_title', 'sasabudi_template_loop_product_sale_item', 40 );
add_action( 'woocommerce_shop_loop_item_title', 'sasabudi_template_loop_product_sizes', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'sasabudi_template_loop_product_title', 20 );
add_action( 'woocommerce_shop_loop_item_title', 'sasabudi_template_loop_product_price', 30 );
add_action( 'woocommerce_shop_loop_item_title', 'sasabudi_template_loop_product_colors', 40 );
add_action( 'woocommerce_after_shop_loop_item', 'sasabudi_template_loop_product_edit', 10 );

/**
 * WOOCOMMERCE :: CONTENT ARCHIVE MODES
 * 
 * [Remove Action]
 * woocommerce_breadcrumb
 * woocommerce_result_count
 * woocommerce_catalog_ordering 
 * woocommerce_taxonomy_archive_description 
 * 
 * [Add Action]
 * @see sasabudi_catalog_result_breadcrumb()
 * @see sasabudi_catalog_archive_description()
 * @see sasabudi_catalog_archive_tags()
 * @see sasabudi_catalog_result_filter()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

add_action( 'sasabudi_archive_filter', 'sasabudi_catalog_header_filter', 10 );
add_action( 'sasabudi_archive_breadcrumb', 'sasabudi_catalog_result_breadcrumb', 10 );
add_action( 'sasabudi_offset_catalog_ordering', 'woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_archive_description', 'sasabudi_catalog_archive_description', 10 );
add_action( 'woocommerce_archive_description', 'sasabudi_catalog_archive_tags', 20 );
add_action( 'woocommerce_before_shop_loop', 'sasabudi_catalog_result_filter', 20 );


/**
 * WOOCOMMERCE :: Single Product MODES
 * 
 * [Remove Action]
 * woocommerce_show_product_sale_flash
 * woocommerce_show_product_images
 * woocommerce_template_single_title
 * woocommerce_template_single_rating
 * woocommerce_template_single_price
 * woocommerce_template_single_excerpt
 * woocommerce_template_single_add_to_cart
 * woocommerce_template_single_meta
 * woocommerce_template_single_sharing
 * woocommerce_upsell_display
 * 
 * [Add Action]
 * @see sasabudi_product_single_breadcrumb
 * @see sasabudi_product_single_prev_next
 * @see sasabudi_product_single_highlights
 * @see sasabudi_product_single_images
 * @see sasabudi_product_single_title
 * @see sasabudi_product_single_price
 * @see sasabudi_product_single_options
 * @see sasabudi_product_single_add_to_cart
 * @see sasabudi_product_single_sharing
 * @see sasabudi_product_single_meta
 * @see sasabudi_product_single_tabs
 * @see sasabudi_product_single_tagged_as
 * @see sasabudi_product_single_related_items
 * @see sasabudi_product_single_recently_viewed
 * @see sasabudi_products_statements
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_before_single_product_summary', 'sasabudi_product_single_breadcrumb', 10 );
add_action( 'woocommerce_before_single_product_summary', 'sasabudi_product_single_highlights', 20 );
add_action( 'woocommerce_before_single_product_summary', 'sasabudi_product_single_images', 30 );
add_action( 'woocommerce_single_product_summary', 'sasabudi_product_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'sasabudi_product_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'sasabudi_product_single_options', 20 );
add_action( 'woocommerce_single_product_summary', 'sasabudi_product_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'sasabudi_product_single_meta', 40 );
add_action( 'woocommerce_after_single_product_summary', 'sasabudi_product_single_tabs', 10 );
add_action( 'woocommerce_after_single_product_summary', 'sasabudi_product_single_tagged_as', 20 );
add_action( 'woocommerce_after_single_product_summary', 'sasabudi_product_single_related_items', 30 );
add_action( 'woocommerce_after_single_product_summary', 'sasabudi_product_single_recently_viewed', 40 );
add_action( 'woocommerce_after_single_product_summary', 'sasabudi_home_products_statement', 50 );


/**
 * WOOCOMMERCE :: MINICART MODES
 * 
 * [Add Action]
 * @see sasabudi_catalog_result_breadcrumb()
 * @see sasabudi_product_cart_cross_sell()
 */
add_action( 'woocommerce_before_mini_cart_contents', 'sasabudi_product_cart_shipping_max', 20 );
add_action( 'woocommerce_mini_cart_contents', 'sasabudi_product_cart_cross_sell', 20 );


/**
 * WOOCOMMERCE :: CHECKOUT MODES
 * 
 * [Remove Action]
 * woocommerce_checkout_login_form
 * woocommerce_checkout_coupon_form
 *
 * [Add Action]
 * @see woocommerce_checkout_coupon_form;
 */
 // remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_after_checkout_payment', 'woocommerce_checkout_coupon_form', 10 );


/**
 * WOOCOMMERCE :: ACCOUNT MODES
 * 
 * [Remove Action]
 * woocommerce_output_all_notices
 *
 */
remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );


/**
 * ATTENTION :: REMOVES
 */

/**
 * Sidebar.
 *
 * @see woocommerce_get_sidebar()
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );