<?php
/**
 * Theme Sidebar
 *
 * @package TLG Theme
 *
 */

if( !function_exists('wanium_register_sidebars') ) {
	function wanium_register_sidebars() {
		register_sidebar(
			array(
				'id' 			=> 'primary',
				'name' 			=> esc_html__( 'Blog Sidebar', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Blog sidebar.', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			) 
		);
		register_sidebar(
			array(
				'id' 			=> 'page',
				'name' 			=> esc_html__( 'Page Sidebar', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Sidebar page template.', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			) 
		);
		register_sidebar(
			array(
				'id' 			=> 'shop',
				'name' 			=> esc_html__( 'Shop Sidebar', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Shop sidebar.', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="sidebox widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			) 
		);
		register_sidebar(
			array(
				'id' 			=> 'footer1',
				'name' 			=> esc_html__( 'Footer Column 1', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Footer column 1', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			)
		);
		register_sidebar(
			array(
				'id' 			=> 'footer2',
				'name' 			=> esc_html__( 'Footer Column 2', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Footer column 2.', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			)
		);
		register_sidebar(
			array(
				'id' 			=> 'footer3',
				'name' 			=> esc_html__( 'Footer Column 3', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Footer column 3.', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			)
		);
		register_sidebar(
			array(
				'id' 			=> 'footer4',
				'name' 			=> esc_html__( 'Footer Column 4', 'wanium' ),
				'description' 	=> esc_html__( 'Widget appears in the Footer column 4.', 'wanium' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h6 class="title">',
				'after_title' 	=> '</h6>'
			)
		);
	}
	add_action( 'widgets_init', 'wanium_register_sidebars' );
}