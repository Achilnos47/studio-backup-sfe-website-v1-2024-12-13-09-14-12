<?php
/**
 * Theme Helper
 *
 * @package TLG Theme
 *
 */

/**
	REGISTER REQUIRED PLUGINS
**/
if( !function_exists('wanium_register_required_plugins') ) {
	function wanium_register_required_plugins() {
		$plugins = array(
			array( 
				'name' => esc_html__( 'TLG Framework', 'wanium' ),
				'slug' => 'tlg_framework',
				'source' => get_template_directory() . '/plugins/tlg_framework.zip',
				'required' => true,
				'force_activation' => false,
				'force_deactivation' => true,
				'version' => '2.4.3',
			),
			array( 
				'name' => esc_html__( 'WPBakery Page Builder for WordPress (formerly Visual Composer)', 'wanium' ),
				'slug' => 'js_composer',
				'source' => get_template_directory() . '/plugins/js_composer.zip',
				'required' => true,
				'force_activation' => false,
				'force_deactivation' => false,
				'version' => '6.10.0',
			),
			array( 
				'name' => esc_html__( 'Contact Form 7', 'wanium' ), 
				'slug' => 'contact-form-7', 
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
			),
			array( 
				'name' => esc_html__( 'WooCommerce', 'wanium' ), 
				'slug' => 'woocommerce', 
				'required' => false,
				'force_activation' => false,
				'force_deactivation' => false,
			),
		);
		tgmpa( $plugins, array( 'is_automatic' => true ) );
	}
	add_action( 'tgmpa_register', 'wanium_register_required_plugins' );
}
	

/**
	THE PAGE TITLE
**/
if( !function_exists( 'wanium_get_the_page_title' ) ) {
	function wanium_get_the_page_title( $args = array() ) {
		$output = $title = $subtitle = $image = $background = $size = $layout = false;
		extract( $args );
		$layout = $layout ? $layout : 'center';
		switch ( $layout ) {
			case 'center': $background = false; $image = false; $layout = 'center'; break;
			case 'center-large': $background = false; $image = false; $size = 'large'; $layout = 'center'; break;
			case 'center-bg': $background = 'image-bg overlay'; $layout = 'center'; break;
			case 'center-bg-large': $background = 'image-bg overlay'; $size = 'large'; $layout = 'center'; break;
			case 'center-parallax': $background = 'image-bg overlay parallax'; $layout = 'center'; break;
			case 'center-parallax-large': $background = 'image-bg overlay parallax'; $size = 'large'; $layout = 'center'; break;
			case 'left': $background = false; $image = false; $layout = 'left'; break;
			case 'left-large': $background = false; $image = false; $size = 'large'; $layout = 'left'; break;
			case 'left-bg': $background = 'image-bg overlay'; $layout = 'left'; break;
			case 'left-bg-large': $background = 'image-bg overlay'; $size = 'large'; $layout = 'left'; break;
			case 'left-parallax': $background = 'image-bg overlay parallax'; $layout = 'left'; break;
			case 'left-parallax-large': $background = 'image-bg overlay parallax'; $size = 'large'; $layout = 'left'; break;
			default: break;
		}
		$page_title_tag = get_option( 'tlg_framework_page_title_tag', 'h1' );
		if ( 'center' == $layout ) {
			$output = '<section class="page-title page-title-'.( 'large' == $size ? 'large-center' : 'center'  ).' '. esc_attr($background) .'">'.
							($image ? '<div class="background-content">'. $image .'</div>' : '').'
							<div class="container"><div class="row"><div class="col-sm-12 text-center">
					        	<'.$page_title_tag.' class="heading-title mb0">'. $title .'</'.$page_title_tag.'>
					        	<p class="lead fade-color mb0">'. $subtitle .'</p>
							</div></div></div>'. wanium_breadcrumbs() .'</section>';
		} elseif ( 'left' == $layout ) {
			$output = '<section class="page-title page-title-'.( 'large' == $size ? 'large' : 'basic'  ).' '. esc_attr($background) .'">'.
							($image ? '<div class="background-content">'. $image .'</div>' : '').'
							<div class="container"><div class="row">
								<div class="col-md-6">
					        		<'.$page_title_tag.' class="heading-title mb0">'. $title .'</'.$page_title_tag.'>
					        		<p class="lead fade-color mb0">'. $subtitle .'</p>
								</div>
								<div class="col-md-6 text-right pt8">'. wanium_breadcrumbs() .'</div>
							</div></div></section>';
		}
		return $output;
	}
}

