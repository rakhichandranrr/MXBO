<?php

if ( ! function_exists( 'einar_core_register_testimonials_for_meta_options' ) ) {
	/**
	 * Function that add custom post type into global meta box allowed items array for saving meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function einar_core_register_testimonials_for_meta_options( $post_types ) {
		$post_types[] = 'testimonials';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'einar_core_register_testimonials_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'einar_core_register_testimonials_for_meta_options' );
}

if ( ! function_exists( 'einar_core_add_testimonials_custom_post_type' ) ) {
	/**
	 * Function that adds testimonials custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function einar_core_add_testimonials_custom_post_type( $cpts ) {
		$cpts[] = 'EinarCore_Testimonials_CPT';

		return $cpts;
	}

	add_filter( 'einar_core_filter_register_custom_post_types', 'einar_core_add_testimonials_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class EinarCore_Testimonials_CPT extends QodeFrameworkCustomPostType {

		public function map_post_type() {
			$name = esc_html__( 'Testimonials', 'einar-core' );
			$this->set_base( 'testimonials' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-format-status' );
			$this->set_slug( 'testimonials' );
			$this->set_name( $name );
			$this->set_path( EINAR_CORE_CPT_PATH . '/testimonials' );
			$this->set_labels(
				array(
					'name'          => esc_html__( 'Einar Testimonials', 'einar-core' ),
					'singular_name' => esc_html__( 'Testimonial', 'einar-core' ),
					'add_item'      => esc_html__( 'New Testimonial', 'einar-core' ),
					'add_new_item'  => esc_html__( 'Add New Testimonial', 'einar-core' ),
					'edit_item'     => esc_html__( 'Edit Testimonial', 'einar-core' ),
				)
			);
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports(
				array(
					'title',
					'thumbnail',
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'testimonials-category',
					'slug'          => 'testimonials-category',
					'singular_name' => esc_html__( 'Category', 'einar-core' ),
					'plural_name'   => esc_html__( 'Categories', 'einar-core' ),
				)
			);
		}
	}
}
