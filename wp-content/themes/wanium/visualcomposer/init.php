<?php
/**
 * Force Visual Composer (VC) to initialize as "built into the theme".
 * This will hide certain tabs under the Settings -> Visual Composer page
 */
if( !function_exists('wanium_vc_set_as_theme') ) {
	function wanium_vc_set_as_theme() {
		vc_set_as_theme(true);
	}
	add_action( 'vc_before_init', 'wanium_vc_set_as_theme' );
}

/**
 * Override directory where VC should look for template files for content elements
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	vc_set_shortcodes_templates_dir( get_template_directory() . '/visualcomposer/vc_templates/' );
}

/**
 * Add parammeters
 */
if( !function_exists('wanium_vc_add_params') && function_exists( 'vc_add_param' ) && function_exists( 'vc_remove_param' ) ) {
	function wanium_vc_add_params() {
# TLG-BLOG : Category - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('tlg_blog',  array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Blog category', 'wanium' ),
			'param_name' 	=> 'filter',
			'value' 		=> wanium_get_posts_category( 'category' )
		));
# TLG-SHOP : Category - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('tlg_shop',  array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Shop category', 'wanium' ),
			'param_name' 	=> 'filter',
			'value' 		=> wanium_get_posts_category( 'product_cat' )
		));		
# TLG-PORTFOLIO : Category - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('tlg_portfolio',  array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Portfolio category', 'wanium' ),
			'param_name' 	=> 'filter',
			'value' 		=> wanium_get_posts_category( 'portfolio_category' )
		));
# TLG-CLIENTS : Category - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('tlg_clients',  array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Client category', 'wanium' ),
			'param_name' 	=> 'filter',
			'value' 		=> wanium_get_posts_category( 'client_category' )
		));
# TLG-TESTIMONIALS : Category - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('tlg_testimonial',  array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Testimonial category', 'wanium' ),
			'param_name' 	=> 'filter',
			'value' 		=> wanium_get_posts_category( 'testimonial_category' )
		));
# TLG-TEAM : Category - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('tlg_team',  array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Team category', 'wanium' ),
			'param_name' 	=> 'filter',
			'value' 		=> wanium_get_posts_category( 'team_category' )
		));
# VC-ROW : Large Container  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Large container', 'wanium' ),
			'param_name' 	=> 'tlg_large_container',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 			=> '',
				esc_html__( 'Yes', 'wanium' ) 			=> 'wide-container'
			),
			'description' 	=> esc_html__( 'Enable larger container for this row.', 'wanium' ),
		));		
# VC-ROW : Background  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Row background color preset', 'wanium' ),
			'param_name' 	=> 'tlg_background_style',
			'value' 		=> array(
				esc_html__( 'Light', 'wanium' ) 		=> 'bg-light',
				esc_html__( 'Gray', 'wanium' ) 			=> 'bg-secondary',
				esc_html__( 'Dark', 'wanium' ) 			=> 'bg-dark',
				esc_html__( 'Highlight', 'wanium' ) 	=> 'bg-primary',
			),
			'description' 	=> esc_html__( 'Select a preset background for this row.', 'wanium' ),
		));
# VC-ROW : Padding  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Row padding', 'wanium' ),
			'param_name' 	=> 'tlg_padding',
			'value' 		=> array(
				esc_html__( 'Standard', 'wanium' ) 		=> '',
				esc_html__( 'Large', 'wanium' ) 		=> 'pt180 pb180 pt-xs-80 pb-xs-80',
				esc_html__( 'Small', 'wanium' ) 		=> 'pt64 pb64',
				esc_html__( 'No Top', 'wanium' ) 		=> 'pt0',
				esc_html__( 'No Bottom', 'wanium' ) 	=> 'pb0',
				esc_html__( 'None', 'wanium' ) 			=> 'pt0 pb0'
			),
			'description' 	=> esc_html__( 'Select a padding option for this row.', 'wanium' ),
		));		