/**
	GET PAGE TITLE LAYOUT
**/
if( !function_exists('wanium_get_page_title_layout') ) {
	function wanium_get_page_title_layout() {
		global $post;
		$layout = isset( $post->ID ) ? get_post_meta( $post->ID, '_tlg_page_title_layout', 1 ) : false;
		if( ! $layout || 'default' == $layout ) {
			$layout = get_option( 'wanium_page_layout', 'center' );
		}
		return $layout;	
	}
}

/**
	GET BODY LAYOUT
**/
if( !function_exists('wanium_get_body_layout') ) {
	function wanium_get_body_layout() {
		global $post;
		$layout = isset( $_GET['layout'] ) ? $_GET['layout'] : false;
		if( $layout ) {
			if( 'boxed' ==  $layout || 'boxed-layout' ==  $layout ) $layout = 'boxed-layout';
			elseif( 'border' ==  $layout || 'frame-layout' ==  $layout ) $layout = 'frame-layout';
			else $layout = 'normal-layout';
		} else {
			$layout = isset( $post->ID ) ? get_post_meta( $post->ID, '_tlg_layout_override', 1 ) : false;
			if( ! $layout || 'default' == $layout ) {
				$layout = get_option( 'wanium_site_layout', 'normal-layout' );
			}
		}
		return $layout;
	}
}

/**
	GET HEADER LAYOUT
**/
if( !function_exists('wanium_get_header_layout') ) {
	function wanium_get_header_layout() {
		global $post;
		$default_header = get_option( 'wanium_header_layout', 'standard' );
		$header = isset ($_GET['nav'] ) ? $_GET['nav'] : false;
		if( $header ) {
			return $header;
		}
		if( class_exists('Woocommerce') ) {
			if( is_shop() || is_product_category() || is_product_tag() ) {
				$shop_header = get_option( 'wanium_shop_menu_layout', 'default' );
				if( $shop_header && 'default' != $shop_header ) {
					return $shop_header;
				}
			}
		}
		if( is_home() || is_archive() || is_search() || ! isset( $post->ID ) ) {
			return $default_header;
		}
		$header = isset( $post->ID ) ? get_post_meta( $post->ID, '_tlg_header_override', 1 ) : false;
		if( ! $header || 'default' == $header ) {
			$header = $default_header;
		}
		return $header;	
	}
}

/**
	GET FOOTER LAYOUT
**/
if( !function_exists('wanium_get_footer_layout') ) {
	function wanium_get_footer_layout() {
		global $post;
		if( ! isset( $post->ID ) ) {
			return get_option( 'wanium_footer_layout', 'standard' );
		}
		$footer = isset( $post->ID ) ? get_post_meta( $post->ID, '_tlg_footer_override', 1 ) : false;
		if( ! $footer || 'default' == $footer || ( class_exists('Woocommerce') && ( is_shop() || is_product_category() || is_product_tag() ) ) ) {
			$footer = get_option( 'wanium_footer_layout', 'standard' );
		}
		return $footer;	
	}
}

/**
	GET SINGLE SIDEBAR LAYOUT
**/
if( !function_exists('wanium_get_single_sidebar_layout') ) {
	function wanium_get_single_sidebar_layout() {
		global $post;
		$sidebar = isset ($_GET['sb'] ) ? $_GET['sb'] : false;
		if( $sidebar ) return $sidebar;

		if( ! isset( $post->ID ) ) {
			return get_option( 'wanium_post_layout', 'sidebar-none' );
		}
		$sidebar = isset( $post->ID ) ? get_post_meta( $post->ID, '_tlg_single_sidebar_override', 1 ) : false;
		if( ! $sidebar || 'default' == $sidebar ) {
			$sidebar = get_option( 'wanium_post_layout', 'sidebar-none' );
		}
		return $sidebar;	
	}
}

