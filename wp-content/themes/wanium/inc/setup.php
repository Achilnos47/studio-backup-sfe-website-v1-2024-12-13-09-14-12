<?php
/**
 * Theme Setup
 *
 * @package TLG Theme
 *
 */

if( !function_exists('wanium_init_theme') ) {
	function wanium_init_theme() {
	    global $content_width;
	    if ( ! isset( $content_width ) ) $content_width = 1170;
	    add_editor_style( 'assets/css/editor.css' );
	    add_post_type_support( 'page', 'excerpt' );
	    remove_post_type_support( 'portfolio', 'post-formats' );
	    if ('no' == get_option('wanium_enable_portfolio_comment', 'no')) {
	    	remove_post_type_support( 'portfolio', 'comments' );
		}
	    if ('no' == get_option('wanium_enable_page_comment', 'no')) {
	    	remove_post_type_support( 'page', 'comments' );
		}
	}
	add_action( 'init', 'wanium_init_theme', 10 );
}

if( !function_exists('wanium_setup_theme') ) {
	function wanium_setup_theme() {
		load_theme_textdomain( 'wanium', trailingslashit( get_template_directory() ) . 'languages' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'custom-background', array( 'default-color' => 'eeeeee' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'quote', 'link') );
		add_theme_support( 'post-thumbnails' );
		if( class_exists( 'Woocommerce' ) ) {
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}
		add_theme_support( 'editor-color-palette', array(
	        array(
	            'name' => __( 'Primary Color', 'wanium' ),
	            'slug' => 'primary-color',
	            'color' => get_option('wanium_color_primary', '#3897f0'),
	        ),
	        array(
	            'name' => __( 'Dark Color', 'wanium' ),
	            'slug' => 'dark-color',
	            'color' => get_option('wanium_color_bg_dark', '#252525'),
	        ),
	        array(
	            'name' => __( 'Warning Color', 'wanium' ),
	            'slug' => 'warning-color',
	            'color' => '#f05660',
	        ),
	        array(
	            'name' => __( 'Success Color', 'wanium' ),
	            'slug' => 'success-color',
	            'color' => '#6abaf7',
	        ),
	        array(
	            'name' => __( 'Hot Color', 'wanium' ),
	            'slug' => 'hot-color',
	            'color' => '#f96f39',
	        ),
	    ) );
		add_image_size( 'wanium_grid', 600, 450, true );
		add_image_size( 'wanium_grid_big', 960, 720, true );
	}
	add_action( 'after_setup_theme', 'wanium_setup_theme', 10 );
}