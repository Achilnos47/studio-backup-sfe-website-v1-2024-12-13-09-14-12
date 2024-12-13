<?php
/**
 * Theme Filter
 *
 * @package TLG Theme
 *
 */

/**
	BODY CLASSES
**/
if( !function_exists('wanium_body_classes') ) {
	function wanium_body_classes( $classes ) {
		$classes[] = wanium_get_body_layout();
		if ( 'yes' == get_option( 'wanium_enable_preloader', 'no' ) ) {
			$classes[] = 'loading';
		}
		if ( 'yes' == get_option( 'wanium_enable_blur_overlay', 'no' ) ) {
			$classes[] = 'blur_overlay';
		}
		return $classes;
	}
	add_filter( 'body_class', 'wanium_body_classes' );
}

/**
	REMOVE WHITESPACE FROM EXPERT
**/
if( !function_exists('wanium_excerpt_length') ) {
	function wanium_excerpt_trim( $excerpt ) {
	    return preg_replace( '~^(\s*(?:&nbsp;)?)*~i', '', $excerpt );
	}
	add_filter( 'get_the_excerpt', 'wanium_excerpt_trim', 999 );
}

/**
	EXPERT DEFAULT MORE
**/
if( !function_exists('wanium_excerpt_more') ) {
	function wanium_excerpt_more( $more ) {
		return esc_html__( '...', 'wanium' );
	}
	add_filter( 'excerpt_more', 'wanium_excerpt_more' );
}

/**
	EXPERT DEFAULT LENGTH
**/
if( !function_exists('wanium_excerpt_length') ) {
	function wanium_excerpt_length( $length ) {
		return get_option( 'wanium_blog_excerpt_length', 16 );
	}
	add_filter( 'excerpt_length', 'wanium_excerpt_length', 999 );
}


/**
	REMOVE MORE LINK
**/
if( !function_exists('wanium_remove_more_link_scroll') ) { 
	function wanium_remove_more_link_scroll( $link ) {
		return preg_replace( '|#more-[0-9]+|', '', $link );
	}
	add_filter( 'the_content_more_link', 'wanium_remove_more_link_scroll' );
}

/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
if( !function_exists('wanium_gutenberg_styles') ) { 
	function wanium_gutenberg_styles() {
		wp_enqueue_style( 'wanium-gutenberg', WANIUM_THEME_DIRECTORY . 'assets/css/gutenberg.css');
		$custom_css = '';
		$primary_color = get_option('wanium_color_primary', '#3897f0');
		$light_color = get_option('wanium_color_light', '#f8f8f8');
		$text_color = get_option('wanium_color_text', '#737373');
		$dark_color = get_option('wanium_color_dark', '#262626');
		$body_font = wanium_parsing_fonts( get_option('wanium_font'), 'Roboto', 400 );
		$heading_font = wanium_parsing_fonts( get_option('wanium_header_font'), 'Montserrat', 500 );
		$subtitle_font = wanium_parsing_fonts( get_option('wanium_subtitle_font'), 'Poppins', 400 );
		$custom_css .= 'body.block-editor-page .wp-block-preformatted pre, body.block-editor-page .wp-block-verse pre{border-left-color:'.$primary_color.'}';
		$custom_css .= 'body.block-editor-page .wp-block-pullquote, body.block-editor-page .wp-block-quote, body.block-editor-page .wp-block-quote:not(.is-large):not(.is-style-large) {background-color:'.$primary_color.'}';
		$custom_css .= 'body.block-editor-page .editor-styles-wrapper a, body.block-editor-page .editor-styles-wrapper a em, body.block-editor-page .editor-styles-wrapper a strong{color:'.$primary_color.'}';
		$custom_css .= 'body.block-editor-page .editor-styles-wrapper {background-color:'.$light_color.';color:'.$text_color.'}';
		$custom_css .= 'body.block-editor-page .edit-post-visual-editor p.wp-block-subhead{color:'.$text_color.'}';
		$custom_css .= 'body.block-editor-page editor-post-title__input, body.block-editor-page .editor-post-title__block .editor-post-title__input, body.block-editor-page .editor-styles-wrapper h1, body.block-editor-page .editor-styles-wrapper h2, body.block-editor-page .editor-styles-wrapper h3, body.block-editor-page .editor-styles-wrapper h4, body.block-editor-page .editor-styles-wrapper h5, body.block-editor-page .editor-styles-wrapper h6 {font-family: '.$heading_font['name'].';color:'.$dark_color.'}';
		$custom_css .= 'body.block-editor-page .wp-block-pullquote, body.block-editor-page .wp-block-quote, body.block-editor-page .wp-block-quote:not(.is-large):not(.is-style-large) {font-family: '.$subtitle_font['name'].';}';
		$custom_css .= 'body.block-editor-page .editor-styles-wrapper, body.block-editor-page .wp-block-quote cite, body.block-editor-page .wp-block-quote footer, body.block-editor-page .wp-block-quote__citation{font-family: '.$body_font['name'].';}';
		if (!empty($custom_css)) {
			wp_add_inline_style( 'wanium-gutenberg', $custom_css );
		}
	}
	add_action( 'enqueue_block_editor_assets', 'wanium_gutenberg_styles' );
}

