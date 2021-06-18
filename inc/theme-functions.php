<?php
/**
 * Theme functions
 *
 * @package imicra
 */

/**
 * var_dump prettify
 */
function imicra_var_dump( $arg, $format = true ) {
  if ( $format ) {
    echo '<pre>';
    var_dump( $arg );
    echo '</pre>';
  } else {
    var_dump( $arg );
  }
}

/**
 * Change Sender Name and Email Address
 */
// Function to change email address
function imicra_sender_email( $original_email_address ) {
	return 'noreply@' . $_SERVER['SERVER_NAME'];
}
add_filter( 'wp_mail_from', 'imicra_sender_email' );

// Function to change sender name
function imicra_sender_name( $original_email_from ) {
	return get_bloginfo( 'name' );
}
// add_filter( 'wp_mail_from_name', 'imicra_sender_name' );

/*
 * Convert user-inputted phone number to consistently formatted HTML link.
 * Source https://gist.github.com/RadGH/7580023f71e8d4fbf356
 * 
 * +7 (901) 200–36–06
 * //+7–912–171–29–27
 * 
format_phone( $input, $html = true )
  Converts any phone number to a 10-digit phone number.
  
    - If $html is true (default), the returned value will be an HTML-formatted phone number, including "tel:+" in the link.
    - If a pattern match is not found, the original string will be returned without HTML formatting.
    
  Example:
    <?php var_dump(format_phone("My phone number is: 1 (5411) 23-45-67 ext. 3999. Thank you.")); ?>
    
  Output - With HTML [default] (white space added manually)
      <a href="tel:+15552931039">1 (5411) 23-45-67</a>
    
  Output - No HTML
      tel:+15552931039
*/
function imicra_format_phone( $string, $html = true ) {
	// Pattern to collect digits from a phone number, and optional extension
	// Extensions can be identified using: + - x ex ex. ext ext. extension extension.
  // Now (should) function with country codes!
	$pattern = '/\+?([0-9]{0,3})?[^0-9]*([0-9]{0,3})[^0-9]*([0-9]{0,3})[^0-9]*([0-9]{0,3})[^0-9]*([0-9]{0,3})?[^0-9]*$/i';
  
  if ( preg_match($pattern, $string, $matches) ) {
	  // Input: "7 (901) 232-45-67"
	  // 1 => 7
	  // 2 => 901
	  // 3 => 232
	  // 4 => 45
		// 5 => 67
	  $result = array();

	  $countrycode = ( '8' == $matches[1] ) ? 7 : $matches[1];
	  // Output (HTML):
	  // <a href="tel+15411234567">1 (5411) 23-45-67</a>
	  // Output (Raw):
	  // tel:+15552931039
    if ( $html ) { $result[] = sprintf('<a href="tel:+%s%s%s%s%s">', $countrycode, $matches[2], $matches[3], $matches[4], $matches[5]); }
    if ( $html ) { $result[] = sprintf('+%s (%s) %s-%s-%s', $countrycode, $matches[2], $matches[3], $matches[4], $matches[5]); }
    if ( $html ) { $result[] = sprintf('</a>'); }
    if ( ! $html ) { $result[] = sprintf('tel:+%s%s%s%s%s', $countrycode, $matches[2], $matches[3], $matches[4], $matches[5]); }

	  return implode($result);
  }
  
  // Pattern not found
  return esc_html($string); // The phone number isn't valid, but that's ok. Keep the original.
}

/**
 * Add bootstrap class in Nav Menu item.
 */
function imicra_menu_item_css_classes( $classes, $item, $args, $depth ) {
	if( $args->theme_location === 'header-main' ) {
		$classes[] = 'nav-item';
  }
  
  if ( in_array( 'current-menu-item', $classes ) && $args->theme_location === 'header-main' ) {
    $classes[] = 'active';
  }

	return $classes;
}
// add_filter( 'nav_menu_css_class', 'imicra_menu_item_css_classes', 10, 4 );

/**
 * Disable Editor for specific page templates
 * @link https://wordpress.stackexchange.com/questions/256071/disable-wp-editor-for-specific-page-templates
 */
function remove_editor() {
  if ( isset( $_GET['post'] ) ) {
      $id = $_GET['post'];
      $template = get_post_meta( $id, '_wp_page_template', true );

      switch ( $template ) {
          case 'templates/front-page.php':
          // case 'templates/template-contacts.php':
            remove_post_type_support( 'page', 'editor' );
          break;

          default :
          // Don't remove any other template.
          break;
      }
  }
}
add_action( 'init', 'remove_editor' );

/*
 * FontAwesome Shortcode.
 */
function icon_fa( $atts ) {
	return '<i class="fa fa-' . $atts[0] . '"></i>';
}
add_shortcode( 'fa', 'icon_fa' );
