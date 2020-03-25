<?php
add_filter( 'woocommerce_get_catalog_ordering_args', 'misha_custom_product_sorting' );
 
function misha_custom_product_sorting( $args ) {
 
	// Sort alphabetically
	if ( isset( $_GET['orderby'] ) && 'title' === $_GET['orderby'] ) {
		$args['orderby'] = 'title';
		$args['order'] = 'asc';
	}
 
	// Show products in stock first
	if( isset( $_GET['orderby'] ) && 'in-stock' === $_GET['orderby'] ) {
		$args['meta_key'] = '_stock_status';
		$args['orderby'] = array( 'meta_value' => 'ASC' );
	}
 
	return $args;
 
}