<?php

if ( ! function_exists( 'einar_core_add_product_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_product_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'product' ),
				'type'   => 'meta',
				'slug'   => 'product-list',
				'title'  => esc_html__( 'Product List', 'einar-core' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			/* General Tab */

			$general_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-page',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Page Settings', 'einar-core' ),
					'description' => esc_html__( 'General page layout settings', 'einar-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_single_content_skin',
					'title'       => esc_html__( 'Product Skin', 'einar-core' ),
					'description' => esc_html__( 'Change content and header skin to dark or use default for predefined style.', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'page_skin' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'einar-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'einar-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_opposite_color',
					'title'       => esc_html__( 'Main Opposite Color', 'einar-core' ),
					'description' => esc_html__( 'Choose the opposite color from the main color', 'einar-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_second_color',
					'title'       => esc_html__( 'Second Color', 'einar-core' ),
					'description' => esc_html__( 'Choose the secondary theme color', 'einar-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'einar-core' ),
					'description' => esc_html__( 'Set background color', 'einar-core' ),
				)
			);

			/* Product List sections */

			$product_list_section = $page->add_tab_element(
				array(
					'name'  => 'tab-general',
					'title' => esc_html__( 'Product List', 'einar-core' ),
				)
			);

			$product_list_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_product_list_image',
					'title'       => esc_html__( 'Product List Image', 'einar-core' ),
					'description' => esc_html__( 'Upload image to be displayed on product list instead of featured image', 'einar-core' ),
				)
			);

			$product_list_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_product',
					'title'       => esc_html__( 'Image Dimension', 'einar-core' ),
					'description' => esc_html__( 'Choose an image layout for product list. If you are using fixed image proportions on the list, choose an option other than default', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			$product_list_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_new_sign',
					'title'         => esc_html__( 'Show New Sign', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will show "New Sign" mark on product.', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => 'no',
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_product_single_meta_box_map', $page );
		}
	}

	add_action( 'einar_core_action_default_meta_boxes_init', 'einar_core_add_product_single_meta_box' );
}
