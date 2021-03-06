<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Module Name: Map
 * Description: Display Map
 */
class TB_Map_Module extends Themify_Builder_Module {
	function __construct() {
		parent::__construct(array(
			'name' => __( 'Map', 'themify' ),
			'slug' => 'map'
		));
	}

	public function get_title( $module ) {
		return isset( $module['mod_settings']['address_map'] ) ? esc_textarea( $module['mod_settings']['address_map'] ) : '';
	}

	public function get_options() {
		$zoom_opt = range( 1, 16 );
		$options = array(
			array(
				'id' => 'mod_title_map',
				'type' => 'text',
				'label' => __( 'Module Title', 'themify' ),
				'class' => 'large'
			),
			array(
				'id' => 'map_display_type',
				'type' => 'radio',
				'label' => __( 'Type', 'themify' ),
				'options' => array(
					'dynamic' => __( 'Dynamic', 'themify' ),
					'static' => __( 'Static image', 'themify' ),
				),
				'default' => 'dynamic',
				'option_js' => true
			),
			array(
				'id' => 'address_map',
				'type' => 'textarea',
				'value' => '',
				'class' => 'fullwidth',
				'label' => __( 'Address', 'themify' )
			),
			array(
				'id' => 'latlong_map',
				'type' => 'text',
				'value' => '',
				'class' => 'large',
				'label' => __( 'Lat/Long', 'themify' ),
				'help' => '<br/>' . __( 'Use Lat/Long instead of address (Leave address field empty to use this). Exp: 43.6453137,-79.3918391', 'themify' )
			),
			array(
				'id' => 'zoom_map',
				'type' => 'select',
				'label' => __( 'Zoom', 'themify' ),
				'default' => 8,
				'options' => $zoom_opt
			),
			array(
				'id' => 'w_map',
				'type' => 'text',
				'class' => 'xsmall',
				'label' => __( 'Width', 'themify' ),
				'unit' => array(
					'id' => 'unit_w',
					'type' => 'select',
					'selected' => '%',
					'options' => array(
						array( 'id' => 'pixel_unit_w', 'value' => 'px'),
						array( 'id' => 'percent_unit_w', 'value' => '%')
					)
				),
				'value' => 100,
				'wrap_with_class' => 'tf-group-element tf-group-element-dynamic'
			),
			array(
				'id' => 'w_map_static',
				'type' => 'text',
				'class' => 'xsmall',
				'label' => __( 'Width', 'themify' ),
				'value' => 500,
				'after' => 'px',
				'wrap_with_class' => 'tf-group-element tf-group-element-static'
			),
			array(
				'id' => 'h_map',
				'type' => 'text',
				'label' => __( 'Height', 'themify' ),
				'class' => 'xsmall',
				'unit' => array(
					'id' => 'unit_h',
					'type' => 'select',
					'options' => array(
						array( 'id' => 'pixel_unit_h', 'value' => 'px')
					)
				),
				'value' => 300
			),
			array(
				'id' => 'multi_map_border',
				'type' => 'multi',
				'label' => __( 'Border', 'themify' ),
				'fields' => array(
					array(
						'id' => 'b_style_map',
						'type' => 'select',
						'label' => '',
						'options' => array(
							'solid' => __( 'Solid', 'themify' ),
							'dashed' => __( 'Dashed', 'themify' ),
							'dotted' => __( 'Dotted', 'themify' ),
							'double' => __( 'Double', 'themify' ),
							'' => __( 'None', 'themify' )
						)
					),
					array(
						'id' => 'b_width_map',
						'type' => 'text',
						'label' => '',
						'class' => 'medium',
						'after' => 'px'
					),
					array(
						'id' => 'b_color_map',
						'type' => 'text',
						'colorpicker' => true,
						'class' => 'large',
						'label' => '',
						'render_callback' => array(
							'control_type' => 'color'
						)
					),
				)
			),
			array(
				'id' => 'type_map',
				'type' => 'select',
				'label' => __( 'Type', 'themify' ),
				'options' => array(
					'ROADMAP' => __( 'Road Map', 'themify' ),
					'SATELLITE' => __( 'Satellite', 'themify' ),
					'HYBRID' => __( 'Hybrid', 'themify' ),
					'TERRAIN' => __( 'Terrain', 'themify' )
				)
			),
			array(
				'id' => 'scrollwheel_map',
				'type' => 'select',
				'label' => __( 'Scrollwheel', 'themify' ),
				'options' => array(
					'disable' => __( 'Disable', 'themify' ),
					'enable' => __( 'Enable', 'themify' ),
				),
				'wrap_with_class' => 'tf-group-element tf-group-element-dynamic'
			),
			array(
				'id' => 'draggable_map',
				'type' => 'select',
				'label' => __( 'Draggable', 'themify' ),
				'options' => array(
					'enable' => __( 'Enable', 'themify' ),
					'disable' => __( 'Disable', 'themify' )
				),
				'wrap_with_class' => 'tf-group-element tf-group-element-dynamic'
			),
			array(
				'id' => 'draggable_disable_mobile_map',
				'type' => 'select',
				'label' => __( 'Disable draggable on mobile', 'themify' ),
				'options' => array(
					'yes' => __( 'Yes', 'themify' ),
					'no' => __( 'No', 'themify' )
				),
				'wrap_with_class' => 'tf-group-element tf-group-element-dynamic'
			),
			array(
				'id' => 'info_window_map',
				'type' => 'textarea',
				'value' => '',
				'class' => 'fullwidth',
				'label' => __( 'Info window', 'themify' ),
				'help' => __( 'Additional info that will be shown when clicking on map marker', 'themify' ),
				'wrap_with_class' => 'tf-group-element tf-group-element-dynamic'
			),
			// Additional CSS
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr/>')
			),
			array(
				'id' => 'css_map',
				'type' => 'text',
				'label' => __( 'Additional CSS Class', 'themify' ),
				'class' => 'large exclude-from-reset-field',
				'help' => sprintf( '<br/><small>%s</small>', __( 'Add additional CSS class(es) for custom styling', 'themify' ) )
			)
		);
		return $options;
	}

	public function get_default_settings() {
		$settings = array(
			'address_map' => 'Toronto',
			'b_style_map' => 'solid'
		);
		return $settings;
	}

	public function get_animation() {
		$animation = array(
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . esc_html__( 'Appearance Animation', 'themify' ) . '</h4>')
			),
			array(
				'id' => 'multi_Animation Effect',
				'type' => 'multi',
				'label' => __( 'Effect', 'themify' ),
				'fields' => array(
					array(
						'id' => 'animation_effect',
						'type' => 'animation_select',
						'label' => __( 'Effect', 'themify' )
					),
					array(
						'id' => 'animation_effect_delay',
						'type' => 'text',
						'label' => __( 'Delay', 'themify' ),
						'class' => 'xsmall',
						'description' => __( 'Delay (s)', 'themify' ),
					),
					array(
						'id' => 'animation_effect_repeat',
						'type' => 'text',
						'label' => __( 'Repeat', 'themify' ),
						'class' => 'xsmall',
						'description' => __( 'Repeat (x)', 'themify' ),
					),
				)
			)
		);

		return $animation;
	}

	public function get_styling() {
		$general = array(
			// Background
			array(
				'id' => 'separator_image_background',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Background', 'themify' ) . '</h4>' )
			),
			array(
				'id' => 'background_color',
				'type' => 'color',
				'label' => __( 'Background Color', 'themify' ),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => '.module-map',
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_padding',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Padding', 'themify' ) . '</h4>' ),
			),
			Themify_Builder_Model::get_field_group( 'padding', '.module-map', 'top' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-map', 'right' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-map', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-map', 'left' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-map', 'all' ),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_margin',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Margin', 'themify') . '</h4>' ),
			),
			Themify_Builder_Model::get_field_group( 'margin', '.module-map', 'top' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-map', 'right' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-map', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-map', 'left' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-map', 'all' ),
			// Border
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_border',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Border', 'themify' ) . '</h4>' )
			),
			Themify_Builder_Model::get_field_group( 'border', '.module-map', 'top' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-map', 'right' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-map', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-map', 'left' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-map', 'all' )
		);

		return array(
			array(
				'type' => 'tabs',
				'id' => 'module-styling',
				'tabs' => array(
					'general' => array(
					'label' => __( 'General', 'themify' ),
					'fields' => $general
					),
					'module-title' => array(
						'label' => __( 'Module Title', 'themify' ),
						'fields' => Themify_Builder_Model::module_title_custom_style( $this->slug )
					)
				)
			)
		);

	}
}

///////////////////////////////////////
// Module Options
///////////////////////////////////////
Themify_Builder_Model::register_module( 'TB_Map_Module' );