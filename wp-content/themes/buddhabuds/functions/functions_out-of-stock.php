<?php
// display an 'Out of Stock' label on archive pages
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10 );
function woocommerce_template_loop_stock() {
    global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() )
        echo '<p class="stock out-of-stock">Sold Out</p>';
}

add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Sold Out', 'woocommerce');
    }
    return $availability;
}

function cw_change_product_html( $price_html, $product ) {
 if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
 	$price_html = '<p class="stock out-of-stock">Sold Out</p>';
 }
 return $price_html;
}
add_filter( 'woocommerce_get_price_html', 'cw_change_product_html', 10, 2 );