<?php
global $post;
if( 'yes' == get_option( 'wanium_header_full', 'no' ) ) {
    $menu_class = 'full-menu';
} else {
    $menu_class = '';
}
if( !wanium_is_mobile() && ( ( isset($post->ID) && get_post_meta( $post->ID, '_tlg_header_boxed', 1 ) ) || 
    'yes' == get_option( 'wanium_header_boxed', 'no' ) ) ) {
    $header_layout_class = 'container container-sm-full';
    $menu_class = 'full-menu';
} else {
    $header_layout_class = '';
}
$logos = wanium_get_logo();
?>
<div class="nav-container <?php echo esc_attr( $menu_class ); ?>">
    <nav class="transparent absolute nav-dark">
    	<?php get_template_part( 'templates/header/inc', 'top' ); ?>
        <div class="nav-bar <?php echo esc_attr( $header_layout_class ); ?>">
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
            <div class="module widget-wrap mobile-toggle right visible-sm visible-xs">
                <i class="ti-menu"></i>
            </div>
            <div class="module-group right">
                <div class="module left">
                    <?php
            	    wp_nav_menu( 
            	    	array(
            		        'theme_location'    => 'primary',
            		        'depth'             => 3,
            		        'container'         => false,
            		        'container_class'   => false,
            		        'menu_class'        => 'menu',
            		        'fallback_cb'       => 'Wanium_Nav_Walker::fallback',
            		        'walker'            => new Wanium_Nav_Walker()
            	        )
            	    );
                    ?>
                </div>
				<?php get_template_part( 'templates/header/inc', 'icons' ); ?>
            </div>
        </div>
    </nav>
</div>