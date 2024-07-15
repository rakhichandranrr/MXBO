<?php

class EinarCore_Elementor_Container_Handler {
	private static $instance;
	public $containers = array();

	public function __construct() {
		// container extension
		add_action( 'elementor/element/container/_section_responsive/after_section_end', array( $this, 'render_parallax_options' ), 10, 2 );
		add_action( 'elementor/element/container/_section_responsive/after_section_end', array( $this, 'render_offset_options' ), 10, 2 );
		add_action( 'elementor/element/container/_section_responsive/after_section_end', array( $this, 'render_grid_options' ), 10, 2 );
		add_action( 'elementor/frontend/container/before_render', array( $this, 'container_before_render' ) );

		// common stuff
		add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'enqueue_styles' ), 9 );
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
	}

	/**
	 * @return EinarCore_Elementor_Container_Handler
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// container extension
	public function render_parallax_options( $container, $args ) {
		$container->start_controls_section(
			'qodef_parallax',
			array(
				'label' => esc_html__( 'Einar Parallax', 'einar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			)
		);

		$container->add_control(
			'qodef_parallax_type',
			array(
				'label'       => esc_html__( 'Enable Parallax', 'einar-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => array(
					'no'       => esc_html__( 'No', 'einar-core' ),
					'parallax' => esc_html__( 'Yes', 'einar-core' ),
				),
				'render_type' => 'template',
			)
		);

		$container->add_control(
			'qodef_parallax_image',
			array(
				'label'       => esc_html__( 'Parallax Background Image', 'einar-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => array(
					'qodef_parallax_type' => 'parallax',
				),
				'render_type' => 'template',
			)
		);

		$container->end_controls_section();
	}

	public function render_offset_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_offset',
			array(
				'label' => esc_html__( 'Einar Offset Image', 'einar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			)
		);

		$section->add_control(
			'qodef_offset_type',
			array(
				'label'       => esc_html__( 'Enable Offset Image', 'einar-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => array(
					'no'     => esc_html__( 'No', 'einar-core' ),
					'offset' => esc_html__( 'Yes', 'einar-core' ),
				),
				'render_type' => 'template',
			)
		);

		$section->add_control(
			'qodef_offset_type_disable_from',
			array(
				'label'        => esc_html__( 'Offset Image Disable From', 'einar-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array(
					''     => esc_html__( 'Default', 'einar-core' ),
					'1512' => esc_html__( 'Screen Size 1512', 'einar-core' ),
					'1368' => esc_html__( 'Screen Size 1368', 'einar-core' ),
					'1200' => esc_html__( 'Screen Size 1200', 'einar-core' ),
					'1024' => esc_html__( 'Screen Size 1024', 'einar-core' ),
					'880'  => esc_html__( 'Screen Size 880', 'einar-core' ),
				),
				'condition'    => array(
					'qodef_offset_type' => 'offset',
				),
				'prefix_class' => 'qodef-offset-image-disabled--',
			)
		);

		$repeater = new Elementor\Repeater();

		$repeater->add_control(
			'qodef_offset_image',
			array(
				'label'       => esc_html__( 'Offset Image', 'einar-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'render_type' => 'template',
			)
		);

		$repeater->add_control(
			'qodef_offset_movement',
			array(
				'label'       => esc_html__( 'Enable Offset Movement', 'einar-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''       => esc_html__( 'No', 'einar-core' ),
					'scroll' => esc_html__( 'Scroll', 'einar-core' ),
					'cursor' => esc_html__( 'Cursor', 'einar-core' ),
				),
				'render_type' => 'template',
			)
		);

		$repeater->add_control(
			'qodef_offset_vertical_anchor',
			array(
				'label'   => esc_html__( 'Offset Image Vertical Anchor', 'einar-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'top'    => esc_html__( 'Top', 'einar-core' ),
					'bottom' => esc_html__( 'Bottom', 'einar-core' ),
				),
				'default' => 'top',
			)
		);

		$repeater->add_control(
			'qodef_offset_vertical_position',
			array(
				'label'   => esc_html__( 'Offset Image Vertical Position', 'einar-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '25%',
			)
		);

		$repeater->add_control(
			'qodef_offset_horizontal_anchor',
			array(
				'label'   => esc_html__( 'Offset Image Horizontal Anchor', 'einar-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left'  => esc_html__( 'Left', 'einar-core' ),
					'right' => esc_html__( 'Right', 'einar-core' ),
				),
				'default' => 'left',
			)
		);

		$repeater->add_control(
			'qodef_offset_horizontal_position',
			array(
				'label'   => esc_html__( 'Offset Image Horizontal Position', 'einar-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '25%',
			)
		);

		$section->add_control(
			'qodef_offset_image_items',
			array(
				'label'       => esc_html__( 'Offset Image Items', 'einar-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Item', 'einar-core' ),
				'condition'   => array(
					'qodef_offset_type' => 'offset',
				),
			)
		);

		$section->end_controls_section();
	}

	public function render_grid_options( $container, $args ) {
		$container->start_controls_section(
			'qodef_grid_row',
			array(
				'label' => esc_html__( 'Einar Grid', 'einar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			)
		);

		$container->add_control(
			'qodef_enable_grid_row',
			array(
				'label'        => esc_html__( 'Make this row "In Grid"', 'einar-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array(
					''     => esc_html__( 'No', 'einar-core' ),
					'grid' => esc_html__( 'Yes', 'einar-core' ),
				),
				'prefix_class' => 'qodef-elementor-content-',
			)
		);

		$container->add_control(
			'qodef_grid_row_behavior',
			array(
				'label'        => esc_html__( 'Grid Row Behavior', 'einar-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array(
					''      => esc_html__( 'Default', 'einar-core' ),
					'right' => esc_html__( 'Extend Grid Right', 'einar-core' ),
					'left'  => esc_html__( 'Extend Grid Left', 'einar-core' ),
				),
				'condition'    => array(
					'qodef_enable_grid_row' => 'grid',
				),
				'prefix_class' => 'qodef-extended-grid qodef-extended-grid--',
			)
		);

		$container->add_control(
			'qodef_grid_row_behavior_disable_from',
			array(
				'label'        => esc_html__( 'Grid Row Behavior Disable From', 'einar-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array(
					''     => esc_html__( 'Default', 'einar-core' ),
					'1512' => esc_html__( 'Screen Size 1512', 'einar-core' ),
					'1368' => esc_html__( 'Screen Size 1368', 'einar-core' ),
					'1200' => esc_html__( 'Screen Size 1200', 'einar-core' ),
					'1024' => esc_html__( 'Screen Size 1024', 'einar-core' ),
					'880'  => esc_html__( 'Screen Size 880', 'einar-core' ),
				),
				'condition'    => array(
					'qodef_grid_row_behavior' => array ( 'left', 'right' ),
				),
				'prefix_class' => 'qodef-extended-grid-disabled--',
			)
		);

		$container->end_controls_section();
	}

	public function container_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'container';
		$settings = $data['settings'];

		if ( 'container' === $type ) {
			if ( isset( $settings['qodef_parallax_type'] ) && 'parallax' === $settings['qodef_parallax_type'] ) {
				$parallax_type  = $widget->get_settings_for_display( 'qodef_parallax_type' );
				$parallax_image = $widget->get_settings_for_display( 'qodef_parallax_image' );

				if ( ! in_array( $data['id'], $this->containers, true ) ) {
					$this->containers[ $data['id'] ][] = array(
						'parallax_type'  => $parallax_type,
						'parallax_image' => $parallax_image,
					);
				}
			}

			if ( isset( $settings['qodef_offset_type'] ) && 'offset' === $settings['qodef_offset_type'] ) {
				$offset_type        = $widget->get_settings_for_display( 'qodef_offset_type' );
				$offset_image_items = $widget->get_settings_for_display( 'qodef_offset_image_items' );

				if ( ! in_array( $data['id'], $this->containers, true ) ) {
					$this->containers[ $data['id'] ][] = array(
						'offset_type'        => $offset_type,
						'offset_image_items' => $offset_image_items,
					);
				}
			}
		}
	}

	// common stuff
	public function enqueue_styles() {
		wp_enqueue_style( 'einar-core-elementor', EINAR_CORE_PLUGINS_URL_PATH . '/elementor/assets/css/elementor.min.css' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'einar-core-elementor', EINAR_CORE_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.min.js', array( 'jquery', 'elementor-frontend' ) );

		$elementor_global_vars = array(
			'elementorContainerHandler' => $this->containers,
		);

		wp_localize_script(
			'einar-core-elementor',
			'qodefElementorContainerGlobal',
			array(
				'vars' => $elementor_global_vars,
			)
		);
	}
}

if ( ! function_exists( 'einar_core_init_elementor_container_handler' ) ) {
	/**
	 * Function that initialize main page builder handler
	 */
	function einar_core_init_elementor_container_handler() {
		EinarCore_Elementor_Container_Handler::get_instance();
	}

	add_action( 'init', 'einar_core_init_elementor_container_handler', 1 );
}
