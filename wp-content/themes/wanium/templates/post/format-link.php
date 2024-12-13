<?php
if ( has_post_thumbnail() ) {
	echo '<div class="blockquote-link-img boxed-intro mb32">';
	echo '<div class="background-content visible">'. wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image') );
	echo '<div class="background-overlay"></div>';
	echo '</div>';
}
echo '<blockquote class="blockquote blockquote-link pb0 m0">'.get_the_content().'</blockquote>';
if ( has_post_thumbnail() ) {
	echo '</div>';
}