/**
	ADD CLEARFIX TO END CONTENT
**/
if( !function_exists('wanium_add_clearfix') ) { 
	function wanium_add_clearfix( $content ) { 
		if( is_single() ) {
	   		$content .= '<div class="clearfix"></div>';
		}
	    return $content;
	}
	add_filter( 'the_content', 'wanium_add_clearfix' );
}

/**
	NAV MENU SELECTED
**/
if( !function_exists('wanium_wp_nav_menu_args') ) {
	function wanium_wp_nav_menu_args( $args = '' ) {
		global $post;
		$selected_menu_id = null;
		if (class_exists('Woocommerce')) {
			if (is_woocommerce() || is_cart() || is_checkout()) {
				$shop_menu_id = get_option( 'wanium_shop_menu_override', '' );
				if (!empty($shop_menu_id)) {
					$selected_menu_id = $shop_menu_id;
				}
			}
		}
		if (isset($post->ID)) {
			$custom_menu_id = get_post_meta( $post->ID, '_tlg_menu_override', 1 );
			if (!empty($custom_menu_id)) {
				$selected_menu_id = $custom_menu_id;
			}
		}
		if (!empty($selected_menu_id) && is_nav_menu( $selected_menu_id ) && 'primary' == $args['theme_location'] ) {
			$args['theme_location'] = false;
			$args['menu'] = $selected_menu_id;
		}
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'wanium_wp_nav_menu_args' );
}

/**
	SEARCH FILTER FOR POST ONLY
**/
if( !function_exists('wanium_search_filter') && 'yes' == get_option( 'wanium_enable_search_filter', 'yes' ) ) { 
	function wanium_search_filter( $query ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', array('post', 'product') );
		}
		return $query;
	}
	add_filter('pre_get_posts','wanium_search_filter');
}

/**
	FIX FOR EASY GOOGLE FONT PLUGIN USERS
**/
if( !function_exists('wanium_force_styles') ) { 
	function wanium_force_styles( $force_styles ) {
	    return true;
	}
	add_filter( 'tt_font_force_styles', 'wanium_force_styles' );
}