/**
	GET POSTS CATEGORY
**/
if( !function_exists('wanium_get_posts_category') ) {
	function wanium_get_posts_category( $taxonomy = 'category' ) {
		$cats = array( esc_html__( 'Show all categories', 'wanium' ) => 'all' );
		$post_cats = get_categories( array( 'orderby' => 'name', 'hide_empty' => 0, 'hierarchical' => 1, 'taxonomy' => $taxonomy ) );
		if( is_array( $post_cats ) && count( $post_cats ) ) {
			foreach( $post_cats as $cat ) {
				if ( isset( $cat->name ) && isset( $cat->term_id ) ) {
					$cats[$cat->name] = $cat->term_id;
				}
			}
		}
		return $cats;
	}
}

/**
	GET PORTFOLIO LINK
**/
if( !function_exists('wanium_get_portfolio_link') ) {
	function wanium_get_portfolio_link( $class = '' ) {
		global $post;
		$link_prefix = '<a class="'.esc_attr($class).'" href="'.esc_url( get_permalink() ).'">';
		$link_sufix  = '</a>';
		$lightbox  = false;
		$gallery = isset ($_GET['gallery'] ) ? $_GET['gallery'] : false;
		$gallery_item = isset($post->ID) ? get_post_meta( $post->ID, '_tlg_portfolio_gallery', 1 ) : '';
		if ( $gallery || $gallery_item || 'yes' == get_option( 'wanium_portfolio_gallery', 'no' ) ) {
		    $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		    if ( isset($url[0]) && $url[0] ) {
		        $link_prefix = '<a class="'.esc_attr($class).'" href="'. esc_url($url[0]) .'" data-lightbox="true" data-title="'.get_the_title().'">';
		        $lightbox = true;
		    }
		} else {
		    $external_url = isset($post->ID) ? get_post_meta( $post->ID, '_tlg_portfolio_external_url', 1 ) : '';
		    if ($external_url) {
		        $target     = get_post_meta( $post->ID, '_tlg_portfolio_url_new_window', 1 )  ? '_blank' : '_self';
		        $rel        = get_post_meta( $post->ID, '_tlg_portfolio_url_nofollow', 1 )  ? 'nofollow' : '';
		        $link_prefix    = '<a class="'.esc_attr($class).'" href="'.esc_url( $external_url ).'" target="'.esc_attr($target).'" rel="'.esc_attr($rel).'">';
		    }
		}
		return array(
			'prefix' 	=> $link_prefix,
			'sufix' 	=> $link_sufix,
			'lightbox' 	=> $lightbox,
		);
	}
}

/**
	PORTFOLIO FILTERS
**/
if( !function_exists( 'wanium_portfolio_filters' ) ) {
	function wanium_portfolio_filters($project_id = '', $layout_full = false) {
		$output = '';
	    if (!empty($project_id)) {
	    	$terms = get_terms('portfolio_category');
	    	if (is_array($terms) && !empty($terms)) {
	    		if ($layout_full) {
	    			$wrapper = '<div class="text-center line-height-1">';
	    			$wrapper_end = '</div>';
	    			$class = "filters pt24 pb40 mb0";
	    		} else {
	    			$wrapper = '<div class="row"><div class="col-sm-12 text-center">';
	    			$wrapper_end = '</div></div>';
	    			$class = "filters mb0 pb40";
	    		}
		    	$output .= $wrapper.'<ul class="'.esc_attr($class).'" data-project-id="'.esc_attr($project_id).'">
		    		<li class="filter active" data-group="*">'.esc_html__( 'All', 'wanium' ).'</li>';
		    	foreach ($terms as $term) {
		    	$output .= '<li class="filter" data-group=".'. esc_attr(md5(sanitize_title($term->name))) .'">'. esc_html($term->name) .'</li>';
		        }
		    	$output .= '</ul>'.$wrapper_end;
		    }
	    }
	    return $output;
	}
}

/**
	PORTFOLIO FILTERS GROUP
**/
if( !function_exists( 'wanium_portfolio_filters_group' ) ) {
	function wanium_portfolio_filters_group() {
		global $post;
		$output = '';
		$categories = array();
		$terms = get_the_terms( $post->ID, 'portfolio_category');
		if (is_array($terms) && !empty($terms)) {
			foreach ($terms as $term) {
				$categories[] = md5(sanitize_title($term->name));
			}
			$output = implode(' ', $categories);
		}
		return $output;
	}
}

