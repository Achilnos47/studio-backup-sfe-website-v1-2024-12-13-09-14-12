<?php $logos = wanium_get_logo(); ?>
<div class="show-sm">
	<?php get_template_part( 'templates/header/layout', 'standard-no-top' ); ?>
</div>
<div class="nav-container left-menu vertical-menu hide-sm">
	<nav class="absolute side-menu height-full">
		<div class="text-center bg-white pl-32 pr-32 height-full">
			<div class="vertical-top-no bg-white above pt40 pb24">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php if( $logos['logo_text'] && 'text' == $logos['site_logo'] ) : ?>
                        <h1 class="logo"><?php echo esc_attr($logos['logo_text']); ?></h1>
                    <?php else: ?>
					<img class="mb40 mb-xs-24" alt="<?php echo esc_attr(get_bloginfo('title')); ?>" src="<?php echo esc_url($logos['logo']); ?>" />
					<?php endif; ?>
				</a>
			</div>
			<div class="vertical-alignment-no ml--32 mr--32 text-left">
				<?php
			    wp_nav_menu(
			    	array(
				        'theme_location'    => 'primary',
				        'depth'             => 3,
				        'container'         => false,
				        'container_class'   => false,
				        'menu_class'        => 'mb40 mb-xs-24 offcanvas-menu',
				        'fallback_cb'       => 'Wanium_Nav_Walker::fallback',
				        'walker'            => new Wanium_Nav_Walker()
			        )
			    );
				?>
			</div>
			<div class="vertical-bottom-no bg-white above pt24 pb24">
				<?php if ( 'yes' == get_option( 'wanium_enable_copyright', 'yes' ) ) : ?>
					<div class="heading-font s-text"><?php echo wpautop(wp_kses(get_option( 'wanium_footer_copyright', esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ) ), wanium_allowed_tags())); ?></div>
				<?php endif; ?>
				<ul class="list-inline social-list text-left"><?php echo wanium_header_social_icons(); ?></ul>
			</div>
		</div>
	</nav>
</div>