<footer class="footer-widget bg-graydark <?php echo ( !is_active_sidebar('footer1') && !is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4') ) ? 'p0' : '' ?> ">
    <div class="container">
        <div class="row">
        	<?php
        		if( is_active_sidebar('footer1') && !( is_active_sidebar('footer2') ) && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-sm-12">';
        				dynamic_sidebar('footer1');
        			echo '</div>';
        		}
        		if( is_active_sidebar('footer2') && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-sm-6">';
        				dynamic_sidebar('footer1');
        			echo '</div><div class="col-sm-6">';
        				dynamic_sidebar('footer2');
        			echo '</div><div class="clear"></div>';
        		}
        		if( is_active_sidebar('footer3') && !( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-md-4 col-sm-6">';
        				dynamic_sidebar('footer1');
        			echo '</div><div class="col-md-4 col-sm-6">';
        				dynamic_sidebar('footer2');
        			echo '</div><div class="col-md-4 col-sm-6">';
        				dynamic_sidebar('footer3');
        			echo '</div><div class="clear"></div>';
        		}
        		if( ( is_active_sidebar('footer4') ) ){
        			echo '<div class="col-md-3 col-sm-6">';
        				dynamic_sidebar('footer1');
        			echo '</div><div class="col-md-3 col-sm-6">';
        				dynamic_sidebar('footer2');
        			echo '</div><div class="col-md-3 col-sm-6">';
        				dynamic_sidebar('footer3');
        			echo '</div><div class="col-md-3 col-sm-6">';
        				dynamic_sidebar('footer4');
        			echo '</div><div class="clear"></div>';
        		}
        	?>
        </div>
    </div>
    <?php if ( 'yes' == get_option( 'wanium_enable_copyright', 'yes' ) ) : ?>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <span class="sub">
                        <?php echo wp_kses(get_option( 'wanium_footer_copyright', esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ) ), wanium_allowed_tags()); ?>
                    </span>
                </div>
                <div class="col-sm-6 text-right text-left-sm">
                    <ul class="list-inline social-list mt-xs-8">
                        <?php echo wanium_footer_social_icons(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</footer>