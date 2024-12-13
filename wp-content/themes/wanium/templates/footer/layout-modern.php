<?php 
$logos 			= wanium_get_logo();
$header_first 	= get_option('wanium_header_first', esc_html__( 'We create elegant websites', 'wanium' ) );
$header_second 	= get_option('wanium_header_second', esc_html__( '(012) 1006 2310', 'wanium' ) );
?>
<footer class="footer-modern bg-dark pt48 pb40 pr-xs-15 pl-xs-15">
	<div class="row">
	    <div class="col-md-offset-1 col-md-3 col-sm-4 text-center-xs">
	    	<?php if( $header_first ) : ?>
	        <span class="sub mb8"><?php echo wp_kses($header_first, wanium_allowed_tags()); ?></span>
	        <?php endif; ?>
	        <span class="sub"><?php echo wp_kses(get_option( 'wanium_footer_copyright', esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ) ), wanium_allowed_tags()); ?></span>
	    </div>
	    <div class="col-sm-4 text-center mt-xx-24 mb-xx-24">
	        <a href="<?php echo esc_url(home_url('/')); ?>">
				<img alt="<?php echo esc_attr(get_bloginfo('title')); ?>" class="image-s fade-hover" src="<?php echo esc_url($logos['logo_light']); ?>" />
			</a>
	    </div>
	    <div class="col-md-3 col-sm-4 text-right text-center-xs">
	        <ul class="list-inline social-list mb16"><?php echo wanium_footer_social_icons(); ?></ul>
	        <?php if( $header_second ) : ?>
	        <span class="sub"><?php echo wp_kses($header_second, wanium_allowed_tags()); ?></span>
	        <?php endif; ?>
	    </div>
    </div>
</footer>