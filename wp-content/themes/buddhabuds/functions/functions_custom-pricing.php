<?php

// CUSTOMIZE PRICING PER PRODUCTS
function sv_change_product_html( $price_html, $product ) {
	$price = $product->get_price();
	if ( 252 === $product->id ) {
		$price_html = '<span class="amount">$100 / ounce</span>';	
	} elseif ( 261 === $product->id ) {
		$price_html = '<span class="amount">$8 / joint</span>';
	} else {
		$price_html = '<span class="amount">$' . $price . ' / gram</span>';
	}
	
	return $price_html;
}
add_filter( 'woocommerce_get_price_html', 'sv_change_product_html', 10, 2 );

function sv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
	if ( 252 === $cart_item['product_id'] ) {
		$price = '$100.00 / ounce';
	} elseif ( 261 === $cart_item['product_id'] ) {
		$price = '$8.00 / joint';
	}
	return $price;
}	
add_filter( 'woocommerce_cart_item_price', 'sv_change_product_price_cart', 10, 3 );

/* ONLY SHOW PER GRAM PRICE */
function wpglorify_variation_price_format( $price, $product ) {
 
// Main Price
$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
$price = $prices[0] !== $prices[1] ? sprintf( __( 'From %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
// Sale Price
$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
sort( $prices );
$saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
if ( $price !== $saleprice ) {
$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
}
return $price;
}