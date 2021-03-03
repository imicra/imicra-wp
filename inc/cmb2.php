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

function cmb2_imicra_metaboxes() {
    
  // Start with an underscore to hide fields from custom fields list
  $prefix = '_imicra_';

  /**
	 * Initiate the metabox for Frontpage
	 */
  $cmb = new_cmb2_box( array(
    'id'            => $prefix . 'cmb',
    'title'         => __( 'Блок Видео', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'page-template', 'value' => 'templates/front-page.php' ),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'closed'     => true, // Keep the metabox closed by default
  ) );

  $cmb->add_field( array(
    'name' => __( 'Показать блок', 'cmb2' ),
    'id'   => $prefix . 'cmb_check',
    'type' => 'checkbox',
  ) );

}
add_action( 'cmb2_admin_init', 'cmb2_imicra_metaboxes' );