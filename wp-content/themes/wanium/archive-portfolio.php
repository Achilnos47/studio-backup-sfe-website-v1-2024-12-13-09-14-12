<?php 
get_header();
$page_title_args = array(
	'title'   	=> get_option( 'wanium_portfolio_title', esc_html__( 'Our portfolio', 'wanium' ) ),
	'subtitle'  => get_option( 'wanium_portfolio_subtitle', '' ),
	'layout' 	=> get_option( 'wanium_portfolio_header_layout', 'center' ),
	'image'    	=> get_option( 'wanium_portfolio_header_image' ) ? '<img src="'. get_option( 'wanium_portfolio_header_image' ) .'" alt="'.esc_attr( 'page-header' ).'" class="background-image" />' : false
);
echo wanium_get_the_page_title( $page_title_args );
get_template_part( 'templates/portfolio/layout', get_option( 'wanium_portfolio_layout', 'full-masonry-4col' ) );
get_footer();