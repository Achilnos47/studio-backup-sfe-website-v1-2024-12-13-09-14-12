<section>
	<?php get_template_part( 'templates/post/inc', 'loader' ); ?>
	<div class="row masonry masonry-show mb40">
	    <?php
    	if ( have_posts() ) : 
    		while ( have_posts() ) : the_post();
	    		get_template_part( 'templates/post/inc', 'fullwidth' );
	    	endwhile;
    	else :
    		get_template_part( 'templates/post/content', 'none' );
    	endif;
	    ?>
	</div>
	<div class="row">
	    <?php echo function_exists('wanium_pagination') ? wanium_pagination() : posts_nav_link(); ?>
	</div>
</section>