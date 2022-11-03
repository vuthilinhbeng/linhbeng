<?php
/**
 * Sirat Theme Customizer
 *
 * @package Sirat
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function sirat_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'sirat_custom_controls' );

function sirat_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->add_setting('sirat_background_skin',array(
        'default' => 'Without Background',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_background_skin',array(
        'type' => 'select',
        'label' => __('Background Skin','sirat'),
        'description' => __('you can add the background skin with the background image.','sirat'),
        'section' => 'background_image',
        'choices' => array(
            'With Background' => __('With Background Skin Mode','sirat'),
            'Without Background' => __('Without Background Skin Mode','sirat'),
        ),
	) );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 'selector' => '.logo .site-title a', 
	 	'render_callback' => 'sirat_customize_partial_blogname', ) ); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 'selector' => 'p.site-description', 
		'render_callback' => 'sirat_customize_partial_blogdescription', ) );

	//Homepage Settings
	$wp_customize->add_panel( 'sirat_homepage_panel', array(
		'title' => esc_html__( 'Homepage Settings', 'sirat' ),
		'panel' => 'sirat_panel_id',
		'priority' => 20,
	));

	//Top Bar
	$wp_customize->add_section( 'sirat_topbar', array(
    	'title'      => __( 'Top Bar Settings', 'sirat' ),
		'panel' => 'sirat_homepage_panel'
	) );

	$wp_customize->add_setting( 'sirat_topbar_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_topbar_hide_show',array(
		'label' => esc_html__( 'Show / Hide Topbar','sirat' ),
		'section' => 'sirat_topbar'
    )));

    $wp_customize->add_setting('sirat_topbar_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_topbar_padding_top_bottom',array(
		'label'	=> __('Topbar Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

    $wp_customize->add_setting( 'sirat_header_search',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_header_search',array(
      	'label' => esc_html__( 'Show / Hide Search','sirat' ),
      	'section' => 'sirat_topbar'
    )));

    $wp_customize->add_setting('sirat_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_search_icon',array(
		'label'	=> __('Add Search Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_topbar',
		'setting'	=> 'sirat_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('sirat_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_topbar',
		'setting'	=> 'sirat_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('sirat_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_search_font_size',array(
		'label'	=> __('Search Font Size','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_search_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_search_padding_top_bottom',array(
		'label'	=> __('Search Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_search_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_search_padding_left_right',array(
		'label'	=> __('Search Padding Left Right','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_search_border_radius', array(
		'default'              => "",
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_search_border_radius', array(
		'label'       => esc_html__( 'Search Border Radius','sirat' ),
		'section'     => 'sirat_topbar',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('sirat_search_placeholder',array(
       'default' => esc_html__('Search','sirat'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('sirat_search_placeholder',array(
       'type' => 'text',
       'label' => __('Search Placeholder Text','sirat'),
       'section' => 'sirat_topbar'
    ));

    //Sticky Header
	$wp_customize->add_setting( 'sirat_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','sirat' ),
        'section' => 'sirat_topbar'
    )));

    $wp_customize->add_setting('sirat_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

    $wp_customize->add_setting('sirat_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_navigation_menu_font_weight',array(
        'default' => 'Default',
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','sirat'),
        'section' => 'sirat_topbar',
        'choices' => array(
        	'Default' => __('Default','sirat'),
            'Normal' => __('Normal','sirat')
        ),
	) );	

	 $wp_customize->add_setting('sirat_navigation_menu_text_transform',array(
        'default' => 'Default',
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_navigation_menu_text_transform',array(
        'type' => 'select',
        'label' => __('Menus Text Transform','sirat'),
        'section' => 'sirat_topbar',
        'choices' => array(
        	'Default' => __('Default','sirat'),
            'Uppercase' => __('Uppercase','sirat')
        ),
	) );

	$wp_customize->add_setting('sirat_header_menus_color', array(
		'default'           => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_header_menus_color', array(
		'label'    => __('Menus Color', 'sirat'),
		'section'  => 'sirat_topbar',
	)));

	$wp_customize->add_setting('sirat_header_menus_hover_color', array(
		'default'           => '#febe00',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'sirat'),
		'section'  => 'sirat_topbar',
	)));

	$wp_customize->add_setting('sirat_header_submenus_color', array(
		'default'           => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'sirat'),
		'section'  => 'sirat_topbar',
	)));

	$wp_customize->add_setting('sirat_header_submenus_hover_color', array(
		'default'           => '#febe00',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'sirat'),
		'section'  => 'sirat_topbar',
	)));

    $wp_customize->add_setting('sirat_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_phone_icon',array(
		'label'	=> __('Add Phone Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_topbar',
		'setting'	=> 'sirat_phone_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('sirat_contact_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'sirat_sanitize_phone_number'
	));
	$wp_customize->add_control('sirat_contact_call',array(
		'label'	=> __('Add Phone Number','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '+00 987 654 1230', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'sirat_contact_call', array( 'selector' => '.top-bar p:first-child', 
		'render_callback' => 'sirat_customize_partial_sirat_contact_call', ) );

	$wp_customize->add_setting('sirat_contact_email_icon',array(
		'default'	=> 'far fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_contact_email_icon',array(
		'label'	=> __('Add Email Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_topbar',
		'setting'	=> 'sirat_contact_email_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('sirat_contact_email',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));
	$wp_customize->add_control('sirat_contact_email',array(
		'label'	=> __('Add Email Address','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'example@gmail.com', 'sirat' ),
        ),
		'section'=> 'sirat_topbar',
		'type'=> 'text'
	));

    //Header layout
	$wp_customize->add_setting('sirat_header_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control(new Sirat_Image_Radio_Control($wp_customize, 'sirat_header_content_option', array(
        'type' => 'select',
        'label' => __('Header Layouts','sirat'),
        'section' => 'sirat_topbar',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/header-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/header-layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/header-layout3.png',
    ))));
    
	//Slider 
	$wp_customize->add_section( 'sirat_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'sirat' ),
    	'description' => __('Free theme has 3 slides options, For unlimited slides and more options <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/multipurpose-wordpress-theme/">GO PRO</a>','sirat'),
		'panel' => 'sirat_homepage_panel'
	) );

	$wp_customize->add_setting( 'sirat_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','sirat' ),
      	'section' => 'sirat_slidersettings'
    )));

    $wp_customize->add_setting( 'sirat_slider_indicator_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_slider_indicator_show_hide',array(
		'label' => esc_html__( 'Show / Hide Slider Indicators','sirat' ),
		'section' => 'sirat_slidersettings'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('sirat_slider_arrows',array(
		'selector'        => '.slider-refresh h3, #slider h1',
		'render_callback' => 'sirat_customize_partial_sirat_slider_arrows',
	));

    $wp_customize->add_setting('sirat_slider_background_options',array(
        'default' => 'Slideshow',
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_slider_background_options',array(
        'type' => 'select',
        'label' => __('Slider Background Option','sirat'),
        'section' => 'sirat_slidersettings',
        'choices' => array(
        	'Slideshow' => __('Slideshow','sirat'),
            'Image' => __('Image','sirat'),
            'Gradient' => __('Gradient','sirat'),
            'Video' => __('Video','sirat')
        ),
	) );

		//Slideshow
		for ( $count = 1; $count <= 3; $count++ ) {
			$wp_customize->add_setting( 'sirat_slider_page' . $count, array(
				'default'           => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'sirat_sanitize_dropdown_pages'
			) );
			$wp_customize->add_control( 'sirat_slider_page' . $count, array(
				'label'    => __( 'Select Slider Page', 'sirat' ),
				'description' => __('Slider image size (1500 x 800)','sirat'),
				'section'  => 'sirat_slidersettings',
				'type'     => 'dropdown-pages',
				'active_callback' => 'sirat_slider_slideshow'
			));
		}

		//Image
		$wp_customize->add_setting( 'sirat_slider2_page' , array(
			'default'           => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'sirat_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'sirat_slider2_page' , array(
			'label'    => __( 'Select Slider Page', 'sirat' ),
			'description' => __('Image Size (1500 x 800)','sirat'),
			'section'  => 'sirat_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'sirat_slider_image'
		));

		//Gradient
		$wp_customize->add_setting( 'sirat_slider_background', array(
		    'default' => '#febe00',
		    'transport' => 'refresh',
		    'sanitize_callback' => 'sanitize_hex_color'
	  	));
	  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sirat_slider_background', array(
	  		'label'    => __( 'Slider Background Color', 'sirat' ),
		    'section' => 'sirat_slidersettings',
		    'settings' => 'sirat_slider_background',
			'active_callback' => 'sirat_slider_gradient'
	  	)));

		//Video
		$wp_customize->add_setting('sirat_slider_background_video_url',array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		));
		$wp_customize->add_control('sirat_slider_background_video_url',array(
			'label' => __('Add video embed link','sirat'),
			'section' => 'sirat_slidersettings',
			'setting' => 'sirat_slider_background_video_url',
			'type' => 'url',
			'active_callback' => 'sirat_slider_video'
		));

	//Slider title, content and button hide show
	$wp_customize->add_setting( 'sirat_slider_title_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_slider_title_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Title','sirat' ),
		'section' => 'sirat_slidersettings',
		'active_callback' => 'sirat_slider_hide_show_title'
    )));

    $wp_customize->add_setting( 'sirat_slider_content_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_slider_content_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Content','sirat' ),
		'section' => 'sirat_slidersettings',
		'active_callback' => 'sirat_slider_hide_show_content'
    )));

    $wp_customize->add_setting( 'sirat_slider_button_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_slider_button_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Button','sirat' ),
		'section' => 'sirat_slidersettings',
		'active_callback' => 'sirat_slider_hide_show_button'
    )));

    $wp_customize->add_setting('sirat_slider_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'sirat' ),
        ),
		'section'=> 'sirat_slidersettings',
		'type'=> 'text',
        'active_callback' => 'sirat_slider_hide_show_button_text'
	));

	//content layout
	$wp_customize->add_setting('sirat_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control(new Sirat_Image_Radio_Control($wp_customize, 'sirat_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','sirat'),
        'section' => 'sirat_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ))));

	//Slider content padding
    $wp_customize->add_setting('sirat_slider_content_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_slider_content_padding_top_bottom',array(
		'label'	=> __('Slider Content Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in %. Example:20%','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'sirat' ),
        ),
		'section'=> 'sirat_slidersettings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_slider_content_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_slider_content_padding_left_right',array(
		'label'	=> __('Slider Content Padding Left Right','sirat'),
		'description'	=> __('Enter a value in %. Example:20%','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'sirat' ),
        ),
		'section'=> 'sirat_slidersettings',
		'type'=> 'text'
	));

    //Slider excerpt
	$wp_customize->add_setting( 'sirat_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','sirat' ),
		'section'     => 'sirat_slidersettings',
		'type'        => 'range',
		'settings'    => 'sirat_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('sirat_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'sirat_sanitize_choices'
	));

	$wp_customize->add_control( 'sirat_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','sirat' ),
	'section'     => 'sirat_slidersettings',
	'type'        => 'select',
	'settings'    => 'sirat_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','sirat'),
      '0.1' =>  esc_attr('0.1','sirat'),
      '0.2' =>  esc_attr('0.2','sirat'),
      '0.3' =>  esc_attr('0.3','sirat'),
      '0.4' =>  esc_attr('0.4','sirat'),
      '0.5' =>  esc_attr('0.5','sirat'),
      '0.6' =>  esc_attr('0.6','sirat'),
      '0.7' =>  esc_attr('0.7','sirat'),
      '0.8' =>  esc_attr('0.8','sirat'),
      '0.9' =>  esc_attr('0.9','sirat')
	),
	));

	//Slider height
	$wp_customize->add_setting('sirat_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_slider_height',array(
		'label'	=> __('Slider Height','sirat'),
		'description'	=> __('Specify the slider height (px).','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'sirat' ),
        ),
		'section'=> 'sirat_slidersettings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'sirat_sanitize_float'
	) );
	$wp_customize->add_control( 'sirat_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','sirat'),
		'section' => 'sirat_slidersettings',
		'type'  => 'number',
	) );

	$wp_customize->add_setting( 'sirat_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_slider_image_overlay',array(
      	'label' => esc_html__( 'Slider Image Overlay','sirat' ),
      	'section' => 'sirat_slidersettings'
    )));

    $wp_customize->add_setting('sirat_slider_image_overlay_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'sirat'),
		'section'  => 'sirat_slidersettings',
	)));

	//Partners Contact
	$wp_customize->add_section('sirat_partners', array(
		'title'       => __('Partners Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_partners_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_partners_text',array(
		'description' => __('<p>1. More options for Partners section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Partners section.</p>','sirat'),
		'section'=> 'sirat_partners',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_partners_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_partners_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_partners',
		'type'=> 'hidden'
	));

	//About Us Section
	$wp_customize->add_section('sirat_about', array(
		'title'       => __('About Us Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_about_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_about_text',array(
		'description' => __('<p>1. More options for about section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for about section.</p>','sirat'),
		'section'=> 'sirat_about',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_about_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_about_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_about',
		'type'=> 'hidden'
	));
    
	//Our Services section
	$wp_customize->add_section( 'sirat_services_section' , array(
    	'title'      => __( 'Our Services Settings', 'sirat' ),
    	'description' => __('For more options of services section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/multipurpose-wordpress-theme/">GO PRO</a>','sirat'),
		'priority'   => null,
		'panel' => 'sirat_homepage_panel'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'sirat_section_title', array( 
		'selector' => '#serv-section .heading-box h2, .services-refresh h3', 
		'render_callback' => 'sirat_customize_partial_sirat_section_title', ) );

	$wp_customize->add_setting('sirat_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_section_title',array(
		'label'	=> __('Add Section Title','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'AWESOME SERVICES', 'sirat' ),
        ),
		'section'=> 'sirat_services_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_section_text',array(
		'label'	=> __('Add Section Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Lorem ipsum is dummy text', 'sirat' ),
        ),
		'section'=> 'sirat_services_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('sirat_our_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sirat_sanitize_choices',
	));
	$wp_customize->add_control('sirat_our_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Services','sirat'),
		'description' => __('Image Size (50 x 50)','sirat'),
		'section' => 'sirat_services_section',
	));

	$wp_customize->add_setting('sirat_services_icon',array(
		'default'	=> 'fas fa-arrow-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_services_icon',array(
		'label'	=> __('Add Services Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_services_section',
		'setting'	=> 'sirat_services_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'sirat_about_page' , array(
		'default'           => '',
		'sanitize_callback' => 'sirat_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'sirat_about_page' , array(
		'label'    => __( 'Select About Page', 'sirat' ),
		'description' => __('Image Size (280 x 280)','sirat'),
		'section'  => 'sirat_services_section',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting( 'sirat_services_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_services_excerpt_number', array(
		'label'       => esc_html__( 'Services Excerpt length','sirat' ),
		'section'     => 'sirat_services_section',
		'type'        => 'range',
		'settings'    => 'sirat_services_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('sirat_about_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_about_button_text',array(
		'label'	=> __('Add About Button Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'sirat' ),
        ),
		'section'=> 'sirat_services_section',
		'type'=> 'text'
	));

	//Our Classes Section
	$wp_customize->add_section('sirat_classes', array(
		'title'       => __('Our Classes Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_classes_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_classes_text',array(
		'description' => __('<p>1. More options for Our Classes section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Classes section.</p>','sirat'),
		'section'=> 'sirat_classes',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_classes_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_classes_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_classes',
		'type'=> 'hidden'
	));

	//Get Quote Section
	$wp_customize->add_section('sirat_quote', array(
		'title'       => __('Quote Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_quote_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_quote_text',array(
		'description' => __('<p>1. More options for Quote section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Quote section.</p>','sirat'),
		'section'=> 'sirat_quote',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_quote_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_quote_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_quote',
		'type'=> 'hidden'
	));

	//Our Team Section
	$wp_customize->add_section('sirat_team', array(
		'title'       => __('Team Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_team_text',array(
		'description' => __('<p>1. More options for Team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Team section.</p>','sirat'),
		'section'=> 'sirat_team',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_team',
		'type'=> 'hidden'
	));

	//Our Skills and Video Section
	$wp_customize->add_section('sirat_skills_and_video', array(
		'title'       => __('Skills and Video Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_skills_and_video_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_skills_and_video_text',array(
		'description' => __('<p>1. More options for Skills and Video section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Skills and Video section.</p>','sirat'),
		'section'=> 'sirat_skills_and_video',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_skills_and_video_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_skills_and_video_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_skills_and_video',
		'type'=> 'hidden'
	));

	//Pricing Plans Section
	$wp_customize->add_section('sirat_pricing_plans', array(
		'title'       => __('Pricing Plans Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_pricing_plans_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_pricing_plans_text',array(
		'description' => __('<p>1. More options for Pricing Plans section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Pricing Plans section.</p>','sirat'),
		'section'=> 'sirat_pricing_plans',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_pricing_plans_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_pricing_plans_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_pricing_plans',
		'type'=> 'hidden'
	));

	//Testimonials Section
	$wp_customize->add_section('sirat_testimonials', array(
		'title'       => __('Testimonials Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_testimonials_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_testimonials_text',array(
		'description' => __('<p>1. More options for Testimonials section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Testimonials section.</p>','sirat'),
		'section'=> 'sirat_testimonials',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_testimonials_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_testimonials_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_testimonials',
		'type'=> 'hidden'
	));

	//Our Blogs Section
	$wp_customize->add_section('sirat_our_blogs', array(
		'title'       => __('Our Blogs Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_our_blogs_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_our_blogs_text',array(
		'description' => __('<p>1. More options for Our Blogs section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Blogs section.</p>','sirat'),
		'section'=> 'sirat_our_blogs',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_our_blogs_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_our_blogs_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_our_blogs',
		'type'=> 'hidden'
	));

	//Newsletter Section
	$wp_customize->add_section('sirat_newsletter', array(
		'title'       => __('Newsletter Section', 'sirat'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','sirat'),
		'priority'    => null,
		'panel'       => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_newsletter_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_newsletter_text',array(
		'description' => __('<p>1. More options for Newsletter section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Newsletter section.</p>','sirat'),
		'section'=> 'sirat_newsletter',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('sirat_newsletter_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_newsletter_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=sirat_guide') ." '>More Info</a>",
		'section'=> 'sirat_newsletter',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('sirat_footer',array(
		'title'	=> __('Footer Settings','sirat'),
		'description' => __('For more options of footer section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/multipurpose-wordpress-theme/">GO PRO</a>','sirat'),
		'panel' => 'sirat_homepage_panel',
	));

	$wp_customize->add_setting('sirat_footer_background_color', array(
		'default'           => '#121212',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_footer_background_color', array(
		'label'    => __('Footer Background Color', 'sirat'),
		'section'  => 'sirat_footer',
	)));	

	$wp_customize->add_setting('sirat_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'sirat_footer_background_image',array(
        'label' => __('Footer Background Image','sirat'),
        'section' => 'sirat_footer'
	)));

	$wp_customize->add_setting('sirat_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','sirat'),
        'section' => 'sirat_footer',
        'choices' => array(
        	'Left' => __('Left','sirat'),
            'Center' => __('Center','sirat'),
            'Right' => __('Right','sirat')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'sirat_footer_text', array( 'selector' => '#footer-2 .copyright p', 
		'render_callback' => 'sirat_customize_partial_sirat_footer_text', ) );
	
	$wp_customize->add_setting('sirat_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('sirat_footer_text',array(
		'label'	=> __('Copyright Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control(new Sirat_Image_Radio_Control($wp_customize, 'sirat_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','sirat'),
        'section' => 'sirat_footer',
        'settings' => 'sirat_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

	$wp_customize->add_setting( 'sirat_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','sirat' ),
      	'section' => 'sirat_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('sirat_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'sirat_customize_partial_sirat_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('sirat_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_footer',
		'setting'	=> 'sirat_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('sirat_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_scroll_to_top_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_scroll_to_top_padding_top_bottom',array(
		'label'	=> __('Icon Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_scroll_to_top_width',array(
		'label'	=> __('Icon Width','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_scroll_to_top_height',array(
		'label'	=> __('Icon Height','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','sirat' ),
		'section'     => 'sirat_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('sirat_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control(new Sirat_Image_Radio_Control($wp_customize, 'sirat_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top Alignment','sirat'),
        'section' => 'sirat_footer',
        'settings' => 'sirat_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

	//Blog Post Settings
	$wp_customize->add_panel( 'sirat_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'sirat' ),
		'panel' => 'sirat_panel_id',
		'priority' => 20,
	));

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'sirat_post_settings', array(
		'title' => __( 'Post Settings', 'sirat' ),
		'panel' => 'sirat_blog_post_parent_panel',
	));

	$wp_customize->add_setting('sirat_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','sirat'),
        'description' => __('Here you can change the sidebar layout for posts. ','sirat'),
        'section' => 'sirat_post_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','sirat'),
            'Right Sidebar' => __('Right Sidebar','sirat'),
            'One Column' => __('One Column','sirat'),
            'Three Columns' => __('Three Columns','sirat'),
            'Four Columns' => __('Four Columns','sirat'),
            'Grid Layout' => __('Grid Layout','sirat')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('sirat_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'sirat_customize_partial_sirat_toggle_postdate', 
	));

	$wp_customize->add_setting('sirat_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_post_settings',
		'setting'	=> 'sirat_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'sirat_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','sirat' ),
        'section' => 'sirat_post_settings'
    )));

    $wp_customize->add_setting('sirat_toggle_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_post_settings',
		'setting'	=> 'sirat_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_author',array(
		'label' => esc_html__( 'Author','sirat' ),
		'section' => 'sirat_post_settings'
    )));

    $wp_customize->add_setting('sirat_toggle_comments_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_post_settings',
		'setting'	=> 'sirat_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_comments',array(
		'label' => esc_html__( 'Comments','sirat' ),
		'section' => 'sirat_post_settings'
    )));

    $wp_customize->add_setting('sirat_toggle_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_post_settings',
		'setting'	=> 'sirat_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_time',array(
		'label' => esc_html__( 'Time','sirat' ),
		'section' => 'sirat_post_settings'
    )));

    $wp_customize->add_setting( 'sirat_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
	));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_featured_image_hide_show', array(
		'label' => esc_html__( 'Featured Image','sirat' ),
		'section' => 'sirat_post_settings'
    )));

    $wp_customize->add_setting('sirat_blog_post_featured_image_option',array(
       'default' => 'Blog Post Image',
       'sanitize_callback'	=> 'sirat_sanitize_choices'
    ));
    $wp_customize->add_control('sirat_blog_post_featured_image_option',array(
       'type' => 'select',
       'label'	=> __('Blog Post Featured Image Option','sirat'),
       'choices' => array(
            'Blog Post Image' => __('Blog Post Image','sirat'),
            'Blog Post Image Color' => __('Blog Post Image Color','sirat'),
            'None' => __('None','sirat'),
        ),
      	'section'	=> 'sirat_post_settings'
    ));

    $wp_customize->add_setting('sirat_blog_post_featured_image_color', array(
		'default'           => '#febe00',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_blog_post_featured_image_color', array(
		'label'    => __('Blog Post Featured Image Color', 'sirat'),
		'section'  => 'sirat_post_settings',
		'settings' => 'sirat_blog_post_featured_image_color',
		'active_callback' => 'sirat_show_blog_post_image_color'
	)));

	//Featured Image
	$wp_customize->add_setting('sirat_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'sirat_sanitize_choices'
    ));
    $wp_customize->add_control('sirat_blog_post_featured_image_dimension',array(
       'type' => 'select',
       'label'	=> __('Blog Post Featured Image Dimension','sirat'),
       'section'	=> 'sirat_post_settings',
       'choices' => array(
            'default' => __('Default','sirat'),
            'custom' => __('Custom Image Size','sirat'),
        ),
    ));

    $wp_customize->add_setting('sirat_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_post_settings',
		'type'=> 'text',
		'active_callback' => 'sirat_blog_post_featured_image_dimension'
	));

	$wp_customize->add_setting('sirat_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_post_settings',
		'type'=> 'text',
		'active_callback' => 'sirat_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'sirat_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','sirat' ),
		'section'     => 'sirat_post_settings',
		'type'        => 'range',
		'settings'    => 'sirat_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
	$wp_customize->add_setting('sirat_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control(new Sirat_Image_Radio_Control($wp_customize, 'sirat_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','sirat'),
        'section' => 'sirat_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('sirat_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Page posts','sirat'),
        'section' => 'sirat_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','sirat'),
            'Without Blocks' => __('Without Blocks','sirat')
        ),
	) );

	$wp_customize->add_setting('sirat_meta_field_separator',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','sirat'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','sirat'),
		'section'=> 'sirat_post_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('sirat_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','sirat'),
        'section' => 'sirat_post_settings',
        'choices' => array(
        	'Content' => __('Content','sirat'),
            'Excerpt' => __('Excerpt','sirat'),
            'No Content' => __('No Content','sirat')
        ),
	) );

	$wp_customize->add_setting('sirat_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'sirat' ),
        ),
		'section'=> 'sirat_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','sirat' ),
      'section' => 'sirat_post_settings'
    )));

	$wp_customize->add_setting( 'sirat_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'sirat_sanitize_choices'
    ));
    $wp_customize->add_control( 'sirat_blog_pagination_type', array(
        'section' => 'sirat_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'sirat' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'sirat' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'sirat' ),
    )));

    $wp_customize->add_setting('sirat_blog_post_pagination_position',array(
        'default' => 'bottom',
        'sanitize_callback' => 'sirat_sanitize_choices'
    ));
	$wp_customize->add_control('sirat_blog_post_pagination_position', array(
        'type' => 'select',
        'label' => __( 'Blog Post Pagination Position', 'sirat' ),
        'section' => 'sirat_post_settings',
        'choices' => array(
            'top' => __('Top','sirat'),
            'bottom' => __('Bottom','sirat'),
            'both' => __('Both','sirat')
        ),
    ));

	// Button Settings
	$wp_customize->add_section( 'sirat_button_settings', array(
		'title' => __( 'Button Settings', 'sirat' ),
		'panel' => 'sirat_blog_post_parent_panel',
	));

	$wp_customize->add_setting('sirat_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','sirat' ),
		'section'     => 'sirat_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('sirat_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'sirat_customize_partial_sirat_button_text', 
	));

	$wp_customize->add_setting('sirat_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_button_text',array(
		'label'	=> __('Add Button Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'sirat' ),
        ),
		'section'=> 'sirat_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'sirat_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'sirat' ),
		'panel' => 'sirat_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('sirat_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'sirat_customize_partial_sirat_related_post_title', 
	));

    $wp_customize->add_setting( 'sirat_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_related_post',array(
		'label' => esc_html__( 'Related Post','sirat' ),
		'section' => 'sirat_related_posts_settings'
    )));

    $wp_customize->add_setting('sirat_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_related_post_title',array(
		'label'	=> __('Add Related Post Title','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'sirat' ),
        ),
		'section'=> 'sirat_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('sirat_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'sirat_sanitize_float'
	));
	$wp_customize->add_control('sirat_related_posts_count',array(
		'label'	=> __('Add Related Post Count','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'sirat' ),
        ),
		'section'=> 'sirat_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'sirat_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','sirat' ),
		'section'     => 'sirat_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'sirat_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Single Posts Settings
	$wp_customize->add_section( 'sirat_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'sirat' ),
		'panel' => 'sirat_blog_post_parent_panel',
	));

	$wp_customize->add_setting('sirat_single_post_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_single_post_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Single Post Sidebar Layout','sirat'),
        'description' => __('Here you can change the sidebar layout for posts. ','sirat'),
        'section' => 'sirat_single_blog_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','sirat'),
            'Right Sidebar' => __('Right Sidebar','sirat'),
            'One Column' => __('One Column','sirat'),
            'Three Columns' => __('Three Columns','sirat'),
            'Four Columns' => __('Four Columns','sirat'),
            'Grid Layout' => __('Grid Layout','sirat')
        ),
	) );

	$wp_customize->add_setting( 'sirat_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_post_breadcrumb',array(
		'label' => esc_html__( 'Single Post Breadcrumb','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting('sirat_single_post_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_single_post_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_single_blog_settings',
		'setting'	=> 'sirat_single_post_postdate_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_single_post_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_post_postdate',array(
        'label' => esc_html__( 'Post Date','sirat' ),
        'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting('sirat_single_post_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_single_post_author_icon',array(
		'label'	=> __('Add Author Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_single_blog_settings',
		'setting'	=> 'sirat_single_post_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_single_post_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_post_author',array(
		'label' => esc_html__( 'Author','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting('sirat_single_post_comments_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_single_post_comments_icon',array(
		'label'	=> __('Add Comments Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_single_blog_settings',
		'setting'	=> 'sirat_single_post_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_single_post_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_post_comments',array(
		'label' => esc_html__( 'Comments','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting('sirat_single_post_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_single_post_time_icon',array(
		'label'	=> __('Add Time Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_single_blog_settings',
		'setting'	=> 'sirat_single_post_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'sirat_single_post_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_post_time',array(
		'label' => esc_html__( 'Time','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));	

	$wp_customize->add_setting('sirat_single_post_meta_field_separator',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','sirat'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','sirat'),
		'section'=> 'sirat_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_single_blog_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
	));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_blog_featured_image_hide_show', array(
		'label' => esc_html__( 'Featured Image','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting( 'sirat_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
	));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_tags', array(
		'label' => esc_html__( 'Tags','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting( 'sirat_single_blog_comment_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
	));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_blog_comment_show_hide', array(
		'label' => esc_html__( 'comments','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

    $wp_customize->add_setting('sirat_single_blog_comment_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('sirat_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'sirat' ),
        ),
		'section'=> 'sirat_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_single_blog_comment_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('sirat_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'sirat' ),
        ),
		'section'=> 'sirat_single_blog_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('sirat_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','sirat'),
		'description'	=> __('Enter a value in %. Example:50%','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '100%', 'sirat' ),
        ),
		'section'=> 'sirat_single_blog_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting( 'sirat_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
	));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Post Navigation','sirat' ),
		'section' => 'sirat_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('sirat_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'sirat' ),
        ),
		'section'=> 'sirat_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'sirat' ),
        ),
		'section'=> 'sirat_single_blog_settings',
		'type'=> 'text'
	));

	//Others Settings
	$wp_customize->add_panel( 'sirat_others_panel', array(
		'title' => esc_html__( 'Others Settings', 'sirat' ),
		'panel' => 'sirat_panel_id',
		'priority' => 20,
	));

	// Layout
	$wp_customize->add_section( 'sirat_left_right', array(
    	'title'      => __( 'General Settings', 'sirat' ),
		'panel' => 'sirat_others_panel'
	) );

	$wp_customize->add_setting('sirat_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control(new Sirat_Image_Radio_Control($wp_customize, 'sirat_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','sirat'),
        'description' => __('Here you can change the width layout of Website.','sirat'),
        'section' => 'sirat_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('sirat_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','sirat'),
        'description' => __('Here you can change the sidebar layout for pages. ','sirat'),
        'section' => 'sirat_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','sirat'),
            'Right Sidebar' => __('Right Sidebar','sirat'),
            'One Column' => __('One Column','sirat')
        ),
	) );

	$wp_customize->add_setting( 'sirat_single_page_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_single_page_breadcrumb',array(
		'label' => esc_html__( 'Single Page Breadcrumb','sirat' ),
		'section' => 'sirat_left_right'
    )));

	//Featured Image
	$wp_customize->add_setting( 'sirat_featured_image_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','sirat' ),
		'section'     => 'sirat_left_right',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'sirat_featured_image_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','sirat' ),
		'section'     => 'sirat_left_right',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Wow Animation
	$wp_customize->add_setting( 'sirat_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_switch_sanitization'
    ));
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_animation',array(
        'label' => esc_html__( 'Animations','sirat' ),
        'description' => __('Here you can disable overall site animation effect','sirat'),
        'section' => 'sirat_left_right'
    )));

    $wp_customize->add_setting('sirat_reset_all_settings',array(
      'sanitize_callback'	=> 'sanitize_text_field',
   	));
   	$wp_customize->add_control(new Sirat_Reset_Custom_Control($wp_customize, 'sirat_reset_all_settings',array(
      'type' => 'reset_control',
      'label' => __('Reset All Settings', 'sirat'),
      'description' => 'sirat_reset_all_settings',
      'section' => 'sirat_left_right'
   	)));

	//Pre-Loader
	$wp_customize->add_setting( 'sirat_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','sirat' ),
        'section' => 'sirat_left_right'
    )));

	$wp_customize->add_setting('sirat_preloader_bg_color', array(
		'default'           => '#febe00',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'sirat'),
		'section'  => 'sirat_left_right',
	)));

	$wp_customize->add_setting('sirat_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'sirat'),
		'section'  => 'sirat_left_right',
	)));

	//404 Page Setting
	$wp_customize->add_section('sirat_404_page',array(
		'title'	=> __('404 Page Settings','sirat'),
		'panel' => 'sirat_others_panel',
	));	

	$wp_customize->add_setting('sirat_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('sirat_404_page_title',array(
		'label'	=> __('Add Title','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'sirat' ),
        ),
		'section'=> 'sirat_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('sirat_404_page_content',array(
		'label'	=> __('Add Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'sirat' ),
        ),
		'section'=> 'sirat_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_404_page_button_text',array(
		'label'	=> __('Add Button Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Go Back', 'sirat' ),
        ),
		'section'=> 'sirat_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('sirat_no_results_page',array(
		'title'	=> __('No Results Page Settings','sirat'),
		'panel' => 'sirat_others_panel',
	));	

	$wp_customize->add_setting('sirat_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('sirat_no_results_page_title',array(
		'label'	=> __('Add Title','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'sirat' ),
        ),
		'section'=> 'sirat_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('sirat_no_results_page_content',array(
		'label'	=> __('Add Text','sirat'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sirat' ),
        ),
		'section'=> 'sirat_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('sirat_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','sirat'),
		'panel' => 'sirat_others_panel',
	));	

	$wp_customize->add_setting('sirat_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_social_icon_padding',array(
		'label'	=> __('Icon Padding','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_social_icon_width',array(
		'label'	=> __('Icon Width','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_social_icon_height',array(
		'label'	=> __('Icon Height','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','sirat' ),
		'section'     => 'sirat_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('sirat_responsive_media',array(
		'title'	=> __('Responsive Media','sirat'),
		'panel' => 'sirat_others_panel',
	));

	$wp_customize->add_setting( 'sirat_resp_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_resp_search_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_resp_search_hide_show',array(
      'label' => esc_html__( 'Show / Hide Search','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_stickyheader_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sticky Header','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_resp_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_resp_slider_btn_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_resp_slider_btn_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider Button','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_toggle_postdate_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_postdate_hide_show',array(
      'label' => esc_html__( 'Show / Hide Post Date','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_toggle_author_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_author_hide_show',array(
      'label' => esc_html__( 'Show / Hide Author','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_toggle_comments_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_comments_hide_show',array(
      'label' => esc_html__( 'Show / Hide Comments','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_toggle_time_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_toggle_time_hide_show',array(
      'label' => esc_html__( 'Show / Hide Time','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

	$wp_customize->add_setting( 'sirat_metabox_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_metabox_hide_show',array(
      'label' => esc_html__( 'Show / Hide Metabox','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting( 'sirat_resp_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_resp_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','sirat' ),
      'section' => 'sirat_responsive_media'
    )));

    $wp_customize->add_setting('sirat_mobile_menu_label',array(
       'default' => 'Menu',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('sirat_mobile_menu_label',array(
       'type' => 'text',
       'label' => __('Add Mobile Menu Label','sirat'),
       'section' => 'sirat_responsive_media'
    ));

    $wp_customize->add_setting('sirat_res_menus_open_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_res_menus_open_icon',array(
		'label'	=> __('Add Open Menu Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_responsive_media',
		'setting'	=> 'sirat_res_menus_open_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('sirat_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Sirat_Fontawesome_Icon_Chooser(
        $wp_customize,'sirat_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','sirat'),
		'transport' => 'refresh',
		'section'	=> 'sirat_responsive_media',
		'setting'	=> 'sirat_res_close_menus_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('sirat_resp_menu_toggle_btn_bg_color', array(
		'default'           => '#febe00',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sirat_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'sirat'),
		'section'  => 'sirat_responsive_media',
	)));

	//Woocommerce Settings
	$wp_customize->add_section( 'sirat_wocommerce_section' , array(
    	'title'      => __( 'Woocommerce Settings', 'sirat' ),
		'priority'   => null,
		'panel' => 'sirat_others_panel'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'sirat_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'sirat_customize_partial_sirat_woocommerce_shop_page_sidebar', ) );

	//Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'sirat_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','sirat' ),
		'section' => 'sirat_wocommerce_section'
    )));

    //Woocommerce Shop Page Pagination
	$wp_customize->add_setting( 'sirat_woocommerce_shop_page_pagination',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_woocommerce_shop_page_pagination',array(
		'label' => esc_html__( 'Shop Page Pagination','sirat' ),
		'section' => 'sirat_wocommerce_section'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'sirat_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'sirat_customize_partial_sirat_woocommerce_single_product_page_sidebar', ) );
	
    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'sirat_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','sirat' ),
		'section' => 'sirat_wocommerce_section'
    )));

    //Related Products
	$wp_customize->add_setting( 'sirat_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'sirat_switch_sanitization'
    ) );
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_related_product_show_hide',array(
        'label' => esc_html__( 'Related product','sirat' ),
        'section' => 'sirat_wocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('sirat_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'sirat_sanitize_float'
	));
	$wp_customize->add_control('sirat_products_per_page',array(
		'label'	=> __('Products Per Page','sirat'),
		'description' => __('Display on shop page','sirat'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('sirat_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_products_per_row',array(
		'label'	=> __('Products Per Row','sirat'),
		'description' => __('Display on shop page','sirat'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'select',
	));

	$wp_customize->add_setting( 'sirat_products_border',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'sirat_switch_sanitization'
    ));  
    $wp_customize->add_control( new Sirat_Toggle_Switch_Custom_Control( $wp_customize, 'sirat_products_border',array(
      'label' => esc_html__( 'Product Border','sirat' ),
      'section' => 'sirat_wocommerce_section'
    )));

	$wp_customize->add_setting('sirat_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','sirat' ),
		'section'     => 'sirat_wocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting( 'sirat_products_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','sirat' ),
		'section'     => 'sirat_wocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('sirat_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_products_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','sirat' ),
		'section'     => 'sirat_wocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Sale settings
	$wp_customize->add_setting('sirat_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'sirat_sanitize_choices'
	));
	$wp_customize->add_control('sirat_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','sirat'),
        'section' => 'sirat_wocommerce_section',
        'choices' => array(
            'left' => __('Left','sirat'),
            'right' => __('Right','sirat'),
        ),
	) );

	$wp_customize->add_setting('sirat_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('sirat_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('sirat_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','sirat'),
		'description'	=> __('Enter a value in pixels. Example:20px','sirat'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'sirat' ),
        ),
		'section'=> 'sirat_wocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'sirat_woocommerce_sale_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'sirat_sanitize_number_range'
	) );
	$wp_customize->add_control( 'sirat_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','sirat' ),
		'section'     => 'sirat_wocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    // Has to be at the top
	$wp_customize->register_panel_type( 'Sirat_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Sirat_WP_Customize_Section' );	
}

add_action( 'customize_register', 'sirat_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Sirat_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'sirat_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class Sirat_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'sirat_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function sirat_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'sirat_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Sirat_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Sirat_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Sirat_Customize_Section_Pro( $manager,'sirat_upgrade_pro_link', array(
			'priority'   => 1,
			'title'    => esc_html__( 'SIRAT PRO', 'sirat' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'sirat' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/multipurpose-wordpress-theme/'),
		) )	);

		// Register sections.
		$manager->add_section(new Sirat_Customize_Section_Pro($manager,'sirat_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'sirat' ),
			'pro_text' => esc_html__( 'DOCS', 'sirat' ),
			'pro_url'  => esc_url('https://www.vwthemesdemo.com/docs/free-sirat/'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'sirat-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'sirat-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );

		wp_localize_script(
		'sirat-customize-controls',
		'sirat_customizer_params',
		array(
			'ajaxurl' =>	admin_url( 'admin-ajax.php' )
		));
	}
}

// Doing this customizer thang!
Sirat_Customize::get_instance();