/**
	GET FONTS SETTING
**/
if( !function_exists('wanium_get_logo') ) {
	function wanium_get_logo() {
		global $post;
		$logo = get_option('wanium_custom_logo', WANIUM_THEME_DIRECTORY . 'assets/img/logo-dark.png');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_logo', true ) ) {
		    $logo = get_post_meta( $post->ID, '_tlg_logo', true );
		}
		$logo_light = get_option('wanium_custom_logo_light', WANIUM_THEME_DIRECTORY . 'assets/img/logo-light.png');
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_logo_light', true ) ) {
		    $logo_light = get_post_meta( $post->ID, '_tlg_logo_light', true );
		}
		$logo = preg_replace( '/^https?:/', '', $logo );
		$logo_light = preg_replace( '/^https?:/', '', $logo_light );
		$site_logo = get_option( 'wanium_site_logo', 'image' );
        $logo_text = get_option( 'wanium_logo_text', '' );
		return array(
			'logo' 			=> $logo,
			'logo_light' 	=> $logo_light,
			'site_logo' 	=> $site_logo,
			'logo_text' 	=> $logo_text,
		);
	}
}
/**
	GET FONTS SETTING
**/
if( !function_exists('wanium_get_fonts') ) {
	function wanium_get_fonts() {
		global $post;
		$body_font 		= wanium_parsing_fonts( get_option('wanium_font'), 'Roboto', 400 );
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_font_override', true ) ) {
		    $body_font = wanium_parsing_fonts( get_post_meta( $post->ID, '_tlg_font_override', true ), 'Roboto', 400 );
		}
		$heading_font 	= wanium_parsing_fonts( get_option('wanium_header_font'), 'Montserrat', 500 );
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_header_font_override', true ) ) {
		    $heading_font = wanium_parsing_fonts( get_post_meta( $post->ID, '_tlg_header_font_override', true ), 'Montserrat', 500 );
		}
		$subtitle_font 	= wanium_parsing_fonts( get_option('wanium_subtitle_font'), 'Poppins', 400 );
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_subtitle_font_override', true ) ) {
		    $subtitle_font = wanium_parsing_fonts( get_post_meta( $post->ID, '_tlg_subtitle_font_override', true ), 'Poppins', 400 );
		}
		$menu_font 		= wanium_parsing_fonts( get_option('wanium_menu_font'), 'Poppins', 400 );
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_menu_font_override', true ) ) {
		    $menu_font = wanium_parsing_fonts( get_post_meta( $post->ID, '_tlg_menu_font_override', true ), 'Poppins', 400 );
		}
		$button_font 	= wanium_parsing_fonts( get_option('wanium_button_font'), 'Poppins', 400 );
		if( isset( $post->ID ) && get_post_meta( $post->ID, '_tlg_button_font_override', true ) ) {
		    $button_font = wanium_parsing_fonts( get_post_meta( $post->ID, '_tlg_button_font_override', true ), 'Poppins', 400 );
		}
		return array(
			'body_font' 	=> $body_font,
			'heading_font' 	=> $heading_font,
			'subtitle_font' => $subtitle_font,
			'menu_font' 	=> $menu_font,
			'button_font' 	=> $button_font,
		);
	}
}

/**
	PARSING GOOGLE FONTS
**/
if( !function_exists('wanium_parsing_fonts') ) {
	function wanium_parsing_fonts( $gg_font = false, $default_font = '', $default_weight = 400 ) {
		$font = array(
			'name' 		=> $default_font,
			'weight' 	=> $default_weight,
			'style' 	=> 'normal',
			'url' 		=> false,
			'family' 	=> $default_font.':'.$default_weight.',100,300,400,400italic,600,700',
		);
		if ( $gg_font ) {
	        $parsing_font 	= explode( ':tlg:', $gg_font );
	        $font_style 	= isset($parsing_font[2]) ? $parsing_font[2] : '400';
	        if ( 'regular' == $font_style ) $font_style = '400';
	        if ( 'italic'  == $font_style ) $font_style = '400italic';
	        if ( isset($parsing_font[0]) && isset($parsing_font[1]) ) {
	        	$font = array(
					'name' 		=> $parsing_font[0],
					'url' 		=> $parsing_font[1],
					'weight' 	=> intval( $font_style ),
					'style' 	=> strpos( $font_style, 'italic' ) ? 'italic' : 'normal',
					'family' 	=> $parsing_font[0].':'.$font_style.',100,300,400,600,700',
				);
	        }
	    }
	    return $font;
	}
}

