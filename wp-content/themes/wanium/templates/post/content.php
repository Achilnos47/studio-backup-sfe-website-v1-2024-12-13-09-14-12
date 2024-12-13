<?php 
$format = get_post_format();
$sticky = is_sticky() ? '<span class="featured-stick">'.esc_html__( 'Featured', 'wanium' ).'</span>' : '';
?>
<div class="post-wrap mb64">
	<div class="inner-wrap border-none p0">
		<div class="inner-left">
			<div class="post-date">
				<div class="day"><?php echo get_the_time('d') ?></div>
				<div class="month"><?php echo get_the_time('M').' '.get_the_time('Y') ?></div>
			</div>
			<div class="entry-meta mt8 mb16 p0">
				<span class="block"><i class="ti-user"></i><?php the_author_posts_link() ?></span>
				<?php if ( has_category() ) : ?>
					<span class="block"><i class="ti-folder"></i><?php the_category( ',</span><span class="inline-block">' ) ?></span>
				<?php endif; ?>
				<?php if ( ! post_password_required() && 'yes' == get_option( 'wanium_blog_comment', 'yes' ) && ( comments_open() && get_comments_number() ) ) : ?>
					<span class="block"><i class="ti-comment"></i><?php comments_popup_link( esc_html__( '0 Comment', 'wanium' ), esc_html__( '1 Comment', 'wanium' ), esc_html__( '% Comments', 'wanium' ) ); ?></span>
				<?php endif; ?>
				<?php 
				if (function_exists('tlg_framework_setup')) {
					echo tlg_framework_like_display(); 
				}
				?>
			</div>
		</div>
		<div class="inner-right <?php echo esc_attr( $format ); ?>">
			<?php 
			if( 'quote' != $format && 'link' != $format ) { ?>
				<div class="post-title">
				    <?php the_title('<h3><a class="link-dark-title" href="'. esc_url(get_permalink()) .'">'.$sticky, '</a></h3>'); ?>
				</div><?php 
			}
			get_template_part( 'templates/post/format', $format );
			if( 'quote' != $format && 'link' != $format ) {
				the_excerpt(); ?>
				<div class="overflow-hidden">
					<div class="pull-left">
						<span class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'wanium' ); ?></a></span>
					</div>
				</div><?php
			}
			?>
		</div>
	</div>
</div>