<?php
/*
Plugin Name: WP Document Revisions - Rename Documents Label
Plugin URI: https://github.com/benbalter/WP-Document-Revisions-Code-Cookbook
Description: Example code to change the "Documents" labels used throughout the plugin to something else such as "articles" or "reports"
Version: 0.1
Author: Benjamin J. Balter
Author URI: http://ben.balter.com
License: GPL2
*/
	
/** 
 * Changes all references to "Documents" in the interface to "Articles"
 * @params array $args the default args for the custom post type
 * @returns array $args the CPT args with our modified labels
 */
function bb_filter_document_cpt( $args ) {
	$options = get_option('WPDR_AddOns_Config', false);
	$sn = isset($options['opt']['rename_documents_label']) ? ucfirst( strtolower($options['opt']['rename_documents_label'])) : 'Document';
	$pl = isset($options['opt']['rename_documents_label_plural']) ? ucfirst(strtolower($options['opt']['rename_documents_label_plural'])) : 'Documents';
	
	
	$args['labels'] = array(
		'name' => _x( $pl, 'post type general name', 'wp_document_revisions' ),
		'singular_name' => _x( $sn, 'post type singular name', 'wp_document_revisions' ),
		'add_new' => _x( 'Add '.$sn, 'article', 'wp_document_revisions' ),
		'add_new_item' => __( 'Add New '.$sn, 'wp_document_revisions' ),
		'edit_item' => __( 'Edit '.$sn, 'wp_document_revisions' ),
		'new_item' => __( 'New '.$sn, 'wp_document_revisions' ),
		'view_item' => __( 'View '.$sn, 'wp_document_revisions' ),
		'search_items' => __( 'Search '.$pl, 'wp_document_revisions' ),
		'not_found' =>__( 'No '.strtolower($pl).' found', 'wp_document_revisions' ),
		'not_found_in_trash' => __( 'No '.strtolower($pl).' found in Trash', 'wp_document_revisions' ), 
		'parent_item_colon' => '',
		'menu_name' => __( $pl, 'wp_document_revisions' ),
		);
	
	return $args;
	
}

add_filter( 'document_revisions_cpt', 'bb_filter_document_cpt' );