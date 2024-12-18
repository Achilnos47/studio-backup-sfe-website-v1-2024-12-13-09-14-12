<?php
/**
    ADD DEMO IMPORT MENU
**/
if ( ! function_exists('wanium_add_import_link') ) {
	function wanium_add_import_link() {
		add_theme_page( 
			esc_html__( 'Install Demo', 'wanium' ), 
			esc_html__( 'Install Demo', 'wanium' ), 
			'manage_options', 
			'one-click-demo',
			'wanium_import' );
	}
	add_action( 'admin_menu', 'wanium_add_import_link' );
}

/**
    DEMO IMPORTER
**/
if ( ! function_exists( 'wanium_import' ) ) {
	function wanium_import() {
		$flag_import_slider = false;
		$no_file 			= false;
		$file 				= get_template_directory().'/inc/importer/demo-files/content.xml';
		
		if ( !file_exists( $file ) ) $no_file = true;

		if( isset($_POST['import']) ) {
			if( isset($_POST['all']) && 'ON' == $_POST['all'] ) {
				wanium_import_content( $file );
				wanium_import_widgets();
				if( $flag_import_slider ) { wanium_import_slider(); }
			}
			if( isset($_POST['content']) && 'ON' == $_POST['content'] ) {
				wanium_import_content( $file );
			}
			if( isset($_POST['widget']) && 'ON' == $_POST['widget'] ) {
				wanium_import_widgets();
			}
			if( isset($_POST['slider']) && 'ON' == $_POST['slider'] ) {
				if( $flag_import_slider ) { wanium_import_slider(); }
			}
			?>
			<div class="wrap">
				<div class="tlg-import-msg finish">
					<h1><?php echo esc_html__( 'Import completed!', 'wanium' ) ?></h1>
					<p><a href="<?php echo site_url(); ?>" target="_blank"><?php echo esc_html__( 'Visit Site', 'wanium' ) ?></a>.</p>
					<div class="tlg-importer-alert text-left">
						<strong><?php echo esc_html__( 'NOTES:', 'wanium' ) ?></strong>
						<ol>
							<li><?php echo wp_kses( __( 'If the One-Click Import did not work for any reason, please refer to the <a href="http://www.themelogi.com/docs/wanium/#!/demo_import" target="_blank">Theme Documentation</a> so you can install the Demo Content manually or check <a href="http://www.themelogi.com/docs/wanium/#!/common_issue">common Import issues</a>.', 'wanium' ), wanium_allowed_tags() ) ?></li>
							<li><?php echo wp_kses( __( 'In case of any missing data, you can try to re-install demo content via <strong>Advanded demo content import</strong>.', 'wanium' ), wanium_allowed_tags() ) ?></li>
						</ol>
					</div>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="wrap">
				<form class="tlg-importer" action="?page=one-click-demo" method="post">
					<?php if( !$no_file ) { ?>
					<div>
						<h2><?php echo esc_html__( 'Install demo content', 'wanium' ) ?></h2>
						<div class="tlg-importer-alert">
							<strong><?php echo esc_html__( 'NOTES:', 'wanium' ) ?></strong>
							<ol>
								<li><?php echo esc_html__( 'Please click import only once and wait, it can take few minutes. Please be patient and DO NOT close the browser or navigate away. The import procedure can take up to 15mins on slow servers and you will see the messages when the import is done.', 'wanium' ) ?></li>
								<li><?php echo esc_html__( 'It\'s always recommended to run the import on a clean installtion of WordPress.', 'wanium' ) ?></li>
								<li><?php echo esc_html__( 'Make sure you\'ve installed all the required plugins before running the Importer.', 'wanium' ) ?></li>
								<li><?php echo esc_html__( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'wanium' ) ?></li>
								<li><?php echo esc_html__( 'The images in demos are copyrighted which are not included in the theme package. Simply replace these images with your own.', 'wanium' ) ?></li>
								<li><?php echo esc_html__( 'If the One-Click Import did not work for any reason (it is normally due to host performances), you can install the Demo Content manually as described in the Theme Documentation.', 'wanium' ) ?></li>
							</ol>
						</div>
						<input name="import" type="submit" class="tlg_import_btn button button-primary button-large" value="<?php echo esc_html__( 'Import', 'wanium' ) ?>">
						<input class="tlg-hide" id="all" type="checkbox" value="ON" name="all" checked="checked">
						<p><?php echo esc_html__( 'In case the One-Click Import did not work or any other missing data, you can try to re-install demo content here:', 'wanium' ) ?> <strong><a href="#" class="advanded_import_btn"><?php echo esc_html__( 'Advanded demo content import', 'wanium' ) ?></a></strong></p>
					</div>
					<?php } else { ?>
						<div class="tlg-import-msg">
							<h1><?php echo esc_html__( 'The XML file containing the dummy content is not available or could not be read ..', 'wanium' ) ?></h1>
						</div>
					<?php } ?>
				</form>
				<div class="tlg-import-msg advanded" style="display:none">
					<form class="tlg-importer-advanded" action="?page=one-click-demo" method="post">
						<div>
							<h2><?php echo esc_html__( 'Advanded demo content import', 'wanium' ) ?></h2>
							<div class="tlg-importer-alert">
								<p><?php echo wp_kses( __( 'If you have any problems with the importing, please refer to the <a href="http://www.themelogi.com/docs/wanium/#!/common_issue" target="_blank">Common Issues with Importing Data</a> for the solutions.', 'wanium' ), wanium_allowed_tags() ) ?></p>
								</ol>
							</div>
							<input class="tlg-hide" id="content" type="checkbox" value="ON" name="content" checked="checked">
							<input type="hidden" name="ids" id="ids" class="ids" value="" />
							<input name="import" type="submit" class="tlg_import_btn_advanded button button-primary button-large" value="<?php echo esc_html__( 'Import Demo Content Only', 'wanium' ) ?>">

							<p><a href="#" class="quick_import_btn"><?php echo esc_html__( 'Back to Quick demo content import', 'wanium' ) ?></a></p>
						</div>
					</form>

					<form class="tlg-importer-advanded-meta" action="?page=one-click-demo" method="post">
						<div class="tlg-divider">
							<div>
								<label>
									<input id="widget" type="checkbox" value="ON" name="widget" checked="checked">
									<span><?php echo esc_html__( 'Import Widgets', 'wanium' ) ?></span>
								</label>
								<?php if ( $flag_import_slider && class_exists('RevSlider') ) : // no import slider ?>
								<span style="display:inline-block;width:20px;"></span>
								<label>
									<input id="slider" type="checkbox" value="ON" name="slider" checked="checked">
									<span><?php echo esc_html__( 'Import Revolution Sliders', 'wanium' ) ?></span>
								</label>
								<?php endif; ?>
							</div>
							<div style="clear:both; margin-bottom: 20px;"></div>
							<input type="hidden" name="ids" id="ids" class="ids" value="" />
							<input name="import" type="submit" class="tlg_import_btn_advanded_meta button button-primary button-large" value="<?php echo esc_html__( 'Import', 'wanium' ) ?>">
						</div>
					</form>
				</div>
				<div class="tlg-import-msg progress" style="display:none">
					<div class="tlg-spinner-wrap"><div class="tlg-spinner"></div></div>
					<h1><?php echo esc_html__( 'Importing Demo Content...', 'wanium' ) ?></h1>
					<div class="tlg-importer-alert text-left">
						<strong><?php echo esc_html__( 'NOTES:', 'wanium' ) ?></strong>
						<ol>
							<li><?php echo esc_html__( 'Please be patient and DO NOT close the browser or navigate away. The import procedure can take up to 15mins on slow servers and you will see the messages when the import is done.', 'wanium' ) ?></li>
							<li><?php echo esc_html__( 'If you haven\'t had a notification in 20mins, use the fallback method in the Theme Documentation.', 'wanium' ) ?></li>
						</ol>
					</div>
				</div>
			</div>
			<script>
				jQuery(document).ready(function() {
					jQuery('.tlg_import_btn').click(function() {
						jQuery('.tlg-importer').fadeOut(0);
						jQuery('.tlg-import-msg.progress').fadeIn();
					});
					jQuery('.tlg_import_btn_advanded').click(function() {
						jQuery('.tlg-import-msg.advanded').fadeOut(0);
						jQuery('.tlg-import-msg.progress').fadeIn();
						var ids = jQuery( 'form.tlg-importer-advanded' ).serialize();
						jQuery('.ids').val( ids );
					});
					jQuery('.tlg_import_btn_advanded_meta').click(function() {
						jQuery('.tlg-import-msg.advanded').fadeOut(0);
						jQuery('.tlg-import-msg.progress').fadeIn();
					});
					jQuery('.advanded_import_btn').click(function(e) {
						e.preventDefault();
						jQuery('.tlg-importer').fadeOut(0);
						jQuery('.tlg-import-msg.advanded').fadeIn();
					});
					jQuery('.quick_import_btn').click(function(e) {
						e.preventDefault();
						jQuery('.tlg-import-msg.advanded').fadeOut(0);
						jQuery('.tlg-importer').fadeIn();
					});
				});
			</script>
			<?php
		}
	}
}

