<?php if( 'yes' == get_option( 'wanium_portfolio_enable_share', 'yes' ) ) :  ?>
<section>
    <div class="container">
        <div class="col-sm-12 portfolio-meta text-center text-left-xs-force">
            <h4 class="bold-title thin"><?php esc_html_e( 'Share this project', 'wanium' ); ?></h4>
            <?php 
            if (function_exists('tlg_framework_setup')) {
                echo tlg_framework_like_display( 'btn btn-rounded btn-sm-sm btn-style-gray' ); 
            }
            ?>
            <?php get_template_part( 'templates/post/inc', 'sharing' ); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if( 'yes' == get_option( 'wanium_portfolio_enable_pagination', 'yes' ) ) :  ?>
<section class="p0 m0">
    <?php
    $prev = get_previous_post();
    $next = get_next_post();
    $prev_date = $prev ? mysql2date('M d, Y', $prev->post_date, false) : false;
    $next_date = $next ? mysql2date('M d, Y', $next->post_date, false) : false;
    if ( $next || $prev ) { ?>
        <div class="projects-bottom-nav">
            <div class="row">
                <div class="col-sm-6 left-btn-part pt180 pb180">
                    <?php if ( $prev ) { ?>
                    <a href="<?php echo get_permalink( $prev->ID ) ?>">
                        <?php
                        $thumbnail_id = get_post_thumbnail_id( $prev->ID );
                        $url = wp_get_attachment_image_src( $thumbnail_id, 'wanium_grid_big' );
                        if ( isset($url[0]) && $url[0] ) {
                            ?><div class="background-content"><img src="<?php echo esc_url( $url[0] ) ?>" alt="<?php echo esc_attr( $prev->post_title ) ?>" /></div><?php
                        } ?>
                        <div class="background-overlay"></div>
                        <div class="middle-holder left">
                            <div class="title">
                                <h5 class="widgettitle big-widgettitle mb16"><i class="fa fa-long-arrow-left"></i></h5>
                                <div class="widgetsubtitle small-widgetsubtitle mb16 uppercase-force"><?php esc_html_e( 'Previous Project', 'wanium' ); ?></div>
                                <h5 class="widgettitle big-widgettitle"><?php echo esc_attr($prev->post_title); ?></h5>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-6 right-btn-part pt180 pb180">
                    <?php if ( $next ) { ?>
                    <a href="<?php echo get_permalink( $next->ID ) ?>">
                        <?php
                        $thumbnail_id = get_post_thumbnail_id( $next->ID );
                        $url = wp_get_attachment_image_src( $thumbnail_id, 'wanium_grid_big' );
                        if ( isset($url[0]) && $url[0] ) {
                            ?><div class="background-content"><img src="<?php echo esc_url( $url[0] ) ?>" alt="<?php echo esc_attr( $next->post_title ) ?>" /></div><?php
                        } ?>
                        <div class="background-overlay"></div>
                        <div class="middle-holder right">
                            <div class="title">
                                <h5 class="widgettitle big-widgettitle mb16"><i class="fa fa-long-arrow-right"></i></h5>
                                <div class="widgetsubtitle small-widgetsubtitle mb16 uppercase-force"><?php esc_html_e( 'Next Project', 'wanium' ); ?></div>
                                <h5 class="widgettitle big-widgettitle"><?php echo esc_attr($next->post_title); ?></h5>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
<?php endif; ?>