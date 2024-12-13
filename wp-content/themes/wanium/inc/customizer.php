<?php
/**
 * Theme Customizer
 *
 * @package TLG Theme
 *
 */

include_once( ABSPATH . 'wp-includes/class-wp-customize-control.php' );

class Wanium_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
    public function render_content() {
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="3" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
    <?php
    }
}

class Wanium_Customize_Range_Control extends WP_Customize_Control {
    public $type = 'range';
    public function render_content() {
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input <?php $this->link(); ?> name="<?php echo esc_html( wanium_sanitize_title($this->label) ); ?>" type="range" min="<?php echo esc_attr($this->choices['min']); ?>" max="<?php echo esc_attr($this->choices['max']); ?>" step="<?php echo esc_attr($this->choices['step']); ?>" value="<?php echo intval( $this->value() ); ?>" class="tlg-range" onchange="printValue('<?php echo esc_html( wanium_sanitize_title($this->label) ); ?>')" />
            <input type="text" name="<?php echo esc_html( wanium_sanitize_title($this->label) ); ?>" class="tlg-range-output" value="<?php echo intval( $this->value() ); ?>" disabled/>
        </label>
    <?php
    }
}

if( !function_exists('wanium_register_options') ) {
    function wanium_register_options( $wp_customize ) {
        $prefix             = 'wanium_';
        $footer_layouts     = tlg_framework_get_footer_options();
        $header_layouts     = tlg_framework_get_header_options();
        $font_options       = tlg_framework_get_font_options();
        $social_list        = tlg_framework_get_social_icons();
        $portfolio_layouts  = tlg_framework_get_portfolio_layouts();
        $blog_layouts       = tlg_framework_get_blog_layouts();
        $page_titles        = tlg_framework_get_page_title_options();
        $shop_layouts       = tlg_framework_get_shop_layouts();
        $single_layouts     = tlg_framework_get_single_layouts();
        $site_layouts       = tlg_framework_get_site_layouts();
        $menus = wp_get_nav_menus();
        $menu_options = array();
        if( is_array($menus) && count($menus) ) {
            foreach($menus as $menu) {
                $menu_options[$menu->term_id] = $menu->name;
            }
        }
        $menu_options       = array( 0 => esc_html__( '(default menu)', 'wanium' ) ) + $menu_options;
        $yesno_options      = array( 'yes' => esc_html__( 'Yes', 'wanium' ), 'no' => esc_html__( 'No', 'wanium' ) );
        $logo_options       = array( 'image' => esc_html__( 'Image', 'wanium' ), 'text' => esc_html__( 'Text', 'wanium' ) );
        $text_options       = array( 'uppercase' => esc_html__( 'Uppercase', 'wanium' ), 'capitalize' => esc_html__( 'Capitalize', 'wanium' ), 'none' => esc_html__( 'None', 'wanium' ) );
        $page_title_tag    = array( 'h1' => esc_html__( 'H1', 'wanium' ), 'h2' => esc_html__( 'H2', 'wanium' ), 'h3' => esc_html__( 'H3', 'wanium' ), 'h4' => esc_html__( 'H4', 'wanium' ), 'h5' => esc_html__( 'H5', 'wanium' ), 'h6' => esc_html__( 'H6', 'wanium' ) );
        foreach( $social_list as $icon ) $social_options[$icon]  = ucfirst(str_replace('ti-', '', str_replace('fa fa-', '', $icon)));

# SITE IDENTITY - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_setting( $prefix .'site_layout', array( 'default' => 'normal-layout', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'site_layout', array( 'priority' => 1, 'label' => esc_html__( 'Site Layout', 'wanium' ), 'type' => 'select', 'section' => 'title_tagline', 'settings'=> $prefix .'site_layout', 'choices' => $site_layouts ));
        $wp_customize->add_setting( 'tlg_framework_login_logo', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tlg_framework_login_logo', array( 'priority' => 2, 'label' => esc_html__( 'Login Logo', 'wanium' ), 'section' => 'title_tagline', 'settings' => 'tlg_framework_login_logo' )));
        
# COLORS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_setting( $prefix .'color_text', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#1d1d1d', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_text', array( 'priority' => 1, 'label' => esc_html__( 'Text Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_text' )));
        $wp_customize->add_setting( $prefix .'color_primary', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#3897f0', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_primary', array( 'priority' => 2, 'label' => esc_html__( 'Primary Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_primary' )));
        $wp_customize->add_setting( $prefix .'color_primary_gradient', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_primary_gradient', array( 'priority' => 2, 'label' => esc_html__( 'Primary Gradient Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_primary_gradient' )));
        $wp_customize->add_setting( $prefix .'color_primary_text', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#fff', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_primary_text', array( 'priority' => 3, 'label' => esc_html__( 'Primary Text Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_primary_text' )));
        $wp_customize->add_setting( $prefix .'color_dark', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#262626', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_dark', array( 'priority' => 4, 'label' => esc_html__( 'Dark Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_dark' )));
        $wp_customize->add_setting( $prefix .'color_bg_dark', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#252525', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_bg_dark', array( 'priority' => 5, 'label' => esc_html__( 'Background Dark Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_bg_dark' )));
        $wp_customize->add_setting( $prefix .'color_bg_graydark', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#252525', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_bg_graydark', array( 'priority' => 6, 'label' => esc_html__( 'Background Gray Dark Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_bg_graydark' )));
        $wp_customize->add_setting( $prefix .'color_secondary', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#f5f5f5', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_secondary', array( 'priority' => 7, 'label' => esc_html__( 'Background Secondary Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_secondary' )));
        $wp_customize->add_setting( $prefix .'color_light', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#f8f8f8', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_light', array( 'priority' => 8, 'label' => esc_html__( 'Background Light Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_light' ))); 
        $wp_customize->add_setting( $prefix .'color_menu_bg', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_menu_bg', array( 'priority' => 997, 'label' => esc_html__( 'Menu Background Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_menu_bg' ))); 
        $wp_customize->add_setting( $prefix .'color_menu', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_menu', array( 'priority' => 998, 'label' => esc_html__( 'Menu Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_menu' ))); 
        $wp_customize->add_setting( $prefix .'color_menu_badge', array( 'capability' => 'edit_theme_options', 'type' => 'option', 'default' => '#fc1547', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix .'color_menu_badge', array( 'priority' => 999, 'label' => esc_html__( 'Menu Badge Color', 'wanium' ), 'section' => 'colors', 'settings' => $prefix .'color_menu_badge' )));
        
# FONTS, CSS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'styling_section', array( 'title' => esc_html__( 'Fonts &amp; CSS', 'wanium' ), 'priority' => 211 ));
        $wp_customize->add_setting( $prefix .'font', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'font', array( 'priority' => 1, 'label' => esc_html__( 'Body Font', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'font', 'choices' => $font_options ));

        $wp_customize->add_setting( $prefix .'subtitle_font', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'subtitle_font', array( 'priority' => 2, 'label' => esc_html__( 'Subtitle Font', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'subtitle_font', 'choices' => $font_options ));
        
        $wp_customize->add_setting( $prefix .'header_font', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_font', array( 'priority' => 3, 'label' => esc_html__( 'Heading Font', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'header_font', 'choices' => $font_options ));
        
        $wp_customize->add_setting( $prefix .'menu_font', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'menu_font', array( 'priority' => 4, 'label' => esc_html__( 'Menu Font', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'menu_font', 'choices' => $font_options ));
        
        $wp_customize->add_setting( $prefix .'button_font', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'button_font', array( 'priority' => 5, 'label' => esc_html__( 'Button Font', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'button_font', 'choices' => $font_options ));
        
        $wp_customize->add_setting( $prefix .'button_text_transform', array( 'default' => 'uppercase', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'button_text_transform', array( 'priority' => 6, 'label' => esc_html__( 'Button Text Transform', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'button_text_transform', 'choices' => $text_options ));
        
        $wp_customize->add_setting( $prefix .'header_text_transform', array( 'default' => 'uppercase', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_text_transform', array( 'priority' => 7, 'label' => esc_html__( 'Header Text Transform', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'header_text_transform', 'choices' => $text_options ));
        
        $wp_customize->add_setting( $prefix .'menu_text_transform', array( 'default' => 'uppercase', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'menu_text_transform', array( 'priority' => 8, 'label' => esc_html__( 'Menu Text Transform', 'wanium' ), 'type' => 'select', 'section' => 'styling_section', 'settings'=> $prefix .'menu_text_transform', 'choices' => $text_options ));
        
        $wp_customize->add_setting( $prefix .'menu_font_size', array( 'default' => '12', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'menu_font_size', array( 'priority' => 9, 'label' => esc_html__( 'Menu Font Size (default: 12px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'menu_font_size', 'choices' => array('min' => '10', 'max' => '20', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'submenu_font_size', array( 'default' => '11', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'submenu_font_size', array( 'priority' => 10, 'label' => esc_html__( 'Submenu Font Size (default: 11px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'submenu_font_size', 'choices' => array('min' => '10', 'max' => '20', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'pagetitle_font_size', array( 'default' => '79', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'pagetitle_font_size', array( 'priority' => 11, 'label' => esc_html__( 'Page Title Font Size (default: 79px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'pagetitle_font_size', 'choices' => array('min' => '10', 'max' => '100', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'header_font_size', array( 'default' => '40', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'header_font_size', array( 'priority' => 12, 'label' => esc_html__( 'Header Font Size (default: 40px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'header_font_size', 'choices' => array('min' => '10', 'max' => '100', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'header_letter_spacing', array( 'default' => '-0.5', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'header_letter_spacing', array( 'priority' => 13, 'label' => esc_html__( 'Header Letter Spacing (default: -0.5px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'header_letter_spacing', 'choices' => array('min' => '-10', 'max' => '100', 'step' => '0.5') )));
        
        $wp_customize->add_setting( $prefix .'subtitle_font_size', array( 'default' => '18', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'subtitle_font_size', array( 'priority' => 14, 'label' => esc_html__( 'Subtitle Font Size (default: 18px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'subtitle_font_size', 'choices' => array('min' => '10', 'max' => '100', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'subtitle_letter_spacing', array( 'default' => '-0.5', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'subtitle_letter_spacing', array( 'priority' => 15, 'label' => esc_html__( 'Subtitle Letter Spacing (default: -0.5px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'subtitle_letter_spacing', 'choices' => array('min' => '-10', 'max' => '100', 'step' => '0.5') )));

        $wp_customize->add_setting( $prefix .'widget_font_size', array( 'default' => '12', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'widget_font_size', array( 'priority' => 16, 'label' => esc_html__( 'Widget Title Font Size (default: 12px)', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'widget_font_size', 'choices' => array('min' => '10', 'max' => '100', 'step' => '1') )));
 
        $wp_customize->add_setting( $prefix .'custom_css', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( new Wanium_Customize_Textarea_Control( $wp_customize, $prefix .'custom_css', array( 'priority' => 17, 'label' => esc_html__( 'Custom CSS', 'wanium' ), 'section' => 'styling_section', 'settings' => $prefix .'custom_css' )));

# HEADER - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'header_section', array( 'title' => esc_html__( 'Header', 'wanium' ), 'priority' => 212 ));
        
        $wp_customize->add_setting( $prefix .'site_logo', array( 'default' => 'image', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'site_logo', array( 'priority' => 0, 'label' => esc_html__( 'Site Logo', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'site_logo', 'choices' => $logo_options ));
        
        $wp_customize->add_setting( $prefix .'logo_text', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'logo_text', array( 'priority' => 1, 'label' => esc_html__( 'Logo Text', 'wanium' ), 'section' => 'header_section', 'settings'=> $prefix .'logo_text' ));

        $wp_customize->add_setting( $prefix .'custom_logo', array( 'default' => WANIUM_THEME_DIRECTORY . 'assets/img/logo-dark.png', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix .'custom_logo', array( 'priority' => 1, 'label' => esc_html__( 'Logo', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'custom_logo' )));
        $wp_customize->add_setting( $prefix .'custom_logo_light', array( 'default' => WANIUM_THEME_DIRECTORY . 'assets/img/logo-light.png', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix .'custom_logo_light', array( 'priority' => 2, 'label' => esc_html__( 'Logo Light', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'custom_logo_light' )));
        
        $wp_customize->add_setting( $prefix .'menu_wrap_width', array( 'default' => '100', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'menu_wrap_width', array( 'priority' => 3, 'label' => esc_html__( 'Menu Width (default: 100%)', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'menu_wrap_width', 'choices' => array('min' => '55', 'max' => '100', 'step' => '1') )));
        $wp_customize->add_setting( $prefix .'menu_height', array( 'default' => '64', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'menu_height', array( 'priority' => 4, 'label' => esc_html__( 'Menu Height (default: 64px)', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'menu_height', 'choices' => array('min' => '55', 'max' => '250', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'menu_right_space', array( 'default' => '32', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'menu_right_space', array( 'priority' => 5, 'label' => esc_html__( 'Menu Right Spacing (default: 32px)', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'menu_right_space', 'choices' => array('min' => '32', 'max' => '150', 'step' => '1') )));
        
        $wp_customize->add_setting( $prefix .'menu_column_width', array( 'default' => '230', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'menu_column_width', array( 'priority' => 6, 'label' => esc_html__( 'Menu Column Width (default: 230px)', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'menu_column_width', 'choices' => array('min' => '200', 'max' => '350', 'step' => '1') )));
        $wp_customize->add_setting( $prefix .'menu_vertical_width', array( 'default' => '280', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new Wanium_Customize_Range_Control( $wp_customize, $prefix .'menu_vertical_width', array( 'priority' => 7, 'label' => esc_html__( 'Menu Vertical Width (default: 280px)', 'wanium' ), 'section' => 'header_section', 'settings' => $prefix .'menu_vertical_width', 'choices' => array('min' => '200', 'max' => '900', 'step' => '1') )));
        $wp_customize->add_setting( $prefix .'header_layout', array( 'default' => 'standard', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_layout', array( 'priority' => 8, 'label' => esc_html__( 'Header Layout', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_layout', 'choices' => $header_layouts ));
        
        $wp_customize->add_setting( $prefix .'header_boxed', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_boxed', array( 'priority' => 9, 'label' => esc_html__( 'Boxed Header?', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_boxed', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'header_sticky', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_sticky', array( 'priority' => 9, 'label' => esc_html__( 'Sticky Header?', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_sticky', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'header_sticky_mobile', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_sticky_mobile', array( 'priority' => 9, 'label' => esc_html__( 'Sticky Header on mobile?', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_sticky_mobile', 'choices' => $yesno_options ));
        
        $wp_customize->add_setting( $prefix .'header_full', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_full', array( 'priority' => 10, 'label' => esc_html__( 'Header Megamenu Full Width?', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_full', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'header_search', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_search', array( 'priority' => 11, 'label' => esc_html__( 'Show Header Search?', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_search', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'header_cart', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_cart', array( 'priority' => 12, 'label' => esc_html__( 'Show Header Cart?', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_cart', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'header_language', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_language', array( 'priority' => 13, 'label' => esc_html__( 'Show Header Language? (require WPML plugin)', 'wanium' ), 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_language', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'header_first', array( 'default' => esc_html__( 'We create elegant websites', 'wanium' ), 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_first', array( 'priority' => 14, 'label' => esc_html__( 'Header First Text', 'wanium' ), 'section' => 'header_section', 'settings'=> $prefix .'header_first' ));
        $wp_customize->add_setting( $prefix .'header_second', array( 'default' => esc_html__( '(012) 1006 2310', 'wanium' ), 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'header_second', array( 'priority' => 15, 'label' => esc_html__( 'Header Second Text', 'wanium' ), 'section' => 'header_section', 'settings'=> $prefix .'header_second' ));
        for( $i = 1; $i < 11; $i++ ) {
            $wp_customize->add_setting( $prefix .'header_social_icon_' . $i, array( 'default' => 'none', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
            $wp_customize->add_control( $prefix .'header_social_icon_' . $i, array( 'priority' => (16 + $i + $i), 'label' => esc_html__( 'Header Social Icon ', 'wanium' ) . $i, 'type' => 'select', 'section' => 'header_section', 'settings'=> $prefix .'header_social_icon_' . $i, 'choices' => $social_options ));
            $wp_customize->add_setting( $prefix .'header_social_url_' . $i, array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
            $wp_customize->add_control( $prefix .'header_social_url_' . $i, array( 'priority' => (17 + $i + $i), 'label' => esc_html__( 'Header Social URL ', 'wanium' ) . $i, 'section' => 'header_section', 'settings'=> $prefix .'header_social_url_' . $i ));
        }

# FOOTER - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'footer_section', array( 'title' => esc_html__( 'Footer', 'wanium' ), 'priority' => 213 ));
        $wp_customize->add_setting( $prefix .'footer_layout', array( 'default' => 'standard', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'footer_layout', array( 'priority' => 1, 'label' => esc_html__( 'Footer Layout', 'wanium' ), 'type' => 'select', 'section' => 'footer_section', 'settings'=> $prefix .'footer_layout', 'choices' => $footer_layouts ));
        $wp_customize->add_setting( $prefix .'enable_copyright', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_copyright', array( 'priority' => 2, 'label' => esc_html__( 'Enable Footer Copyright?', 'wanium' ), 'type' => 'select', 'section' => 'footer_section', 'settings'=> $prefix .'enable_copyright', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'footer_copyright', array( 'default' => esc_html__( 'Modify this text in: Appearance > Customize > Footer', 'wanium' ), 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'footer_copyright', array( 'priority' => 3, 'label' => esc_html__( 'Footer Copyright Text', 'wanium' ), 'section' => 'footer_section', 'settings'=> $prefix .'footer_copyright' ));
        for( $i = 1; $i < 11; $i++ ) {
            $wp_customize->add_setting( $prefix .'footer_social_icon_' . $i, array( 'default' => 'none', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
            $wp_customize->add_control( $prefix .'footer_social_icon_' . $i, array( 'priority' => (4 + $i + $i), 'label' => esc_html__( 'Footer Social Icon ', 'wanium' ) . $i, 'type' => 'select', 'section' => 'footer_section', 'settings'=> $prefix .'footer_social_icon_' . $i, 'choices' => $social_options ));
            $wp_customize->add_setting( $prefix .'footer_social_url_' . $i, array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
            $wp_customize->add_control( $prefix .'footer_social_url_' . $i, array( 'priority' => (5 + $i + $i), 'label' => esc_html__( 'Footer Social URL ', 'wanium' ) . $i, 'section' => 'footer_section', 'settings'=> $prefix .'footer_social_url_' . $i ));
        }

# SEARCH - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'search_section', array( 'title' => esc_html__( 'Search', 'wanium' ), 'priority' => 214 ));
        $wp_customize->add_setting( $prefix .'search_layout', array( 'default' => 'sidebar-right', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'search_layout', array( 'priority' => 1, 'label' => esc_html__( 'Archives Layout', 'wanium' ), 'type' => 'select', 'section' => 'search_section', 'settings'=> $prefix .'search_layout', 'choices' => $single_layouts ));
        $wp_customize->add_setting( $prefix .'search_header_layout', array( 'default' => 'center', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'search_header_layout', array( 'priority' => 2, 'label' => esc_html__( 'Search Title Layout', 'wanium' ), 'type' => 'select', 'section' => 'search_section', 'settings'=> $prefix .'search_header_layout', 'choices' => $page_titles ));
        $wp_customize->add_setting( $prefix .'search_header_image', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix .'search_header_image', array( 'priority' => 3, 'label' => esc_html__( 'Search Header Background', 'wanium' ), 'section' => 'search_section', 'settings' => $prefix .'search_header_image' )));
        
# BLOG - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'blog_section', array( 'title' => esc_html__( 'Blog', 'wanium' ), 'priority' => 214 ));
        $wp_customize->add_setting( $prefix .'post_layout', array( 'default' => 'sidebar-none', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'post_layout', array( 'priority' => 1, 'label' => esc_html__( 'Single Layout', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'post_layout', 'choices' => $single_layouts ));
        $wp_customize->add_setting( $prefix .'blog_layout', array( 'default' => 'sidebar-right', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_layout', array( 'priority' => 2, 'label' => esc_html__( 'Archives Layout', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_layout', 'choices' => $blog_layouts ));
        $wp_customize->add_setting( $prefix .'blog_header_layout', array( 'default' => 'center', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_header_layout', array( 'priority' => 3, 'label' => esc_html__( 'Blog Title Layout', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_header_layout', 'choices' => $page_titles ));
        $wp_customize->add_setting( 'tlg_framework_blog_title', array( 'default' => esc_html__( 'Our Blog', 'wanium' ), 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_blog_title', array( 'priority' => 4, 'label' => esc_html__( 'Blog Title', 'wanium' ), 'section' => 'blog_section', 'settings'=> 'tlg_framework_blog_title' ));
        $wp_customize->add_setting( $prefix .'blog_subtitle', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_subtitle', array( 'priority' => 5, 'label' => esc_html__( 'Blog Subtitle', 'wanium' ), 'section' => 'blog_section', 'settings'=> $prefix .'blog_subtitle' ));
        $wp_customize->add_setting( $prefix .'blog_header_image', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix .'blog_header_image', array( 'priority' => 6, 'label' => esc_html__( 'Blog Header Background', 'wanium' ), 'section' => 'blog_section', 'settings' => $prefix .'blog_header_image' )));
        $wp_customize->add_setting( $prefix .'blog_show_feature', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_show_feature', array( 'priority' => 7, 'label' => esc_html__( 'Show feature image on single post?', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_show_feature', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'blog_enable_pagination', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_enable_pagination', array( 'priority' => 8, 'label' => esc_html__( 'Enable Single Pagination?', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_enable_pagination', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'blog_author_info', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_author_info', array( 'priority' => 9, 'label' => esc_html__( 'Enable Author Info?', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_author_info', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'blog_related', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_related', array( 'priority' => 10, 'label' => esc_html__( 'Enable Related Posts', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_related', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'blog_comment', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_comment', array( 'priority' => 11, 'label' => esc_html__( 'Enable Post Comment?', 'wanium' ), 'type' => 'select', 'section' => 'blog_section', 'settings'=> $prefix .'blog_comment', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'blog_excerpt_length', array( 'default' => 16, 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'blog_excerpt_length', array( 'priority' => 12, 'label' => esc_html__( 'Number of words (excerpt length)', 'wanium' ), 'section' => 'blog_section', 'settings'=> $prefix .'blog_excerpt_length' ));

# PORTFOLIO - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'portfolio_section', array( 'title' => esc_html__( 'Portfolio', 'wanium' ), 'priority' => 215, 'description' => wp_kses( __( '* When you make change on \'Portfolio URL slug\', please make sure to refresh the permalinks by going to <a target="_blank" href="options-permalink.php">Settings > Permalinks</a> and click on the \'Save Changes\' button. Otherwise, the change will do not work properly.', 'wanium' ), wanium_allowed_tags() ) ));
        $wp_customize->add_setting( 'tlg_framework_portfolio_slug', array( 'default' => 'portfolio', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_portfolio_slug', array( 'priority' => 1, 'label' => esc_html__( '* Portfolio URL slug', 'wanium' ), 'section' => 'portfolio_section', 'settings'=> 'tlg_framework_portfolio_slug' ));
        $wp_customize->add_setting( $prefix .'portfolio_layout', array( 'default' => 'full-grid-4col', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_layout', array( 'priority' => 2, 'label' => esc_html__( 'Archives Layout', 'wanium' ), 'type' => 'select', 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_layout', 'choices' => $portfolio_layouts ));
        $wp_customize->add_setting( $prefix .'portfolio_header_layout', array( 'default' => 'center', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_header_layout', array( 'priority' => 3, 'label' => esc_html__( 'Portfolio Title Layout', 'wanium' ), 'type' => 'select', 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_header_layout', 'choices' => $page_titles ));
        $wp_customize->add_setting( $prefix .'portfolio_title', array( 'default' => esc_html__( 'Our Portfolio', 'wanium' ), 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_title', array( 'priority' => 4, 'label' => esc_html__( 'Portfolio Title', 'wanium' ), 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_title' ));
        $wp_customize->add_setting( $prefix .'portfolio_subtitle', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_subtitle', array( 'priority' => 5, 'label' => esc_html__( 'Portfolio Subtitle', 'wanium' ), 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_subtitle' ));
        $wp_customize->add_setting( $prefix .'portfolio_header_image', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix .'portfolio_header_image', array( 'priority' => 6, 'label' => esc_html__( 'Portfolio Header Background', 'wanium' ), 'section' => 'portfolio_section', 'settings' => $prefix .'portfolio_header_image' )));
        $wp_customize->add_setting( $prefix .'portfolio_enable_share', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_enable_share', array( 'priority' => 7, 'label' => esc_html__( 'Enable Share Project?', 'wanium' ), 'type' => 'select', 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_enable_share', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'portfolio_enable_pagination', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_enable_pagination', array( 'priority' => 8, 'label' => esc_html__( 'Enable Next/Previous Projects?', 'wanium' ), 'type' => 'select', 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_enable_pagination', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'portfolio_gallery', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'portfolio_gallery', array( 'priority' => 9, 'label' => esc_html__( 'Enable portfolio gallery lightbox?', 'wanium' ), 'type' => 'select', 'section' => 'portfolio_section', 'settings'=> $prefix .'portfolio_gallery', 'choices' => $yesno_options ));

# SHOP - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'shop_section', array( 'title' => esc_html__( 'Shop', 'wanium' ), 'priority' => 216 ));
        $wp_customize->add_setting( $prefix .'shop_ppp', array( 'default' => 6, 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_ppp', array( 'priority' => 1, 'label' => esc_html__( 'Number of Products per Page', 'wanium' ), 'section' => 'shop_section', 'settings'=> $prefix .'shop_ppp' ));
        $wp_customize->add_setting( $prefix .'shop_layout', array( 'default' => 'sidebar-right', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_layout', array( 'priority' => 2, 'label' => esc_html__( 'Archives Layout', 'wanium' ), 'type' => 'select', 'section' => 'shop_section', 'settings'=> $prefix .'shop_layout', 'choices' => $shop_layouts ));
        $wp_customize->add_setting( $prefix .'shop_menu_layout', array( 'default' => 'default', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_menu_layout', array( 'priority' => 3, 'label' => esc_html__( 'Header Layout', 'wanium' ), 'type' => 'select', 'section' => 'shop_section', 'settings'=> $prefix .'shop_menu_layout', 'choices' => array( 'default' => esc_html__( '(default layout)', 'wanium' ) ) + $header_layouts ));
        $wp_customize->add_setting( $prefix .'shop_header_layout', array( 'default' => 'center', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_header_layout', array( 'priority' => 4, 'label' => esc_html__( 'Shop Title Layout', 'wanium' ), 'type' => 'select', 'section' => 'shop_section', 'settings'=> $prefix .'shop_header_layout', 'choices' => $page_titles ));
        $wp_customize->add_setting( $prefix .'shop_title', array( 'default' => esc_html__( 'Our Shop', 'wanium' ), 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_title', array( 'priority' => 5, 'label' => esc_html__( 'Shop Title', 'wanium' ), 'section' => 'shop_section', 'settings'=> $prefix .'shop_title' ));
        $wp_customize->add_setting( $prefix .'shop_subtitle', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_subtitle', array( 'priority' => 6, 'label' => esc_html__( 'Shop Subtitle', 'wanium' ), 'section' => 'shop_section', 'settings'=> $prefix .'shop_subtitle' ));
        $wp_customize->add_setting( $prefix .'shop_header_image', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize', ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix .'shop_header_image', array( 'priority' => 7, 'label' => esc_html__( 'Shop Header Background', 'wanium' ), 'section' => 'shop_section', 'settings' => $prefix .'shop_header_image' )));
        $wp_customize->add_setting( $prefix .'shop_enable_pagination', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_enable_pagination', array( 'priority' => 8, 'label' => esc_html__( 'Enable Single Pagination?', 'wanium' ), 'type' => 'select', 'section' => 'shop_section', 'settings'=> $prefix .'shop_enable_pagination', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'shop_menu_override', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'shop_menu_override', array( 'priority' => 9, 'label' => esc_html__( 'Shop Selected Menu', 'wanium' ), 'type' => 'select', 'section' => 'shop_section', 'settings'=> $prefix .'shop_menu_override', 'choices' => $menu_options ));
        
# SYSTEM - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        $wp_customize->add_section( 'system_section', array( 'title' => esc_html__( 'System', 'wanium' ), 'priority' => 218 ));
        $wp_customize->add_setting( 'tlg_framework_gmaps_key', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_gmaps_key', array( 'priority' => 0, 'label' => esc_html__( 'Google Maps API key', 'wanium' ), 'section' => 'system_section', 'settings'=> 'tlg_framework_gmaps_key', 'description' => wp_kses( __( 'As per Google announcement, usage of the Google Maps <strong>Embed API</strong> now requires a key. Please have a look at the <a target="_blank" href="https://developers.google.com/maps/documentation/embed/get-api-key">Google Maps APIs documentation</a> to get a key and add it to the field below.', 'wanium' ), wanium_allowed_tags() ) ));
        $wp_customize->add_setting( 'tlg_framework_instagram_token', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_instagram_token', array( 'priority' => 0, 'label' => esc_html__( 'Instagram Access Token', 'wanium' ), 'section' => 'system_section', 'settings'=> 'tlg_framework_instagram_token', 'description' => wp_kses( __( 'Due to recent changes in the Instagram API – you\'ll need to provide Access Token in order to show Instagram photos on your site. Please have a look at <a href="http://www.themelogi.com/how-to-get-instagram-access-token/" target="_blank">Instagram Access Token documentation</a> to retrieve an access token.', 'wanium' ), wanium_allowed_tags() ) ));
        $wp_customize->add_setting( 'tlg_framework_custom_fonts', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_custom_fonts', array( 'priority' => 0, 'label' => esc_html__( 'Custom Google Font ([font-family|source-link|font-style], separated by commas)', 'wanium' ), 'section' => 'system_section', 'settings'=> 'tlg_framework_custom_fonts', 'description' => wp_kses( __( 'Please have a look at <a target="_blank" href="http://www.themelogi.com/tickets/topic/faq/#custom_google_font">our FAQs page</a> for more details about adding custom Google fonts.', 'wanium' ), wanium_allowed_tags() ) ) );
        $wp_customize->add_setting( 'tlg_framework_custom_icons', array( 'default' => '', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_custom_icons', array( 'priority' => 0, 'label' => esc_html__( 'Custom Icons Font Classes (separated by commas)', 'wanium' ), 'section' => 'system_section', 'settings'=> 'tlg_framework_custom_icons' ));
        $wp_customize->add_setting( $prefix .'page_layout', array( 'default' => 'center', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'page_layout', array( 'priority' => 0, 'label' => esc_html__( 'Single Page Title Layout', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'page_layout', 'choices' => $page_titles ));
        $wp_customize->add_setting( 'tlg_framework_page_title_tag', array( 'default' => 'h1', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_page_title_tag', array( 'priority' => 0, 'label' => esc_html__( 'Page Title Heading', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> 'tlg_framework_page_title_tag', 'choices' => $page_title_tag ));
        $wp_customize->add_setting( $prefix .'enable_preloader', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_preloader', array( 'priority' => 0, 'label' => esc_html__( 'Enable Preloader?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_preloader', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_portfolio_comment', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_portfolio_comment', array( 'priority' => 0, 'label' => esc_html__( 'Enable Portfolio Comment?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_portfolio_comment', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_page_comment', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_page_comment', array( 'priority' => 0, 'label' => esc_html__( 'Enable Page Comment?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_page_comment', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_blur_overlay', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_blur_overlay', array( 'priority' => 0, 'label' => esc_html__( 'Enable Blur Overlay?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_blur_overlay', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_portfolio', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_portfolio', array( 'priority' => 1, 'label' => esc_html__( 'Enable Portfolio?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_portfolio', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_team', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_team', array( 'priority' => 2, 'label' => esc_html__( 'Enable Team Members?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_team', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_client', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_client', array( 'priority' => 3, 'label' => esc_html__( 'Enable Clients?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_client', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_testimonial', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_testimonial', array( 'priority' => 4, 'label' => esc_html__( 'Enable Testimonials?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_testimonial', 'choices' => $yesno_options ));
        $wp_customize->add_setting( 'tlg_framework_show_breadcrumbs', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_show_breadcrumbs', array( 'priority' => 5, 'label' => esc_html__( 'Enable Breadcrumbs?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> 'tlg_framework_show_breadcrumbs', 'choices' => $yesno_options ));
        $wp_customize->add_setting( 'tlg_framework_show_breadcrumbs_cat', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( 'tlg_framework_show_breadcrumbs_cat', array( 'priority' => 5, 'label' => esc_html__( 'Enable Category in Breadcrumbs?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> 'tlg_framework_show_breadcrumbs_cat', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_scroll_top', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_scroll_top', array( 'priority' => 6, 'label' => esc_html__( 'Enable Scroll To Top button?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_scroll_top', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_search_filter', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_search_filter', array( 'priority' => 7, 'label' => esc_html__( 'Exclude Pages from Search Results?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_search_filter', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'auto_vc_page', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'auto_vc_page', array( 'priority' => 8, 'label' => esc_html__( 'Auto activate Visual Composer for Page?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'auto_vc_page', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'auto_vc_post', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'auto_vc_post', array( 'priority' => 9, 'label' => esc_html__( 'Auto activate Visual Composer for Post?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'auto_vc_post', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'auto_vc_portfolio', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'auto_vc_portfolio', array( 'priority' => 10, 'label' => esc_html__( 'Auto activate Visual Composer for Portfolio?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'auto_vc_portfolio', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'auto_vc_product', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'auto_vc_product', array( 'priority' => 11, 'label' => esc_html__( 'Auto activate Visual Composer for Product?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'auto_vc_product', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_default_vc_shortcode', array( 'default' => 'no', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_default_vc_shortcode', array( 'priority' => 12, 'label' => esc_html__( 'Enable Visual Composer Default Shortcode?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_default_vc_shortcode', 'choices' => $yesno_options ));
        $wp_customize->add_setting( $prefix .'enable_default_wc_shortcode', array( 'default' => 'yes', 'capability' => 'edit_theme_options', 'type' => 'option', 'sanitize_callback' => 'wanium_sanitize' ));
        $wp_customize->add_control( $prefix .'enable_default_wc_shortcode', array( 'priority' => 12, 'label' => esc_html__( 'Enable WooCommerce Default Shortcode?', 'wanium' ), 'type' => 'select', 'section' => 'system_section', 'settings'=> $prefix .'enable_default_wc_shortcode', 'choices' => $yesno_options ));

    }
    add_action( 'customize_register', 'wanium_register_options' );
}