# VC-ROW : White color  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Enable light color?', 'wanium' ),
			'param_name' 	=> 'tlg_white_color',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 			=> 'not-color',
				esc_html__( 'Yes', 'wanium' ) 			=> 'color-white',
			),
			'description' 	=> esc_html__( 'Enable light color for this row.', 'wanium' ),
		));
# VC-ROW : Background Overlay  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		vc_add_param('vc_row',array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Enable custom background overlay?', 'wanium' ),
			'class' 		=> '',
			'admin_label' 	=> false,
			'param_name' 	=> 'tlg_enable_overlay',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 	=> 'no',
				esc_html__( 'Yes', 'wanium' ) 	=> 'yes',
			),
			'description' 	=> esc_html__( 'Customize overlay background color.', 'wanium' ),
		));
		vc_add_param('vc_row', array(
			'type' 			=> 'colorpicker',
			'heading' 		=> esc_html__( 'Row overlay background color', 'wanium' ),
			'param_name' 	=> 'tlg_bg_overlay',
			'dependency' 	=> array('element' => 'tlg_enable_overlay','value' => array('yes')),
			'description' 	=> esc_html__( 'Select your overlay color. Leave empty to use default overlay color.', 'wanium' ),
		));
		vc_add_param('vc_row', array(
			'type' 			=> 'tlg_number',
			'heading' 		=> esc_html__( 'Row overlay value', 'wanium' ),
			'param_name' 	=> 'tlg_bg_overlay_value',
			'min' 			=> 1,
			'min' 			=> 10,
			'suffix' 		=> '',
			'dependency' 	=> array('element' => 'tlg_enable_overlay','value' => array('yes')),
			'description' 	=> esc_html__( 'Enter a number from 0 to 10. Leave empty to use the default overlay value.', 'wanium' ),
		));
		vc_add_param('vc_row', array(
			'type' 			=> 'colorpicker',
			'heading' 		=> esc_html__( 'Row gradient background color', 'wanium' ),
			'param_name' 	=> 'tlg_bg_gradient_color',
			'dependency' 	=> array('element' => 'tlg_enable_overlay','value' => array('yes')),
			'description' 	=> esc_html__( 'To use combine with row overlay background color.', 'wanium' ),
		));
# VC-ROW : Parallax  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Enable parallax?', 'wanium' ),
			'param_name' 	=> 'tlg_parallax',
			'value' 		=> array(
				esc_html__( 'Yes', 'wanium' ) 			=> 'overlay parallax',
				esc_html__( 'No', 'wanium' ) 			=> 'not-parallax'
			),
			'description' 	=> esc_html__( 'Enable parallax effect for this row (background image only).', 'wanium' ),
		));
# VC-ROW : Text Align  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Row text center alignment?', 'wanium' ),
			'param_name' 	=> 'tlg_text_align',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 			=> 'no',
				esc_html__( 'Yes', 'wanium' ) 			=> 'text-center'
			),
			'description' 	=> esc_html__( 'Center alignment for this row.', 'wanium' ),
		));
# VC-ROW : Vertical Align  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Row vertically middle alignment?', 'wanium' ),
			'param_name' 	=> 'tlg_vertical_align',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 			=> 'no',
				esc_html__( 'Yes', 'wanium' ) 			=> 'yes'
			),
			'description' 	=> esc_html__( 'Middle alignment for this row.', 'wanium' ),
		));
# VC-ROW : Equal height  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		vc_add_param('vc_row', array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Row equal height?', 'wanium' ),
			'param_name' 	=> 'tlg_equal_height',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 			=> 'not-equal',
				esc_html__( 'Yes', 'wanium' ) 			=> 'equal-height',
			),
			'description' 	=> esc_html__( 'Enable equal columns for this row.', 'wanium' ),
		));
