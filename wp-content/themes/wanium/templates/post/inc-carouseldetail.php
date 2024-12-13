<?php
$format = get_post_format();
if( !has_post_thumbnail() || 'quote' == $format || 'link' == $format ) return false;
?>
<div class="post-wrap project">
    <div class="inner-wrap border-none p0 zoom-hover">
        <a href="<?php the_permalink(); ?>">
            <div class="post-image overflow-hidden mb16">
                <?php the_post_thumbnail( 'wanium_grid', array('class' => 'background-image') ); ?>
            </div>
        </a>
        <div class="text-center">
            <div class="entry-meta mt8 mb8 p0">
                <?php if ( has_category() ) : ?>
                    <span class="uppercase primary-color bold s-text spacing-text-s"><?php the_category( ',</span><span class="inline-block">' ) ?></span>
                <?php endif; ?>
            </div>
            <div class="post-title">
                <?php the_title('<h5 class="mb0 bold spacing-text-s"><a class="link-dark-title" href="'. esc_url(get_permalink()) .'">', '</a></h5>'); ?>
            </div>
        </div>
    </div>
</div>