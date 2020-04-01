<?php

// CUSTOMIZE PRICING PER PRODUCTS
function sv_change_product_html( $price_html, $product ) {
	$price = $product->get_price();
	if ( 252 === $product->id ) {
		$price_html = '<span class="amount">$100/ounce</span>';	
	} elseif ( 381 === $product->id ) {
		$price_html = '<span class="amount">$100/ounce</span>';	
	} elseif ( 261 === $product->id ) {
		$price_html = '<span class="amount">$8/joint</span>';
	} elseif ( 374 === $product->id ) {
		$price_html = '<span class="amount">$100/ounce</span>';	
	} elseif ( 386 === $product->id ) {
		$price_html = '<span class="amount">$' . $price . '/6 gummies</span>';	
	} elseif ( 445 === $product->id ) {
		$price_html = '<span class="amount">$' . $price . '/bottle</span>';	
	}
	
	return $price_html;
}
add_filter( 'woocommerce_get_price_html', 'sv_change_product_html', 10, 2 );

/*function sv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
	if ( 252 === $cart_item['product_id'] ) {
		$price = '$100.00 / ounce';
	} elseif ( 381 === $cart_item['product_id'] ) {
		$price = '$100.00 / ounce';
	} elseif ( 374 === $cart_item['product_id'] ) {
		$price = '$100.00 / ounce';
	} elseif ( 261 === $cart_item['product_id'] ) {
		$price = '$8.00 / joint';
	} elseif ( 386 === $cart_item['product_id'] ) {
		$price = '$10.00 / 6 gummies';
	}
	return $price;
}	
add_filter( 'woocommerce_cart_item_price', 'sv_change_product_price_cart', 10, 3 );

/* ONLY SHOW PER GRAM PRICE 
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

add_filter( 'woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2 );

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {
$price = '';

if ( !$product->min_variation_price || $product->min_variation_price !== $product->max_variation_price ) $price .= '<span class="from">' . _x('From', 'min_price', 'woocommerce') . ' </span>';
$price .= woocommerce_price($product->get_price());
if ( $product->max_variation_price && $product->max_variation_price !== $product->min_variation_price ) {
$price .= '<span class="to"> ' . _x('to', 'max_price', 'woocommerce') . ' </span>';

$price .= woocommerce_price($product->max_variation_price);
}

return $price;
}*/

add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format_min', 9999, 2 );

function bbloomer_variation_price_format_min( $price, $product ) {
   $prices = $product->get_variation_prices('min', true );
   $maxprices = $product->get_variation_price( 'max', true ) ;
   $min_price = current( $prices['price'] );
   //$max_price = current( $maxprices['price'] );
   $minPrice = sprintf( __( 'from %1$s', 'woocommerce' ), wc_price( $min_price ) ) . '/gram<br>';
   $maxPrice = sprintf( __( 'to %1$s', 'woocommerce' ), wc_price( $maxprices ) ) . '/ounce';
   return $minPrice .' ' .$maxPrice ;
}