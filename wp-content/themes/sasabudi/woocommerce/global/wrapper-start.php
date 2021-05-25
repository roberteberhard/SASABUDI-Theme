<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

$template = wc_get_theme_slug_for_templates();

switch ( $template ) {
  case 'binspired' :
    echo '<main class="main">';
    break;
  case 'sasabudi' :
    echo '<main class="main is-statement">';
    break;
  case 'littlerocker' :
    echo '<main class="main">';
    break;
  case 'robhisattwa' :
    echo '<main class="main">';
    break;
  case 'pokertees' :
    echo '<main class="main">';
    break;
  case 'nunopi' :
    echo '<main class="main">';
    break;
  case 'robyhard' :
    echo '<main class="main">';
    break;
  case 'feelbrazeel' :
    echo '<main class="main">';
    break;
  default :
  echo '<main class="main">';
    break;
}
