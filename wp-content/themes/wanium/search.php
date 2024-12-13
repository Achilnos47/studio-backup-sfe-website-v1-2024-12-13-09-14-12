<?php
$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : false;
if ( 'product' == $post_type ) {
	get_template_part( 'woocommerce' );
} else {
	get_header();
	global $wp_query;
	$results 			= $wp_query->found_posts;
	$search_term 		= get_search_query();
	$page_title_args 	= array(
		'title'   	=> esc_html__( 'Results for: ', 'wanium' ) . ( $search_term ? $search_term : esc_html__( 'Empty', 'wanium' ) ), 
		'subtitle'  => $search_term ? $results . ( '1' == $results ? esc_html__(' item', 'wanium') : esc_html__( ' items', 'wanium' ) ) . esc_html__( ' found ' ,'wanium' ) : '',
		'layout' 	=> get_option( 'wanium_search_header_layout', 'center' ),
		'image'    	=> get_option( 'wanium_search_header_image' ) ? '<img src="'. get_option( 'wanium_search_header_image' ) .'" alt="'.esc_attr( 'page-header' ).'" class="background-image" />' : false,
	);
	echo wanium_get_the_page_title( $page_title_args );
	if( $search_term ) {
		get_template_part( 'templates/post/layout-search', get_option( 'wanium_search_layout', 'sidebar-right' ) );
	} else { ?>
		<section class="search-wrap">
			<div class="container">
				<?php get_template_part( 'templates/post/content', 'none' ); ?>
			</div>
		</section><?php
	}
	get_footer();
}