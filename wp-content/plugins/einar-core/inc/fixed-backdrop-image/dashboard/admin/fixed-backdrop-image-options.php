<?php

if ( ! function_exists( 'einar_core_add_add_fixed_backdrop_image_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_add_fixed_backdrop_image_options( $page ) {

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_fixed_backdrop_image_enabled',
					'title'         => esc_html__( 'Enable Fixed Backgrop Image', 'einar-core' ),
					'default_value' => 'no',
				)
			);
			$contact_section = $page->add_section_element(
				array(
					'name'       => 'qodef_contact_section',
					'title'      => esc_html__( 'Fixed Backdrop Image Section', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_fixed_backdrop_image_enabled' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
            $contact_section->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_fixed_backdrop_image',
                    'title'       => esc_html__( 'Fixed Backdrop Image', 'einar-core' )
                )
            );
		}
	}

    add_action( 'einar_core_action_after_general_options_map', 'einar_core_add_add_fixed_backdrop_image_options' );
}
