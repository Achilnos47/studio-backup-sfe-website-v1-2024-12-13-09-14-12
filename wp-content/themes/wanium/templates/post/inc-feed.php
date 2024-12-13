<?php 
$sticky = is_sticky() ? '<span class="featured-stick">'.esc_html__( 'Featured', 'wanium' ).'</span>' : '';
$format = get_post_format(); 
?>
<div class="feed-item pt48 pt-xs-0 mb96 mb-xs-32">
    <div class="row mb8 mb-xs-0 text-center">
        <div class="col-md-8 col-md-offset-2">
            <h6 class="entry-meta mb16 mb-xs-8"><?php echo get_the_time(get_option('date_format')) ?></h6>
            <?php the_title('<h3><a class="link-dark-title" href="'. esc_url(get_permalink()) .'">'.$sticky, '</a></h3>'); ?>
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-1 mb16 mb-phone-0">
        <?php get_template_part( 'templates/post/format', $format ); ?>
    </div>
    <div class="row mb8 mb-xs-16">
        <div class="col-md-6 col-md-offset-3 clearfloat">
            <div class="entry-meta mb8 mt-xs-32 border-bottom">
                <span class="inline-block"><i class="ti-user"></i><?php the_author_posts_link() ?></span>
                <?php if ( has_category() ) : ?>
                    <span class="inline-block mobile-hide"><i class="ti-folder"></i><?php the_category( ',</span><span class="inline-block">' ) ?></span>
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
        	<?php if( 'quote' != $format && 'link' != $format ) the_excerpt(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <span class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'wanium' ); ?></a></span>
        </div>
    </div>
</div>