/**
	SANITIZE CUSTOMIZER OPTION
**/
if( !function_exists('wanium_sanitize') ) {
    function wanium_sanitize( $input ) {
        return $input;
    }
}

/**
	SANITIZE TITLE
**/
if( !function_exists( 'wanium_sanitize_title' ) ) {
	function wanium_sanitize_title($string) {
		$string = strtolower(str_replace(' ', '-', $string));
		$string = preg_replace('/[^A-Za-z\-]/', '', $string);
		return preg_replace('/-+/', '-', $string);
	}
}

/**
	CHECK BLOG PAGES
**/
if( !function_exists('wanium_is_blog_page') ) {
	function wanium_is_blog_page() {
	    global $post;
	    if ( ( is_home() || is_archive() || is_single() ) && 'post' == get_post_type($post) ) {
	    	return true;
	    }
	   	return false;
	}
}

/**
	GET PAGE CLASS
**/
if( !function_exists('wanium_the_page_class') ) {
	function wanium_the_page_class($class = '') {
	    echo !wanium_is_shop_page() ? esc_attr( 'post-content '.$class ) : esc_attr( 'shop-content'.(wanium_is_cart_empty() ? ' text-center' : '') );
	}
}

/**
	CHECK SHOP PAGES
**/
if( !function_exists('wanium_is_shop_page') ) {
	function wanium_is_shop_page() {
	    if( class_exists('Woocommerce') ) {
		    if ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() || is_woocommerce() ) {
		    	return true;
		    }
		}
	   	return false;
	}
}

/**
	CHECK CART EMPTY
**/
if( !function_exists('wanium_is_cart_empty') ) {
	function wanium_is_cart_empty() {
	    if( class_exists('Woocommerce') ) {
	    	global $woocommerce;
		    if( is_cart() && !$woocommerce->cart->get_cart_contents_count() ) return true;
		}
	   	return false;
	}
}

/**
	CHECK MOBILE DEVICES
**/
if( !function_exists('wanium_is_mobile') ) {
	function wanium_is_mobile() {
		$isMobile = false;
		if (function_exists('tlg_framework_setup')) {
			if (tlg_framework_is_mobile()) {
				$isMobile = true;
			}
		}
		return $isMobile;
	}
}

/**
	ALLOWED HTML TAGS
**/
if( !function_exists('wanium_allowed_tags') ) {
	function wanium_allowed_tags() {
		return array( 'a' => array( 'href' => array(), 'title' => array(), 'class' => array(), 'target' => array(), 'rel' => array(), 'data-lightbox' => array(), 'data-title' => array() ), 'br' => array(), 'em' => array(), 'i' =>  array( 'class' => array() ), 'u' => array(), 'strong' => array(), 'p' => array( 'class' => array() ), 'blockquote' => array( 'class' => array() ), 'cite' => array( 'class' => array() ) );
	}
}

/**
	DISPLAY HEADER SOCIAL ICONS
**/
if( !function_exists('wanium_header_social_icons') ) { 
	function wanium_header_social_icons() {
		$output = false;
		for( $i = 1; $i < 11; $i++ ) {
			if( get_option("wanium_header_social_url_$i") ) {
				$output .= '<li><a href="' . esc_url(get_option("wanium_header_social_url_$i")) . '" target="_blank">'.
						   '<i class="' . esc_attr(get_option("wanium_header_social_icon_$i")) . '"></i></a></li>';
			}
		} 
		return $output;
	}
}

/**
	DISPLAY FOOTER SOCIAL ICONS
**/
if( !function_exists('wanium_footer_social_icons') ) { 
	function wanium_footer_social_icons() {
		$output = false;
		for( $i = 1; $i < 11; $i++ ) {
			if( get_option("wanium_footer_social_url_$i") ) {
				$output .= '<li><a href="' . esc_url(get_option("wanium_footer_social_url_$i")) . '" target="_blank">'.
						   '<i class="' . esc_attr(get_option("wanium_footer_social_icon_$i")) . '"></i></a></li>';
			}
		} 
		return $output;
	}
}

