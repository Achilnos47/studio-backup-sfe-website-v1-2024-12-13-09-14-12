<?php 
/*
Template Name: Sidebar Template
*/
get_header();
the_post();
$page_title_args = array(
	'title'   	=> get_the_title(),
	'subtitle'  => get_post_meta( $post->ID, '_tlg_the_subtitle', true ),
	'layout' 	=> wanium_get_page_title_layout(),
	'image'    	=> has_post_thumbnail() ? wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image', 'alt' => 'page-header') ) : false
);
echo wanium_get_the_page_title( $page_title_args );
?>
<section id="page-<?php the_ID(); ?>" <?php post_class( 'p0' ); ?>>
	<div class="container">
	    <div class="row">
	        <div id="main-content" class="col-md-9 col-sm-12 post-content">
	        	<?php the_content(); wp_link_pages(); comments_template(); ?>
	        </div>
	        <?php get_sidebar( 'page' ); ?>
	    </div>
	</div>
</section>
<?php get_footer();