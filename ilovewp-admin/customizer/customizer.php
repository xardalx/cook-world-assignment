<?php

if ( ! class_exists( 'ILOVEWP_Customizer' ) ) :
    class ILOVEWP_Customizer {
        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'init' ) );
            add_action( 'customize_register', array( $this, 'panels' ) );
            add_action( 'customize_register', array( $this, 'sections' ) );
            add_action( 'wp_head', array( $this, 'ilovewp_display_customization' ) );
            add_action( 'customize_preview_init', array( $this, 'ilovewp_customizer_js' ), 100 );
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'ilovewp_customizer_presets_js' ) );

        }

        public function init() {
            require_once get_template_directory() . '/ilovewp-admin/customizer/helpers.php';
            require_once get_template_directory() . '/ilovewp-admin/customizer/helpers-css.php';
            require_once get_template_directory() . '/ilovewp-admin/customizer/helpers-defaults.php';
            require_once get_template_directory() . '/ilovewp-admin/customizer/helpers-display.php';

			$theme_editor_palette = self::get_editor_color_palette();
			// If we have colors, add them to the block editor palette.
			if ( $theme_editor_palette ) {
				add_theme_support( 'editor-color-palette', $theme_editor_palette );
			}

        }

        function ilovewp_customizer_presets_js() {

            wp_enqueue_script(
                'ilovewp-customizer-presets',
                get_stylesheet_directory_uri() . '/ilovewp-admin/js/customizer-presets.js',
                array('jquery'),
                false,
                true // In the header!
            );

        }

        function ilovewp_customizer_js() {

            wp_enqueue_script(
                'ilovewp-vein-js',
                get_stylesheet_directory_uri() . '/ilovewp-admin/js/vein.min.js',
                array(),
                false,
                true // In the footer!
            );

            wp_enqueue_script(
                'ilovewp-customizer-js',
                get_stylesheet_directory_uri() . '/ilovewp-admin/js/customizer-preview.js',
                array('jquery', 'customize-preview'),
                false,
                true // In the footer!
            );

            wp_localize_script('ilovewp-customizer-js', 'ilovewp_css_rules', ilovewp_get_css_rules());

        }

        /**
         * Register Customizer panels.
         *
         * @param  WP_Customize_Manager $wp_customize
         *
         * @return void
         */
        public function panels( $wp_customize ) {
            $priority = 1000;
            foreach ( $this->get_panels() as $panel => $data ) {
                if (!isset($data['priority'])) {
                    $data['priority'] = $priority += 100;
                }

                $wp_customize->add_panel( $this->get_prefix() . $panel, $data );
            }

            // Re-prioritize and rename the Widgets panel
            if ( ! isset( $wp_customize->get_panel( 'widgets' )->priority ) ) {
                $wp_customize->add_panel( 'widgets' );
            }
            $wp_customize->get_panel( 'widgets' )->priority = $priority += 100;
        }

        /**
         * Add sections and controls to the customizer.
         *
         * @param  WP_Customize_Manager $wp_customize
         *
         * @return void
         */
        public function sections( $wp_customize ) {
            $default_path = get_template_directory() . '/ilovewp-admin/customizer/sections';

            // Load built-in section mods
            $builtin_mods = array(
                'background',
                'navigation',
                'static-front-page',
            );

            foreach ( $builtin_mods as $slug ) {
                $file = trailingslashit( $default_path ) . $slug . '.php';

                if ( file_exists( $file ) ) {
                    require_once( $file );
                }
            }

            foreach ( $this->get_panels() as $panel => $data ) {
                $file = trailingslashit( $default_path ) . $panel . '.php';

                if ( file_exists( $file ) ) {
                    require_once( $file );
                }
            }

            $sections = $this->get_sections();

            $priority = array();
            foreach ( $sections as $section => $data ) {
                $options = null;

                if ( isset( $data['options'] ) ) {
                    $options = $data['options'];
                    unset( $data['options'] );
                }

                if ( ! isset( $data['priority'] ) ) {
                    $panel_priority = ( 'none' !== $panel && isset( $panels[ $panel ]['priority'] ) ) ? $panels[ $panel ]['priority'] : 1000;

                    if ( ! isset( $priority[ $panel ] ) ) {
                        $priority[ $panel ] = $panel_priority;
                    }

                    $data['priority'] = $priority[ $panel ] += 10;
                }

                $wp_customize->add_section( $this->get_prefix() . $section, $data );

                // Add options to the section
                $this->add_sections_options( $wp_customize, $this->get_prefix() . $section, $options );
            }
        }

        /**
         * Register settings and controls for a section.
         *
         * @param WP_Customize_Manager $wp_customize
         * @param string $section
         * @param array $args
         */
        private function add_sections_options( $wp_customize, $section, $args ) {
            
	    	global $theme_defaults;
		    if ( !isset($theme_defaults) ) {
		    	$theme_defaults = ilovewp_get_all_defaults();
			}

            foreach ( $args as $setting_id => $option ) {
                // Add setting
                if ( isset( $option['setting'] ) ) {
                    $defaults = array(
                        'type'                 => 'theme_mod',
                        'capability'           => 'edit_theme_options',
                        'theme_supports'       => '',
                        'default'              => ilovewp_get_a_default($theme_defaults, $setting_id),
                        'transport'            => 'refresh',
                        'sanitize_callback'    => '',
                        'sanitize_js_callback' => '',
                    );

                    $setting = wp_parse_args( $option['setting'], $defaults );

                    // Add the setting arguments inline so Theme Check can verify the presence of sanitize_callback
                    $wp_customize->add_setting( $setting_id, array(
                        'type'                 => $setting['type'],
                        'capability'           => $setting['capability'],
                        'theme_supports'       => $setting['theme_supports'],
                        'default'              => $setting['default'],
                        'transport'            => $setting['transport'],
                        'sanitize_callback'    => $setting['sanitize_callback'],
                        'sanitize_js_callback' => $setting['sanitize_js_callback'],
                    ) );
                }

                // Add control
                if ( isset( $option['control'] ) ) {
                    $control_id = $this->get_prefix() . $setting_id;

                    $defaults = array(
                        'settings' => $setting_id,
                        'section'  => $section,
                    );

                    if ( ! isset( $option['setting'] ) ) {
                        unset( $defaults['settings'] );
                    }

                    $control = wp_parse_args( $option['control'], $defaults );

                    // Check for a specialized control class
                    if ( isset( $control['control_type'] ) ) {
                        $class = $control['control_type'];

                        if ( class_exists( $class ) ) {
                            unset( $control['control_type'] );

                            // Dynamically generate a new class instance
                            $reflection     = new ReflectionClass( $class );
                            $class_instance = $reflection->newInstanceArgs( array(
                                $wp_customize,
                                $control_id,
                                $control
                            ) );

                            $wp_customize->add_control( $class_instance );
                        }
                    } else {
                        $wp_customize->add_control( $control_id, $control );
                    }
                }
            }
        }

        private function get_panels() {
            return apply_filters( 'ilovewp_customizer_panels', array(
                'general'      => array( 'title' => esc_html__( 'Theme Settings', 'nutmeg' ) ),
                'color-scheme' => array( 'title' => esc_html__( 'Theme Colors', 'nutmeg' ) ),
            ) );
        }

        /**
         * @return array Customizer sections
         */
        private function get_sections() {
            return apply_filters( 'ilovewp_customizer_sections', array() );
        }

        /**
         * @return string Theme prefix
         */
        private function get_prefix() {
            // $theme_data = wp_get_theme();
			return 'ilovewp' . '_';
        }

        public function ilovewp_display_customization() {

            $css = $this->ilovewp_get_customization_css();

            if ( ! empty( $css ) ) {
                echo "\n<!-- Begin Theme Custom CSS -->\n<style type=\"text/css\" id=\"ilovewp-custom-css\">\n";
                echo $css;
                echo "\n</style>\n<!-- End Theme Custom CSS -->\n";
            }
        }

        public function ilovewp_get_customization_css() {
            do_action( 'ilovewp_css' );

            $css = ilovewp_get_css()->build();

            if ( ! empty( $css ) ) {
                return $css;
            }
        }

        private function get_editor_color_palette() {

			$all_theme_mods 			= get_theme_mods();
			$all_theme_defaults			= array_filter(ilovewp_get_all_defaults());
			$customizer_rules			= ilovewp_get_css_rules();
			$customizer_color_rules 	= array();
			$all_theme_colors			= array();
			$editor_color_palette		= array();

			// Fetch our Quick Colors settings from the Customizer
			$file = get_template_directory() . '/ilovewp-admin/customizer/sections/color-scheme.php';

			if ( file_exists( $file ) ) {
				include( $file );
				$customizer_color_options = ilovewp_customizer_define_color_scheme_sections(array());
				$customizer_color_options = $customizer_color_options['color-quick']['options'];
			}

			// Get an array of all color mod IDs
			foreach ($customizer_rules['color-rules'] as $key => $value) {
				$customizer_color_rules[$value['id']] = '';
			}

			// Populate the array with default color values
			$all_theme_colors = array_intersect_key($all_theme_defaults, $customizer_color_rules);

			// Populate the array with custom color values from the customizer
			$all_custom_colors = array_intersect_key($all_theme_mods, $customizer_color_rules);

			$all_final_colors = array_merge($all_theme_colors, $all_custom_colors);

			if ( isset($all_custom_colors) && count($all_custom_colors) > 0 ) {
				foreach ($all_custom_colors as $id => $value) {
					if ( isset($all_theme_colors[$id]) ) {
						$all_theme_colors[$id] = $value;
					}
				}
			}

			if ( isset($all_theme_colors) && count($all_theme_colors) > 0 ) {
				foreach ( $all_theme_colors as $id => $color_hex ) {

					$editor_color_palette[] = array(
						'name'	=> $customizer_color_options[$id]['control']['label'] . ': ' . $color_hex,
						'slug'	=> str_replace('color-', '', $id),
						'color'	=> $color_hex
					);
				}
			}

			$background_color = '#' . get_theme_mod( 'background_color', 'ffffff' );
			$editor_color_palette[] = array(
				'name'  => esc_html__( 'Background Color', 'nutmeg' ),
				'slug'  => 'body-background',
				'color' => $background_color,
			);

			if ( isset($editor_color_palette) ) {
				return $editor_color_palette;
			}

        }

    }

