<?php if ( post_password_required() ) return; ?>

<div class="comments" id="comments">
    <?php if( have_comments() ) : ?>
		<h6 class="widgettitle">
    		<?php comments_number( esc_html__( '0 Comment', 'wanium' ), esc_html__( '1 Comment', 'wanium' ), esc_html__( '% Comments', 'wanium' ) ); ?>
    	</h6>
		<ul id="singlecomments" class="comments-list">
			<?php wp_list_comments( 'type=comment&callback=wanium_comment' ); ?>
			<?php wp_list_comments( 'type=pings&callback=wanium_pings' ); ?>
		</ul>
	<?php endif;
	paginate_comments_links();
	if ( comments_open() ) {
		comment_form(
			array(
				'fields' => apply_filters( 'comment_form_default_fields', array(
				    'author' => '<div class="row"><div class="col-sm-4"><input type="text" id="author" name="author" placeholder="' . esc_html__( 'Name *', 'wanium' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" /></div>',
				    'email'  => '<div class="col-sm-4"><input name="email" type="text" id="email" placeholder="' . esc_html__( 'Email *', 'wanium' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div>',
				    'url'    => '<div class="col-sm-4"><input name="url" type="text" id="url" placeholder="' . esc_html__( 'Website', 'wanium' ) . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" /></div></div>')
				),
				'comment_field' 		=> '<textarea name="comment" placeholder="' . esc_html__( 'Your Comment Here', 'wanium' ) . '" id="comment" aria-required="true" rows="3"></textarea>',
				'cancel_reply_link' 	=> esc_html__( 'Cancel' , 'wanium' ),
				'comment_notes_before' 	=> '',
				'comment_notes_after' 	=> '',
				'label_submit' 			=> esc_html__( 'Submit' , 'wanium' )
			)
		);
	} else { ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wanium' ) ?></p>
	<?php } ?>
</div>