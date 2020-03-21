<?php

// Hides Woocommerce menu icon when no items are added to the cart
if ( ! function_exists( 'et_show_cart_total' ) ) {
function et_show_cart_total( $args = array() ) {
if ( ! class_exists( 'woocommerce' ) ) {
return;
}

$defaults = array(
'no_text' => false,
);

$args = wp_parse_args( $args, $defaults );

$items_number = WC()->cart->get_cart_contents_count();

if($items_number):
printf(
'<a href="%1$s" class="et-cart-info">
<span>%2$s</span>
</a>',
esc_url( WC()->cart->get_cart_url() ),
( ! $args['no_text']
? esc_html( sprintf(
_nx( '1 Item', '%1$s Items', $items_number, 'WooCommerce items number', 'Divi' ),
number_format_i18n( $items_number )
) )
: ''
)
);
endif;	
}
}