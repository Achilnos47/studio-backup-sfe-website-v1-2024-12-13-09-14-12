<div class="post-wrap mb0 overflow-visible">
    <div class="inner-wrap">
        <div class="post-content">
            <?php 
            if ( has_post_thumbnail() && 'yes' == get_option( 'wanium_blog_show_feature', 'no' ) ) {
                the_post_thumbnail( 'full', array( 'class' => 'mb16' ) );
            }
            the_content(); wp_link_pages(); 
            ?>
        </div>
    </div>
    <div class="tags"><?php the_tags( '', ' ', '' ); ?></div>
    <?php if ( 'yes' == get_option( 'wanium_blog_author_info', 'yes' ) ) : ?>
    <div class="mt32">
        <?php get_template_part( 'templates/post/inc', 'header-single' ); ?>
    </div>
    <?php endif; ?>
    <div class="mt16 pb48 overflow-hidden">
        <div class="pull-left">
            <?php 
            if (function_exists('tlg_framework_setup')) {
                echo tlg_framework_like_display( 'btn btn-rounded btn-sm-sm btn-style-gray' ); 
            }
            ?>
            <?php if ( 'yes' == get_option( 'wanium_blog_comment', 'yes' ) ) : ?>
            <div class="btn btn-rounded btn-sm-sm btn-min-width btn-style-gray static-icon">
                <?php if ( post_password_required() ) : ?><span><?php endif; ?>
                <?php comments_popup_link( '<i class="ti-comment"></i><span>'.esc_html__( '0', 'wanium' ).'</span>', '<i class="ti-comment"></i><span>'.esc_html__( '1', 'wanium' ).'</span>', '<i class="ti-comment"></i><span>'.esc_html__( '%', 'wanium' ) ).'</span>'; ?>
                <?php if ( post_password_required() ) : ?></span><?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="pull-right"><?php get_template_part( 'templates/post/inc', 'sharing' ); ?></div>
    </div>
</div>
<?php
if ( 'yes' == get_option( 'wanium_blog_related', 'yes' ) ) {
    $tags = wp_get_post_tags( get_the_ID() );
    if ( $tags ) {
        $tag_ids = array();
        foreach( $tags as $individual_tag ) {
            $tag_ids[] = $individual_tag->term_id;
        }
        $args = array (
            'tag__in' => $tag_ids,
            'post__not_in' => array( $post->ID ),
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1,
            'orderby' => 'rand', 
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-quote', 'post-format-link' ),
                    'operator' => 'NOT IN'
                ),
            ),
        );
        $related_query = new  WP_Query( $args );
        if ( $related_query->have_posts() ) { ?>
            <div class="mt30">
                <h3 class="related-title"><?php esc_html_e( 'You may also like', 'wanium' ) ?></h3>
                <div class="related-blog grid-blog row mb48">
                    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <div class="col-sm-4 col-xs-12 mb32 mb-xs-24">
                        <?php get_template_part( 'templates/post/inc', 'content-boxed' ); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div><?php
        }
    }
}
wp_reset_postdata();
if ( 'yes' == get_option( 'wanium_blog_comment', 'yes' ) ) {
    comments_template();
}