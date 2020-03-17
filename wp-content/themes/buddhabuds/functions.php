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

/* REMOVE PUBLIC FACING SKUs */
function sv_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() ) {
        return false;
    }

    return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );

/* ONLY SHOW PER GRAM PRICE */
function wpglorify_variation_price_format( $price, $product ) {
 
// Main Price
$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
$price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
// Sale Price
$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
sort( $prices );
$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
if ( $price !== $saleprice ) {
$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
}
return $price;
}

add_filter( 'woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2 );

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

// APPROVE NEW USER
function ws_new_user_approve_autologout(){
       if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                $user_id = $current_user->ID;
  
                if ( get_user_meta($user_id, 'pw_user_status', true )  === 'approved' ){ $approved = true; }
        else{ $approved = false; }
  
  
        if ( $approved ){ 
            return $redirect_url;
        }
                else{ //when user not approved yet, log them out
                        wp_logout();
                        wp_clear_auth_cookie(); 
                        return add_query_arg( 'approved', 'false', get_permalink( get_option('woocommerce_myaccount_page_id') ) );
                }
        }
}
add_action('woocommerce_registration_redirect', 'ws_new_user_approve_autologout', 2);
  
function ws_new_user_approve_registration_message(){
        $not_approved_message = '<p class="registration">Send in your registration application today!<br /> NOTE: Your account will be held for moderation and you will be unable to login until it is approved.</p>';
  
        if( isset($_REQUEST['approved']) ){
                $approved = $_REQUEST['approved'];
                if ($approved == 'false')  echo '<p class="registration successful">Registration successful! You will be notified upon approval of your account.</p>';
                else echo $not_approved_message;
        }
        else echo $not_approved_message;
}
add_action('woocommerce_before_customer_login_form', 'ws_new_user_approve_registration_message', 2);

//Email Notifications
//Content parsing borrowed from: woocommerce/classes/class-wc-email.php
function ws_new_user_approve_send_approved_email($user_id){
  
    global $woocommerce;
    //Instantiate mailer
    $mailer = $woocommerce->mailer();
  
        if (!$user_id) return;
  
        $user = new WP_User($user_id);
  
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
        $user_pass  = "As specified during registration";
  
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
  
        $subject  = apply_filters( 'woocommerce_email_subject_customer_new_account', sprintf( __( 'Your account on %s has been approved!', 'woocommerce'), $blogname ), $user );
        $email_heading  = "User $user_login has been approved";
  
        // Buffer
        ob_start();
  
        // Get mail template
        woocommerce_get_template('emails/customer-account-approved.php', array(
                'user_login'    => $user_login,
                'user_pass'             => $user_pass,
                'blogname'              => $blogname,
                'email_heading' => $email_heading
       ));
  
        // Get contents
        $message = ob_get_clean();
  
        // Send the mail
        woocommerce_mail( $user_email, $subject, $message, $headers = "Content-Type: text/htmlrn", $attachments = "" );
}
add_action('new_user_approve_approve_user', 'ws_new_user_approve_send_approved_email', 10, 1);
  
function ws_new_user_approve_send_denied_email($user_id){
        return;
}
add_action('new_user_approve_deny_user', 'ws_new_user_approve_send_denied_email', 10, 1);

// OVERRIDE USER APPROVE PLUGIN
add_filter('new_user_approve_approve_user_message', 'modifyUserApprovalEmail');

function modifyUserApprovalEmail($user_id){
    $user = new WP_User( $user_id );

	wp_cache_delete( $user->ID, 'users' );
	wp_cache_delete( $user->data->user_login, 'userlogins' );

	// change usermeta tag in database to approved
	update_user_meta( $user->ID, 'pw_user_status', 'approved' );

	do_action( 'new_user_approve_user_approved', $user );
}

function sv_change_product_html( $price_html, $product ) {
	$price = $product->get_price();
	if ( 252 === $product->id ) {
		$price_html = '<span class="amount">$100 / ounce</span>';	
	} elseif ( 261 === $product->id ) {
		$price_html = '<span class="amount">$8 / joint</span>';
	} elseif ($product->is_type('variable')) ) {
		$price_html = '<span class="amount">$' . $price . '</span>';
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