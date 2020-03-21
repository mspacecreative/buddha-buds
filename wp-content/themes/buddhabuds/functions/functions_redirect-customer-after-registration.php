<?php

// REDIRECT CUSTOMER AFTER REGISTRATION
function custom_redirection_after_registration( $redirection_url ){
    // Change the redirection Url
    $redirection_url = home_url('/success/'); // Success page

    return $redirection_url; // Always return something
}
add_filter( 'woocommerce_registration_redirect', 'custom_redirection_after_registration', 10, 1 );

// HIDE SUCCESS PAGE FROM PUBLIC
add_filter( 'wp_head', function(){
	if (is_page('success') && !is_user_logged_in()) {
		add_filter('the_content', function(){
			return __('Sorry! Only registered customers are allowed to see this page. Please use the navigation above to find what you&#8217;re looking for.');
		}, 99);
	}
});