/**
	PORTFOLIO UNLIMITED
**/
if( !function_exists( 'wanium_portfolio_unlimited' ) ) {
	function wanium_portfolio_unlimited( $query ) {
	    if ( !is_admin() && $query->is_main_query() && ( is_post_type_archive('portfolio') || is_tax('portfolio_category') ) ) {
	        $query->set( 'posts_per_page', '-1' );
	    }    
	    return;
	}
	add_action( 'pre_get_posts', 'wanium_portfolio_unlimited' );
}

/**
	PORTFOLIO TAXONOMY TERMS
**/
if( !function_exists( 'wanium_the_terms' ) ) {
	function wanium_the_terms( $cat, $sep, $value, $args = array() ) {	
		global $post;
		$terms = get_the_terms( $post->ID, $cat, '', $sep, '' );
		if( is_array($terms) ) {
			foreach( $terms as $term ) {
				$args[] = $value;	
			}
			$terms = array_map( 'wanium_get_term_name', $terms, $args );
			return implode( $sep, $terms);
		}
	}
}

/**
	PORTFOLIO GET TAXONOMY TERMS
**/
if( !function_exists('wanium_get_term_name') ) {
	function wanium_get_term_name( $term, $value ) { 
		if( 'slug' == $value ) {
			return $term->slug;
		} elseif( 'link' == $value ) {
			return '<a href="'.get_term_link( $term, 'portfolio_category' ).'">'.$term->name.'</a>';
		} else {
			return $term->name; 
		}
	}
}


/**
	BREADCRUMBS
**/
if( !function_exists('wanium_breadcrumbs') ) { 
	function wanium_breadcrumbs() {
		if ( is_front_page() || is_search() || 'no' == get_option( 'tlg_framework_show_breadcrumbs', 'yes' ) ) return;
		global $post;
		$post_type 	= get_post_type();
		$ancestors 	= array_reverse( get_post_ancestors( $post->ID ) );
		$before 	= '<ol class="breadcrumb breadcrumb-style">';
		$after 		= '</ol>';
		$home 		= '<li><a href="' . esc_url( home_url( "/" ) ) . '" class="home-link" rel="home">' . esc_html__( 'Home', 'wanium' ) . '</a></li>';
		$portfolio_slug = get_option( 'tlg_framework_portfolio_slug', 'portfolio' );
		if( 'portfolio' == $post_type ) {
			if( 'portfolio' != $portfolio_slug ) {
				$home  .= '<li class="active"><a href="' . esc_url( home_url( "/".$portfolio_slug."/" ) ) . '">' . ucwords(strtolower($portfolio_slug)) . '</a></li>';
			} else {
				$home  .= '<li class="active"><a href="' . esc_url( home_url( "/".$portfolio_slug."/" ) ) . '">' . esc_html__( 'Portfolio', 'wanium' ) . '</a></li>';
			}
		}
		if( 'team' == $post_type ) {
			$home  .= '<li class="active"><a href="' . esc_url( home_url( "/team/" ) ) . '">' . esc_html__( 'Team', 'wanium' ) . '</a></li>';
		}
		if( 'product' == $post_type && !(is_archive()) ) {
			$home  .= '<li class="active"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'wanium' ) . '</a></li>';
		} elseif( 'product' == $post_type && is_archive() ) {
			$home  .= '<li class="active">' . esc_html__( 'Shop', 'wanium' ) . '</li>';
		}
		$breadcrumb = '';
		if ( $ancestors ) {
			foreach ( $ancestors as $ancestor ) {
				$breadcrumb .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
			}
		}
		$blog_title = esc_html( get_option( 'tlg_framework_blog_title', esc_html__( 'Our Blog', 'wanium' ) ) );
		$blog_title_link = '';
		if (!empty($blog_title)) {
			$blog_title_link = '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . $blog_title . '</a></li>';
		}
		$category_link = '';
		if ( (is_category() || is_single()) &&'yes' == get_option( 'tlg_framework_show_breadcrumbs_cat', 'no' ) ) {
			$category = get_the_category($post->ID);
			if ( ! empty( $category ) ) {
				$category_link = '<li><a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->name ) . '</a></li>';
			}
		}
		if( wanium_is_blog_page() && is_single() ) {
			$breadcrumb .= $blog_title_link.$category_link.'<li class="active">' . esc_html( get_the_title( $post->ID ) ) . '</li>';
		} elseif( wanium_is_blog_page() ) {
			$breadcrumb .= $blog_title_link.$category_link;
		} elseif( is_post_type_archive('product') || is_archive() ) {
			// nothing
		} else {
			$product_cat = '';
			if ( 'yes' == get_option( 'tlg_framework_show_breadcrumbs_cat', 'no' ) ) {
				if ('product' == $post_type && is_single()) {
					$term_list = wp_get_post_terms($post->ID,'product_cat');
					if (!empty($term_list)) {
						$product_cat = '<li><a href="' . esc_url( get_term_link ($term_list[0]->term_id, 'product_cat') ) . '">' . esc_html( $term_list[0]->name ) . '</a></li>';
					}
				}
			}
			$breadcrumb .= $product_cat.'<li class="active">' . esc_html( get_the_title( $post->ID ) ) . '</li>';
		}
		if( 'team' == get_post_type() ) {
			rewind_posts();
		}
		return $before . $home . $breadcrumb . $after;
	}
}

