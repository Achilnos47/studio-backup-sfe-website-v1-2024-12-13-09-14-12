<?php global $wp_query; ?>
<section>
	<div class="container">
		<div class="grid-blog row mb40">
		    <?php 
	    	if ( have_posts() ) : 
	    		while ( have_posts() ) : the_post();
		    		if( $wp_query->current_post % 2 == 0 && !( $wp_query->current_post == 0 ) ){
		    			echo '</div><div class="row mb40">';
		    		}
		    		get_template_part( 'templates/post/inc', 'grid-2col' );
		    	endwhile;
	    	else :
	    		get_template_part( 'templates/post/content', 'none' );
	    	endif;
		    ?>
		</div>
		<div class="row">
		    <?php echo function_exists('wanium_pagination') ? wanium_pagination() : posts_nav_link(); ?>
		</div>
	</div>
</section>