<?php 
define( 'WANIUM_THEME_PATH', trailingslashit( get_template_directory() ) );
define( 'WANIUM_THEME_DIRECTORY', trailingslashit( get_template_directory_uri() ) );

# Including theme helpers
require_once( WANIUM_THEME_PATH . 'inc/helpers.php' );

# Including plugin activation & metaboxes
if( is_admin() ) {
	if ( !class_exists( 'TGM_Plugin_Activation' ) ) {
		require_once( WANIUM_THEME_PATH . 'inc/lib/class-tgm-plugin-activation.php' );
	}
	if (function_exists('tlg_framework_setup')) {
		require_once( WANIUM_THEME_PATH . 'inc/metaboxes.php' );
		require_once( WANIUM_THEME_PATH . 'inc/importer/init.php' );
	}
}

# Including theme components
require_once( WANIUM_THEME_PATH . 'inc/setup.php' );
require_once( WANIUM_THEME_PATH . 'inc/menus.php' );
require_once( WANIUM_THEME_PATH . 'inc/sidebars.php' );
require_once( WANIUM_THEME_PATH . 'inc/filters.php' );
require_once( WANIUM_THEME_PATH . 'inc/scripts.php' );

if (function_exists('tlg_framework_setup')) {
	require_once( WANIUM_THEME_PATH . 'inc/customizer.php' );
}

# Including WooCommerce Shop functions
if( class_exists( 'Woocommerce' ) ) {
	require_once( WANIUM_THEME_PATH . 'inc/shop.php' );
}

# Including Visual Composer functions
if( function_exists( 'vc_set_as_theme' ) ) {
	require_once( WANIUM_THEME_PATH . 'visualcomposer/init.php' );
}

# Please use a child theme if you need to modify the theme functions
# BE WARNED! You can add code below here but it will be overwritten on theme update