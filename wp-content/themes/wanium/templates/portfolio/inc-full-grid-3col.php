<?php 
$portfolio_link = wanium_get_portfolio_link(); 
$categories_group = wanium_portfolio_filters_group();
?>
<div class="col-md-4 col-sm-6 masonry-item project m0 p0 <?php echo esc_attr($categories_group); ?>" >
    <div class="boxed-intro overflow-hidden bg-white zoom-hover hover-small-dark border-radius-0">
        <div class="intro-image overflow-hidden relative">
            <?php 
            echo wp_kses($portfolio_link['prefix'], wanium_allowed_tags());
            the_post_thumbnail( 'wanium_grid_big', array('class' => 'background-image') );
            echo wp_kses($portfolio_link['sufix'], wanium_allowed_tags());
            ?>
        </div>
        <div class="intro-content intro-content-small">
            <?php
            echo !$portfolio_link['lightbox'] ? wp_kses($portfolio_link['prefix'], wanium_allowed_tags()) : '';
            the_title('<h4 class="xs-text mb0">', '</h4><h6 class="sms-text subtitle thin mb0">'. wanium_the_terms( 'portfolio_category', ' / ', 'name' ) .'</h6>');
            echo !$portfolio_link['lightbox'] ? wp_kses($portfolio_link['sufix'], wanium_allowed_tags()) : '';
            ?>
        </div>
    </div>
</div>