<?php
get_header();
the_post();

$page_title_args = array(
    'title'     => get_post_meta( $post->ID, '_tlg_the_title', true ) ? get_post_meta( $post->ID, '_tlg_the_title', true ) : ( get_the_title( $post->ID ) ? get_the_title( $post->ID ) : get_option( 'tlg_framework_blog_title', esc_html__( 'Our Blog', 'wanium' ) ) ),
    'subtitle'  => get_post_meta( $post->ID, '_tlg_the_subtitle', true ),
    'layout'    => wanium_get_page_title_layout(),
    'image'     => get_post_meta( $post->ID, '_tlg_title_bg_featured', true ) == 'yes' ? 
        ( has_post_thumbnail() ? wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image', 'alt' => 'page-header') ) : false ) :
        ( get_post_meta( $post->ID, '_tlg_title_bg_img', true ) ? '<img class="background-image" alt="'.esc_attr( 'page-header' ).'" src="'.esc_url(get_post_meta( $post->ID, '_tlg_title_bg_img', true )).'" />' : false )
);
echo wanium_get_the_page_title( $page_title_args );
$layout = is_active_sidebar( 'primary' ) ? wanium_get_single_sidebar_layout() : 'sidebar-none';
$class  = 'sidebar-left' == $layout ? 'sidebar-left p0' : 'p0';
?>
<section id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <?php 
    if( 'yes' == get_option( 'wanium_blog_enable_pagination', 'no' ) ) { 
        get_template_part( 'templates/post/inc', 'pagination');
    }
    ?>
    <div class="container">
        <div class="row">
        	<?php get_template_part( 'templates/post/layout-single', $layout ); ?>
        </div>
    </div>
</section>
<?php get_footer();