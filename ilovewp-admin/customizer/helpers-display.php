<?php


function ilovewp_get_css_rules(){
    
    $customizer_rules = array(

        'color-rules' => array(

        	// Quick Vars
        	array(
                'id' => 'color-primary-text',
                'selector' => ':root',
                'rule' => '--nutmeg-primary-text-color',
            ),

            array(
                'id' => 'color-secondary-text',
                'selector' => ':root',
                'rule' => '--nutmeg-secondary-text-color',
            ),

            array(
                'id' => 'color-link',
                'selector' => ':root',
                'rule' => '--nutmeg-link-color',
            ),

            array(
                'id' => 'color-link-hover',
                'selector' => ':root',
                'rule' => '--nutmeg-link-color-hover',
            ),

            array(
                'id' => 'color-primary-accent',
                'selector' => ':root',
                'rule' => '--nutmeg-primary-accent-color',
            ),

            array(
                'id' => 'color-primary-accent-complementary',
                'selector' => ':root',
                'rule' => '--nutmeg-primary-accent-complementary-color',
            ),

            array(
                'id' => 'color-pattern-background',
                'selector' => ':root',
                'rule' => '--nutmeg-pattern-background-color',
            ),

            array(
                'id' => 'color-footer-background',
                'selector' => ':root',
                'rule' => '--nutmeg-footer-background-color',
            ),

            array(
                'id' => 'color-neutral-color-100',
                'selector' => ':root',
                'rule' => '--nutmeg-neutral-color-100',
            ),

            array(
                'id' => 'color-neutral-color-900',
                'selector' => ':root',
                'rule' => '--nutmeg-neutral-color-900',
            ),

            // General

            array(
                'id' => 'color-body-text',
                'selector' => 'body',
                'rule' => 'color'
            ),

            array(
                'id' => 'color-body-link',
                'selector' => 'a',
                'rule' => 'color'
            ),

            array(
                'id' => 'color-body-link-hover',
                'selector' => 'a:hover, a:focus, h1 a:hover, h1 a:focus, h2 a:hover, h2 a:focus, h3 a:hover, h3 a:focus, h4 a:hover, h4 a:focus, h5 a:hover, h5 a:focus, h6 a:hover, h6 a:focus, .site-archive-posts .entry-meta a:hover, .site-archive-posts .entry-meta a:focus, .entry-meta a:hover, .entry-meta a:focus',
                'rule' => 'color'
            ),

            array(
                'id' => 'color-body-link',
                'selector' => 'input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus',
                'rule' => 'border-color'
            ),

            array(
                'id' => 'color-body-link-hover',
                'selector' => 'input[type="submit"]:hover, input[type="submit"]:focus',
                'rule' => 'background'
            ),

            array(
                'id' => 'color-widget-title',
                'selector' => '.widget-title',
                'rule' => 'color'
            ),
            array(
                'id' => 'color-widget-title-accent',
                'selector' => '.widget-title span:before, .widget-title span:after',
                'rule' => 'background'
            ),

        ),
    );

	return $customizer_rules;
}

/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * This function reads in the options from theme mods and determines whether a CSS rule is needed to implement an
 * option. CSS is only written for choices that are non-default in order to avoid adding unnecessary CSS. All options
 * are also filterable allowing for more precise control via a child theme or plugin.
 *
 * Note that all CSS for options is present in this function except for the CSS for fonts and the logo, which require
 * a lot more code to implement.
 *
 * @return void
 */
function ilovewp_css_add_rules() {

    $rules = ilovewp_get_css_rules();
    
    foreach($rules['color-rules'] as $color_rule) {
		ilovewp_css_add_simple_color_rule($color_rule['id'], $color_rule['selector'], $color_rule['rule']);
    }

}

add_action( 'ilovewp_css', 'ilovewp_css_add_rules' );

function ilovewp_css_add_simple_color_rule( $setting_id, $selectors, $declarations ) {
    
    $default_value = ilovewp_get_default( $setting_id );
    $value = ilovewp_maybe_hash_hex_color( get_theme_mod( $setting_id, $default_value ) );

    if ( $value == '' ) {
    	return;
    }

    if ( strtolower( $value ) === strtolower( $default_value ) ) {
        return;
    }

    if ( is_string( $selectors ) ) {
        $selectors = array( $selectors );
    }

    if ( is_string( $declarations ) ) {
        $declarations = array(
            $declarations => $value
        );
    }

    ilovewp_get_css()->add( array(
        'selectors'    => $selectors,
        'declarations' => $declarations
    ) );
}