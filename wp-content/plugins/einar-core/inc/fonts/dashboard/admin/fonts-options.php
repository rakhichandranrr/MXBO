<?php

if ( ! function_exists( 'einar_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function einar_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EINAR_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'einar-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'einar-core' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'einar-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'einar-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'einar-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'einar-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'einar-core' ),
					'description' => esc_html__( 'Choose Google Font', 'einar-core' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'einar-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'einar-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'einar-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'einar-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'einar-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'einar-core' ),
						'300'  => esc_html__( '300 Light', 'einar-core' ),
						'300i' => esc_html__( '300 Light Italic', 'einar-core' ),
						'400'  => esc_html__( '400 Regular', 'einar-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'einar-core' ),
						'500'  => esc_html__( '500 Medium', 'einar-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'einar-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'einar-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'einar-core' ),
						'700'  => esc_html__( '700 Bold', 'einar-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'einar-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'einar-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'einar-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'einar-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'einar-core' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'einar-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'einar-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'einar-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'einar-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'einar-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'einar-core' ),
						'greek'        => esc_html__( 'Greek', 'einar-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'einar-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'einar-core' ),
					),
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'einar-core' ),
					'description' => esc_html__( 'Add custom fonts', 'einar-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'einar-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_ttf',
					'title'      => esc_html__( 'Custom Font TTF', 'einar-core' ),
					'args'       => array(
						'allowed_type' => 'font/ttf',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_otf',
					'title'      => esc_html__( 'Custom Font OTF', 'einar-core' ),
					'args'       => array(
						'allowed_type' => 'font/otf',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff',
					'title'      => esc_html__( 'Custom Font WOFF', 'einar-core' ),
					'args'       => array(
						'allowed_type' => 'font/woff',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff2',
					'title'      => esc_html__( 'Custom Font WOFF2', 'einar-core' ),
					'args'       => array(
						'allowed_type' => 'font/woff2',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_custom_font_name',
					'title'      => esc_html__( 'Custom Font Name', 'einar-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'einar_core_action_default_options_init', 'einar_core_add_fonts_options', einar_core_get_admin_options_map_position( 'fonts' ) );
}
