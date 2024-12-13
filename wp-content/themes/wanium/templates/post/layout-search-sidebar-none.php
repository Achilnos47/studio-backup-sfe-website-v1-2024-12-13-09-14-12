<section class="p0">
    <div class="container">
        <div class="row">
            <div id="main-content" class="col-sm-10 col-sm-offset-1">
            	<?php 
        		if ( have_posts() ) : 
                    while ( have_posts() ) : the_post();
            			get_template_part( 'templates/post/content', 'search' );
            		endwhile;
        		else :
        			get_template_part( 'templates/post/content', 'none' );
        		endif;
        		echo function_exists('wanium_pagination') ? wanium_pagination() : posts_nav_link();
            	?>
            </div>
        </div>
    </div>
</section>