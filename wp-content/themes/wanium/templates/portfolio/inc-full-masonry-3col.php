<?php 
$portfolio_link = wanium_get_portfolio_link("zoom-line"); 
$categories_group = wanium_portfolio_filters_group();
$layout = isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_portfolio_big_size_3_full', 1 ) ? 'col-sm-8' : 'col-sm-4'; 
?>
<div class="<?php echo esc_attr( $layout ); ?> masonry-item project p0 m0 <?php echo esc_attr($categories_group); ?>" >
    <?php echo wp_kses($portfolio_link['prefix'], wanium_allowed_tags()); ?>
	    <div class="image-box text-center plus-cursor">
		    <div class="zoom-line-image">
		    	<?php the_post_thumbnail( 'full', array('class' => 'background-image') ); ?>
		    </div>
	        <div class="zoom-line-caption">
	            <div class="zoom-line-caption-inner">
	                <div class="zoom-line-title">
	                    <h3 class="zoom-line-title-inner ms-text mb0 color-white "><?php echo get_the_title(); ?></h3>
	                </div>
	                <div class="zoom-line-subtitle">
	                	<span class="zoom-line-subtitle-inner xs-text color-white"><?php echo wanium_the_terms( 'portfolio_category', ' / ', 'name' ); ?></span>
	                </div>
	            </div>
        	</div>
	    </div>
    <?php echo wp_kses($portfolio_link['sufix'], wanium_allowed_tags()); ?>
</div>