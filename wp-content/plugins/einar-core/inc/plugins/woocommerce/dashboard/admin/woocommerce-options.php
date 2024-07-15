<?php

if ( ! function_exists( 'einar_core_add_woocommerce_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_woocommerce_options() {
		$qode_framework = qode_framework_get_framework_root();

		$list_item_layouts = apply_filters( 'einar_core_filter_product_list_layouts', array() );
		$options_map       = einar_core_get_variations_options_map( $list_item_layouts );

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EINAR_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'woocommerce',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'WooCommerce', 'einar-core' ),
				'description' => esc_html__( 'Global WooCommerce Options', 'einar-core' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Product List', 'einar-core' ),
					'description' => esc_html__( 'Settings related to product list', 'einar-core' ),
				)
			);

			if ( $options_map['visibility'] ) {
				$list_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_product_list_item_layout',
						'title'         => esc_html__( 'Item Layout', 'einar-core' ),
						'description'   => esc_html__( 'Choose layout for list item on shop lists', 'einar-core' ),
						'options'       => $list_item_layouts,
						'default_value' => $options_map['default_value'],
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns',
					'title'       => esc_html__( 'Number of Columns', 'einar-core' ),
					'description' => esc_html__( 'Choose number of columns for product list on shop pages', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'columns_number' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns_space',
					'title'       => esc_html__( 'Items Horizontal Spacing', 'einar-core' ),
					'description' => esc_html__( 'Choose horizontal space between items for product list on shop pages', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$woo_product_list_columns_space_row = $list_tab->add_row_element(
				array(
					'name'       => 'qodef_woo_product_list_columns_space_row',
					'dependency' => array(
						'show' => array(
							'qodef_woo_product_list_columns_space' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$woo_product_list_columns_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_space_custom',
					'title'       => esc_html__( 'Custom Horizontal Spacing', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_columns_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_space_custom_1512',
					'title'       => esc_html__( 'Custom Horizontal Spacing - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_columns_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_space_custom_1200',
					'title'       => esc_html__( 'Custom Horizontal Spacing - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_columns_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_space_custom_680',
					'title'       => esc_html__( 'Custom Horizontal Spacing - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns_vertical_space',
					'title'       => esc_html__( 'Items Vertical Spacing', 'einar-core' ),
					'description' => esc_html__( 'Choose vertical space between items for product list on shop pages', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$woo_product_list_columns_vertical_space_row = $list_tab->add_row_element(
				array(
					'name'       => 'qodef_woo_product_list_columns_vertical_space_row',
					'dependency' => array(
						'show' => array(
							'qodef_woo_product_list_columns_vertical_space' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$woo_product_list_columns_vertical_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_vertical_space_custom',
					'title'       => esc_html__( 'Custom Vertical Spacing', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_columns_vertical_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_vertical_space_custom_1512',
					'title'       => esc_html__( 'Custom Vertical Spacing - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_columns_vertical_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_vertical_space_custom_1200',
					'title'       => esc_html__( 'Custom Vertical Spacing - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_columns_vertical_space_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_columns_vertical_space_custom_680',
					'title'       => esc_html__( 'Custom Vertical Spacing - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_products_per_page',
					'title'       => esc_html__( 'Products per Page', 'einar-core' ),
					'description' => esc_html__( 'Set number of products on shop pages. Default value is 12', 'einar-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_title_tag',
					'title'       => esc_html__( 'Title Tag', 'einar-core' ),
					'description' => esc_html__( 'Choose title tag for product list item on shop pages', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'title_tag' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_product_list_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for shop pages', 'einar-core' ),
					'default_value' => 'no-sidebar',
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_woo_product_list_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on shop pages', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$woo_product_list_sidebar_grid_gutter_row = $list_tab->add_row_element(
				array(
					'name'       => 'qodef_woo_product_list_sidebar_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_woo_product_list_sidebar_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$woo_product_list_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter_custom_1512',
					'title'       => esc_html__( 'Custom Grid Gutter - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter_custom_1200',
					'title'       => esc_html__( 'Custom Grid Gutter - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$woo_product_list_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'no',
					'name'          => 'qodef_woo_enable_percent_sign_value',
					'title'         => esc_html__( 'Enable Percent Sign', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'einar-core' ),
				)
			);

			// Hook to include additional options after section module options
			do_action( 'einar_core_action_after_woo_product_list_options_map', $list_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Product Single', 'einar-core' ),
					'description' => esc_html__( 'Settings related to product single', 'einar-core' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'einar-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title on single product page', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_title_tag',
					'title'       => esc_html__( 'Title Tag', 'einar-core' ),
					'description' => esc_html__( 'Choose title tag for product on single product page', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'title_tag' ),
				)
			);

			$media_section = $single_tab->add_section_element(
				array(
					'name'  => 'qodef_woo_single_media_section',
					'title' => esc_html__( 'Media', 'einar-core' ),
				)
			);

			$media_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_single_media_layout',
					'title'         => esc_html__( 'Media Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose media display layout on single product pages', 'einar-core' ),
					'options'       => array(
						'slider'  => esc_html__( 'Slider', 'einar-core' ),
						'gallery' => esc_html__( 'Gallery', 'einar-core' ),
						'combo'   => esc_html__( 'Combo', 'einar-core' ),
					),
					'default_value' => 'combo',
				)
			);

			$media_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_single_enable_image_lightbox',
					'title'         => esc_html__( 'Enable Image Lightbox', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will set lightbox functionality for images on single product page', 'einar-core' ),
					'options'       => array(
						''               => esc_html__( 'None', 'einar-core' ),
						'photo-swipe'    => esc_html__( 'Photo Swipe', 'einar-core' ),
						'magnific-popup' => esc_html__( 'Magnific Popup', 'einar-core' ),
					),
					'default_value' => 'magnific-popup',
					'dependency'    => array(
						'show' => array(
							'qodef_woo_single_media_layout' => array(
								'values'        => array( 'gallery', 'combo' ),
								'default_value' => 'combo',
							),
						),
					),
				)
			);

			$media_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_woo_single_enable_image_zoom',
					'title'         => esc_html__( 'Enable Zoom Magnifier', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will show magnifier image on hover on single product page', 'einar-core' ),
					'default_value' => 'yes',
					'dependency'    => array(
						'show' => array(
							'qodef_woo_single_media_layout' => array(
								'values'        => array( 'gallery', 'combo' ),
								'default_value' => 'combo',
							),
						),
					),
				)
			);

			$media_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_single_thumb_images_position',
					'title'         => esc_html__( 'Set Thumbnail Images Position', 'einar-core' ),
					'description'   => esc_html__( 'Choose position of the thumbnail images on single product page relative to featured image', 'einar-core' ),
					'options'       => array(
						'below' => esc_html__( 'Below', 'einar-core' ),
						'left'  => esc_html__( 'Left', 'einar-core' ),
					),
					'default_value' => 'below',
					'dependency'    => array(
						'show' => array(
							'qodef_woo_single_media_layout' => array(
								'values'        => array( 'gallery', 'combo' ),
								'default_value' => 'combo',
							),
						),
					),
				)
			);

			$media_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_thumbnail_images_columns',
					'title'       => esc_html__( 'Number of Thumbnail Image Columns', 'einar-core' ),
					'description' => esc_html__( 'Set a number of columns for thumbnail images on single product pages', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'columns_number' ),
					'dependency'  => array(
						'show' => array(
							'qodef_woo_single_media_layout' => array(
								'values'        => array( 'gallery', 'combo' ),
								'default_value' => 'combo',
							),
						),
					),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_related_product_list_columns',
					'title'       => esc_html__( 'Number of Related Product Columns', 'einar-core' ),
					'description' => esc_html__( 'Set a number of columns for related products on single product pages', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'columns_number' ),
				)
			);

			// Hook to include additional options after section module options
			do_action( 'einar_core_action_after_woo_product_single_options_map', $single_tab );

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_woo_options_map', $page );
		}
	}

	add_action( 'einar_core_action_default_options_init', 'einar_core_add_woocommerce_options', einar_core_get_admin_options_map_position( 'woocommerce' ) );
}
