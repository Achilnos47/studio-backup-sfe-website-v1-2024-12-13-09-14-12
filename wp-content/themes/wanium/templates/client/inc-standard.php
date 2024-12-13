<?php global $post;  $client_url = get_post_meta( $post->ID, '_tlg_client_url', true ); ?>
<div class="col-sm-3 text-center">
	<div class="inline-block" data-toggle="tooltip" data-placement="top" title="<?php the_title_attribute(); ?>" data-original-title="<?php the_title_attribute(); ?>">
		<?php
		if( $client_url ) echo '<a href="'. esc_url( $client_url ) .'">';
		the_post_thumbnail( 'full', array('class' => 'image-s mb-xs-8 fade-35') );
		if( $client_url ) echo '</a>';
		?>
	</div>
</div>