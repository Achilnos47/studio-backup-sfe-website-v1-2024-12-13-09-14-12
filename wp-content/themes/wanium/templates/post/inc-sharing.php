<?php
global $post;
$url[] = '';
$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
?>
<div class="ssc-share-wrap">
    <div class="clearfix relative">
        <a href="#" class="ssc-share-toogle">
            <i class="ti-share"></i>
            <span class="like-share-name"><?php esc_html_e( 'Share', 'wanium' ) ?></span>
        </a>
        <ul class="ssc-share-group">
            <li class="facebook-ssc-share" id="facebook-ssc"><a class="btn btn-rounded btn-sm-sm btn-style-facebook ti-facebook" rel="nofollow" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()) ?>&amp;t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>"><span id="facebook-count">0</span></a></li>
            <li class="twitter-ssc-share" id="twitter-ssc"><a class="btn btn-rounded btn-sm-sm btn-style-twitter ti-twitter-alt" rel="nofollow" href="https://twitter.com/share?text=<?php echo htmlspecialchars(urlencode(html_entity_decode(the_title_attribute( array( 'echo' => 0, 'post' => $post->ID ) ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>&amp;url=<?php echo urlencode(get_permalink()) ?>"><span id="twitter-count">0</span></a></li>
            <li class="googleplus-ssc-share" id="googleplus-ssc"><a class="btn btn-rounded btn-sm-sm btn-style-google ti-google" rel="nofollow" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()) ?>"><span id="googleplus-count">0</span></a></li>
            <li class="linkedin-ssc-share" id="linkedin-ssc"><a class="btn btn-rounded btn-sm-sm btn-style-linkedin ti-linkedin" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()) ?>&amp;title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>&amp;source=<?php echo esc_url( home_url( '/' )) ?>"><span id="linkedin-count">0</span></a></li>
            <li class="pinterest-ssc-share" id="pinterest-ssc"><a class="btn btn-rounded btn-sm-sm btn-style-pinterest ti-pinterest" rel="nofollow" href="https://pinterest.com/pin/create/bookmarklet/?url=<?php echo urlencode(get_permalink()) ?>&amp;media=<?php echo esc_url($url[0]); ?>&amp;description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>"><span id="pinterest-count">0</span></a></li>
        </ul>
    </div>
</div>