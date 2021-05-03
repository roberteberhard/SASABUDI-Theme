<?php
/**
 * WP Walker
 *
 * @package sasabudi
 */

class Walker_Nav_Primary extends Walker_Nav_Menu
{
  public $megaMenuID;
  public $count;

  public function __construct()
  {
    $this->megaMenuID = 0;
    $this->count = 0;
  }

  public function start_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\" >\n";

    if($this->megaMenuID != 0) {
      $output .= "<li class=\"megamenu-column\"><ul>\n";
    }
  }

  public function end_lvl(&$output, $depth = 0, $args = array())
  {
    if($this->megaMenuID != 0) {
      $output .= "</ul>";
      if($this->count == "3") {
        $output .= "<div class=\"glide__bullets\" data-glide-el=\"controls[nav]\">";
        $output .= "<button class=\"glide__bullet\" data-glide-dir=\"=0\"></button>";
        $output .= "<button class=\"glide__bullet\" data-glide-dir=\"=1\"></button>";
        $output .= "<button class=\"glide__bullet\" data-glide-dir=\"=2\"></button>";
        $output .= "</div>";
      }
      $output .= "</li>";
    }
    $output .= "</ul>";
  }

  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes        = '';
    $class_names          = $value = '';
    $classes              = empty($item->classes) ? array() : (array) $item->classes;
    $has_featured_product = array_search('featured-product', $classes);
    $item_output          = '';

    // manage megamenu
    if($this->megaMenuID != 0 && $this->megaMenuID === intval($item->menu_item_parent)) {
     
      // classes rguments
      $column_divider = array_search('column-divider', $classes);
      $featured_divider = array_search('featured-divider', $classes);
      $comingsoon_divider = array_search('comingsoon-divider', $classes);

      // excecute column divider
      if ($column_divider !== false) {
        $output .= "</ul></li><li class=\"megamenu-column\"><ul>\n";
      }

      // excecute featured  divider
      if ($featured_divider !== false) {
        $output .= "</ul></li>\n";
        $output .= "<li class=\"megamenu-column\">\n";
        $output .= "<h3 class=\"megamenu__title\">" . __("On Our Radar", "sasabudi") . "</h3>\n";
        $output .= "<div class=\"glide\" id=\"glide_megamenu\"><div class=\"glide__track\" data-glide-el=\"track\">\n";
        $output .= "<ul class=\"glide__slides\">\n";
      }

      // excecute featured  divider
      if ($comingsoon_divider !== false) {
        // adapt for coming soon feature...
      }

    } else {
      $this->megaMenuID = 0;
    }

    // managing divider: add divider class to an element to get a divider before it.
    $divider_class_position = array_search('divider', $classes);
    if ($divider_class_position !== false) {
      $output .= "<li class=\"divider\"></li>\n";
      unset($classes[$divider_class_position]);
    }

    // manage megamenu class
    if (array_search('megamenu', $classes) !== false) {
      $this->megaMenuID = $item->ID;
    }

    $classes[] = ($args->has_children) ? 'dropdown' : '';
    $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
    $classes[] = 'menu-item-'.$item->ID;
    if ($depth && $args->has_children) {
      $classes[] = 'dropdown-submenu';
    }

    $class_glide = $has_featured_product ? ' glide__slide' : ''; // add glide class
    $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="'.esc_attr($class_names).$class_glide.'"';
    

    $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
    $id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

    $output .= $indent.'<li'.$id.$value.$class_names.$li_attributes.'>';
  
    $attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
    $attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
    $attributes .= !empty($item->url) ? ' href="'.esc_attr($item->url).'"' : '';
    $attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

    $item_output .= $args->before;
    $item_output .= '<a'.$attributes.'>';

    // add thumbnail image
    if ($has_featured_product !== false) {
      $productID = $item->object_id;
      $item_output .= "<img alt=\"" . esc_attr($item->title) . "\" src=\"" . get_the_post_thumbnail_url( $productID, 'medium' ) . "\"/>";
      $item_output .= "<h4>" . esc_attr($item->title) . "</h4>";
    } else {
      // add title
      $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
    }

    // add support for menu item title
    if (strlen($item->attr_title) > 2) {
      $item_output .= '</a> <h3 class="menu-item__title">'.$item->attr_title.'</h3>';
    }

    // add support for menu item descriptions
    if (strlen($item->description) > 2) {
      // $item_output .= '</a> <span class="sub">'.$item->description.'</span>';
    }

    $item_output .= (($depth == 0 || 1) && $args->has_children) ? '</a>' : '</a>'; // no caret !!
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

    // update count
    if ($has_featured_product !== false) {
      $this->count++;
    }
  }

  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if (!$element) {
      return;
    }

    $id_field = $this->db_fields['id'];

    //display this element
    if (is_array($args[0])) {
      $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
    } elseif (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }

    $cb_args = array_merge(array(&$output, $element, $depth), $args);
    call_user_func_array(array($this, 'start_el'), $cb_args);

    $id = $element->$id_field;

    // descend only when the depth is right and there are childrens for this element
    if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
      
      foreach ($children_elements[ $id ] as $child) {
        if (!isset($newlevel)) {
          $newlevel = true;
          //start the child delimiter
          $cb_args = array_merge(array(&$output, $depth), $args);
          call_user_func_array(array($this, 'start_lvl'), $cb_args);
        }
        $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
      }
      unset($children_elements[ $id ]);
    }

    if (isset($newlevel) && $newlevel) {
      //end the child delimiter
      $cb_args = array_merge(array(&$output, $depth), $args);
      call_user_func_array(array($this, 'end_lvl'), $cb_args);
    }

    //end this element
    $cb_args = array_merge(array(&$output, $element, $depth), $args);
    call_user_func_array(array($this, 'end_el'), $cb_args);
  }
}

?>