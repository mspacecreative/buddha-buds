<?php

function so174837_registration_email_alert( $user_id ) {
    $user    = get_userdata( $user_id );
    $email   = $user->user_email;
    $message = 'A new customer, ' . $email . ', has registered their account on Buddha Buds.';
    wp_mail( 'orders@buddhabudshfx.com', 'New customer registration', $message );
}
add_action('user_register', 'so174837_registration_email_alert');