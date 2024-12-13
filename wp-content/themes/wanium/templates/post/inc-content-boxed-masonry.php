<?php 
$sticky = is_sticky() ? '<span class="featured-stick">'.esc_html__( 'Featured', 'wanium' ).'</span>' : '';
$format = get_post_format(); 
?>
<div class="boxed-intro overflow-hidden bg-white heavy-shadow zoom-hover">
    <?php 
    if( 'quote' == $format || 'link' == $format ) {
        get_template_part( 'templates/post/format', $format );
    } else {
        if ( has_post_thumbnail() || get_post_meta( $post->ID, '_tlg_title_bg_img', true ) ) : ?>
            <div class="intro-image overflow-hidden relative">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'full', array() ); ?>
                    <?php elseif (get_post_meta( $post->ID, '_tlg_title_bg_img', true )) : ?>
                        <img class="background-image" alt="<?php esc_html_e( 'post-image', 'wanium' ); ?>" src="<?php echo esc_url(get_post_meta( $post->ID, '_tlg_title_bg_img', true )) ?>" />
                    <?php endif; ?>
                    <?php if( 'video' == $format ) : ?>
                        <div class="play-button-wrap">
                            <div class="play-button dark inline"></div>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="intro-content">
            <div class="widgetsubtitle mb16"><?php the_category( ',</span><span class="inline-block">' ) ?></div>
            <a href="<?php the_permalink(); ?>">
                <?php the_title('<h5 class="widgettitle dark-color mb16">'.$sticky, '</h5>'); ?>
            </a>
            <?php if( 'quote' != $format && 'link' != $format ) the_excerpt(); ?>
            <div class="entry-meta mb8 mt-xs-32 border-top">
                <?php if ( has_category() ) : ?>
                    <span class="inline-block widgetsubtitle"><?php echo esc_html__( 'by ', 'wanium' ); the_author_posts_link() ?></span>
                <?php endif; ?>
                <?php if ( !post_password_required() && 'yes' == get_option( 'wanium_blog_comment', 'yes' ) && ( comments_open() || get_comments_number() ) ) : ?>
                    <span class="inline-block">
                        <span class="comments-link"><?php comments_popup_link( '<i class="ti-comment"></i>'.esc_html__( '0', 'wanium' ), '<i class="ti-comment"></i>'.esc_html__( '1', 'wanium' ), '<i class="ti-comment"></i>'.esc_html__( '%', 'wanium' ) ); ?></span>
                    </span>
                <?php endif; ?>
                <?php 
                if (function_exists('tlg_framework_setup')) {
                    echo tlg_framework_like_display(); 
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>