<?php

/* REGISTER CHILD THEME STYLES */
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/* REMOVE PROJECTS CPT */
function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}
add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );

/* CUSTOM STYLES MAIN.CSS */
function customStyles()
{
    wp_register_style('maincss', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('maincss');
}
add_action('wp_enqueue_scripts', 'customStyles');

/* CUSTOM STYLES MAIN.CSS */
function customScripts()
{
    wp_register_script('mainjs', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
    wp_enqueue_script('mainjs');
}
add_action('wp_enqueue_scripts', 'customScripts');

add_filter( 'woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2 );

//include 'functions/functions_minimum-order.php';
include 'functions/functions_custom-pricing.php';
include 'functions/functions_new-customer-email-to-admin.php';
include 'functions/functions_redirect-customer-after-registration.php';
include 'functions/functions_hide-cart.php';
include 'functions/functions_remove-skus.php';
include 'functions/functions_out-of-stock.php';
include 'functions/functions_product-sorting.php';
//include 'functions/functions_approve-new-user.php';