<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes      = array();
$grid_columns = noo_hermosa_shop_grid_column();

if( !is_product() && !is_page() ){
    if( $grid_columns == 4 ){
        $classes[] = 'noo-product-column noo-xs-6 noo-md-3';
    }elseif ( $grid_columns == 2 ) {
        $classes[] = 'noo-product-column noo-xs-6 noo-md-6';
    } elseif ( $grid_columns == 1 ) {
        $classes[] = 'noo-product-column noo-xs-6 noo-md-12';
    } else {
        $classes[] = 'noo-product-column noo-xs-6 noo-md-4';
    }
} elseif( is_product() ){
    $product_layout = noo_hermosa_get_option( 'noo_woocommerce_product_layout', 'same_as_shop' );
    if ( $product_layout == 'same_as_shop' ) {
        $product_layout = noo_hermosa_get_option( 'noo_shop_layout', 'fullwidth' );
    }
    $layout = $product_layout;
	if( $layout == 'fullwidth' ){
		$classes[] = 'noo-product-column noo-md-3 noo-sm-6';
	} else {
		$classes[] = 'noo-product-column noo-md-'.(12/$grid_columns).' noo-sm-6';
	}
}
?>
<div <?php post_class( $classes ); ?>>
	
	<div class="noo-product-column-wrap">

		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		?>
		<div class="noo-product-wrap">
			<h3 class="noo-title-shop">
				<a href="<?php the_permalink(); ?>" title="<?php the_title( ); ?>"><?php the_title( ); ?></a>
			</h3>
			<?php
				
				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</div><!-- /.noo-product-wrap -->
	
	</div><!-- /.noo-product-column-wrap -->
	
</div>
