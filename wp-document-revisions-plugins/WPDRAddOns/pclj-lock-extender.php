<?php
/*
Plugin Name: PCLJ Lock Extender
Plugin URI: 
Description: Extends the default 2 minutes file lock buffer (how long a file is checked out if nothing is heard) to 5 minutes
Version: 0.1
Author: Benjamin J. Balter Edited by Michael R. Lewis (mrl)
Author URI: http://ben.balter.com
License: GPL2
*/

function pclj_extend_file_lock( $original ) {

	$wpdr = Document_Revisions::$instance;
	
	if ( !$wpdr->verify_post_type() )
		return $original;
		
	// 5 min * 60 seconds = 300 seconds
	if($options = get_option('WPDR_AddOns_Config', false))
		if( $options['opt']['lock_extender_time'] && is_numeric( $options['opt']['lock_extender_time'] ) )
			return ($options['opt']['lock_extender_time'] * 60);

	return $original;
}
	
add_filter( 'wp_check_post_lock_window', 'pclj_extend_file_lock' );