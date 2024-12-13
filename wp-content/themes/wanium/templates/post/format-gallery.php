<?php
// Get gallery images in post content
$images = array();
$reg = preg_match('/\[gallery[^\]]*ids=\"(.*)\"[^\]]*\]/i', get_the_content(), $matches );
if( isset( $matches[1] ) ) { $attachments = explode( ',', $matches[1] );
    if( count($attachments) ) {
    	echo '<div class="clearfix mb16">';
		foreach ( $attachments as $id ) {
			$img = '';
			$url = wp_get_attachment_image_src($id, 'wanium_grid_big');
			if ( isset($url[0]) && $url[0] ) {
				$images[] = $url[0];
			}
		}
		if ( count($images) > 1 ) {
			// Display as gallery
			if ( is_rtl() ) {
				echo '<ul class="carousel-one-item-rtl carousel-olw-nav slides post-slider">';
			} else {
				echo '<ul class="carousel-one-item carousel-olw-nav slides post-slider">';
			}
			foreach ( $images as $image ) {
				echo '<li><img src="'. esc_url($image) .'" alt="'.esc_attr( 'gallery-item' ).'" /></li>';
			}
			echo '</ul>';
		} elseif ( count($images) == 1 ) {
			// Display as single image
			echo '<figure><img src="'. esc_url($images[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" /></figure>';
		}
		echo '</div>';
    }
}