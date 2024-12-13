<?php 
$testimonial_url = get_post_meta( $post->ID, '_tlg_testimonial_url', 1 );
$testimonial_content = get_post_meta( $post->ID, '_tlg_testimonial_content', 1 );
$testimonial_info = get_post_meta( $post->ID, '_tlg_testimonial_info', 1 );
?>
<li>
    <div class="quote-author image-round-100 mt0 mb16">
        <?php the_post_thumbnail(); ?>
    	<h6 class="capitalize">
    	<?php 
    	if( !filter_var( $testimonial_url, FILTER_VALIDATE_URL ) === false || $testimonial_url == '#' ) {
		    echo '<a href="'. esc_url($testimonial_url) .'">'.get_the_title().'</a>';
		} else {
		    echo get_the_title();
		}
    	?>
    	</h6>
    	<?php echo !empty($testimonial_info) ? '<span class="droid-text">'.$testimonial_info.'</span>' : ''; ?>
    </div>
    <?php echo !empty($testimonial_content) ? '<div class="quote content graytext-color ms-text">'.$testimonial_content.'</div>' : ''; ?>
</li>