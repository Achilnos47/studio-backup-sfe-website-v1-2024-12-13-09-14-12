<?php 
$logos = wanium_get_logo();
$header_first 	= get_option('wanium_header_first', esc_html__( 'We create elegant websites', 'wanium' ) );
$header_second 	= get_option('wanium_header_second', esc_html__( '(012) 1006 2310', 'wanium' ) );
?>
<div class="show-xs">
	<?php get_template_part( 'templates/header/layout', 'standard-no-top' ); ?>
</div>
<div class="nav-container vertical-menu hide-xs">
	<nav class="absolute transparent">
		<div class="nav-bar">
			<div class="module left">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php if( $logos['logo_text'] && 'text' == $logos['site_logo'] ) : ?>
                        <h1 class="logo"><?php echo esc_attr($logos['logo_text']); ?></h1>
                    <?php else: ?>
				    <img class="logo logo-light" alt="<?php echo esc_attr(get_bloginfo('title')); ?>" src="<?php echo esc_url($logos['logo_light']); ?>" />
                    <img class="logo logo-dark" alt="<?php echo esc_attr(get_bloginfo('title')); ?>" src="<?php echo esc_url($logos['logo']); ?>" />
                    <?php endif; ?>
				</a>
			</div>
			<div class="module widget-wrap offcanvas-toggle right">
				<!-- <i class="ti-menu"></i> -->
				<div class="menu-line is-inactive">
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
				</div>
			</div>
		    <?php if( $header_first ) : ?>
			    <div class="module right">
			        <span class="sub"><?php echo wp_kses($header_first, wanium_allowed_tags()); ?></span>
			    </div>
		    <?php endif; ?>
		</div>
		<div class="offcanvas-container text-center">
			<div class="close-nav"><a href="#">
				<!-- <i class="ti-close"></i> -->
				<div class="menu-line is-active">
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
					<span class="menu--line"><span></span></span>
				</div>
			</a></div>
			<div class="vertical-alignment-no text-center mt120">
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
			<div class="vertical-bottom-no bg-white above pt24 pb96">
				<?php if ( 'yes' == get_option( 'wanium_enable_copyright', 'yes' ) ) : ?>
					<div class="heading-font s-text"><?php echo wpautop(wp_kses(get_option( 'wanium_footer_copyright', esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ) ), wanium_allowed_tags())); ?></div>
				<?php endif; ?>
				<ul class="list-inline social-list"><?php echo wanium_header_social_icons(); ?></ul>
			</div>
		</div>
	</nav>
</div>