<?php
/**
 * Theme Woocommerce
 *
 * @package TLG Theme
 *
 */

/**
	UPDATE CART IN HEADER
**/
if( ! function_exists( 'wanium_woocommerce_update_cart' ) ) {
	function wanium_woocommerce_update_cart( $cartInfo ) {
		global $woocommerce;
		ob_start(); ?>
		<span class="tlg-count"><?php echo wp_specialchars_decode($woocommerce->cart->get_cart_contents_count()); ?></span>
		<?php
		$cartInfo['span.tlg-count'] = ob_get_clean();
		return $cartInfo;
	}
	add_filter('woocommerce_add_to_cart_fragments', 'wanium_woocommerce_update_cart');
}

/**
	NUMBER OF PRODUCTS PER PAGE
**/
if( ! function_exists( 'wanium_woocommerce_ppp' ) ) {
	function wanium_woocommerce_ppp() {
		$ppp = isset ($_GET['ppp'] ) ? $_GET['ppp'] : false;
		if( $ppp ) {
			return $ppp;
		}
		return get_option( 'wanium_shop_ppp', 6 );
	}
	add_filter( 'loop_shop_per_page', 'wanium_woocommerce_ppp', 20 );
}

/**
	WOOCOMMERCE SHARE
**/
if( ! function_exists( 'wanium_woocommerce_share' ) ) {
	function wanium_woocommerce_share() {
		echo '<div class="mt32">';
		get_template_part( 'templates/post/inc', 'sharing' );
		echo '</div>';
	}
	add_action( 'woocommerce_share', 'wanium_woocommerce_share' );
}