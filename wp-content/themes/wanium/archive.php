<?php 	
get_header();
$term = get_queried_object();
$term_name = esc_html__( 'Archives', 'wanium' );
$term_desc = '';
if ( !$term ) {
	if ( is_day() )
		$term_name = esc_html__( 'In: ', 'wanium' ) . get_the_date();
	elseif ( is_month() )
		$term_name = esc_html__( 'In: ', 'wanium' ) . get_the_date( _x( 'F Y', 'monthly archives date format', 'wanium' ) );
	elseif ( is_year() )
		$term_name = esc_html__( 'In: ', 'wanium' ) . get_the_date( _x( 'Y', 'yearly archives date format', 'wanium' ) );
} else {
	if ( isset ($term->name) ) {
		if ( isset($term->taxonomy) && 'post_tag' == $term->taxonomy ) {
			$term_name = esc_html__( 'Tag: ', 'wanium' ) . $term->name;
		} else {
			$term_name = esc_html__( 'Category: ', 'wanium' ) . $term->name;
		}
	} elseif ( isset ($term->display_name) ) {
		$term_name = esc_html__( 'Author: ', 'wanium' ) . $term->display_name;
	}
	$term_desc = isset ($term->description) ? $term->description : '';
}
$page_title_args = array(
	'title'   	=> $term_name,
	'subtitle'  => $term_desc,
	'layout' 	=> get_option( 'wanium_blog_header_layout', 'center' ),
	'image'    	=> get_option( 'wanium_blog_header_image' ) ? '<img src="'. get_option( 'wanium_blog_header_image' ) .'" alt="'.esc_attr( 'page-header' ).'" class="background-image" />' : false
);
echo wanium_get_the_page_title( $page_title_args );
get_template_part( 'templates/post/layout', get_option( 'wanium_blog_layout', 'sidebar-right' ) );
get_footer();