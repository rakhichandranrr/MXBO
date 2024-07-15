<?php

if ( ! function_exists( 'einar_core_include_core_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function einar_core_include_core_is_installed( $installed, $plugin ) {

		if ( 'core' === $plugin ) {
			return class_exists( 'EinarCore' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'einar_core_include_core_is_installed', 10, 2 );
}

if ( ! function_exists( 'einar_core_list_sc_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function einar_core_list_sc_template_part( $module, $template, $slug = '', $params = array() ) {
		echo einar_core_get_list_sc_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'einar_core_get_list_sc_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function einar_core_get_list_sc_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = EINAR_CORE_INC_PATH;

		return qode_framework_get_list_sc_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'einar_core_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 */
	function einar_core_template_part( $module, $template, $slug = '', $params = array() ) {
		echo einar_core_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'einar_core_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function einar_core_get_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = EINAR_CORE_INC_PATH;

		return qode_framework_get_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'einar_core_theme_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function einar_core_theme_template_part( $module, $template, $slug = '', $params = array() ) {
		echo einar_core_get_theme_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'einar_core_get_theme_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function einar_core_get_theme_template_part( $module, $template, $slug = '', $params = array() ) {
		return qode_framework_is_installed( 'theme' ) ? einar_get_template_part( $module, $template, $slug, $params ) : '';
	}
}

if ( ! function_exists( 'einar_core_get_option_value' ) ) {
	/**
	 * Function that returns option value using framework function but providing its own scope
	 *
	 * @param string $type option type
	 * @param string $name name of option
	 * @param string $default_value option default value
	 * @param int $post_id id of
	 *
	 * @return string value of option
	 */
	function einar_core_get_option_value( $type, $name, $default_value = '', $post_id = null ) {
		$scope = EINAR_CORE_OPTIONS_NAME;

		return qode_framework_get_option_value( $scope, $type, $name, $default_value, $post_id );
	}
}

if ( ! function_exists( 'einar_core_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists, otherwise global value using framework function but providing its own scope
	 *
	 * @param string $name name of option
	 * @param int $post_id id of
	 *
	 * @return string|array value of option
	 */
	function einar_core_get_post_value_through_levels( $name, $post_id = null ) {
		$scope = EINAR_CORE_OPTIONS_NAME;

		return qode_framework_get_post_value_through_levels( $scope, $name, $post_id );
	}
}

if ( ! function_exists( 'einar_core_remove_default_post_meta_custom_fields' ) ) {
	/**
	 * Function that remove default custom post types for meta options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function einar_core_remove_default_post_meta_custom_fields( $post_types ) {
		$post_types[] = 'post';
		$post_types[] = 'page';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_remove', 'einar_core_remove_default_post_meta_custom_fields' );
}

if ( ! function_exists( 'einar_core_general_meta_box_callbacks' ) ) {
	/**
	 * Function that return general meta box callback functions
	 *
	 * @return array
	 */
	function einar_core_general_meta_box_callbacks() {
		return apply_filters( 'einar_core_filter_general_meta_box_callbacks', array() );
	}
}

if ( ! function_exists( 'einar_core_get_query_params' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $atts - options value
	 *
	 * @return array
	 */
	function einar_core_get_query_params( $atts ) {
		return qode_framework_is_installed( 'theme' ) ? einar_get_query_params( $atts ) : array();
	}
}

if ( ! function_exists( 'einar_core_get_pagination_data' ) ) {
	/**
	 * Function that return pagination data
	 *
	 * @param string $plugin - plugin name
	 * @param string $module - module name
	 * @param string $shortcode - shortcode name
	 * @param string $post_type - post type value
	 * @param array $params - shortcode params
	 *
	 * @return array
	 */
	function einar_core_get_pagination_data( $plugin, $module, $shortcode, $post_type, $params ) {
		return qode_framework_is_installed( 'theme' ) ? einar_get_pagination_data( $plugin, $module, $shortcode, $post_type, $params ) : array();
	}
}

if ( ! function_exists( 'einar_core_get_page_content_sidebar_classes' ) ) {
	/**
	 * Function that returns classes for the content when sidebar is enabled
	 *
	 * @return string
	 */
	function einar_core_get_page_content_sidebar_classes() {
		return qode_framework_is_installed( 'theme' ) ? einar_get_page_content_sidebar_classes() : '';
	}
}

if ( ! function_exists( 'einar_core_get_page_grid_sidebar_classes' ) ) {
	/**
	 * Function that returns classes for the grid when sidebar is enabled
	 *
	 * @return string
	 */
	function einar_core_get_page_grid_sidebar_classes() {
		return qode_framework_is_installed( 'theme' ) ? einar_get_page_grid_sidebar_classes() : '';
	}
}

if ( ! function_exists( 'einar_core_get_grid_gutter_classes' ) ) {
	/**
	 * Function that returns classes for the gutter when sidebar is enabled
	 *
	 * @return string
	 */
	function einar_core_get_grid_gutter_classes() {
		return qode_framework_is_installed( 'theme' ) ? einar_get_grid_gutter_classes() : '';
	}
}

if ( ! function_exists( 'einar_core_get_grid_gutter_styles' ) ) {
	/**
	 * Function that returns grid gutter styles when sidebar is enabled
	 *
	 * @return string
	 */
	function einar_core_get_grid_gutter_styles() {
		return qode_framework_is_installed( 'theme' ) ? einar_get_grid_gutter_styles() : '';
	}
}

if ( ! function_exists( 'einar_core_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function einar_core_render_svg_icon( $name, $class_name = '' ) {
		echo einar_core_get_svg_icon( $name, $class_name );
	}
}

if ( ! function_exists( 'einar_core_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function einar_core_get_svg_icon( $name, $class_name = '' ) {
		return qode_framework_is_installed( 'theme' ) ? einar_get_svg_icon( $name, $class_name ) : '';
	}
}

if ( ! function_exists( 'einar_core_get_custom_sidebars' ) ) {
	/**
	 * Function that return custom sidebars
	 *
	 * @param bool $enable_default - add first element empty for default value
	 * @param bool $enable_none - add last element as none
	 *
	 * @return array
	 */
	function einar_core_get_custom_sidebars( $enable_default = true, $enable_none = false ) {
		$sidebars = array();

		if ( class_exists( 'QodeFrameworkCustomSidebar' ) ) {
			$qode_framework = qode_framework_get_framework_root();

			$sidebars = $qode_framework->get_custom_sidebars()->get_custom_sidebars( $enable_default );

			if ( $enable_none ) {
				$sidebars['none'] = esc_html__( 'None', 'einar-core' );
			}
		}

		return $sidebars;
	}
}

if ( ! function_exists( 'einar_core_get_customizer_logo' ) ) {
	/**
	 * Function that returns customizer image
	 *
	 * @return string that contains html for logo image
	 */
	function einar_core_get_customizer_logo() {
		$customizer_image = '';
		$customizer_logo  = get_custom_logo();

		if ( ! empty( $customizer_logo ) ) {
			$customizer_logo_id = get_theme_mod( 'custom_logo' );

			if ( $customizer_logo_id ) {
				$customizer_logo_id_attr = array(
					'class'    => 'qodef-header-logo-image qodef--main qodef--customizer',
					'itemprop' => 'logo',
				);

				$image_alt = get_post_meta( $customizer_logo_id, '_wp_attachment_image_alt', true );
				if ( empty( $image_alt ) ) {
					$customizer_logo_id_attr['alt'] = get_bloginfo( 'name', 'display' );
				}

				$customizer_image = wp_get_attachment_image( $customizer_logo_id, 'full', false, $customizer_logo_id_attr );
			}
		}

		return $customizer_image;
	}
}

if ( ! function_exists( 'einar_core_add_responsive_inline_style' ) ) {
	/**
	 * Function that generates global inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function einar_core_add_responsive_inline_style( $style ) {
		$full_style = '';

		$responsive_sizes = array( '1512', '1368', '1200', '1024', '880', '680' );
		foreach ( $responsive_sizes as $responsive_size ) {
			$responsive_style = apply_filters( 'einar_core_filter_add_responsive_' . $responsive_size . '_inline_style', '' );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string = '@media only screen and (max-width: ' . $responsive_size . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		$responsive_range_sizes = array( '1200_1368', '1024_1200', '680_880' );
		foreach ( $responsive_range_sizes as $responsive_range_size ) {
			$responsive_style = apply_filters( 'einar_core_filter_add_responsive_' . $responsive_range_size . '_inline_style', '' );
			$responsive_range = explode( '_', $responsive_range_size );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string = '@media only screen and (min-width: ' . ( intval( $responsive_range[0] ) + 1 ) . 'px) and (max-width: ' . $responsive_range[1] . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		if ( ! empty( $full_style ) ) {
			$style = $style . $full_style;
		}

		return $style;
	}

	add_filter( 'einar_filter_add_inline_style', 'einar_core_add_responsive_inline_style', 12 ); // Permission 12 is set in order to load it last
}

if ( ! function_exists( 'einar_core_print_custom_css_in_footer' ) ) {
	/**
	 * Function that generates global inline styles inside footer area
	 *
	 * @return string
	 */
	function einar_core_print_custom_css_in_footer() {
		$full_style = '';

		$responsive_sizes = array( '1680', '1512', '1368', '1200', '1024', '880', '680' );
		foreach ( $responsive_sizes as $responsive_size ) {
			$responsive_style = apply_filters( 'einar_core_filter_add_responsive_' . $responsive_size . '_inline_style_in_footer', '' );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string = '@media only screen and (max-width: ' . $responsive_size . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		$responsive_range_sizes = array( '1512_1680', '1368_1512', '1200_1368', '1024_1200', '880_1024', '680_880' );
		foreach ( $responsive_range_sizes as $responsive_range_size ) {
			$responsive_style = apply_filters( 'einar_core_filter_add_responsive_' . $responsive_range_size . '_inline_style_in_footer', '' );
			$responsive_range = explode( '_', $responsive_range_size );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string = '@media only screen and (min-width: ' . ( intval( $responsive_range[0] ) + 1 ) . 'px) and (max-width: ' . $responsive_range[1] . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		if ( '' !== $full_style ) {
			echo '<div id="einar-core-page-inline-style" data-style="' . esc_attr( $full_style ) . '"></div>';
		}
	}

	add_action( 'wp_footer', 'einar_core_print_custom_css_in_footer', 999 ); // 999 permission is set in order to add inline style been at the last place
}

if ( ! function_exists( 'einar_core_get_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position
	 *
	 * @param string $map
	 *
	 * @return int
	 */
	function einar_core_get_admin_options_map_position( $map ) {
		$position = 10;

		switch ( $map ) {
			case 'general':
				$position = 1;
				break;
			case 'logo':
				$position = 2;
				break;
			case 'fonts':
				$position = 4;
				break;
			case 'typography':
				$position = 6;
				break;
			case 'header':
				$position = 8;
				break;
			case 'mobile-header':
				$position = 10;
				break;
			case 'fullscreen-menu':
				$position = 12;
				break;
			case 'title':
				$position = 14;
				break;
			case 'sidebar':
				$position = 16;
				break;
			case 'footer':
				$position = 18;
				break;
			case 'search':
				$position = 20;
				break;
			case 'side-area':
				$position = 22;
				break;
			case 'blog':
				$position = 24;
				break;
			case 'social-share':
				$position = 26;
				break;
			case 'maps':
				$position = 28;
				break;
			case 'subscribe-popup':
				$position = 99;
				break;
			case '404':
				$position = 100;
				break;
		}

		return apply_filters( 'einar_core_filter_admin_options_map_position', $position, $map );
	}
}

if ( ! function_exists( 'einar_core_get_variations_options_map' ) ) {
	/**
	 * Function that return options map for module variations
	 *
	 * @param array $variations
	 * @param boolean $default_empty
	 *
	 * @return array
	 */
	function einar_core_get_variations_options_map( $variations, $default_empty = false ) {
		$map = array();

		if ( ! empty( $variations ) ) {
			$map['visibility'] = sizeof( $variations ) > 1;

			reset( $variations );
			$map['default_value'] = key( $variations );

			if ( $default_empty ) {
				$map['default_value'] = '';
			}
		} else {
			$map['visibility']    = false;
			$map['default_value'] = '';
		}

		return $map;
	}
}

if ( ! function_exists( 'einar_core_get_select_type_options_pool' ) ) {
	/**
	 * Function that returns array with pool of options for select fields in framework
	 *
	 *
	 * @param string $type - type of select field
	 * @param bool $enable_default - add first element empty for default value
	 * @param array $exclude - array of items to exclude
	 * @param array $include - array of items to include
	 *
	 * @return array escaped output
	 */
	function einar_core_get_select_type_options_pool( $type, $enable_default = true, $exclude = array(), $include = array() ) {
		$options = array();
		if ( $enable_default ) {
			$options[''] = esc_html__( 'Default', 'einar-core' );
		}
		switch ( $type ) {
			case 'content_width':
				$options['1400'] = esc_html__( '1400px', 'einar-core' );
				$options['1300'] = esc_html__( '1300px', 'einar-core' );
				$options['1200'] = esc_html__( '1200px', 'einar-core' );
				$options['1100'] = esc_html__( '1100px', 'einar-core' );
				$options['1000'] = esc_html__( '1000px', 'einar-core' );
				$options['800']  = esc_html__( '800px', 'einar-core' );
				break;
			case 'title_tag':
				$options['h1'] = 'H1';
				$options['h2'] = 'H2';
				$options['h3'] = 'H3';
				$options['h4'] = 'H4';
				$options['h5'] = 'H5';
				$options['h6'] = 'H6';
				$options['p']  = 'P';
				break;
			case 'link_target':
				$options['_self']  = esc_html__( 'Same Window', 'einar-core' );
				$options['_blank'] = esc_html__( 'New Window', 'einar-core' );
				break;
			case 'border_style':
				$options['solid']  = esc_html__( 'Solid', 'einar-core' );
				$options['dashed'] = esc_html__( 'Dashed', 'einar-core' );
				$options['dotted'] = esc_html__( 'Dotted', 'einar-core' );
				break;
			case 'font_weight':
				$options['100'] = esc_html__( 'Thin (100)', 'einar-core' );
				$options['200'] = esc_html__( 'Extra Light (200)', 'einar-core' );
				$options['300'] = esc_html__( 'Light (300)', 'einar-core' );
				$options['400'] = esc_html__( 'Normal (400)', 'einar-core' );
				$options['500'] = esc_html__( 'Medium (500)', 'einar-core' );
				$options['600'] = esc_html__( 'Semi Bold (600)', 'einar-core' );
				$options['700'] = esc_html__( 'Bold (700)', 'einar-core' );
				$options['800'] = esc_html__( 'Extra Bold (800)', 'einar-core' );
				$options['900'] = esc_html__( 'Black (900)', 'einar-core' );
				break;
			case 'font_style':
				$options['normal']  = esc_html__( 'Normal', 'einar-core' );
				$options['italic']  = esc_html__( 'Italic', 'einar-core' );
				$options['oblique'] = esc_html__( 'Oblique', 'einar-core' );
				$options['initial'] = esc_html__( 'Initial', 'einar-core' );
				$options['inherit'] = esc_html__( 'Inherit', 'einar-core' );
				break;
			case 'text_transform':
				$options['none']       = esc_html__( 'None', 'einar-core' );
				$options['capitalize'] = esc_html__( 'Capitalize', 'einar-core' );
				$options['uppercase']  = esc_html__( 'Uppercase', 'einar-core' );
				$options['lowercase']  = esc_html__( 'Lowercase', 'einar-core' );
				$options['initial']    = esc_html__( 'Initial', 'einar-core' );
				$options['inherit']    = esc_html__( 'Inherit', 'einar-core' );
				break;
			case 'text_decoration':
				$options['none']         = esc_html__( 'None', 'einar-core' );
				$options['underline']    = esc_html__( 'Underline', 'einar-core' );
				$options['overline']     = esc_html__( 'Overline', 'einar-core' );
				$options['line-through'] = esc_html__( 'Line-Through', 'einar-core' );
				$options['initial']      = esc_html__( 'Initial', 'einar-core' );
				$options['inherit']      = esc_html__( 'Inherit', 'einar-core' );
				break;
			case 'list_behavior':
				$options['columns']           = esc_html__( 'Gallery', 'einar-core' );
				$options['masonry']           = esc_html__( 'Masonry', 'einar-core' );
				$options['slider']            = esc_html__( 'Slider', 'einar-core' );
				$options['justified-gallery'] = esc_html__( 'Justified Gallery', 'einar-core' );
				break;
			case 'columns_number':
				$options['1'] = esc_html__( 'One', 'einar-core' );
				$options['2'] = esc_html__( 'Two', 'einar-core' );
				$options['3'] = esc_html__( 'Three', 'einar-core' );
				$options['4'] = esc_html__( 'Four', 'einar-core' );
				$options['5'] = esc_html__( 'Five', 'einar-core' );
				$options['6'] = esc_html__( 'Six', 'einar-core' );
                $options['7'] = esc_html__( 'Seven', 'einar-core' );
                $options['8'] = esc_html__( 'Eight', 'einar-core' );

				break;
			case 'items_space':
				$options['extra-huge'] = esc_html__( 'Extra Huge (150)', 'einar-core' );
				$options['huge']       = esc_html__( 'Huge (70)', 'einar-core' );
				$options['greater']    = esc_html__( 'Greater (55)', 'einar-core' );
				$options['large']      = esc_html__( 'Large (50)', 'einar-core' );
				$options['medium']     = esc_html__( 'Medium (40)', 'einar-core' );
				$options['normal']     = esc_html__( 'Normal (30)', 'einar-core' );
				$options['small']      = esc_html__( 'Small (20)', 'einar-core' );
				$options['tiny']       = esc_html__( 'Tiny (10)', 'einar-core' );
				$options['little']     = esc_html__( 'Little (6)', 'einar-core' );
				$options['no']         = esc_html__( 'No (0)', 'einar-core' );
				$options['custom']     = esc_html__( 'Custom', 'einar-core' );
				break;
			case 'order_by':
				$options['date']       = esc_html__( 'Date', 'einar-core' );
				$options['ID']         = esc_html__( 'ID', 'einar-core' );
				$options['menu_order'] = esc_html__( 'Menu Order', 'einar-core' );
				$options['name']       = esc_html__( 'Post Name', 'einar-core' );
				$options['rand']       = esc_html__( 'Random', 'einar-core' );
				$options['title']      = esc_html__( 'Title', 'einar-core' );
				break;
			case 'order':
				$options['DESC'] = esc_html__( 'Descending', 'einar-core' );
				$options['ASC']  = esc_html__( 'Ascending', 'einar-core' );
				break;
			case 'pagination_type':
				$options['no-pagination']   = esc_html__( 'No Pagination', 'einar-core' );
				$options['standard']        = esc_html__( 'Standard', 'einar-core' );
				$options['load-more']       = esc_html__( 'Load More', 'einar-core' );
				$options['infinite-scroll'] = esc_html__( 'Infinite Scroll', 'einar-core' );
				break;
			case 'columns_responsive':
				$options['predefined'] = esc_html__( 'Predefined', 'einar-core' );
				$options['custom']     = esc_html__( 'Custom', 'einar-core' );
				break;
			case 'yes_no':
				$options['yes'] = esc_html__( 'Yes', 'einar-core' );
				$options['no']  = esc_html__( 'No', 'einar-core' );
				break;
			case 'no_yes':
				$options['no']  = esc_html__( 'No', 'einar-core' );
				$options['yes'] = esc_html__( 'Yes', 'einar-core' );
				break;
			case 'sidebar_layouts':
				$options['no-sidebar']       = esc_html__( 'No Sidebar', 'einar-core' );
				$options['sidebar-33-right'] = esc_html__( 'Sidebar 1/3 Right', 'einar-core' );
				$options['sidebar-25-right'] = esc_html__( 'Sidebar 1/4 Right', 'einar-core' );
				$options['sidebar-33-left']  = esc_html__( 'Sidebar 1/3 Left', 'einar-core' );
				$options['sidebar-25-left']  = esc_html__( 'Sidebar 1/4 Left', 'einar-core' );
				break;
			case 'icon_source':
				$options['predefined'] = esc_html__( 'Predefined', 'einar-core' );
				$options['icon_pack']  = esc_html__( 'Icon Pack', 'einar-core' );
				$options['svg_path']   = esc_html__( 'SVG Path', 'einar-core' );
				break;
			case 'list_image_dimension':
				$options['full']      = esc_html__( 'Original', 'einar-core' );
				$options['thumbnail'] = esc_html__( 'Thumbnail', 'einar-core' );
				$options['medium']    = esc_html__( 'Medium', 'einar-core' );
				$options['large']     = esc_html__( 'Large', 'einar-core' );
				$options['custom']    = esc_html__( 'Custom', 'einar-core' );
				$options              = apply_filters( 'qode_framework_filter_pool_list_image_dimension', $options );
				break;
			case 'weekdays':
				$options['monday']    = esc_html__( 'Monday', 'einar-core' );
				$options['tuesday']   = esc_html__( 'Tuesday', 'einar-core' );
				$options['wednesday'] = esc_html__( 'Wednesday', 'einar-core' );
				$options['thursday']  = esc_html__( 'Thursday', 'einar-core' );
				$options['friday']    = esc_html__( 'Friday', 'einar-core' );
				$options['saturday']  = esc_html__( 'Saturday', 'einar-core' );
				$options['sunday']    = esc_html__( 'Sunday', 'einar-core' );
				break;
			case 'page_skin':
				$options['']      = esc_html__( 'Default', 'einar-core' );
				$options['light'] = esc_html__( 'Light', 'einar-core' );
				$options['dark']  = esc_html__( 'Dark', 'einar-core' );
				break;
			case 'shortcode_skin':
				$options['light'] = esc_html__( 'Light', 'einar-core' );
				break;
			case 'shortcode_skin_dark':
				$options['dark'] = esc_html__( 'Dark', 'einar-core' );
				break;
			case 'header_skin':
				$options['none']  = esc_html__( 'None', 'einar-core' );
				$options['light'] = esc_html__( 'Light', 'einar-core' );
				$options['dark']  = esc_html__( 'Dark', 'einar-core' );
				break;
		}

		if ( ! empty( $exclude ) ) {
			foreach ( $exclude as $e ) {
				if ( array_key_exists( $e, $options ) ) {
					unset( $options[ $e ] );
				}
			}
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $options ) ) {
					$options[ $key ] = $value;
				}
			}
		}

		return apply_filters( 'einar_core_filter_select_type_option', $options, $type, $enable_default, $exclude );
	}
}

if ( ! function_exists( 'einar_core_escape_title_tag' ) ) {
    /**
     * Function that escape title tag variable for modules
     *
     * @param string $title_tag
     *
     * @return string
     */
    function einar_core_escape_title_tag( $title_tag ) {
        $escaped_title_tag = '';
        if ( ! empty( $title_tag ) ) {
            $escaped_title_tag = wp_kses(
                $title_tag,
                array(
                    'h1'   => array(),
                    'h2'   => array(),
                    'h3'   => array(),
                    'h4'   => array(),
                    'h5'   => array(),
                    'h6'   => array(),
                    'p'    => array(),
                    'span' => array(),
                    'ul'   => array(),
                    'li'   => array(),
                )
            );
        }
        return $escaped_title_tag;
    }
}

if ( ! function_exists( 'einar_core_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function einar_core_get_space_value( $text_value ) {
		switch ( $text_value ) {
			case 'extra-huge':
				return 150;
			case 'huge':
				return 70;
			case 'greater':
				return 55;
			case 'large':
				return 50;
			case 'medium':
				return 40;
			case 'normal':
				return 30;
			case 'small':
				return 20;
			case 'tiny':
				return 10;
			case 'little':
				return 6;
			case 'no':
				return 0;
			default:
				return is_int( $text_value ) ? $text_value : 30;
		}
	}
}

if ( ! function_exists( 'einar_core_get_gutter_custom_styles' ) ) {
	/**
	 * Function that generates gutter custom styles
	 *
	 * @param string $option_name
	 * @param string $meta_name
	 * @param array $atts
	 * @param bool $set_meta_as_vertical
	 *
	 * @return array
	 */
	function einar_core_get_gutter_custom_styles( $option_name = '', $meta_name = '', $atts = array(), $set_meta_as_vertical = false ) {
		$styles = array();
		$stages = array( 'custom', 'custom_1512', 'custom_1200', 'custom_680' );

		if ( ! empty( $option_name ) || ! empty( $meta_name ) ) {
			foreach ( $stages as $stage ) {
				$option      = '';
				$meta_option = '';
				$vertical    = false;

				if ( ! empty( $atts ) ) {

					if ( isset( $atts[ $option_name . $stage ] ) && ! empty( $atts[ $option_name . $stage ] ) ) {
						$option = $atts[ $option_name . $stage ];
					}

					if ( isset( $atts[ $meta_name . $stage ] ) && ! empty( $atts[ $meta_name . $stage ] ) ) {
						$meta_option = $atts[ $meta_name . $stage ];
					}
				} else {

					if ( ! empty( $option_name ) ) {
						$option = einar_core_get_post_value_through_levels( esc_attr( $option_name ) . $stage );
					}

					if ( ! empty( $meta_name ) ) {
						if ( $set_meta_as_vertical ) {
							$meta_option = einar_core_get_post_value_through_levels( esc_attr( $meta_name ) . $stage );
						} else {
							$meta_option = get_post_meta( get_the_ID(), esc_attr( $meta_name ) . $stage, true );
						}
					}
				}

				$stage_value = str_replace( array( 'custom', '_' ), array( '', '' ), $stage );

				if ( ! empty( $option ) ) {
					$styles[ $stage ] = einar_core_get_gutter_custom_inline_style( $option, $stage_value );
				}

				if ( ! empty( $meta_option ) ) {

					if ( $set_meta_as_vertical ) {
						$vertical                       = true;
						$styles[ 'vertical_' . $stage ] = einar_core_get_gutter_custom_inline_style( $meta_option, $stage_value, $vertical );
					} else {
						$styles[ $stage ] = einar_core_get_gutter_custom_inline_style( $meta_option, $stage_value );
					}
				}
			}
		}

		return $styles;
	}
}

if ( ! function_exists( 'einar_core_get_gutter_custom_inline_style' ) ) {
	/**
	 * Function that generates gutter custom inline style
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	function einar_core_get_gutter_custom_inline_style( $value, $stage = '', $vertical = false ) {
		$style = '';

		if ( ! empty( $stage ) ) {
			$stage = '-' . $stage;
		}

		if ( ! empty( $value ) ) {
			if ( $vertical ) {
				if ( qode_framework_string_ends_with_space_units( $value ) ) {
					$style = '--qode-vertical-gutter-custom' . $stage . ': ' . $value;
				} else {
					$style = '--qode-vertical-gutter-custom' . $stage . ': ' . intval( $value ) . 'px';
				}
			} else {
				if ( qode_framework_string_ends_with_space_units( $value ) ) {
					$style = '--qode-gutter-custom' . $stage . ': ' . $value;
				} else {
					$style = '--qode-gutter-custom' . $stage . ': ' . intval( $value ) . 'px';
				}
			}
		}

		return $style;
	}
}

if ( ! function_exists( 'einar_core_get_typography_styles' ) ) {
	/**
	 * Generates typography styles
	 *
	 * @param string $field_name
	 * @param string $selector
	 * @param int $post_id
	 *
	 * @return array
	 */
	function einar_core_get_typography_styles( $field_name, $selector = '', $post_id = - 1 ) {
		$color           = einar_core_get_post_value_through_levels( $field_name . '_color', $post_id );
		$font_family     = einar_core_get_post_value_through_levels( $field_name . '_font_family', $post_id );
		$font_size       = einar_core_get_post_value_through_levels( $field_name . '_font_size', $post_id );
		$line_height     = einar_core_get_post_value_through_levels( $field_name . '_line_height', $post_id );
		$letter_spacing  = einar_core_get_post_value_through_levels( $field_name . '_letter_spacing', $post_id );
		$font_weight     = einar_core_get_post_value_through_levels( $field_name . '_font_weight', $post_id );
		$text_transform  = einar_core_get_post_value_through_levels( $field_name . '_text_transform', $post_id );
		$font_style      = einar_core_get_post_value_through_levels( $field_name . '_font_style', $post_id );
		$text_decoration = einar_core_get_post_value_through_levels( $field_name . '_text_decoration', $post_id );
		$margin_top      = einar_core_get_post_value_through_levels( $field_name . '_margin_top', $post_id );
		$margin_bottom   = einar_core_get_post_value_through_levels( $field_name . '_margin_bottom', $post_id );

		$styles = array();

		if ( 'p' !== $selector ) {

			if ( ! empty( $color ) ) {
				$styles['color'] = $color;
			}

			if ( isset( $font_family ) && false !== $font_family && '-1' !== $font_family && '' !== $font_family ) {
				$styles['font-family'] = qode_framework_get_formatted_font_family( $font_family );
			}

			if ( ! empty( $font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles['font-size'] = $font_size;
				} else {
					$styles['font-size'] = intval( $font_size ) . 'px';
				}
			}

			if ( ! empty( $line_height ) ) {
				if ( qode_framework_string_ends_with_typography_units( $line_height ) ) {
					$styles['line-height'] = $line_height;
				} else {
					$styles['line-height'] = floatval( $line_height ) . 'px';
				}
			}

			if ( ! empty( $font_style ) ) {
				$styles['font-style'] = $font_style;
			}

			if ( ! empty( $font_weight ) ) {
				$styles['font-weight'] = $font_weight;
			}

			if ( ! empty( $text_decoration ) ) {
				$styles['text-decoration'] = $text_decoration;
			}

			if ( '' !== $letter_spacing && ! is_bool( $letter_spacing ) ) {
				if ( qode_framework_string_ends_with_typography_units( $letter_spacing ) ) {
					$styles['letter-spacing'] = $letter_spacing;
				} else {
					$styles['letter-spacing'] = floatval( $letter_spacing ) . 'px';
				}
			}

			if ( ! empty( $text_transform ) ) {
				$styles['text-transform'] = $text_transform;
			}
		}

		if ( 'body' !== $selector ) {

			if ( '' !== $margin_top ) {
				if ( qode_framework_string_ends_with_space_units( $margin_top, true ) ) {
					$styles['margin-top'] = $margin_top;
				} else {
					$styles['margin-top'] = intval( $margin_top ) . 'px';
				}
			}

			if ( '' !== $margin_bottom ) {
				if ( qode_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
					$styles['margin-bottom'] = $margin_bottom;
				} else {
					$styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
				}
			}
		}

		return $styles;
	}
}

if ( ! function_exists( 'einar_core_get_typography_hover_styles' ) ) {
	/**
	 * Generates hover typography styles
	 *
	 * @param string $field_name
	 * @param int $post_id
	 *
	 * @return array
	 */
	function einar_core_get_typography_hover_styles( $field_name, $post_id = - 1 ) {
		$hover_color           = einar_core_get_post_value_through_levels( $field_name . '_hover_color', $post_id );
		$hover_text_decoration = einar_core_get_post_value_through_levels( $field_name . '_hover_text_decoration', $post_id );

		$styles = array();

		if ( ! empty( $hover_color ) ) {
			$styles['color'] = $hover_color;
		}

		if ( ! empty( $hover_text_decoration ) ) {
			$styles['text-decoration'] = $hover_text_decoration;
		}

		return $styles;
	}
}

if ( ! function_exists( 'einar_core_get_custom_post_type_related_posts' ) ) {
	/**
	 * Function which return related posts for forward post item
	 *
	 * @param int $post_id
	 * @param array $allowed_types
	 *
	 * @return array
	 */
	function einar_core_get_custom_post_type_related_posts( $post_id, $allowed_types ) {
		$related_posts = array();

		if ( ! empty( $post_id ) && ! empty( $allowed_types ) ) {
			$tax_query = array();
			foreach ( $allowed_types as $key => $value ) {
				$term_ids = array();

				if ( ! empty( $value ) ) {
					$tax_query['relation'] = 'OR';

					foreach ( $value as $term ) {
						$term_ids[] = $term->term_id;
					}

					$tax_query[] = array(
						'taxonomy' => $key,
						'field'    => 'term_id',
						'terms'    => $term_ids,
					);
				}
			}

			if ( ! empty( $tax_query ) ) {
				$related_posts_by_term = einar_core_get_custom_post_type_related_posts_by_term( $post_id, $tax_query );

				if ( ! empty( $related_posts_by_term->posts ) ) {
					$items_id = array();

					foreach ( $related_posts_by_term->posts as $related_post ) {
						$items_id[] = $related_post->ID;
					}

					$related_posts = array(
						'items' => implode( ',', $items_id ),
					);

					return $related_posts;
				}
			}
		}

		return $related_posts;
	}
}

if ( ! function_exists( 'einar_core_get_custom_post_type_related_posts_by_term' ) ) {
	/**
	 * Function which return related posts query object
	 *
	 * @param int $post_id
	 * @param array $tax_query
	 *
	 * @return WP_Query
	 */
	function einar_core_get_custom_post_type_related_posts_by_term( $post_id, $tax_query ) {
		$args = apply_filters(
			'einar_core_filter_custom_post_type_related_posts_by_term',
			array(
				'post_status'    => 'publish',
				'post_type'      => get_post_type( $post_id ),
				'post__not_in'   => array( $post_id ),
				'orderby'        => 'rand',
				'posts_per_page' => 6,
				// 6 is random value in case that someone change with filter number of posts for related posts item
				'tax_query'      => $tax_query,
			)
		);

		$related_posts = new WP_Query( $args );

		return $related_posts;
	}
}

if ( ! function_exists( 'einar_core_get_custom_post_type_taxonomy_query_args' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $params - options value
	 * @param array $include - additional query arguments
	 *
	 * @return array
	 */
	function einar_core_get_custom_post_type_taxonomy_query_args( $params, $include = array() ) {
		$args = array();

		if ( isset( $params['taxonomy'] ) && ! empty( $params['taxonomy'] ) ) {
			$args['taxonomy'] = $params['taxonomy'];
		}

		if ( isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ) {
			$args['number'] = $params['posts_per_page'];
		}

		if ( isset( $params['orderby'] ) && ! empty( $params['orderby'] ) ) {
			$args['orderby'] = $params['orderby'];
		}

		if ( isset( $params['order'] ) && ! empty( $params['order'] ) ) {
			$args['order'] = $params['order'];
		}

		$args['hide_empty'] = isset( $params['hide_empty'] ) && 'yes' === $params['hide_empty'];

		if ( isset( $params['taxonomy_ids'] ) && ! empty( $params['taxonomy_ids'] ) ) {
			$args['include'] = explode( ',', trim( $params['taxonomy_ids'] ) );
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $args ) ) {
					$args[ $key ] = $value;
				}
			}
		}

		return $args;
	}
}

if ( ! function_exists( 'einar_core_get_custom_post_type_excerpt' ) ) {
	/**
	 * Return excerpt text for current custom post type item
	 *
	 * @param int $custom_excerpt_length
	 * @param string $custom_excerpt
	 *
	 * @return string
	 */
	function einar_core_get_custom_post_type_excerpt( $custom_excerpt_length, $custom_excerpt = '' ) {
		$item_excerpt   = get_the_excerpt();
		$excerpt_length = intval( apply_filters( 'einar_core_filter_post_excerpt_length', 180 ) ); // 180 is number of characters

		if ( empty( $item_excerpt ) && ! empty( $custom_excerpt ) ) {
			$item_excerpt = esc_html( $custom_excerpt );
		}

		if ( isset( $custom_excerpt_length ) && '' !== $custom_excerpt_length ) {
			$excerpt_length = intval( $custom_excerpt_length );
		}

		// Return empty string if excerpt length is zero or excerpt doesn't exist
		if ( 0 === $excerpt_length || empty( $item_excerpt ) ) {
			return '';
		}

		$excerpt = substr( $item_excerpt, 0, $excerpt_length );

		return strip_tags( strip_shortcodes( $excerpt ) );
	}
}

if ( ! function_exists( 'einar_core_render_page_builder_post_content' ) ) {
	/**
	 * Function that print post content unmodified by page builder
	 *
	 * @param int $id post id
	 */
	function einar_core_render_page_builder_post_content( $id ) {

		if ( qode_framework_is_installed( 'elementor' ) ) {
			echo einar_core_get_elementor_instance()->frontend->get_builder_content( $id, true );
		} else {
			the_content();
		}
	}
}

if ( ! function_exists( 'einar_core_get_formated_output' ) ) {

	function einar_core_get_formated_output( $output ) {

		if ( ! empty( $output ) ) {
			return $output;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'einar_core_get_split_title_text' ) ) {
	/**
	 * Function that return modified text value with html tags
	 *
	 * @param string $text
	 *
	 * @return string that contains html content
	 */
	function einar_core_get_split_title_text( $text, $split_letters = true ) {
		if ( ! empty( $text ) ) {
			$split_text = explode( ' ', $text );
			$i = 0;

			foreach ( $split_text as $position => $value ) {
				$split_text_chars        = mb_str_split( $split_text[ $position ] );
				$split_text[ $position ] = '<span class="qodef--word">';

				if ( ! $split_letters ) {
					$split_text[ $position ] .= $value;
				} else {
					foreach ( $split_text_chars as $char_position => $value ) {
						$split_text_chars[ $char_position ] = '<span class="qode--char" style="--qode-i:' . $i . '">' . $split_text_chars[ $char_position ] . '</span>';

						$split_text[ $position ] .= $split_text_chars[ $char_position ];

						$i++;
					}
				}

				$split_text[ $position ] .= '</span>';
			}

			$text = implode( ' ', $split_text );
		}

		return $text;
	}
}

if ( ! function_exists( 'einar_core_set_glass_filter_icon' ) ) {
	/**
	 * Function that add drag cursor icon into global js object
	 *
	 * @param $array
	 *
	 * @return mixed
	 */
	function einar_core_set_glass_filter_icon( $array ) {
		$array['glassFilter'] = einar_core_get_svg_icon( 'glass-filter' );

		return $array;
	}

	add_filter( 'einar_filter_localize_main_js', 'einar_core_set_glass_filter_icon' );
}
