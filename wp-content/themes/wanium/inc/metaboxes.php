<?php 
/**
 * Theme Metabox
 *
 * @package TLG Theme
 *
 */

if( !function_exists('wanium_metaboxes') ) {
	function wanium_metaboxes( $meta_boxes ) {
		$menus = wp_get_nav_menus();
		$menu_options = array();
		if( is_array($menus) && count($menus) ) {
			foreach($menus as $menu) {
				$menu_options[$menu->term_id] = $menu->name;
			}
		}
		$menu_options = array( 0 => esc_html__( '(default menu)', 'wanium' ) ) + $menu_options;
		$title_options 	= array( 'default' => esc_html__( '(default)', 'wanium' ) ) + tlg_framework_get_page_title_options();
		$layout_options = array( 'default' => esc_html__( '(default layout)', 'wanium' ) ) + tlg_framework_get_site_layouts();
		$header_options = array( 'default' => esc_html__( '(default layout)', 'wanium' ) ) + tlg_framework_get_header_options();
		$footer_options = array( 'default' => esc_html__( '(default layout)', 'wanium' ) ) + tlg_framework_get_footer_options();
		$sidebar_options = array( 'default' => esc_html__( '(default layout)', 'wanium' ) ) + tlg_framework_get_single_layouts();
		$font_options = tlg_framework_get_font_options();
		$yesno_options = array( 'yes' => esc_html__( 'Yes', 'wanium' ), 'no' => esc_html__( 'No', 'wanium' ) );
		$text_options = array( '' => esc_html__( '(default)', 'wanium' ), 'uppercase' => esc_html__( 'Uppercase', 'wanium' ), 'capitalize' => esc_html__( 'Capitalize', 'wanium' ), 'none' => esc_html__( 'None', 'wanium' ) );
		$prefix = '_tlg_';
		# PAGE/POST SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'page_metabox',
			'title' => esc_html__( 'Page Layout', 'wanium' ),
			'object_types' => array( 'page', 'post', 'portfolio', 'product' ),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name'         	=> esc_html__( 'Site Layout', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Site Layout is set in: Appearance > Customize > Site Identity', 'wanium' ),
					'id'           	=> $prefix . 'layout_override',
					'type'         	=> 'select',
					'options'      	=> $layout_options,
					'std'          	=> 'default'
				),
				array(
					'name'         	=> esc_html__( 'Header Layout', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Header Layout is set in: Appearance > Customize > Header', 'wanium' ),
					'id'           	=> $prefix . 'header_override',
					'type'         	=> 'select',
					'options'      	=> $header_options,
					'std'          	=> 'default'
				),
				array(
					'name'         	=> esc_html__( 'Footer Layout', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Footer Layout is set in: Appearance > Customize > Footer', 'wanium' ),
					'id'           	=> $prefix . 'footer_override',
					'type'         	=> 'select',
					'options'      	=> $footer_options,
					'std'          	=> 'default'
				),
			)
		);
		$meta_boxes[] = array(
			'id' => 'page_title_metabox',
			'title' => esc_html__( 'Default Page Title', 'wanium' ),
			'object_types' => array( 'page', 'post', 'portfolio', 'product' ),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name' 			=> esc_html__( 'Page Title Layout', 'wanium' ),
					'desc' 			=> esc_html__( 'Default setting is set in: Appearance > Customize > System. If you are using Slider or Single Header element in your page builder, please set Page Title Layout to "No Title" to remove the default title. Also, if you want to display the page title background image, please choose "Background" or "Parallax" option.', 'wanium' ),
					'id' 			=> $prefix . 'page_title_layout',
					'type' 			=> 'select',
					'options' 		=> $title_options
				),
				array(
					'name' 			=> esc_html__( 'Page Title', 'wanium' ),
					'desc' 			=> esc_html__( 'Enter a title for this page (optional). This will overwrite the default title.', 'wanium' ),
					'id'   			=> $prefix . 'the_title',
					'type' 			=> 'text',
				),
				array(
					'name' 			=> esc_html__( 'Page Title Subtitle', 'wanium' ),
					'desc' 			=> esc_html__( 'Enter a subtitle for this page (optional).', 'wanium' ),
					'id'   			=> $prefix . 'the_subtitle',
					'type' 			=> 'text',
				),
				array(
					'name' 			=> esc_html__( 'Page Title Background Type', 'wanium' ),
					'desc' 			=> esc_html__( 'Select a background image type for page title Background or Parallax layouts.', 'wanium' ),
					'id' 			=> $prefix . 'title_bg_featured',
					'type' 			=> 'select',
					'options' 		=> array( 'yes' => esc_html__( 'Featured Image', 'wanium' ), 'no' => esc_html__( 'Custom Background Image', 'wanium' ) )
				),
				array(
		            'name' 			=> esc_html__( 'Custom Background Image', 'wanium' ),
		            'desc' 			=> esc_html__( 'Select image pattern for stunning header background.', 'wanium' ),
		            'id'   			=> $prefix . 'title_bg_img',
	                'type' 			=> 'file',
		        ),
			)
		);
		# POST SIDEBAR SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'single_sidebar_metabox',
			'title' => esc_html__( 'Single Sidebar Settings', 'wanium' ),
			'object_types' => array('post'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name'         	=> esc_html__( 'Single Sidebar Layout', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Single Sidebar Layout is set in: Appearance > Customize > Blog', 'wanium' ),
					'id'           	=> $prefix . 'single_sidebar_override',
					'type'         	=> 'select',
					'options'      	=> $sidebar_options,
					'std'          	=> 'default'
				),
			),
		);
		# MENU SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'menu_metabox',
			'title' => esc_html__( 'Menu Settings', 'wanium' ),
			'object_types' => array( 'page', 'post', 'portfolio', 'product' ),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name'         	=> esc_html__( 'Selected Menu', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Selected Menu is the menu in primary location.', 'wanium' ),
					'id'           	=> $prefix . 'menu_override',
					'type'         	=> 'select',
					'options'      	=> $menu_options,
					'std'          	=> 'default'
				),
				array(
				    'name' 			=> esc_html__( 'Enable Boxed Header?', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default setting is set in: Appearance > Customize > Header', 'wanium' ),
				    'id'   			=> $prefix . 'header_boxed',
				    'type' 			=> 'checkbox'
				),
				array(
				    'name' 			=> esc_html__( 'Hide Header Cart Icon?', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default setting is set in: Appearance > Customize > Header', 'wanium' ),
				    'id'   			=> $prefix . 'menu_hide_cart',
				    'type' 			=> 'checkbox'
				),
				array(
				    'name' 			=> esc_html__( 'Hide Header Search Icon?', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default setting is set in: Appearance > Customize > Header', 'wanium' ),
				    'id'   			=> $prefix . 'menu_hide_search',
				    'type' 			=> 'checkbox'
				),
				array(
				    'name' 			=> esc_html__( 'Hide Header Language Icon?', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default setting is set in: Appearance > Customize > Header', 'wanium' ),
				    'id'   			=> $prefix . 'menu_hide_language',
				    'type' 			=> 'checkbox'
				),
			)
		);
		# PAGE SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'font_color_metabox',
			'title' => esc_html__( 'Customize Font, Color &amp; Logo', 'wanium' ),
			'object_types' => array( 'page', 'post', 'portfolio', 'product' ),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name'         	=> esc_html__( 'Body Font', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Body Font is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'font_override',
					'type'         	=> 'select',
					'options'      	=> $font_options,
					'std'          	=> 'default'
				),
				array(
					'name'         	=> esc_html__( 'Header Font', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Header Font is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'header_font_override',
					'type'         	=> 'select',
					'options'      	=> $font_options,
					'std'          	=> 'default'
				),
				array(
					'name'         	=> esc_html__( 'Subtitle Font', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Subtitle Font is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'subtitle_font_override',
					'type'         	=> 'select',
					'options'      	=> $font_options,
					'std'          	=> 'default'
				),
				array(
					'name'         	=> esc_html__( 'Menu Font', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Menu Font is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'menu_font_override',
					'type'         	=> 'select',
					'options'      	=> $font_options,
					'std'          	=> 'default'
				),
				array(
					'name'         	=> esc_html__( 'Button Font', 'wanium' ),
					'desc'         	=> esc_html__( 'Default Button Font is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'button_font_override',
					'type'         	=> 'select',
					'options'      	=> $font_options,
					'std'          	=> 'default'
				),
				array(
		            'name' 			=> esc_html__( 'Primary Color', 'wanium' ),
		            'desc' 			=> esc_html__( 'Default Primary Color is set in: Appearance > Customize > Colors', 'wanium' ),
		            'id'   			=> $prefix . 'primary_color',
	                'type' 			=> 'colorpicker',
		        ),
		        array(
		            'name' 			=> esc_html__( 'Primary Gradient Color', 'wanium' ),
		            'desc' 			=> esc_html__( 'Default Primary Gradient Color is set in: Appearance > Customize > Colors', 'wanium' ),
		            'id'   			=> $prefix . 'primary_gradient_color',
	                'type' 			=> 'colorpicker',
		        ),
		        array(
		            'name' 			=> esc_html__( 'Primary Text Color', 'wanium' ),
		            'desc' 			=> esc_html__( 'Default Primary Text Color is set in: Appearance > Customize > Colors', 'wanium' ),
		            'id'   			=> $prefix . 'primary_text_color',
	                'type' 			=> 'colorpicker',
		        ),
		        array(
		            'name' 			=> esc_html__( 'Light Color', 'wanium' ),
		            'desc' 			=> esc_html__( 'Default Light Color is set in: Appearance > Customize > Colors', 'wanium' ),
		            'id'   			=> $prefix . 'light_color',
	                'type' 			=> 'colorpicker',
		        ),
		        array(
					'name'         	=> esc_html__( 'Header Text Transform', 'wanium' ),
					'desc'         	=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'header_text_transform',
					'type'         	=> 'select',
					'options'      	=> $text_options,
				),
				array(
					'name'         	=> esc_html__( 'Button Text Transform', 'wanium' ),
					'desc'         	=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'button_text_transform',
					'type'         	=> 'select',
					'options'      	=> $text_options,
				),
				array(
					'name'         	=> esc_html__( 'Menu Text Transform', 'wanium' ),
					'desc'         	=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'           	=> $prefix . 'menu_text_transform',
					'type'         	=> 'select',
					'options'      	=> $text_options,
				),
				array(
					'name' 			=> esc_html__( 'Menu Font Size (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'menu_font_size',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Submenu Font Size (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'submenu_font_size',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Page Title Font Size (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'pagetitle_font_size',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Header Font Size (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'header_font_size',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Header Letter Spacing (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'header_letter_spacing',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Subtitle Font Size (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'subtitle_font_size',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Subtitle Letter Spacing (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'subtitle_letter_spacing',
					'type' 			=> 'text_small',
				),
				array(
					'name' 			=> esc_html__( 'Widget Title Font Size (px)', 'wanium' ),
					'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Fonts &amp; CSS', 'wanium' ),
					'id'   			=> $prefix . 'widget_font_size',
					'type' 			=> 'text_small',
				),
				array(
				    'name' 			=> esc_html__( 'Wrap Menu Width (%)', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Header', 'wanium' ),
				    'id'   			=> $prefix . 'menu_wrap_width',
				    'type' 			=> 'text_small',
				),
				array(
				    'name' 			=> esc_html__( 'Menu Height (px)', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default value is set in: Appearance > Customize > Header', 'wanium' ),
				    'id'   			=> $prefix . 'menu_height',
				    'type' 			=> 'text_small',
				),
				array(
		            'name' 			=> esc_html__( 'Logo Image', 'wanium' ),
		            'desc' 			=> esc_html__( 'Default logo is set in: Appearance > Customize > Header', 'wanium' ),
		            'id'   			=> $prefix . 'logo',
	                'type' 			=> 'file',
		        ),
		        array(
		            'name' 			=> esc_html__( 'Logo Image Light', 'wanium' ),
		            'desc' 			=> esc_html__( 'Default light logo is set in: Appearance > Customize > Header', 'wanium' ),
		            'id'   			=> $prefix . 'logo_light',
	                'type' 			=> 'file',
		        ),
			)
		);
		# PORTFOLIO SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'portfolio_metabox',
			'title' => esc_html__( 'Portfolio Settings', 'wanium' ),
			'object_types' => array('portfolio'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
				    'name' => esc_html__( 'Big Thumbnail in 2 Columns layout?', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to enable big thumbnail in archive page (Masonry layout only).', 'wanium' ),
				    'id'   => $prefix . 'portfolio_big_size_2',
				    'type' => 'checkbox'
				),
				array(
				    'name' => esc_html__( 'Big Thumbnail in 3 Columns layout?', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to enable big thumbnail in archive page (Masonry layout only).', 'wanium' ),
				    'id'   => $prefix . 'portfolio_big_size_3',
				    'type' => 'checkbox'
				),
				array(
				    'name' => esc_html__( 'Big Thumbnail in 4 Columns layout?', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to enable big thumbnail in archive page (Masonry layout only).', 'wanium' ),
				    'id'   => $prefix . 'portfolio_big_size_4',
				    'type' => 'checkbox'
				),
				array(
				    'name' => esc_html__( 'Big Thumbnail in Full Width 2 Columns layout?', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to enable big thumbnail in archive page (Masonry layout only).', 'wanium' ),
				    'id'   => $prefix . 'portfolio_big_size_2_full',
				    'type' => 'checkbox'
				),
				array(
				    'name' => esc_html__( 'Big Thumbnail in Full Width 3 Columns layout?', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to enable big thumbnail in archive page (Masonry layout only).', 'wanium' ),
				    'id'   => $prefix . 'portfolio_big_size_3_full',
				    'type' => 'checkbox'
				),
				array(
				    'name' => esc_html__( 'Big Thumbnail in Full Width 4 Columns layout?', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to enable big thumbnail in archive page (Masonry layout only).', 'wanium' ),
				    'id'   => $prefix . 'portfolio_big_size_4_full',
				    'type' => 'checkbox'
				),
				array(
				    'name' 			=> esc_html__( 'Enable portfolio gallery lightbox?', 'wanium' ),
				    'desc' 			=> esc_html__( 'Default setting is set in: Appearance > Customize > Portfolio', 'wanium' ),
				    'id'   			=> $prefix . 'portfolio_gallery',
				    'type' 			=> 'checkbox'
				),
				array(
					'name' => esc_html__( 'Link Portfolio Item to External URL', 'wanium' ),
					'desc' => esc_html__( 'Enter a external URL for this project.', 'wanium' ),
					'id'   => $prefix . 'portfolio_external_url',
					'type' => 'text',
				),
				array(
				    'name' => esc_html__( 'Open External URL in New Window', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to open external URL in new window.', 'wanium' ),
				    'id'   => $prefix . 'portfolio_url_new_window',
				    'type' => 'checkbox'
				),
				array(
				    'name' => esc_html__( 'Add Nofollow for External URL', 'wanium' ),
				    'desc' => esc_html__( 'Check this option to add rel=nofollow in external URL.', 'wanium' ),
				    'id'   => $prefix . 'portfolio_url_nofollow',
				    'type' => 'checkbox'
				),
			),
		);		
		# CLIENT SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'clients_metabox',
			'title' => esc_html__( 'Client Settings', 'wanium' ),
			'object_types' => array('client'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name' => esc_html__( 'Client URL', 'wanium' ),
					'desc' => esc_html__( 'Enter a URL for this client.', 'wanium' ),
					'id'   => $prefix . 'client_url',
					'type' => 'text',
				),
			),
		);
		# TEAM SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'team_metabox',
			'title' => esc_html__( 'Team Member Settings', 'wanium' ),
			'object_types' => array('team'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
				    'name' => esc_html__( 'Member description', 'wanium' ),
				    'desc' => esc_html__( 'Member description for this person.', 'wanium' ),
				    'id' => $prefix . 'team_about',
				    'type' => 'wysiwyg',
				    'options' => array(),
				),
				array(
					'name' => esc_html__( 'Member position', 'wanium' ),
					'desc' => esc_html__( 'Member position for this person.', 'wanium' ),
					'id'   => $prefix . 'team_position',
					'type' => 'text',
				),
				array(
				    'id'          => $prefix . 'team_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => esc_html__( 'Add Icon', 'wanium' ),
				        'remove_button' => esc_html__( 'Remove Icon', 'wanium' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' 			=> esc_html__( 'Social Icon', 'wanium' ),
							'description' 	=> esc_html__( 'Leave text field blank for no icon.', 'wanium' ),
							'id' 			=> $prefix . 'team_social_icon',
							'std' 			=> 'none',
							'type' 			=> 'tlg_social_icons',
						),
						array(
							'name' => esc_html__( 'Social URL', 'wanium' ),
							'desc' => esc_html__( 'Enter the URL for Social Icon.', 'wanium' ),
							'id'   => $prefix . 'team_social_icon_url',
							'type' => 'text_url',
						),
				    ),
				),
				array(
					'name' => esc_html__( 'Member URL (optional)', 'wanium' ),
					'desc' => esc_html__( 'Enter a URL for this member.', 'wanium' ),
					'id'   => $prefix . 'team_url',
					'type' => 'text',
				),
			)
		);
		# TESTIMONIAL SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'testimonials_metabox',
			'title' => esc_html__( 'Testimonial Settings', 'wanium' ),
			'object_types' => array('testimonial'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
				    'name' => esc_html__( 'Testimonial Content', 'wanium' ),
				    'desc' => esc_html__( 'Enter the testimonial content.', 'wanium' ),
				    'id' => $prefix . 'testimonial_content',
				    'type' => 'wysiwyg',
				    'options' => array(),
				),
				array(
					'name' => esc_html__( 'Author Info', 'wanium' ),
					'desc' => esc_html__( 'Enter author infomation for this testimonial.', 'wanium' ),
					'id'   => $prefix . 'testimonial_info',
					'type' => 'text',
				),
		        array(
					'name' => esc_html__( 'Author URL (optional)', 'wanium' ),
					'desc' => esc_html__( 'Enter a URL for this author.', 'wanium' ),
					'id'   => $prefix . 'testimonial_url',
					'type' => 'text',
				),
			)
		);
		# POST VIDEO SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'post_format_metabox_video',
			'title' => esc_html__( 'Videos & oEmbeds', 'wanium' ),
			'object_types' => array('post'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name' => esc_html__( 'oEmbed', 'wanium' ),
					'desc' => esc_html__( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'wanium' ),
					'id'   => $prefix . 'the_oembed',
					'type' => 'oembed',
				),
			)
		);
		# POST AUDIO SETTINGS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$meta_boxes[] = array(
			'id' => 'post_format_metabox_audio',
			'title' => esc_html__( 'Audio Embed', 'wanium' ),
			'object_types' => array('post'),
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true,
			'fields' => array(
				array(
					'name' => esc_html__( 'oEmbed', 'wanium' ),
					'desc' => esc_html__( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'wanium' ),
					'id'   => $prefix . 'the_audio_oembed',
					'type' => 'oembed',
				),
			)
		);
		return $meta_boxes;
	}
	add_filter( 'cmb2_meta_boxes', 'wanium_metaboxes' );
}