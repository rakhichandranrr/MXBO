<?php

if ( ! function_exists( 'einar_core_add_fixed_backdrop_image_meta_box' ) ) {
    /**
     * Function that add general options for this module
     */
    function einar_core_add_fixed_backdrop_image_meta_box( $general_tab ) {

        if ( $general_tab ) {
            $general_tab->add_field_element(
                array(
                    'field_type'    => 'yesno',
                    'default_value' => 'no',
                    'name'          => 'qodef_fixed_backdrop_image_enabled',
                    'title'         => esc_html__( 'Enable Fixed Backgrop Image', 'einar-core' ),
                )
            );

            $contact_section = $general_tab->add_section_element(
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
	        $contact_section->add_field_element(
		        array(
			        'field_type'    => 'yesno',
			        'name'          => 'qodef_fixed_backdrop_image_animation',
			        'title'         => esc_html__( 'Enable Fixed Backgrop Image Animation', 'einar-core' ),
			        'default_value' => 'no',
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
			        'field_type'    => 'yesno',
			        'name'          => 'qodef_fixed_backdrop_image_control',
			        'title'         => esc_html__( 'Enable Fixed Backgrop Image Mouse Control', 'einar-core' ),
			        'default_value' => 'no',
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
        }
    }

    add_action( 'einar_core_action_after_general_page_meta_box_map', 'einar_core_add_fixed_backdrop_image_meta_box' );
}
