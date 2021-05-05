<?php
/**
 * Get the bootstrap! CMB2
 * 
 * @package imicra
 */
if ( file_exists( __DIR__ . '/cmb2/init.php' ) ) {
  require_once __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once __DIR__ . '/CMB2/init.php';
}

/**
 * Frontpage.
 */
require_once dirname( __FILE__ ) . '/metaboxes/cmb2-frontpage.php';
