<?php

function ilovewp_customizer_define_color_scheme_sections( $sections ) {
    $panel           = 'ilovewp' . '_color-scheme';
    $colors_sections = array();

    $colors_sections['color-quick'] = array(
        'panel'   => $panel,
        'title'   => esc_html__( 'Quick Styling', 'nutmeg' ),
        'priority'  => 4900,
        'options' => array(

            'color-primary-text' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Primary Text', 'nutmeg' ),
                ),
            ),

            'color-secondary-text' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Secondary Text', 'nutmeg' ),
                ),
            ),

            'color-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Link', 'nutmeg' ),
                ),
            ),

            'color-link-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Link on Hover', 'nutmeg' ),
                ),
            ),

            'color-primary-accent' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Primary Accent', 'nutmeg' ),
                ),
            ),

            'color-primary-accent-complementary' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Primary Accent - Complementary', 'nutmeg' ),
                ),
            ),

            'color-pattern-background' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Pattern Background', 'nutmeg' ),
                ),
            ),

            'color-footer-background' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Footer Background', 'nutmeg' ),
                ),
            ),

            'color-neutral-color-100' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Neutral - Light', 'nutmeg' ),
                ),
            ),

            'color-neutral-color-900' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Neutral - Dark', 'nutmeg' ),
                ),
            ),

            'color-widget-title' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Widget Title', 'nutmeg' ),
                ),
            ),

            'color-widget-title-accent' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_maybe_hash_hex_color',
                    'transport'  => 'postMessage'
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => esc_html__( 'Widget Title Accent', 'nutmeg' ),
                ),
            ),

        )
    );

    return array_merge( $sections, $colors_sections );
}

add_filter( 'ilovewp_customizer_sections', 'ilovewp_customizer_define_color_scheme_sections' );