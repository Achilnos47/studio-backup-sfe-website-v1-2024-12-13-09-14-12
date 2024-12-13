<?php 
get_header();
the_post();
$page_title_args = array(
	'title'   	=> get_post_meta( $post->ID, '_tlg_the_title', true ) ? get_post_meta( $post->ID, '_tlg_the_title', true ) : get_the_title(),
	'subtitle'  => get_post_meta( $post->ID, '_tlg_the_subtitle', true ),
	'layout' 	=> wanium_get_page_title_layout(),
	'image'     => get_post_meta( $post->ID, '_tlg_title_bg_featured', true ) == 'yes' ? 
        ( has_post_thumbnail() ? wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image', 'alt' => 'page-header') ) : false ) :
        ( get_post_meta( $post->ID, '_tlg_title_bg_img', true ) ? '<img class="background-image" alt="'.esc_attr( 'page-header' ).'" src="'.esc_url(get_post_meta( $post->ID, '_tlg_title_bg_img', true )).'" />' : false )
);
echo wanium_get_the_page_title( $page_title_args );
?>
<div class="tlg-page-wrapper">
	<a id="home" href="#"></a>
	<?php 
	the_content();
	if( is_singular( 'portfolio' ) ) { 
		get_template_part( 'templates/portfolio/inc', 'meta'); 
	} elseif( is_single() ) {
		get_template_part( 'templates/post/inc', 'pagination');
	} 
	?>
</div>
<?php if ( comments_open() && 'yes' == get_option('wanium_enable_page_comment', 'no') ) : ?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php get_footer();