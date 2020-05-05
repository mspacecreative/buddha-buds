<?php 

add_filter( 'woocommerce_shortcode_products_query', function( $query_args, $atts, $loop_name ){
    if( $loop_name == 'recent_products' ){
        $query_args['meta_query'] = array( array(
            'key'     => '_stock_status',
            'value'   => 'outofstock',
            'compare' => 'NOT LIKE',
        ) );
    }
    return $query_args;
}, 10, 3);