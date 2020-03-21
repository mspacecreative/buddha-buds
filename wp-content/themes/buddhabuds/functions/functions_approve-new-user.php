<?php
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