<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
	
	<div id="contact" class="et_pb_section et_pb_section_2 et_pb_section_parallax et_pb_with_background et_section_regular" style="padding: 0;">
				
	<div class="et_parallax_bg_wrap">
		<div class="et_parallax_bg" style="background-image: url(../../../../wp-content/uploads/2020/03/buddha_buds_halifax_cannabis.jpg); height: 598.0999999999999px; transform: translate(0px, 111.89999999999999px);"></div>
	</div>
				
				
	<div class="et_pb_row et_pb_row_0 et_pb_row_fullwidth et_pb_equal_columns et_pb_gutters1" style="padding: 0; width: 100%;">
		<div class="et_pb_column et_pb_column_1_2 et_pb_column_2  et_pb_css_mix_blend_mode_passthrough" style="background-color: rgba(0,0,0,0.6); padding-top: 100px; padding-right: 10%; padding-bottom: 100px; padding-left: 10%;">
				
			<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_left et_pb_bg_layout_dark">
				<div class="et_pb_text_inner">
					<h2 style="font-size: 40px; line-height: 1.5em;">Contact Us</h2>
				</div>
			</div>
			
			<div class="et_pb_button_module_wrapper et_pb_button_0_wrapper  et_pb_module ">
				<a class="et_pb_button et_pb_button_0 et_pb_bg_layout_light" href="mailto:info@buddhabudshfx.com">info@buddhabudshfx.com
				</a>
			</div>
			
		</div>
			
		<div class="et_pb_column et_pb_column_1_2 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough et-last-child" style="background-color: #414042; padding-top: 100px; padding-right: 10%; padding-bottom: 100px; padding-left: 10%;">
				
			<div class="et_pb_module et_pb_text et_pb_text_1  et_pb_text_align_left et_pb_bg_layout_dark">
				
				<div class="et_pb_text_inner">
					<h2 style="font-size: 40px; line-height: 1.5em;">My account</h2>
				</div>
				
				<div class="et_pb_button_module_wrapper et_pb_button_1_wrapper et_pb_module">
					<a class="et_pb_button et_pb_button_1 home_login-register et_pb_bg_layout_light" href="/my-account/">Go to dashboard</a>
				</div>
				
			</div>
			
		</div>
				
				
	</div>
				
</div>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
