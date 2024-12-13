<?php 
/**
 * Theme Script
 *
 * @package TLG Theme
 *
 */

if( !function_exists('wanium_fonts_url') ) {
	function wanium_fonts_url() {
	    $fonts_url      = '';
	    $font_families  = array();
	    $fonts = wanium_get_fonts();
	    
	    /*
	    Translators: If there are characters in your language that are not supported
	    by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== _x( 'on', 'Body font: on or off', 'wanium' ) ) {
	    	$font_families[] = $fonts['body_font']['family'];
	    }
	    if ( 'off' !== _x( 'on', 'Heading font: on or off', 'wanium' ) ) {
	    	$font_families[] = $fonts['heading_font']['family'];
	    }
	    if ( 'off' !== _x( 'on', 'Subtitle font: on or off', 'wanium' ) ) {
	    	$font_families[] = $fonts['subtitle_font']['family'];
	    }
	    if ( 'off' !== _x( 'on', 'Menu font: on or off', 'wanium' ) ) {
	    	$font_families[] = $fonts['menu_font']['family'];
	    }
	    if ( 'off' !== _x( 'on', 'Button font: on or off', 'wanium' ) ) {
	    	$font_families[] = $fonts['button_font']['family'];
	    }
	    if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'wanium' ) ) {
	    	$font_families[] = 'Open Sans:400';
	    }

	    $query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	    return esc_url_raw( $fonts_url );
	}
}

if( !function_exists('wanium_load_scripts') ) {
	function wanium_load_scripts() {
		global $post;
		# FONT - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		wp_enqueue_style( 'wanium-google-fonts', wanium_fonts_url() );
		# CSS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		wp_enqueue_style( 'wanium-libs', WANIUM_THEME_DIRECTORY . 'assets/css/libs.css' );
		if( class_exists('bbPress') ) {
			wp_enqueue_style( 'wanium-bbpress', WANIUM_THEME_DIRECTORY . 'assets/css/bbpress.css' );
		}
		if (function_exists('tlg_framework_setup')) {
			wp_enqueue_style( 'wanium-theme-styles', WANIUM_THEME_DIRECTORY . 'assets/css/theme.less' );
		} else {
			wp_enqueue_style( 'wanium-theme-styles', WANIUM_THEME_DIRECTORY . 'assets/css/theme.min.css' );
		}
		wp_enqueue_style( 'wanium-style', get_stylesheet_uri() );
		# CUSTOM CSS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$custom_css = '';
		// sticky header
		if( 'no' == get_option( 'wanium_header_sticky', 'yes' ) ) {
		    $custom_css .= '.nav-container nav.fixed{position:absolute;}';
		}
		if( 'yes' == get_option( 'wanium_header_sticky_mobile', 'no' ) ) {
		    $custom_css .= '@media (max-width: 990px) {nav.absolute, nav.fixed{position:fixed!important;}.site-scrolled nav{background:#fff!important;top:0!important;}.site-scrolled nav .sub,.site-scrolled nav h1.logo,.site-scrolled nav .module.widget-wrap i{color:#252525!important;}.site-scrolled nav .logo-light{display:none!important;} .site-scrolled nav .logo-dark{display:inline-block!important;}}';
		}
		// gradient color
		$primary_gradient_color = get_option('wanium_color_primary_gradient', '');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_primary_gradient_color', true ) ) {
		    $primary_gradient_color = get_post_meta( $post->ID, '_tlg_primary_gradient_color', true );
		}
		if( $primary_gradient_color ) {
			$primary_color = get_option('wanium_color_primary', '#3897f0');
			if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_primary_color', true ) ) {
			    $primary_color = get_post_meta( $post->ID, '_tlg_primary_color', true );
			}
			$custom_css .= '.widget .title span, .widget .title cite, .widgettitle span, .widgettitle cite, .widgetsubtitle span, .widgetsubtitle cite, .lead span, .lead cite, .heading-title-standard span, .heading-title-standard cite, .heading-title-thin span, .heading-title-thin cite, .heading-title-bold span, .heading-title-bold cite, .primary-color, .primary-color a, .primary-color-hover:hover, .primary-color-hover:hover a, .primary-color-icon i, .primary-color-icon-hover:hover i, .primary-color .icon-link i{background: linear-gradient(to right, '.$primary_color.' 0%,'.$primary_gradient_color.' 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;}';
		}
		// menu color
		$menu_bgcolor = get_option('wanium_color_menu_bg', '');
		$menu_color = get_option('wanium_color_menu', '');
		if( $menu_bgcolor || $menu_color ) {
			$custom_css .= '.vertical-menu .side-menu, .vertical-menu .subnav{background:'.$menu_bgcolor.'!important;}.vertical-menu li,.vertical-menu li a{border:none!important;} .vertical-menu li i {color: '.$menu_color.'!important;}.vertical-menu,.vertical-menu .text-center,.vertical-menu [class*="vertical-"]{background:'.$menu_bgcolor.'!important;color:'.$menu_color.'!important;}.vertical-menu a,.vertical-menu li{color:'.$menu_color.'!important;}.offcanvas-container.bg-dark .menu-line .menu--line{background-color:'.$menu_color.'!important;}.nav-container nav:not(.transparent), .nav-container nav.transparent.nav-show, nav .menu > li ul { background: '.$menu_bgcolor.'!important;}.nav-container nav:not(.transparent) .nav-utility { border-bottom-color: '.$menu_bgcolor.'; color: '.$menu_color.'; }.nav-container nav:not(.transparent) .nav-utility .social-list a, .nav-container nav:not(.transparent) .menu li:not(.menu-item-btn) a, nav .menu > li > ul li a, .mega-menu .has-dropdown > a, .nav-container nav:not(.transparent) .widget-wrap.module i, nav .has-dropdown:after, nav .menu > li ul > .has-dropdown:hover:after, nav .menu > li > ul > li a i, .nav-container nav.transparent.nav-show .menu li:not(.menu-item-btn) a, .nav-container nav.transparent.nav-show .widget-wrap.module i, .nav-container nav:not(.transparent) h1.logo, .nav-container nav.transparent.nav-show h1.logo {opacity: 1!important; color: '.$menu_color.'!important;}@media (max-width: 990px) {.nav-container nav .module-group .menu > li > a, .nav-container nav .module-group .menu > li > span.no-link, .nav-container nav .module-group .widget-wrap a, .nav-container nav .module-group .widget-wrap .search {background-color: '.$menu_bgcolor.'!important; border: none;}.nav-container nav .module-group .menu > li > a, .nav-container nav .module-group .module.widget-wrap i, .nav-container nav .module-group .widget-wrap a,.nav-container nav .module-group .has-dropdown:after{color: '.$menu_color.'!important;}}';
		}
		wp_add_inline_style( 'wanium-style', get_option( 'wanium_custom_css', '' ).$custom_css );
		# JS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		wp_enqueue_script( 'bootstrap', WANIUM_THEME_DIRECTORY . 'assets/js/bootstrap.js', array('jquery'), false, true );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'equalheights', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.equalheights.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'smoothscroll', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.smooth-scroll.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'owlcarousel', WANIUM_THEME_DIRECTORY . 'assets/js/lib/owl.carousel.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'flexslider', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.flexslider-min.js', array('jquery'), false, true );
		wp_enqueue_script( 'social-share-counter', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.social-share-counter.js', array('jquery'), false, true );
		wp_enqueue_script( 'flickr-photo-stream', WANIUM_THEME_DIRECTORY . 'assets/js/lib/flickrPhotoStream.js', array('jquery'), false, true );
		wp_enqueue_script( 'jsparallax', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.parallax.js', array('jquery'), false, true );
		wp_enqueue_script( 'waypoint', WANIUM_THEME_DIRECTORY . 'assets/js/lib/waypoint.js', array('jquery'), false, true );
		wp_enqueue_script( 'counterup', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.counterup.js', array('jquery'), false, true );
		wp_enqueue_script( 'jslightbox', WANIUM_THEME_DIRECTORY . 'assets/js/lib/lightbox.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'mb-ytplayer', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.mb.YTPlayer.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'countdown', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.countdown.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'fluidvids', WANIUM_THEME_DIRECTORY . 'assets/js/lib/fluidvids.js', array('jquery'), false, true );
		wp_enqueue_script( 'jsmcustomscrollbar', WANIUM_THEME_DIRECTORY . 'assets/js/lib/jquery.mCustomScrollbar.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'modernizr', WANIUM_THEME_DIRECTORY . 'assets/js/lib/modernizr.js', array('jquery'), false, true );
		wp_enqueue_script( 'classie', WANIUM_THEME_DIRECTORY . 'assets/js/lib/classie.js', array('jquery'), false, true );
		wp_enqueue_script( 'animonscroll', WANIUM_THEME_DIRECTORY . 'assets/js/lib/animOnScroll.js', array('jquery'), false, true );
		wp_enqueue_script( 'gmap3', WANIUM_THEME_DIRECTORY . 'assets/js/lib/gmap3.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'isotope', WANIUM_THEME_DIRECTORY . 'assets/js/lib/isotope.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'jsphotoswipe', WANIUM_THEME_DIRECTORY . 'assets/js/lib/photoswipe.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'iscroll', WANIUM_THEME_DIRECTORY . 'assets/js/lib/iscroll.js', array('jquery'), false, true );
		wp_enqueue_script( 'fullpage', WANIUM_THEME_DIRECTORY . 'assets/js/lib/fullPage.js', array('jquery'), false, true );
		wp_enqueue_script( 'wanium-scripts', WANIUM_THEME_DIRECTORY . 'assets/js/scripts.js', array('jquery'), false, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_localize_script( 'wanium-scripts', 'wp_data', array(
			'wanium_ajax_url' 		=> admin_url( 'admin-ajax.php' ),
			'wanium_menu_height' 	=> get_option( 'wanium_menu_height', '64' ),
			'wanium_permalink' 		=> get_permalink(),
		));
	}
	add_action( 'wp_enqueue_scripts', 'wanium_load_scripts', 110 );
}

if( !function_exists('wanium_admin_load_scripts') ) {
	function wanium_admin_load_scripts() {
		# FONT - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -	
		wp_enqueue_style( 'wanium-google-fonts', wanium_fonts_url() );	
		wp_enqueue_style( 'wanium-fonts', WANIUM_THEME_DIRECTORY . 'assets/css/fonts.css' );
		# CSS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		wp_enqueue_style( 'wanium-admin-css', WANIUM_THEME_DIRECTORY . 'assets/css/admin.css' );
		$custom_css = '';
		if( 'no' == get_option( 'wanium_enable_portfolio', 'yes' ) ) {
			$custom_css .= '#menu-posts-portfolio,[data-element="tlg_portfolio"]{display:none!important;}';
		}
		if( 'no' == get_option( 'wanium_enable_team', 'yes' ) ) {
			$custom_css .= '#menu-posts-team,[data-element="tlg_team"]{display:none!important;}';
		}
		if( 'no' == get_option( 'wanium_enable_client', 'yes' ) ) {
			$custom_css .= '#menu-posts-client,[data-element="tlg_clients"]{display:none!important;}';
		}
		if( 'no' == get_option( 'wanium_enable_testimonial', 'yes' ) ) {
			$custom_css .= '#menu-posts-testimonial,[data-element="tlg_testimonial"]{display:none!important;}';
		}
		if( $custom_css ) {
			wp_add_inline_style( 'wanium-admin-css', $custom_css );
		}
		# JS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -		
		wp_enqueue_script( 'wanium-admin-js', WANIUM_THEME_DIRECTORY . 'assets/js/admin.js', array('jquery'), false, true );
	}
	add_action( 'admin_enqueue_scripts', 'wanium_admin_load_scripts', 200 );
}

if( !function_exists('wanium_less_vars') ) {
	function wanium_less_vars( $vars, $handle = 'wanium-theme-styles' ) {
		global $post;
		$primary_color = get_option('wanium_color_primary', '#3897f0');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_primary_color', true ) ) {
		    $primary_color = get_post_meta( $post->ID, '_tlg_primary_color', true );
		}
		$primary_text_color = get_option('wanium_color_primary_text', '#fff');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_primary_text_color', true ) ) {
		    $primary_text_color = get_post_meta( $post->ID, '_tlg_primary_text_color', true );
		}
		$light_color = get_option('wanium_color_light', '#f8f8f8');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_light_color', true ) ) {
		    $light_color = get_post_meta( $post->ID, '_tlg_light_color', true );
		}
		$header_text_transform = get_option('wanium_header_text_transform', 'capitalize');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_header_text_transform', true ) ) {
		    $header_text_transform = get_post_meta( $post->ID, '_tlg_header_text_transform', true );
		}
		$menu_text_transform = get_option('wanium_menu_text_transform', 'uppercase');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_menu_text_transform', true ) ) {
		    $menu_text_transform = get_post_meta( $post->ID, '_tlg_menu_text_transform', true );
		}
		$button_text_transform = get_option('wanium_button_text_transform', 'uppercase');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_button_text_transform', true ) ) {
		    $button_text_transform = get_post_meta( $post->ID, '_tlg_button_text_transform', true );
		}
		$menu_font_size = get_option('wanium_menu_font_size', '12');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_menu_font_size', true )) ) {
		    $menu_font_size = get_post_meta( $post->ID, '_tlg_menu_font_size', true );
		}
		$submenu_font_size = get_option('wanium_submenu_font_size', '11');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_submenu_font_size', true )) ) {
		    $submenu_font_size = get_post_meta( $post->ID, '_tlg_submenu_font_size', true );
		}
		$pagetitle_font_size = get_option('wanium_pagetitle_font_size', '79');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_pagetitle_font_size', true )) ) {
		    $pagetitle_font_size = get_post_meta( $post->ID, '_tlg_pagetitle_font_size', true );
		}
		$header_font_size = get_option('wanium_header_font_size', '40');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_header_font_size', true )) ) {
		    $header_font_size = get_post_meta( $post->ID, '_tlg_header_font_size', true );
		}
		$header_letter_spacing = get_option('wanium_header_letter_spacing', '-0.5');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_header_letter_spacing', true )) ) {
		    $header_letter_spacing = get_post_meta( $post->ID, '_tlg_header_letter_spacing', true );
		}
		$subtitle_font_size = get_option('wanium_subtitle_font_size', '18');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_subtitle_font_size', true )) ) {
		    $subtitle_font_size = get_post_meta( $post->ID, '_tlg_subtitle_font_size', true );
		}
		$subtitle_letter_spacing = get_option('wanium_subtitle_letter_spacing', '-0.5');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_subtitle_letter_spacing', true )) ) {
		    $subtitle_letter_spacing = get_post_meta( $post->ID, '_tlg_subtitle_letter_spacing', true );
		}
		$widget_font_size = get_option('wanium_widget_font_size', '12');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_widget_font_size', true )) ) {
		    $widget_font_size = get_post_meta( $post->ID, '_tlg_widget_font_size', true );
		}
		$menu_height = get_option('wanium_menu_height', '64');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_menu_height', true )) ) {
		    $menu_height = get_post_meta( $post->ID, '_tlg_menu_height', true );
		}
		$menu_wrap_width = get_option('wanium_menu_wrap_width', '100');
		if( isset( $post->ID ) && is_numeric(get_post_meta( $post->ID, '_tlg_menu_wrap_width', true )) ) {
		    $menu_wrap_width = get_post_meta( $post->ID, '_tlg_menu_wrap_width', true );
		}
		$fonts = wanium_get_fonts();
		$vars['body-font']       	 		= $fonts['body_font']['name'];
		$vars['body-font-weight']    		= $fonts['body_font']['weight'];
		$vars['body-font-style']   	 		= $fonts['body_font']['style'];
		$vars['heading-font']    	 		= $fonts['heading_font']['name'];
		$vars['heading-font-weight'] 		= $fonts['heading_font']['weight'];
		$vars['heading-font-style']  		= $fonts['heading_font']['style'];
		$vars['subtitle-font']    	 		= $fonts['subtitle_font']['name'];
		$vars['subtitle-font-weight']    	= $fonts['subtitle_font']['weight'];
		$vars['menu-font']    	 	 		= $fonts['menu_font']['name'];
		$vars['menu-font-weight']  	 		= $fonts['menu_font']['weight'];
		$vars['button-font']    	 		= $fonts['button_font']['name'];
		$vars['button-font-weight']  		= $fonts['button_font']['weight'];
		$vars['widget-font-weight']  		= ('100' == $fonts['heading_font']['weight']) ? '300' : $fonts['heading_font']['weight'];
		$vars['primary-text-color']  		= $primary_text_color;
		$vars['primary-color']   	 		= $primary_color;
		$vars['light-color']   	 	 		= $light_color;
		$vars['text-color']    	 	 		= get_option('wanium_color_text', '#737373');
		$vars['dark-color']      	 		= get_option('wanium_color_dark', '#262626');
		$vars['bg-dark-color']       		= get_option('wanium_color_bg_dark', '#1b1b1b');
		$vars['bg-graydark-color']   		= get_option('wanium_color_bg_graydark', '#1b1b1b');
		$vars['secondary-color'] 	 		= get_option('wanium_color_secondary', '#f4f4f4');
		$vars['menu-badge-color'] 	 		= get_option('wanium_color_menu_badge', '#fc1547');
		$vars['menu-wrap-width']   	 		= $menu_wrap_width.'%';
		$vars['menu-height']   		 		= $menu_height.'px';
		$vars['menu-column-width']   		= get_option('wanium_menu_column_width', '230').'px';
		$vars['menu-vertical-width'] 		= get_option('wanium_menu_vertical_width', '280').'px';
		$vars['menu-rmargin']   	 		= get_option('wanium_menu_right_space', '32').'px';
		$vars['menu-font-size']   	 		= $menu_font_size.'px';
		$vars['submenu-font-size']   		= $submenu_font_size.'px';
		$vars['pagetitle-font-size']    	= $pagetitle_font_size.'px';
		$vars['header-font-size']    		= $header_font_size.'px';
		$vars['header-letter-spacing']    	= $header_letter_spacing.'px';
		$vars['subtitle-font-size']    		= $subtitle_font_size.'px';
		$vars['subtitle-letter-spacing']    = $subtitle_letter_spacing.'px';
		$vars['widget-font-size']    		= $widget_font_size.'px';
		$vars['header-text']   	 	 		= $header_text_transform;
		$vars['menu-text']   	 	 		= $menu_text_transform;
		$vars['button-text']   	 	 		= $button_text_transform;
	    return $vars;
	}
	if (function_exists('tlg_framework_setup')) {
		add_filter( 'less_vars', 'wanium_less_vars', 10, 2 );
	}
}