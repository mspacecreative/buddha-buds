<?php

function custom_woocommerce_prod_title() {
   $newarrival = get_field('new_arrival');
   if ( $newarrival ) {
   echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '<br /><span class="new-arrival"> New Arrival</span></h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
   } else {
   	echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
   }
}
remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
add_action('woocommerce_shop_loop_item_title','custom_woocommerce_prod_title',10);