# VC-ROW : Background video  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		vc_add_param('vc_row',array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Row background video style', 'wanium' ),
			'description' 	=> wp_kses( __( 'Select the kind of video background would you like to set for this row. <br>If you use background video here, please select also a background image (in "Design Options"), which will be displayed in case background video are restricted (fallback for mobile devices).', 'wanium' ), wanium_allowed_tags() ),
			'group' 		=> esc_html__( 'Background Video Options', 'wanium' ),
			'class' 		=> '',
			'admin_label' 	=> false,
			'param_name' 	=> 'tlg_bg_video_style',
			'value' 		=> array(
				esc_html__( 'No', 'wanium' ) 				=> 'no',
				esc_html__( 'YouTube video', 'wanium' ) 	=> 'youtube',
				esc_html__( 'Hosted video', 'wanium' ) 	=> 'video',
			),
		));
		vc_add_param('vc_row',array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Link to the video in MP4 format', 'wanium' ),
			'group' 		=> esc_html__( 'Background Video Options', 'wanium' ),
			'class' 		=> '',
			'param_name' 	=> 'tlg_bg_video_url',
			'value' 		=> '',
			'dependency' 	=> array('element' => 'tlg_bg_video_style','value' => array('video')),
		));
		vc_add_param('vc_row',array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Link to the video in WebM / Ogg format', 'wanium' ),
			'group' 		=> esc_html__( 'Background Video Options', 'wanium' ),
			'class' 		=> '',
			'param_name' 	=> 'tlg_bg_video_url_2',
			'value' 		=> '',
			'description' 	=> esc_html__( 'To display a video using HTML5, which works in the newest versions of all major browsers, you can serve your video in both WebM format and MPEG H.264 AAC format. You can upload the video through your Media Library.', 'wanium'),
			'dependency' 	=> array('element' => 'tlg_bg_video_style','value' => array('video')),
		));
		vc_add_param('vc_row',array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Enter YouTube video ID', 'wanium' ),
			'description' 	=> wp_kses( __( 'Eg: https://www.youtube.com/watch?v=lMJXxhRFO1k <br>Enter the video ID: "lMJXxhRFO1k"', 'wanium' ), wanium_allowed_tags() ),
			'group' 		=> esc_html__( 'Background Video Options', 'wanium' ),
			'class' 		=> '',
			'param_name' 	=> 'tlg_bg_youtube_url',
			'value' 		=> '',
			'dependency' 	=> array('element' => 'tlg_bg_video_style','value' => array('youtube')),
		));
# VC remove paramms  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		vc_remove_param('vc_row', 'video_bg');
		vc_remove_param('vc_row', 'video_bg_url');
		vc_remove_param('vc_row', 'video_bg_parallax');
		vc_remove_param('vc_row', 'parallax');
		vc_remove_param('vc_row', 'parallax_image');
		vc_remove_param('vc_row', 'parallax_speed_video');
		vc_remove_param('vc_row', 'parallax_speed_bg');
		vc_remove_param('vc_row', 'content_placement');
		vc_remove_param('vc_row', 'columns_placement');
		vc_remove_param('vc_row', 'equal_height');
		vc_remove_param('vc_row', 'gap');
		vc_remove_param('vc_row', 'rtl_reverse');
	}
	add_action('init', 'wanium_vc_add_params', 999);
}

/**
 * Auto activate VC Page Template
 */
if( !function_exists('wanium_vc_page_template') ) {
	function wanium_vc_page_template( $template ) {
		global $post;
		if ( is_archive() || is_404() || is_search() || ! isset( $post->post_content ) || 'no' == get_option( 'wanium_auto_vc_' . $post->post_type ) ) {
			return $template;
		}
		if ( has_shortcode( $post->post_content, 'vc_row') ) {
			$vc_page_template = locate_template( array( 'page_visualcomposer.php' ) );
			if ( '' != $vc_page_template )
				return $vc_page_template;
		}
		return $template;
	}
	add_filter( 'template_include', 'wanium_vc_page_template', 99 );
}

/**
 * Disable default VC shortcodes
 */