/**
	CUSTOM MEDIA GALLERY STYLE
**/
if( !function_exists('wanium_add_gallery_settings') ) { 
	function wanium_add_gallery_settings() { ?>
		<script type="text/html" id="tmpl-tlg_gallery-setting">
			<label class="setting">
				<span><?php esc_html_e('Layout', 'wanium'); ?></span>
				<select data-setting="layout">
					<option value="default"><?php esc_html_e( '(default)', 'wanium' ); ?></option>
					<option value="slider"><?php esc_html_e( 'Slider', 'wanium' ); ?></option>
					<option value="slider-padding"><?php esc_html_e( 'Slider Featured (Stretch Row layout only)', 'wanium' ); ?></option>
					<option value="slider-thumb"><?php esc_html_e( 'Slider Thumbnail', 'wanium' ); ?></option>
					<option value="lightbox"><?php esc_html_e( 'Lightbox Grid', 'wanium' ); ?></option>
					<option value="lightbox-fullwidth"><?php esc_html_e( 'Lightbox Grid Fullwidth', 'wanium' ); ?></option>
					<option value="masonry"><?php esc_html_e( 'Lightbox Masonry', 'wanium' ); ?></option>
					<option value="masonry-flip"><?php esc_html_e( 'Lightbox Masonry Flip', 'wanium' ); ?></option>
					<option value="masonry-flip-photoswipe"><?php esc_html_e( 'Lightbox Masonry PhotoSwipe', 'wanium' ); ?></option>
					<option value="fullwidth"><?php esc_html_e( 'Full Width', 'wanium' ); ?></option>
				</select>
			</label>
		</script>
		<script>
			jQuery(document).ready(function() {
				jQuery.extend(wp.media.gallery.defaults, { layout: 'default' });
				wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
					template: function(view) {
					  return wp.media.template('gallery-settings')(view) + wp.media.template('tlg_gallery-setting')(view);
					}
				});
			});
		</script>
	<?php
	}
	add_action( 'print_media_templates', 'wanium_add_gallery_settings' );
}

