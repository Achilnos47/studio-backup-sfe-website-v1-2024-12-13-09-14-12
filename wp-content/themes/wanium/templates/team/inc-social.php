<?php
global $post;
$icons = get_post_meta( $post->ID, '_tlg_team_social_icons', true );
?>
<?php if( is_array($icons) ) : ?>
	<ul class="list-inline social-list social-icons text-center">
		<?php 
			foreach( $icons as $key => $icon ){
				if(!( isset( $icon['_tlg_team_social_icon_url'] ) ))
					continue;
				echo '<li><a href="'. esc_url($icon['_tlg_team_social_icon_url']) .'" target="_blank"><i class="icon '. esc_attr($icon['_tlg_team_social_icon']) .'"></i></a></li>';
			}
		?>
	</ul>	
<?php endif; ?>