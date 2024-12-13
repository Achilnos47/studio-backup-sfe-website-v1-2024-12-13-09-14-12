<?php 
$testimonial_url = get_post_meta( $post->ID, '_tlg_testimonial_url', 1 );
$testimonial_content = get_post_meta( $post->ID, '_tlg_testimonial_content', 1 );
$testimonial_info = get_post_meta( $post->ID, '_tlg_testimonial_info', 1 );
?>
<li class="item image-round-100">
    <?php the_post_thumbnail( 'full', array('class' => 'image-small inline-block mb24') ); ?>
	<?php echo !empty($testimonial_content) ? '<div class="quote content ms-text graytext-color">'.$testimonial_content.'</div>' : ''; ?>
    <div class="quote-author">
    	<h6 class="p0 capitalize">
    	<?php 
    	if( !filter_var( $testimonial_url, FILTER_VALIDATE_URL ) === false || $testimonial_url == '#' ) {
		    echo '<a href="'. esc_url($testimonial_url) .'">'.get_the_title() . ( $testimonial_info ? esc_html__( ',' , 'wanium' ).' '.$testimonial_info: '' ).'</a>';
		} else {
		    echo get_the_title() . ( $testimonial_info ? esc_html__( ',' , 'wanium' ).' '.$testimonial_info: '' );
		}
    	?>
    	</h6>
    </div>
</li>