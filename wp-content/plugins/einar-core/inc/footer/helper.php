<?php

if ( ! function_exists( 'einar_core_is_page_footer_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function einar_core_is_page_footer_enabled( $is_enabled ) {
		$option = 'no' !== einar_core_get_post_value_through_levels( 'qodef_enable_page_footer' );

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	add_filter( 'einar_filter_enable_page_footer', 'einar_core_is_page_footer_enabled' );
}

if ( ! function_exists( 'einar_core_set_footer_holder_classes' ) ) {
	/**
	 * Function that return classes for page footer area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function einar_core_set_footer_holder_classes( $classes ) {
        $logo_footer_height = einar_core_get_post_value_through_levels('qodef_footer_logo_height');

        if ( ! empty( $logo_footer_height ) ) {
            $classes[] = 'qodef-height--set';
        } else {
            $classes[] = 'qodef-height--not-set';
        }

		if ( 'yes' === einar_core_get_post_value_through_levels( 'qodef_enable_uncovering_footer' ) ) {
			$classes[] = 'qodef--uncover';
		}

		if ( 'yes' === einar_core_get_post_value_through_levels( 'qodef_enable_logo_footer_area' ) ) {
			$classes[] = 'qodef--footer-logo-area';
		}

		if ( 'yes' === einar_core_get_post_value_through_levels( 'qodef_enable_top_footer_area' ) ) {
			$classes[] = 'qodef--footer-top-area';
		}

		if ( 'yes' === einar_core_get_post_value_through_levels( 'qodef_set_footer_logo_down' ) ) {
			$classes[] = 'qodef--footer-logo-down';
		}

		$footer_skin = einar_core_get_post_value_through_levels( 'qodef_footer_skin' );
		if ( ! empty( $footer_skin ) && 'none' !== $footer_skin ) {
			$classes[] = 'qodef-skin--' . $footer_skin;
		}

		if ( function_exists( 'is_product' ) ) {
			if ( is_product() ) {
				$product_single_content_skin_options = get_post_meta( get_the_ID(), 'qodef_woo_product_single_content_skin', true );
				$product_single_footer_skin          = ! empty( $product_single_content_skin_options ) ? $product_single_content_skin_options : '';

				if ( ! empty( $product_single_footer_skin ) ) {
					$classes[] = 'qodef-skin--' . $product_single_footer_skin;
				}
			}
		}

		if ( is_singular( 'portfolio-item' ) ) {
			$portfolio_single_content_skin_options = get_post_meta( get_the_ID(), 'qodef_portfolio_single_content_skin', true );
			$portfolio_single_footer_skin          = ! empty( $portfolio_single_content_skin_options ) ? $portfolio_single_content_skin_options : '';

			if ( ! empty( $portfolio_single_footer_skin ) ) {
				$classes[] = 'qodef-skin--' . $portfolio_single_footer_skin;
			}
		}

		return $classes;
	}

	add_filter( 'einar_filter_footer_holder_classes', 'einar_core_set_footer_holder_classes' );
}

if ( ! function_exists( 'einar_core_is_footer_top_area_enabled' ) ) {
	/**
	 * Function that check if page footer top area widgets are empty
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function einar_core_is_footer_top_area_enabled( $is_enabled ) {
		$option = 'no' !== einar_core_get_post_value_through_levels( 'qodef_enable_top_footer_area' );

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	add_filter( 'einar_filter_enable_footer_top_area', 'einar_core_is_footer_top_area_enabled' );
}

if ( ! function_exists( 'einar_core_is_footer_bottom_area_enabled' ) ) {
	/**
	 * Function that check if page footer bottom area widgets are empty
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function einar_core_is_footer_bottom_area_enabled( $is_enabled ) {
		$option = 'no' !== einar_core_get_post_value_through_levels( 'qodef_enable_bottom_footer_area' );

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	add_filter( 'einar_filter_enable_footer_bottom_area', 'einar_core_is_footer_bottom_area_enabled' );
}

if ( ! function_exists( 'einar_core_set_footer_top_area_classes' ) ) {
	/**
	 * Function that return classes for page footer top area
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function einar_core_set_footer_top_area_classes( $classes ) {
		$is_grid_enabled = 'no' !== einar_core_get_post_value_through_levels( 'qodef_set_footer_top_area_in_grid' );

		if ( ! $is_grid_enabled ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'einar_filter_footer_top_area_classes', 'einar_core_set_footer_top_area_classes' );
}

if ( ! function_exists( 'einar_core_set_footer_bottom_area_classes' ) ) {
	/**
	 * Function that return classes for page footer bottom area
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function einar_core_set_footer_bottom_area_classes( $classes ) {
		$is_grid_enabled = 'no' !== einar_core_get_post_value_through_levels( 'qodef_set_footer_bottom_area_in_grid' );

		if ( ! $is_grid_enabled ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'einar_filter_footer_bottom_area_classes', 'einar_core_set_footer_bottom_area_classes' );
}

if ( ! function_exists( 'einar_core_set_footer_sidebars_config' ) ) {
	/**
	 * Function that override default page footer sidebars config
	 *
	 * @param array $config
	 *
	 * @return array
	 */
	function einar_core_set_footer_sidebars_config( $config ) {
		$top_area_columns    = einar_core_get_post_value_through_levels( 'qodef_set_footer_top_area_columns' );
		$bottom_area_columns = einar_core_get_post_value_through_levels( 'qodef_set_footer_bottom_area_columns' );

		if ( ! empty( $top_area_columns ) ) {
			$config['footer_top_sidebars_number'] = $top_area_columns;
		}

		if ( ! empty( $bottom_area_columns ) ) {
			$config['footer_bottom_sidebars_number'] = $bottom_area_columns;
		}

		return $config;
	}

	add_filter( 'einar_filter_page_footer_sidebars_config', 'einar_core_set_footer_sidebars_config' );
	add_filter( 'einar_core_filter_footer_areas_columns_size', 'einar_core_set_footer_sidebars_config' );
}

if ( ! function_exists( 'einar_core_set_footer_top_area_columns_classes' ) ) {
	/**
	 * Function that set classes for page footer top area columns
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function einar_core_set_footer_top_area_columns_classes( $classes ) {
		$gutter_size          = einar_core_get_post_value_through_levels( 'qodef_set_footer_top_area_grid_gutter' );
		$alignment            = einar_core_get_post_value_through_levels( 'qodef_set_footer_top_area_content_alignment' );
		$columns_distribution = einar_core_get_post_value_through_levels( 'qodef_set_footer_top_area_columns_distribution' );

		if ( ! empty( $gutter_size ) ) {
			$classes[] = 'qodef-gutter--' . esc_attr( $gutter_size );
		}

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . esc_attr( $alignment );
		}

		if ( ! empty( $columns_distribution ) ) {
			$classes[] = 'qodef-columns-distribution--' . esc_attr( $columns_distribution );
		}

		return $classes;
	}

	add_filter( 'einar_filter_footer_top_area_columns_classes', 'einar_core_set_footer_top_area_columns_classes' );
}

if ( ! function_exists( 'einar_core_set_footer_top_area_grid_gutter_styles' ) ) {
	/**
	 * Function that returns grid gutter styles
	 *
	 * @return array
	 */
	function einar_core_set_footer_top_area_grid_gutter_styles() {
		$styles = einar_core_get_gutter_custom_styles( 'qodef_set_footer_top_area_grid_gutter_' );

		return $styles;
	}

	add_filter( 'einar_filter_footer_top_area_grid_gutter_styles', 'einar_core_set_footer_top_area_grid_gutter_styles' );
}

if ( ! function_exists( 'einar_core_set_footer_bottom_area_columns_classes' ) ) {
	/**
	 * Function that set classes for page footer bottom area columns
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function einar_core_set_footer_bottom_area_columns_classes( $classes ) {
		$gutter_size = einar_core_get_post_value_through_levels( 'qodef_set_footer_bottom_area_grid_gutter' );
		$alignment   = einar_core_get_post_value_through_levels( 'qodef_set_footer_bottom_area_content_alignment' );

		if ( ! empty( $gutter_size ) ) {
			$classes[] = 'qodef-gutter--' . esc_attr( $gutter_size );
		}

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . esc_attr( $alignment );
		}

		return $classes;
	}

	add_filter( 'einar_filter_footer_bottom_area_columns_classes', 'einar_core_set_footer_bottom_area_columns_classes' );
}

if ( ! function_exists( 'einar_core_set_footer_bottom_area_grid_gutter_styles' ) ) {
	/**
	 * Function that returns grid gutter styles
	 *
	 * @return array
	 */
	function einar_core_set_footer_bottom_area_grid_gutter_styles() {
		$styles = einar_core_get_gutter_custom_styles( 'qodef_set_footer_bottom_area_grid_gutter_' );

		return $styles;
	}

	add_filter( 'einar_filter_footer_bottom_area_grid_gutter_styles', 'einar_core_set_footer_bottom_area_grid_gutter_styles' );
}

if ( ! function_exists( 'einar_core_set_custom_footer_widget_area' ) ) {
	/**
	 * This function set custom footer widgets area
	 *
	 * @param string $widget_id
	 * @param string $widget_area
	 * @param string $column
	 *
	 * @return string
	 */
	function einar_core_set_custom_footer_widget_area( $widget_id, $widget_area, $column ) {
		$page_id            = qode_framework_get_page_id();
		$custom_widget_id   = 'qodef_footer_' . esc_attr( $widget_area ) . '_area_custom_widget_' . esc_attr( $column );
		$custom_widget_area = get_post_meta( $page_id, $custom_widget_id, true );

		if ( ! empty( $custom_widget_area ) ) {
			return $custom_widget_area;
		}

		return $widget_id;
	}

	add_filter( 'einar_filter_footer_widget_area', 'einar_core_set_custom_footer_widget_area', 10, 3 );
}

if ( ! function_exists( 'einar_core_set_page_footer_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function einar_core_set_page_footer_area_styles( $style ) {
		$footer_area = array( 'top', 'bottom' );
        $logo_footer_height = einar_core_get_post_value_through_levels('qodef_footer_logo_height');

        $logo_footer_styles = array();

        if ( ! empty( $logo_footer_height ) ) {
            $logo_footer_styles['height'] = $logo_footer_height . 'px';
            $style .= qode_framework_dynamic_style( '#qodef-page-footer-logo-area .qodef-footer-logo-link', $logo_footer_styles );
        }
		foreach ( $footer_area as $area ) {

			$styles           = array();
			$background_color = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_background_color' );
			$background_image = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_background_image' );

			if ( ! empty( $background_color ) ) {
				$styles['background-color'] = $background_color;
			}

			if ( ! empty( $background_image ) ) {
				$styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) . ')';
			}

			if ( ! empty( $styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area', $styles );
			}

			$inner_styles = array();

			$columns_size     = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_columns_size' );
			$padding_top      = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_padding_top' );
			$padding_bottom   = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_padding_bottom' );
			$side_padding     = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_side_padding' );
			$top_border_color = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_top_border_color' );
			$top_border_width = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_top_border_width' );
			$top_border_style = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_top_border_style' );

			if ( ! empty( $columns_size ) ) {
				if ( qode_framework_string_ends_with_space_units( $columns_size ) ) {
					$inner_styles['max-width'] = $columns_size;
				} else {
					$inner_styles['max-width'] = intval( $columns_size ) . 'px';
				}
			}

			if ( '' !== $padding_top ) {
				if ( qode_framework_string_ends_with_space_units( $padding_top, true ) ) {
					$inner_styles['padding-top'] = $padding_top;
				} else {
					$inner_styles['padding-top'] = intval( $padding_top ) . 'px';
				}
			}

			if ( '' !== $padding_bottom ) {
				if ( qode_framework_string_ends_with_space_units( $padding_bottom, true ) ) {
					$inner_styles['padding-bottom'] = $padding_bottom;
				} else {
					$inner_styles['padding-bottom'] = intval( $padding_bottom ) . 'px';
				}
			}

			if ( '' !== $side_padding ) {
				if ( qode_framework_string_ends_with_space_units( $side_padding, true ) ) {
					$inner_styles['padding-left']  = $side_padding . '!important';
					$inner_styles['padding-right'] = $side_padding . '!important';
				} else {
					$inner_styles['padding-left']  = intval( $side_padding ) . 'px !important';
					$inner_styles['padding-right'] = intval( $side_padding ) . 'px !important';
				}
			}

			if ( ! empty( $top_border_color ) ) {
				$inner_styles['border-top-color'] = $top_border_color;

				if ( '' === $top_border_width ) {
					$inner_styles['border-top-width'] = '1px';
				}
			}

			if ( '' !== $top_border_width ) {
				$inner_styles['border-top-width'] = intval( $top_border_width ) . 'px';
			}

			if ( ! empty( $top_border_style ) ) {
				$inner_styles['border-top-style'] = $top_border_style;
			}

			if ( ! empty( $inner_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area-inner', $inner_styles );
			}

			$widgets_styles = array();
			$margin_bottom  = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_widgets_margin_bottom' );

			if ( ! empty( $margin_bottom ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
					$widgets_styles['margin-bottom'] = $margin_bottom;
				} else {
					$widgets_styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
				}
			}

			if ( ! empty( $widgets_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area .widget', $widgets_styles );
			}

			$widgets_title_styles = array();
			$title_margin_bottom  = einar_core_get_post_value_through_levels( 'qodef_' . $area . '_footer_area_widgets_title_margin_bottom' );

			if ( ! empty( $title_margin_bottom ) ) {
				if ( qode_framework_string_ends_with_space_units( $title_margin_bottom, true ) ) {
					$widgets_title_styles['margin-bottom'] = $title_margin_bottom;
				} else {
					$widgets_title_styles['margin-bottom'] = intval( $title_margin_bottom ) . 'px';
				}
			}

			if ( ! empty( $widgets_title_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-page-footer-' . $area . '-area .widget .qodef-widget-title', $widgets_title_styles );
			}

            //responsive styles - start
            $footer_styles_mobile = array();
            $logo_mobile_footer_height = einar_core_get_post_value_through_levels('qodef_footer_mobile_logo_height');

            if ( ! empty( $logo_mobile_footer_height ) ) {
                $footer_styles_mobile['height'] = intval( $logo_mobile_footer_height ) . 'px';
            }

            if ( ! empty( $footer_styles_mobile ) ) {
                $style .= qode_framework_dynamic_style_responsive( '#qodef-page-footer-logo-area .qodef-footer-logo-link', $footer_styles_mobile, '', '1024' );
            }
		}

		return $style;
	}

	add_filter( 'einar_filter_add_inline_style', 'einar_core_set_page_footer_area_styles' );
}