/**
    CONTENT IMPORTER
**/
if ( ! function_exists( 'wanium_import_content' ) ) {
	function wanium_import_content( $file ) {
		set_time_limit(0);
		global $wp_filesystem;

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once ABSPATH . 'wp-admin/includes/import.php';

		if ( !class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) )
				require_once( $class_wp_importer );
			else return false;
		}

		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = TLG_FRAMEWORK_PATH . 'includes/lib/importer/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) )
				require_once( $class_wp_import );
			else return false;
		}

		if (empty($wp_filesystem)) {
		  	require_once (ABSPATH . '/wp-admin/includes/file.php');
		  	WP_Filesystem();
		}
		$response = $wp_filesystem->get_contents($file);
		if($response){
			$wp_import = new WP_Import();
			$wp_import->fetch_attachments = true;
			$wp_import->import( $file );
		} else return false;

		// SET MENU
		$menu = get_term_by('name', 'Primary Menu', 'nav_menu');
		if( isset($menu->term_id) ) {
			set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu->term_id ) );
		}
		// SET HOMEPAGE
		$home = get_page_by_title( 'Home' );
		if( isset($home->ID) ) {
			update_option('page_on_front',  $home->ID);
			update_option('show_on_front', 'page');
		}
		return true;
	}
}

/**
    SLIDER IMPORTER
**/
if ( ! function_exists( 'wanium_import_slider' ) ) {
	function wanium_import_slider() {
		set_time_limit(0);
		if ( ! class_exists('RevSlider') ) return false;
		ob_start();

		$file = get_template_directory().'/inc/importer/demo-files/slider.zip';
		if ( ! file_exists( $file ) ) return false;
		$_FILES["import_file"]["tmp_name"] = $file;
		$slider = new RevSlider();
		$slider->importSliderFromPost();
		unset($slider);

		ob_end_clean();
		return true;
	}
}

