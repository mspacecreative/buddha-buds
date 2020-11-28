<?php 
// WOOCOMMERCE REGISRATION FORM
function buddha_woocommerce_edit_registration_form() {
	echo '<p id="recaptcha" class="g-recaptcha" data-sitekey="6LcP0OUUAAAAAP3mrJ9Z601JYH5yMtC_Dp-R5e3S"></p>';
}
add_action( 'woocommerce_register_form', 'buddha_woocommerce_edit_registration_form', 15 );

function buddha_validate_extra_register_fields( $errors, $username, $email ) {
    if ( empty( $_POST['g-recaptcha-response'] ) ) {
        $errors->add( 'captcha-error', wp_kses_post( '<strong>Error</strong>: Captcha is missing.', 'nada' ) );
    }
    return $errors;
}
add_filter( 'woocommerce_registration_errors', 'buddha_validate_extra_register_fields', 10, 3 );

// WOOCOMMERCE LOGIN FORM
function buddha_woocommerce_edit_login_form() {
	echo '<p id="recaptcha" class="g-recaptcha" data-sitekey="6LcP0OUUAAAAAP3mrJ9Z601JYH5yMtC_Dp-R5e3S"></p>';
}
add_action( 'woocommerce_login_form', 'buddha_woocommerce_edit_login_form', 15 );

function buddha_validate_extra_login_fields( $errors, $sanitized_user_login, $user_email ) {
    if ( empty( $_POST['g-recaptcha-response'] ) ) {
        $errors->add( 'captcha-error', wp_kses_post( '<strong>Error</strong>: Captcha is missing.', 'nada' ) );
    }
    return $errors;
}
add_filter( 'woocommerce_login_errors', 'buddha_validate_extra_login_fields', 10, 3 );