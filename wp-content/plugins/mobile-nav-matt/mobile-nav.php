<?php
/*
 * Plugin Name: Matt's Off Canvas Mobile Menu
 * Plugin URI: http://mspacecreative.com
 * Description: Off canvas menu, slide from right
 * Version: 1.0
 * Author: Matt Cyr
 * Author URI: http://mspacecreative.com
 */
 
 function off_canvas_menu() {
 	wp_enqueue_style( 'mobile-css', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), null );
 	wp_enqueue_script( 'mobile-script', plugin_dir_url( __FILE__ ) . 'js/mobile.js', array( 'jquery' ), '1.0', true );
 }
 
 function mobilenavPlugin() {
 	ob_start(); ?>
 <!--<div class="body-overlay"></div>-->	
 	
 <div class="mobile-nav-container">
 	<button class="hamburger hamburger--squeeze" type="button">
 		 <span class="hamburger-box">
 		    <span class="hamburger-inner"></span>
 		 </span>
 	</button>
 </div>
 	
 <div class="mobile-nav">
 		<?php 
 		
 			wp_nav_menu( array( 
 				'theme_location' => 'primary-menu',
 				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s ' . $menu . '</ul>', 
 			) ); ?>
 </div>
 <?php echo ob_get_clean();
 }
 
 add_action( 'wp_head', 'mobilenavPlugin' );
 add_action( 'wp_enqueue_scripts', 'off_canvas_menu' );