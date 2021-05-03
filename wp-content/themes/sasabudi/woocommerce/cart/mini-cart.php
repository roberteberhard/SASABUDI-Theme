<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */


defined( 'ABSPATH' ) || exit;

/**
 * Action Hook :: before_mini_cart
 */
do_action( 'woocommerce_before_mini_cart' );

echo '<ul class="woccommerece-mini-cart mini-cart ' . esc_attr( $args['list_class'] ) . '">';

  /* Title */
  echo '<li class="mini-cart__header">';
    echo esc_html__( 'My Shopping Cart', 'sasabudi' );
    echo '<a href="#" class="mini-cart__header--button">Close</a>';
  echo '</li>';

  if ( ! WC()->cart->is_empty() ) :

    /**
     * Action Hook :: before_mini_cart_contents
     * Action Hook :: sasabudi_product_cart_shipping_max
     */
    do_action( 'woocommerce_before_mini_cart_contents' );

    // settings
    $product_sales = get_field('shop_product_sales', 'option');
    $show_sales = ($product_sales == '1') ? true : false;

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

      // settings
      $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

      if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
        
        // product settings
        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
        $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key );
        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
        
        /* Minicart Items */
        echo '<li class="woocommerce-mini-cart-item mini-cart__item' . esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', '', $cart_item, $cart_item_key ) ) . '">';
          echo apply_filters( 'woocommerce_cart_item_remove_link',
            sprintf(
              '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
              esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
              __( 'Remove this item', 'sasabudi' ),
              esc_attr( $product_id ),
              esc_attr( $cart_item_key ),
              esc_attr( $_product->get_sku() )
            ),
            $cart_item_key 
          );

          /* Left Item */
          echo '<div class="mini-cart__item--left">';

            // Image & dont use -> p_kses_post( $product_name );
            if ( !empty( $product_permalink ) ) :
              echo $thumbnail;
            else :
              echo '<a href="' . esc_url( $product_permalink ) . '">' . $thumbnail . '</a>';
            endif;

            // Sale
           if ( $show_sales AND $_product->is_on_sale() ) {
            echo '<a href="' . esc_url( $product_permalink ) . '">';
              echo '<div class="sale">' . esc_html__( 'Sale', 'sasabudi' ) . '</div>';
            echo '</a>';
           }
           
          echo '</div>';

          /* Right Item */
          echo '<div class="mini-cart__item--right">';
            if ( empty( $product_permalink ) ) :
              // echo $product_name;
              echo wp_kses_post( $product_name ); 
            else :
              echo '<a href="' . esc_url( $product_permalink ) . '">' . $product_name . '</a>';
            endif;
            echo wc_get_formatted_cart_item_data( $cart_item );
            echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key );
          echo '</div>';
        echo '</li>';
      }
    }

    /**
     * Action Hook :: mini_cart_contents
     * Action Hook :: sasabudi_product_cart_cross_sell
     */
    do_action( 'woocommerce_mini_cart_contents' );

  else :

    /* Empty Cart */
    echo '<li class="mini-cart__empty">';
      echo '<p class="mini-cart__empty--title">' . __( 'Hmm, it feels a little empty in here..', 'sasabudi' ) . '<br>👀</p>';
      echo '<p class="mini-cart__empty--desc">' . __( 'There are no orders in your cart yet. Click below to choose one!', 'sasabudi' ) . '</p>'; 
    echo '</li>';
    echo '<li class="mini-cart__shopping">';
      echo '<a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" class="button btn-products">' . __( 'Choose a Product', 'sasabudi' ) . '</a>';
    echo '</li>';

  endif;

echo '</ul>';

/**
 * Show Mini Cart Subtotal and Buttons
 */
if ( ! WC()->cart->is_empty() ) :

  // Total
  echo '<div class="mini-total">';
    echo '<span class="mini-total__subtotal">' . esc_html__( 'Subtotal:', 'sasabudi' ) . '</span>' . WC()->cart->get_cart_subtotal();
  echo '</div>';

  /**
   * Action Hook :: shopping_cart_before_buttons
   */
  do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
  
  /** Button Cart & Button Checkout **/
  echo '<div class="mini-buttons">';
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button btn-checkout">' . __( 'Proceed To Checkout', 'sasabudi' ) . '</a>';
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button btn-cart">' . __( 'View Cart', 'sasabudi' ) . '</a>';
  echo '</div>';

  /**
   * Action Hook :: shopping_cart_after_buttons (not working so far)
   */
  do_action( 'woocommerce_widget_shopping_cart_after_buttons' );

endif;

/**
 * Action Hook :: after_mini_cart
 */
do_action( 'woocommerce_after_mini_cart' );
