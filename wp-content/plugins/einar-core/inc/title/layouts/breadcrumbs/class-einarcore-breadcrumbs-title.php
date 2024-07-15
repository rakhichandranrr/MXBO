<?php

class EinarCore_Breadcrumbs_Title extends EinarCore_Title {
	private static $instance;

	public function __construct() {
		$this->slug = 'breadcrumbs';

        // Add title area inline styles
        add_filter( 'einar_filter_add_inline_style', array( $this, 'add_inline_styles' ) );
	}

    function add_inline_styles( $style ) {
        $styles = array();

        $color      = einar_core_get_post_value_through_levels( 'qodef_page_title_color' );

        if ( ! empty( $color ) ) {
            $styles['color'] = $color;
        }

        if ( ! empty( $styles ) ) {
            $style .= qode_framework_dynamic_style( '.qodef-page-title .qodef-breadcrumbs a, .qodef-page-title .qodef-breadcrumbs span ', $styles );
        }

        return $style;
    }

	/**
	 * @return EinarCore_Breadcrumbs_Title
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
