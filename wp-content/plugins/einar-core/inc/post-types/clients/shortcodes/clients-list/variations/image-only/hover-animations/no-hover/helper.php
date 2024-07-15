<?php

if ( ! function_exists( 'einar_core_filter_clients_list_image_only_no_hover' ) ) {
    /**
     * Function that add variation layout for this module
     *
     * @param array $variations
     *
     * @return array
     */
    function einar_core_filter_clients_list_image_only_no_hover( $variations ) {
        $variations['no-hover'] = esc_html__( 'No Hover', 'einar-core' );

        return $variations;
    }

    add_filter( 'einar_core_filter_clients_list_image_only_animation_options', 'einar_core_filter_clients_list_image_only_no_hover' );
}