<?php
global $post;
$header_first 	= get_option('wanium_header_first', esc_html__( 'We create elegant websites', 'wanium' ) );
$header_second 	= get_option('wanium_header_second', esc_html__( '(012) 1006 2310', 'wanium' ) );
if( !wanium_is_mobile() && ( ( isset($post->ID) && get_post_meta( $post->ID, '_tlg_header_boxed', 1 ) ) || 
    'yes' == get_option( 'wanium_header_boxed', 'no' ) ) ) {
    $header_layout_class = 'container container-sm-full';
} else {
    $header_layout_class = '';
}
?>	
<div class="nav-utility <?php echo esc_attr( $header_layout_class ); ?>">
	<?php if( $header_first ) : ?>
	    <div class="module left">
	        <span class="sub"><?php echo wp_kses($header_first, wanium_allowed_tags()); ?></span>
	    </div>
    <?php endif; ?>
    <?php if( $header_second ) : ?>
	    <div class="module left">
	        <span class="sub"><?php echo wp_kses($header_second, wanium_allowed_tags()); ?></span>
	    </div>
    <?php endif; ?>
	<div class="module right">
		<ul class="list-inline social-list mb24">
            <?php echo wanium_header_social_icons(); ?>
        </ul>
    </div>
</div>