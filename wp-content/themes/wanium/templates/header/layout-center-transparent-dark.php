<?php
global $post;
if( !wanium_is_mobile() && ( ( isset($post->ID) && get_post_meta( $post->ID, '_tlg_header_boxed', 1 ) ) || 
    'yes' == get_option( 'wanium_header_boxed', 'no' ) ) ) {
    $header_layout_class = 'container container-sm-full';
} else {
    $header_layout_class = '';
}
$logos = wanium_get_logo();
?>
<div class="nav-container full-menu">
    <nav class="transparent absolute nav-dark">
    	<?php get_template_part( 'templates/header/inc', 'top-center' ); ?>
        <div class="nav-bar <?php echo esc_attr( $header_layout_class ); ?>">
            <div class="module left visible-sm visible-xs inline-block">
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
            <div class="row">
                <div class="text-left col-lg-1 module-group">
                    <?php
                    if( (!isset($post->ID) || (isset($post->ID) && !get_post_meta( $post->ID, '_tlg_menu_hide_cart', 1 ))) && 
                        'yes' == get_option( 'wanium_header_cart', 'yes' ) && class_exists( 'Woocommerce' ) ) {
                        get_template_part( 'templates/header/inc', 'cart' );
                    }
                    ?>
                </div>
                <div class="text-center col-lg-10 module-group">
                    <div class="module text-left">
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
                </div>
                <div class="text-right col-lg-1 module-group right">
                    <?php
                    if( (!isset($post->ID) || (isset($post->ID) && !get_post_meta( $post->ID, '_tlg_menu_hide_language', 1 ))) && 
                        'yes' == get_option( 'wanium_header_language', 'yes' ) && function_exists( 'icl_get_languages' ) ) {
                        get_template_part( 'templates/header/inc', 'language' );
                    }
                    if( (!isset($post->ID) || (isset($post->ID) && !get_post_meta( $post->ID, '_tlg_menu_hide_search', 1 ))) && 
                        'yes' == get_option( 'wanium_header_search', 'yes' ) ) {
                        get_template_part( 'templates/header/inc', 'search' );
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</div>