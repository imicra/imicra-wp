<?php
/**
 * Include repeater files
 *
 * @package imicra
 */

// Require customizer functions and dependencies
require get_template_directory() . '/inc/customizer-repeater/inc/customizer.php';

/**
 * Check if Repeater is empty
 *
 * @param string $imicra_arr Repeater json array.
 *
 * @return bool
 */
function imicra_general_repeater_is_empty( $imicra_arr ) {
	if ( empty( $imicra_arr ) ) {
		return true;
	}
	$imicra_arr_decoded = json_decode( $imicra_arr, true );
	$not_check_keys = array( 'choice', 'id' );
	foreach ( $imicra_arr_decoded as $item ) {
		foreach ( $item as $key => $value ) {
			if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon') ) {
				return false;
			}
			if ( ! in_array( $key, $not_check_keys ) ) {
				if ( ! empty( $value ) ) {
					return false;
				}
			}
		}
	}
	return true;
}
