<?php

if ( ! function_exists( 'einar_core_add_portfolio_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info On Hover', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_layouts', 'einar_core_add_portfolio_list_variation_info_on_hover' );
}

if ( ! function_exists( 'einar_core_add_portfolio_list_options_info_on_hover' ) ) {
    /**
     * Function that add additional options for variation layout
     *
     * @param array $options
     *
     * @return array
     */
    function einar_core_add_portfolio_list_options_info_on_hover( $options ) {
        $extra_options   = array();
        $popup_option    = array(
            'field_type'  => 'select',
            'name'        => 'info_on_hover_behavior',
            'title'       => esc_html__( 'Image Link Behavior', 'einar-core' ),
            'options'     => array(
                ''           => esc_html__( 'Default', 'einar-core' ),
                'open-popup' => esc_html__( 'Open Popup', 'einar-core' ),
            ),
            'description' => esc_html__( 'Opens popup images that are set on single portfolio page for Media Item Type "Gallery"', 'einar-core' ),
            'dependency'  => array(
                'show' => array(
                    'layout' => array(
                        'values'        => 'info-on-hover',
                        'default_value' => '',
                    ),
                ),
            ),
            'group'       => esc_html__( 'Layout', 'einar-core' ),
        );
        $extra_options[] = $popup_option;

        return array_merge( $options, $extra_options );
    }

    add_filter( 'einar_core_filter_portfolio_list_extra_options', 'einar_core_add_portfolio_list_options_info_on_hover' );
}
