<?php $portfolio_link = wanium_get_portfolio_link("btn btn-filled btn-rounded btn-sm-sm"); ?>
<section class="image-bg bg-dark parallax project-parallax overlay z-index pt120 pb120">
    <div class="background-content">
        <?php the_post_thumbnail( 'full', array('class' => 'background-image') ); ?>
        <div class="background-overlay"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="widgetsubtitle small-widgetsubtitle mb16 uppercase-force"><?php echo wanium_the_terms( 'portfolio_category', ' / ', 'name' ) ?></div>
                <?php 
                the_title( '<h5 class="widgettitle big-widgettitle">', '</h5>' );
                echo wp_kses($portfolio_link['prefix'], wanium_allowed_tags());
                esc_html_e( 'See Project', 'wanium' );
                echo wp_kses($portfolio_link['sufix'], wanium_allowed_tags()); 
                ?>
            </div>
        </div>
    </div>
</section>