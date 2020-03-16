<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; _e(' / gram'); ?></span>
<?php endif;

function sv_change_product_html( $price_html, $product ) {
	if ( 252 === $product->id ) {
		$price_html = '<span class="amount">$15.00 per kg</span>';	
	}
	
	return $price_html;
}
add_filter( 'woocommerce_get_price_html', 'sv_change_product_html', 10, 2 );


function sv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
	if ( 252 === $cart_item['product_id'] ) {
		$price = '$15.00 per kg<br>(7-8 skewers per kg)';
	}
	return $price;
}	
add_filter( 'woocommerce_cart_item_price', 'sv_change_product_price_cart', 10, 3 );