if( function_exists( 'vc_remove_element' ) && 'no' == get_option( 'wanium_enable_default_vc_shortcode', 'no' ) ) {
	vc_remove_element('vc_wp_search');
	vc_remove_element('vc_wp_meta');
	vc_remove_element('vc_wp_recentcomments');
	vc_remove_element('vc_wp_calendar');
	vc_remove_element('vc_wp_pages');
	vc_remove_element('vc_wp_tagcloud');
	vc_remove_element('vc_wp_custommenu');
	vc_remove_element('vc_wp_text');
	vc_remove_element('vc_wp_posts');
	vc_remove_element('vc_wp_links');
	vc_remove_element('vc_wp_categories');
	vc_remove_element('vc_wp_archives');
	vc_remove_element('vc_wp_rss');
	vc_remove_element('vc_gallery');
	vc_remove_element('vc_teaser_grid');
	vc_remove_element('vc_button');
	vc_remove_element('vc_cta_button');
	vc_remove_element('vc_posts_grid');
	vc_remove_element('vc_images_carousel');
	vc_remove_element('vc_separator');
	vc_remove_element('vc_text_separator');
	vc_remove_element('vc_message');
	vc_remove_element('vc_facebook');
	vc_remove_element('vc_tweetmeme');
	vc_remove_element('vc_googleplus');
	vc_remove_element('vc_pinterest');
	vc_remove_element('vc_toggle');
	vc_remove_element('vc_posts_slider');
	vc_remove_element('vc_button2');
	vc_remove_element('vc_cta_button2');
	vc_remove_element('vc_gmaps');
	vc_remove_element('vc_flickr');
	vc_remove_element('vc_progress_bar');
	// vc_remove_element('vc_pie');
	vc_remove_element('vc_hoverbox');
	vc_remove_element('vc_zigzag');
	vc_remove_element('vc_empty_space');
	vc_remove_element('vc_custom_heading');
	vc_remove_element('vc_basic_grid');
	vc_remove_element('vc_media_grid');
	vc_remove_element('vc_masonry_grid');
	vc_remove_element('vc_masonry_media_grid');
	vc_remove_element('vc_icon');
	vc_remove_element('vc_btn');
	vc_remove_element('vc_cta');
	vc_remove_element('vc_line_chart');
	vc_remove_element('vc_round_chart');
	vc_remove_element('vc_tta_tabs');
	vc_remove_element('vc_tta_tour');
	vc_remove_element('vc_tta_accordion');
}

/**
 * Disable Woocommerce VC shortcodes
 */
if( !function_exists('wanium_vc_remove_woocommerce') && 'no' == get_option( 'wanium_enable_default_wc_shortcode', 'yes' ) ) {
	function wanium_vc_remove_woocommerce() {
	    if (function_exists( 'vc_remove_element' ) && class_exists('Woocommerce')) {
	        vc_remove_element( 'woocommerce_cart' );
	        vc_remove_element( 'woocommerce_checkout' );
	        vc_remove_element( 'woocommerce_order_tracking' );
			vc_remove_element( 'woocommerce_my_account' );
			vc_remove_element( 'product' );
			vc_remove_element( 'products' );
			vc_remove_element( 'add_to_cart' );
			vc_remove_element( 'add_to_cart_url' );
			vc_remove_element( 'product_page' );
			vc_remove_element( 'product_categories' );
			vc_remove_element( 'product_attribute' );
			vc_remove_element( 'recent_products' );
			vc_remove_element( 'featured_products' );
			vc_remove_element( 'product_category' );
			vc_remove_element( 'sale_products' );
			vc_remove_element( 'best_selling_products' );
			vc_remove_element( 'top_rated_products' );
	    }
	}
	// Hook for admin editor.
	add_action( 'vc_build_admin_page', 'wanium_vc_remove_woocommerce', 11 );
	// Hook for frontend editor.
	add_action( 'vc_load_shortcode', 'wanium_vc_remove_woocommerce', 11 );
}