/**
	PAGINATION
**/
if( !function_exists('wanium_pagination') ) {
	function wanium_pagination( $pages = '', $range = 2 ) {
		global $paged, $wp_query;
		$showitems 	= ($range * 2)+1;
		$output 	= '';
		if( empty($paged) ) {
			$paged = 1;
		}
		if( $pages == '' ) {
			$pages = $wp_query->max_num_pages;
			if( !$pages ) {
				$pages = 1;
			}
		}
		if( 1 != $pages ) {
			$output .= "<div class='text-center mt40'><ul class='pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
				$output .= "<li><a href='".esc_url(get_pagenum_link(1))."' aria-label='". esc_html__( 'Previous', 'wanium' ) ."'><span aria-hidden='true'>&laquo;</span></a></li> ";
			}
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					$output .= ($paged == $i)? "<li class='active'><a href='".esc_url(get_pagenum_link($i))."'>".$i."</a></li> ":"<li><a href='".esc_url(get_pagenum_link($i))."'>".$i."</a></li> ";
				}
			}
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
				$output .= "<li><a href='".esc_url(get_pagenum_link($pages))."' aria-label='". esc_html__( 'Next', 'wanium' ) ."'><span aria-hidden='true'>&raquo;</span></a></li> ";
			}
			$output.= "</ul></div>";
		}
		return $output;
	}
}

/**
	COMMENTS
**/
if( !function_exists('wanium_comment') ) {
	function wanium_comment( $comment, $args, $depth ) { 
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="entry-data mb--6">
				<figure class="entry-data-author">
					<?php echo get_avatar( $comment->comment_author_email, 40 ); ?>
				</figure>
				<div class="entry-data-summary">
					<span class="inline-block author-name"><?php echo get_comment_author_link() ?></span>
					<div class="display-block">
						<span class="inline-block"><?php echo get_comment_date( 'M d, Y' ) ?></span>
						<span class="middot-divider dot"></span>
						<span class="inline-block"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
					</div>
				</div>
			</div>
			<div class="comment-content">
				<?php echo wpautop( get_comment_text() ); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'wanium' ) ?></em></p>
				<?php endif; ?>	
			</div>
		<?php
	}
}

/**
	PINGS
**/
if( !function_exists('wanium_pings') ) {
	function wanium_pings($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	   		<div class="entry-data mb--6">
				<div class="entry-data-summary">
					<span class="inline-block author-name"><?php echo get_comment_author_link() ?></span>
					<div class="display-block">
						<span class="inline-block"><?php echo get_comment_date( 'M d, Y' ) ?></span>
					</div>
				</div>
			</div>
			<div class="comment-content">
				<?php echo wpautop( get_comment_text() ); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'wanium' ) ?></em></p>
				<?php endif; ?>	
			</div>
		<?php
	}
}