endif;

new ILOVEWP_Customizer();

// Extra styles
function nutmeg_customizer_stylesheet() {

    // Stylesheet
	wp_enqueue_style( 'nutmeg-customizer-css', get_template_directory_uri().'/ilovewp-admin/css/customizer-styles.css', NULL, NULL, 'all' );

}

add_action( 'customize_controls_print_styles', 'nutmeg_customizer_stylesheet' );

function nutmeg_customize_register( $wp_customize ) {

    // Custom help section
	class Nutmeg_WP_Help_Customize_Control extends WP_Customize_Control {
		public $type = 'text_help';
		public function render_content() {
			echo '
			<div class="bnt-customizer-help">
			<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/themes/nutmeg/?utm_source=dashboard&utm_medium=customizer-page&utm_campaign=nutmeg&utm_content=official-theme-page-link" target="_blank" rel="noopener">
			<span class="dashicons dashicons-info"></span>
			'.esc_html__( 'Official Theme Page', 'nutmeg' ).'
			</a>
			<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/documentation/nutmeg/?utm_source=dashboard&utm_medium=customizer-page&utm_campaign=nutmeg&utm_content=theme-doc-link" target="_blank" rel="noopener">
			<span class="dashicons dashicons-book"></span>
			'.esc_html__( 'Theme Documentation', 'nutmeg' ).'
			</a>
			<a class="bnt-customizer-link bnt-support-link" href="https://wordpress.org/support/theme/nutmeg/" target="_blank" rel="noopener">
			<span class="dashicons dashicons-sos"></span>
			'.esc_html__( 'Support Forum', 'nutmeg' ).'
			</a>
			<a class="bnt-customizer-link bnt-rate-link" href="https://wordpress.org/support/theme/nutmeg/reviews/" target="_blank" rel="noopener">
			<span class="dashicons dashicons-heart"></span>
			'.esc_html__( 'Rate Nutmeg', 'nutmeg' ).'
			</a>
			<span class="bnt-customizer-link bnt-rate-link">
			<span class="dashicons dashicons-superhero"></span>
			' . esc_html__( 'Upgrade to Nutmeg Plus', 'nutmeg' ) . '
			<span class="customize-action">' . esc_html__( 'Nutmeg Plus contains many improvements and features that were suggested by the users of the free Nutmeg theme.', 'nutmeg' ) . '</span>
			<br><a href="https://www.ilovewp.com/product/nutmeg-plus/?utm_source=dashboard&utm_medium=customizer-page&utm_campaign=nutmeg&utm_content=upgrade-link" target="_blank" rel="noopener"><span class="button button-primary">' . esc_html__( 'View Nutmeg Plus', 'nutmeg' ) . '</span></a></span>

			</div>
			';
		}
	}

	$wp_customize->add_section( 
		'nutmeg_theme_support', 
		array(
			'title' => esc_html__( 'Theme Help & Support', 'nutmeg' ),
			'priority' => 19,
		) 
	);

	$wp_customize->add_setting( 
		'nutmeg_support', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Nutmeg_WP_Help_Customize_Control(
			$wp_customize,
			'nutmeg_support', 
			array(
				'section' => 'nutmeg_theme_support',
				'type' => 'text_help',
			)
		)
	);

	return $wp_customize;

}
add_action( 'customize_register', 'nutmeg_customize_register' );