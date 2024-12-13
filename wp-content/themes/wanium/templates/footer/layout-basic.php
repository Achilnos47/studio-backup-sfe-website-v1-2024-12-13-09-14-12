<?php $logos = wanium_get_logo(); ?>
<footer class="footer-basic bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img alt="<?php echo esc_attr(get_bloginfo('title')); ?>" class="image-small mb32 fade-hover" src="<?php echo esc_url($logos['logo_light']); ?>" />
				</a>
				<?php if ( 'yes' == get_option( 'wanium_enable_copyright', 'yes' ) ) : ?>
				<p class="fade-75 mb32 sub"><?php echo wp_kses(get_option( 'wanium_footer_copyright', esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ) ), wanium_allowed_tags()); ?></p>
				<?php endif; ?>
				<ul class="list-inline social-list mb0"><?php echo wanium_footer_social_icons(); ?></ul>
			</div>
		</div>
	</div>
</footer>