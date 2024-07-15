<?php

if ( ! function_exists( 'einar_core_get_list_shortcode_item_image' ) ) {
	/**
	 * Function that generates thumbnail img tag for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 * @param int $custom_image_width
	 * @param int $custom_image_height
	 *
	 * @return string generated img tag
	 *
	 * @see qode_framework_generate_thumbnail()
	 */
	function einar_core_get_list_shortcode_item_image( $image_dimension, $attachment_id = 0, $custom_image_width = 0, $custom_image_height = 0, $attr = array() ) {
		$item_id = get_the_ID();

		if ( 'custom' !== $image_dimension ) {
			if ( ! empty( $attachment_id ) ) {
				$html = wp_get_attachment_image( $attachment_id, $image_dimension, false, $attr );
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension, $attr );
			}
		} else {
			if ( ! empty( $custom_image_width ) && ! empty( $custom_image_height ) ) {
				if ( ! empty( $attachment_id ) ) {
					$html = qode_framework_generate_thumbnail( intval( $attachment_id ), $custom_image_width, $custom_image_height, true, $attr );
				} else {
					$html = qode_framework_generate_thumbnail( intval( get_post_thumbnail_id( $item_id ) ), $custom_image_width, $custom_image_height, true, $attr );
				}
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension, $attr );
			}
		}

		return apply_filters( 'einar_core_filter_list_shortcode_item_image', $html, $attachment_id );
	}
}

if ( ! function_exists( 'einar_core_get_list_shortcode_item_image_url' ) ) {
	/**
	 * Function that return thumbnail img url for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 *
	 * @return string
	 */
	function einar_core_get_list_shortcode_item_image_url( $image_dimension, $attachment_id = 0 ) {

		if ( ! empty( $attachment_id ) ) {
			$image = wp_get_attachment_image_src( intval( $attachment_id ), $image_dimension );
			$url   = is_array( $image ) ? $image[0] : '';
		} else {
			$url = get_the_post_thumbnail_url( get_the_ID(), $image_dimension );
		}

		return $url;
	}
}

if ( ! function_exists( 'einar_core_get_cpt_items' ) ) {
	/**
	 * Returns array of custom post items
	 *
	 * @param string $cpt_slug
	 * @param array $args
	 * @param bool $enable_default - add first element empty for default value
	 *
	 * @return array
	 */
	function einar_core_get_cpt_items( $cpt_slug, $args = array(), $enable_default = false ) {
		$options    = array();
		$query_args = array(
			'post_status'    => 'publish',
			'post_type'      => $cpt_slug,
			'posts_per_page' => '-1',
			'fields'         => 'ids',
		);

		if ( ! empty( $args ) ) {
			foreach ( $args as $key => $value ) {
				if ( ! empty( $value ) ) {
					$query_args[ $key ] = $value;
				}
			}
		}

		$cpt_items = new \WP_Query( $query_args );

		if ( $cpt_items->have_posts() ) {

			if ( $enable_default ) {
				$options[''] = esc_html__( 'Default', 'einar-core' );
			}

			foreach ( $cpt_items->posts as $id ) :
				$options[ $id ] = get_the_title( $id );
			endforeach;
		}

		wp_reset_postdata();

		return $options;
	}
}

if ( ! function_exists( 'einar_core_return_elementor_templates' ) ) {
	/**
	 * Function that returns all Elementor saved templates
	 */
	function einar_core_return_elementor_templates() {
		if ( qode_framework_is_installed( 'elementor' ) ) {
			$all_templates = einar_core_get_cpt_items( 'elementor_library' );
			$templates     = array();

			foreach ( $all_templates as $id => $title ) {
				$template_type = get_post_meta( $id, '_elementor_template_type', true );
				$allowed_types = array( 'section', 'page' );
				if ( in_array( $template_type, $allowed_types, true ) ) {
					$title            = get_the_title( $id );
					$templates[ $id ] = $title . ' (' . $template_type . ')';
				}
			}

			return $templates;
		} else {
			return array();
		}
	}
}

if ( ! function_exists( 'einar_core_generate_elementor_templates_control' ) ) {
	/**
	 * Function that adds Template Elementor Control
	 */
	function einar_core_generate_elementor_templates_control() {
		$templates = einar_core_return_elementor_templates();

		if ( ! empty( $templates ) ) {
			$options = array(
				'0' => '— ' . esc_html__( 'Select', 'einar-core' ) . ' —',
			);

			$options = $options + $templates;

			return $options;
		} else {
			return array();
		}
	}
}

//function that returns all Elementor saved templates
if ( ! function_exists( 'einar_core_return_elementor_templates_predefined' ) ) {
	function einar_core_return_elementor_templates_predefined() {
		if ( qode_framework_is_installed( 'elementor' ) ) {
			return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
		}
	}
}

//function that adds Template Elementor Control
if ( ! function_exists( 'einar_core_generate_elementor_templates_control_predefined' ) ) {
	function einar_core_generate_elementor_templates_control_predefined( $object, $control_name = 'template_id', $field_name = 'predefined_elementor_template' ) {
		$templates = einar_core_return_elementor_templates_predefined();

		if ( ! empty( $templates ) ) {
			$options = array(
				'0' => '— ' . esc_html__( 'Select', 'einar-core' ) . ' —',
			);

			$types = array();

			foreach ( $templates as $template ) {
				$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
				$types[ $template['template_id'] ]   = $template['type'];
			}

			return array(
				'field_type'    => 'select',
				'name'          => $field_name,
				'title'         => esc_html__( 'Choose Template', 'einar-core' ),
				'description'   => esc_html__( 'Please note that "Content" section below has higher priority over this option, so it will show only if "Content" is empty', 'einar-core' ),
				'options'       => $options,
				'default_value' => '0',
			);
		};
	}
}