/**
	CUSTOM POST GALLERY STYLE
**/
if( !function_exists('wanium_post_gallery') ) {
	function wanium_post_gallery( $output, $attr) {
		global $post, $wp_locale;
	    static $instance = 0; $instance++;
	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post->ID,
	        'itemtag'    => 'div',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 3,
	        'size'       => 'large',
	        'include'    => '',
	        'exclude'    => '',
	        'layout'     => ''
	    ), $attr));
	    $output = $image = '';
	    if ( 'RAND' == $order ) $orderby = 'none';
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) $attachments[$val->ID] = $_attachments[$key];
	    } elseif ( empty($exclude) ) {
	    	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }
	    if ( empty($attachments) ) return '';
	    switch ($layout) {
	    	case 'slider':
	    		if ( is_rtl() ) {
		    		$output = '<div class="clearfix mt16 mt0-vc"><ul class="carousel-one-item-rtl carousel-olw-nav slides post-slider">';
		    	} else {
		    		$output = '<div class="clearfix mt16 mt0-vc"><ul class="carousel-one-item carousel-olw-nav slides post-slider">';
		    	}
	    		foreach ( $attachments as $id => $attachment ) {
	    			$url = wp_get_attachment_image_src($id, 'wanium_grid_big');
	    			if ( isset($url[0]) && $url[0] ) {
	    				$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_caption = $img_caption ? '<div class="bg-mask mask-none"><div class="mask-desc"><h4 class="color-white">'.$img_caption.'</h4></div></div>' : '';
		    		    $output .= '<li class="bg-overlay move-cursor"><img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />'.$img_caption.'</li>';
	    			}
	    		}
		    	$output .= '</ul></div>';
	    		break;

	    	case 'slider-padding':
	    		if ( is_rtl() ) {
	    			$output = '<div class="clearfix mt16 mt0-vc hide-icon"><div class="carousel-padding-item-rtl slides move-cursor">';
	    		} else {
	    			$output = '<div class="clearfix mt16 mt0-vc hide-icon"><div class="carousel-padding-item slides move-cursor">';
	    		}
	    		foreach ( $attachments as $id => $attachment ) {
	    			$url = wp_get_attachment_image_src($id, 'full');
	    			if ( isset($url[0]) && $url[0] ) {
	    				$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_caption = $img_caption ? '<div class="bg-mask mask-none"><div class="mask-desc"><h4 class="color-white">'.$img_caption.'</h4></div></div>' : '';
	    		    	$output .= '<div class="bg-overlay move-cursor"><img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />'.$img_caption.'</div>';
	    			}
	    		}
	    		$output .= '</div></div>';
	    		break;

	    	case 'slider-thumb':
	    		if ( is_rtl() ) {
	    			$output = '<div class="clearfix slider-thumb-rtl mt16 mt0-vc"><ul class="slides">';
	    		} else {
	    			$output = '<div class="clearfix slider-thumb mt16 mt0-vc"><ul class="slides">';
	    		}
	    		foreach ( $attachments as $id => $attachment ) {
	    			$url = wp_get_attachment_image_src($id, 'wanium_grid_big');
	    			if ( isset($url[0]) && $url[0] ) {
	    		    	$output .= '<li><img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" /></li>';
	    			}
	    		} 
		    	$output .= '</ul></div>';
	    		break;

	    	case 'masonry':
	    		$output = '<div><ul class="row masonry masonry-show project-masonry-full hide-icon" data-gallery-title="'. esc_attr(get_the_title()) .'">';
		    	foreach ( $attachments as $id => $attachment ) {
		    		$url = wp_get_attachment_image_src($id, 'full');
		    		if ( isset($url[0]) && $url[0] ) {
		    			$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_desc = isset($img_meta['description']) ? $img_meta['description'] : '';
		    	    	$output .= '<li class="'.( 3 == $columns ? 'col-sm-4' : 'col-sm-3' ).' masonry-item project p0 m0 plus-cursor">
		    	    					<a href="'. esc_url($url[0]) .'" data-lightbox="true" data-title="'.esc_attr($img_caption).'">
											<div class="image-box hover-meta plus-cursor text-center">
											    <img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />
											    <div class="meta-caption">
											    	<h5 class="color-white to-top mb8">'.$img_caption.'</h5>
											    	<h6 class="color-white to-top-after">'.$img_desc.'</h6>
											    </div>
											</div>
										</a>
									</li>';
		    	    }
		    	}
		    	$output .= '</ul></div>';
	    		break;

	    	case 'masonry-flip':
	    		$output = '<div><ul class="masonry-flip effect-rotate" id="masonry-flip">';
		    	foreach ( $attachments as $id => $attachment ) {
		    		$url = wp_get_attachment_image_src($id, 'full');

		    		if ( isset($url[0]) && $url[0] ) {
		    			$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_desc = isset($img_meta['description']) ? $img_meta['description'] : '';
		    	    	$output .= '<li class="flip-column-'.esc_attr($columns).' plus-cursor">
		    	    					<a href="'. esc_url($url[0]) .'" data-lightbox="true" data-title="'.esc_attr($img_caption).'">
											<div class="image-box hover-meta plus-cursor text-center">
											    <img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />
											    <div class="meta-caption">
											    	<h5 class="color-white to-top mb0">'.$img_caption.'</h5>
											    	<h6 class="color-white to-top-after">'.$img_desc.'</h6>
											    </div>
											</div>
										</a>
									</li>';
		    	    }
		    	}
		    	$output .= '</ul></div>';
	    		break;

	    	case 'masonry-flip-photoswipe':
	    		$output = '<div><ul class="masonry-flip masonry-flip-photoswipe effect-rotate" id="masonry-flip">';
		    	foreach ( $attachments as $id => $attachment ) {
		    		$url = wp_get_attachment_image_src($id, 'full');

		    		if ( isset($url[0]) && $url[0] ) {
		    			$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_desc = isset($img_meta['description']) ? $img_meta['description'] : '';
						$img_width = isset($img_meta['width']) ? $img_meta['width'] : '';
						$img_height = isset($img_meta['height']) ? $img_meta['height'] : '';
		    	    	$output .= '<li class="flip-column-'.esc_attr($columns).' plus-cursor">
		    	    					<a href="'. esc_url($url[0]) .'" data-size="'.esc_attr($img_width).'x'.esc_attr($img_height).'">
											<div class="image-box hover-meta plus-cursor text-center">
											    <img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />
											    <div class="meta-caption">
											    	<h5 class="color-white to-top mb8">'.$img_caption.'</h5>
											    	<h6 class="color-white to-top-after">'.$img_desc.'</h6>
											    </div>
											</div>
										</a>
										<figcaption>'.$img_caption.'</figcaption>
									</li>';
		    	    }
		    	}
		    	$output .= '</ul></div>';
	    		break;

	    	case 'lightbox':

	    		$output = '<div class="lightbox-gallery mt16 mt0-vc '.( 3 == $columns ? 'third-thumbs' : ( 2 == $columns ? 'half-thumbs' : '' ) ).'" data-gallery-title="'. esc_attr(get_the_title()) .'"><ul>';
		    	foreach ( $attachments as $id => $attachment ) {
		    		$url_full = wp_get_attachment_image_src($id, 'full');
	    			$url = wp_get_attachment_image_src($id, 'wanium_grid_big');
		    		if ( isset($url_full[0]) && isset($url[0]) && $url[0] ) {
		    			$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_desc = isset($img_meta['description']) ? $img_meta['description'] : '';
		    	    	$output .= '<li>
		    	    					<a href="'. esc_url($url_full[0]) .'" data-lightbox="true" data-title="'.esc_attr($img_caption).'">
		    	    						<div class="image-box hover-meta plus-cursor text-center">
											    <img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />
											    <div class="meta-caption">
											    	<h5 class="color-white to-top mb8">'.$img_caption.'</h5>
											    	<h6 class="color-white to-top-after">'.$img_desc.'</h6>
											    </div>
											</div>
	    	    	        			</a>
	    	    	        		</li>';
		    	    }
		    	}
		    	$output .= '</ul></div>';
	    		break;

	    	case 'lightbox-fullwidth':

	    		$output = '<div class="lightbox-gallery lightbox-fullwidth mt16 mt0-vc '.( 3 == $columns ? 'third-thumbs' : ( 2 == $columns ? 'half-thumbs' : '' ) ).'" data-gallery-title="'. esc_attr(get_the_title()) .'"><ul>';
		    	foreach ( $attachments as $id => $attachment ) {
		    		$url_full = wp_get_attachment_image_src($id, 'full');
	    			$url = wp_get_attachment_image_src($id, 'wanium_grid_big');
		    		if ( isset($url_full[0]) && isset($url[0]) && $url[0] ) {
		    			$img_meta = wp_prepare_attachment_for_js( $id );
						$img_caption = isset($img_meta['caption']) ? $img_meta['caption'] : '';
						$img_desc = isset($img_meta['description']) ? $img_meta['description'] : '';
		    	    	$output .= '<li>
		    	    					<a href="'. esc_url($url_full[0]) .'" data-lightbox="true" data-title="'.esc_attr($img_caption).'">
		    	    						<div class="image-box hover-meta plus-cursor text-center">
											    <img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" />
											    <div class="meta-caption">
											    	<h5 class="color-white to-top mb8">'.$img_caption.'</h5>
											    	<h6 class="color-white to-top-after">'.$img_desc.'</h6>
											    </div>
											</div>
		    	    	        		</a>
		    	    	        	</li>';
		    	    }
		    	}
		    	$output .= '</ul></div>';
	    		break;

	    	case 'fullwidth':
		    	foreach ( $attachments as $id => $attachment ) {
		    		$url = wp_get_attachment_image_src($id, 'full');
		    	    $output .= isset($url[0]) && $url[0] ? '<figure><img src="'. esc_url($url[0]) .'" alt="'.esc_attr( 'gallery-item' ).'" /></figure>' : '';
		    	}
	    		break;
	    	
	    	default:
	    		if ( is_feed() ) {
			        $output = "\n";
			        foreach ( $attachments as $id => $attachment ) {
			            $output .= wp_get_attachment_link($id, $size, true) . "\n";
			        }
			    }
	    		break;
	    }
	    return $output;
	}
	add_filter( 'post_gallery', 'wanium_post_gallery', 10, 2 );
}