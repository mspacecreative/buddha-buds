<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<div id="contact" class="et_pb_section et_pb_section_2 et_pb_section_parallax et_pb_with_background et_section_regular" style="padding: 0;">
				
	<div class="et_parallax_bg_wrap">
		<div class="et_parallax_bg" style="background-image: url(../../../../wp-content/uploads/2020/03/buddha_buds_halifax_cannabis.jpg); height: 598.0999999999999px; transform: translate(0px, 111.89999999999999px);"></div>
	</div>
				
				
	<div class="et_pb_row et_pb_row_0 et_pb_row_fullwidth et_pb_equal_columns et_pb_gutters1" style="padding: 0; width: 100%;">
		<div class="et_pb_column et_pb_column_1_2 et_pb_column_2  et_pb_css_mix_blend_mode_passthrough" style="background-color: rgba(0,0,0,0.6); padding-top: 100px; padding-right: 10%; padding-bottom: 100px; padding-left: 10%;">
				
			<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_left et_pb_bg_layout_dark">
				<div class="et_pb_text_inner">
					<h2 style="font-size: 40px;">Contact Us</h2>
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
					<h2 style="font-size: 40px;">My account</h2>
				</div>
				
				<div class="et_pb_button_module_wrapper et_pb_button_1_wrapper et_pb_module">
					<a class="et_pb_button et_pb_button_1 home_login-register et_pb_bg_layout_light" href="/my-account/">Go to dashboard</a>
				</div>
				
			</div>
			
		</div>
				
				
	</div>
				
</div>
