<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' ); ?>

<div id="contact" class="et_pb_section et_pb_section_2 et_pb_section_parallax et_pb_with_background et_section_regular">
				
	<div class="et_parallax_bg_wrap">
		<div class="et_parallax_bg" style="background-image: url(&quot;http://buddhabuds.urbanbuilt.ca/wp-content/uploads/2020/03/buddha_buds_halifax_cannabis.jpg&quot;); height: 598.0999999999999px; transform: translate(0px, 111.89999999999999px);"></div>
	</div>
				
				
	<div class="et_pb_row et_pb_row_0 et_pb_row_fullwidth et_pb_equal_columns et_pb_gutters1">
		<div class="et_pb_column et_pb_column_1_2 et_pb_column_2  et_pb_css_mix_blend_mode_passthrough" style="background-color: rgba(0,0,0,0.6);">
				
			<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_left et_pb_bg_layout_dark">
				<div class="et_pb_text_inner">
					<h2>Contact Us</h2>
				</div>
			</div>
			
			<div class="et_pb_button_module_wrapper et_pb_button_0_wrapper  et_pb_module ">
				<a class="et_pb_button et_pb_button_0 et_pb_bg_layout_light" href="mailto:info@buddhabudshfx.com">info@buddhabudshfx.com
				</a>
			</div>
			
		</div>
			
		<div class="et_pb_column et_pb_column_1_2 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough et-last-child" style="background-color: #414042;">
				
			<div class="et_pb_module et_pb_text et_pb_text_1  et_pb_text_align_left et_pb_bg_layout_dark">
				
				<div class="et_pb_text_inner">
					<h2>My account</h2>
				</div>
				
				<div class="et_pb_button_module_wrapper et_pb_button_1_wrapper et_pb_module">
					<a class="et_pb_button et_pb_button_1 home_login-register et_pb_bg_layout_light" href="/my-account/">Go to dashboard</a>
				</div>
				
			</div>
			
		</div>
				
				
	</div>
				
</div>

<?php get_footer( 'shop' ); ?>
