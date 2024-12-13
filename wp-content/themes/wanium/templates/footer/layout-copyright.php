<footer class="footer-widget bg-dark p0">
    <?php if ( 'yes' == get_option( 'wanium_enable_copyright', 'yes' ) ) : ?>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <span class="sub">
                        <?php echo wp_kses(get_option( 'wanium_footer_copyright', esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ) ), wanium_allowed_tags()); ?>
                    </span>
                </div>
                <div class="col-sm-6 text-right">
                    <ul class="list-inline social-list">
                        <?php echo wanium_footer_social_icons(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</footer>