<?php
get_header( 'shop' );

/**
	SINGLE PRODUCT
**/
if( is_product() ) {
	$page_title_args = array(
		'title'   	=> get_post_meta( $post->ID, '_tlg_the_title', true ) ? get_post_meta( $post->ID, '_tlg_the_title', true ) : get_the_title(),
		'subtitle'  => get_post_meta( $post->ID, '_tlg_the_subtitle', true ),
		'layout' 	=> wanium_get_page_title_layout(),
		'image'    	=> get_post_meta( $post->ID, '_tlg_title_bg_featured', true ) == 'yes' ? 
	        ( has_post_thumbnail() ? wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image', 'alt' => 'page-header') ) : false ) :
	        ( get_post_meta( $post->ID, '_tlg_title_bg_img', true ) ? '<img class="background-image" alt="'.esc_attr( 'page-header' ).'" src="'.esc_url(get_post_meta( $post->ID, '_tlg_title_bg_img', true )).'" />' : false )
	);
	echo wanium_get_the_page_title( $page_title_args );
	get_template_part( 'templates/product/layout', 'single' );
}

/**
	ARCHIVE SHOP PAGE
**/
elseif( is_shop() || is_product_category() || is_product_tag() ) {
	$layout 	= isset($_GET['style']) ? $_GET['style'] : false;
	$layout 	= $layout ? $layout : get_option( 'wanium_shop_layout', 'sidebar-right' );
	$image 		= get_option( 'wanium_shop_header_image' ) ? '<img src="'. get_option( 'wanium_shop_header_image' ) .'" alt="'.esc_attr( 'page-header' ).'" class="background-image" />' : false;

	$term_name 	= '';
	$term_desc 	= '';
	if( is_product_category() || is_product_tag() ) {
		$term 		= get_queried_object();
		$term_name 	= isset($term->name) ? $term->name : '';
		$term_desc 	= $term_name && isset($term->description) ? $term->description : '';
		$term_thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
        $term_image = wp_get_attachment_url($term_thumbnail_id);
        if( $term_image ) {
        	$image = '<img src="'. esc_url($term_image) .'" alt="'.esc_attr( 'page-header' ).'" class="background-image" />';
        }
	}
	 
	$page_title_args = array(
		'title'   	=> $term_name ? $term_name : get_option( 'wanium_shop_title', esc_html__( 'Our shop', 'wanium' ) ),
		'subtitle'  => $term_desc ? $term_desc : get_option( 'wanium_shop_subtitle', '' ),
		'layout' 	=> get_option( 'wanium_shop_header_layout', 'center'),
		'image'    	=> $image
	); 
	echo wanium_get_the_page_title( $page_title_args );
	get_template_part( 'templates/product/layout', $layout );
}

/**
	SEARCH SHOP PAGE
**/
elseif( is_search() ) {
	global $wp_query;
	$layout 			= isset($_GET['style']) ? $_GET['style'] : false;
	$layout 			= $layout ? $layout : get_option( 'wanium_shop_layout', 'sidebar-right' );
	$results 			= $wp_query->found_posts;
	$search_term 		= get_search_query();
	$page_title_args 	= array(
		'title'   	=> esc_html__( 'Search Results for: ', 'wanium' ) . ( $search_term ? $search_term : esc_html__( 'Empty', 'wanium' ) ), 
		'subtitle'  => $search_term ? esc_html__( 'Found ' ,'wanium' ) . $results . ( '1' == $results ? esc_html__(' Item', 'wanium') : esc_html__( ' Items', 'wanium' ) ) : '',
		'layout' 	=> get_option( 'wanium_shop_header_layout', 'center'),
		'image'    	=> get_option( 'wanium_shop_header_image' ) ? '<img src="'. get_option( 'wanium_shop_header_image' ) .'" alt="'.esc_attr( 'page-header' ).'" class="background-image" />' : false
	);
	echo wanium_get_the_page_title( $page_title_args );
	echo '<div class="woocommerce">';
	get_template_part( 'templates/product/layout', get_option( 'wanium_shop_layout', $layout ) );
	echo '</div>';
}

get_footer( 'shop' );