/**
    WIDGETS IMPORTER
**/
if ( ! function_exists( 'wanium_import_widgets' ) ) {
	function wanium_import_widgets() {
		set_time_limit(0);
		global $wp_registered_sidebars, $wp_filesystem;
		$file = get_template_directory().'/inc/importer/demo-files/widgets.json';
		if ( ! file_exists( $file ) ) return false;

		if (empty($wp_filesystem)) {
		  	require_once (ABSPATH . '/wp-admin/includes/file.php');
		  	WP_Filesystem();
		}
		$response = $wp_filesystem->get_contents($file);
		/* Will result in $api_response being an array of data,
		parsed from the JSON response of the API listed above */
		$data = json_decode( $response, false );
		if ( empty( $data ) || ! is_object( $data ) ) return;
		$list_widgets = wanium_list_widgets();
		// Get all existing widget instances
		$widget_instances = array();
		if( count( $list_widgets ) ) {
			foreach ( $list_widgets as $widget_data ) {
				$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
			}
		}
		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {
			if ( 'wp_inactive_widgets' == $sidebar_id ) continue;
			if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
				$sidebar_available = true;
				$use_sidebar_id = $sidebar_id;
			} else {
				$sidebar_available = false;
				$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			}
			foreach ( $widgets as $widget_instance_id => $widget ) {
				$fail = false;
				$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
				if ( ! $fail && ! isset( $list_widgets[$id_base] ) ) {
					$fail = true; // Site does not support widget
				}
				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[$id_base] ) ) {
					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array();
					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
					foreach ( $single_widget_instances as $check_id => $check_widget ) {
						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
							$fail = true;
							break;
						}
					}
				}
				if ( ! $fail ) {
					// Add widget instance
					$single_widget_instances = get_option( 'widget_' . $id_base );
					$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 );
					$single_widget_instances[] = (array) $widget;
					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}
					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );
					// Assign widget instance to sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$new_instance_id = $id_base . '-' . $new_instance_id_number;
					$sidebars_widgets[$use_sidebar_id][] = $new_instance_id;
					update_option( 'sidebars_widgets', $sidebars_widgets );
				}
			}
		}
		return true;
	}
}

/**
    LIST WIDGETS
**/
if ( ! function_exists( 'wanium_list_widgets' ) ) {
	function wanium_list_widgets() {
    	global $wp_registered_widget_controls;
    	$widget_controls = $wp_registered_widget_controls;
    	$list_widgets = array();
    	foreach ( $widget_controls as $widget ) {
    		if ( ! empty( $widget['id_base'] ) && ! isset( $list_widgets[$widget['id_base']] ) ) {
    			$list_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
    			$list_widgets[$widget['id_base']]['name'] = $widget['name'];
    		}
    	}
    	return $list_widgets;
	}
}