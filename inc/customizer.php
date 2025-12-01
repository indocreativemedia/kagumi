<?php
/**
 * Kagumi Theme Customizer
 *
 * @package Kagumi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kagumi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'kagumi_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'kagumi_customize_partial_blogdescription',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'custom_logo',
			array(
				'render_callback' => 'kagumi_customize_partial_custom_logo',
			)
		);
	}
}
add_action( 'customize_register', 'kagumi_customize_register' );

if ( ! function_exists( 'kagumi_customize_partial_custom_logo' ) ) {
	/**
	 * Callback for rendering the custom logo, used in the custom_logo partial.
	 *
	 * @return string The custom logo markup or the site title.
	 */
	function kagumi_customize_partial_custom_logo() {
		if ( has_custom_logo() ) {
			return get_custom_logo();
		} else {
			return get_bloginfo( 'name' );
		}
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function kagumi_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function kagumi_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! function_exists( 'kagumi_remove_customizer_options' ) ) {
	function kagumi_remove_customizer_options($wp_customize) {
		// Remove Colors section
		$wp_customize->remove_section('colors');
	}
}
add_action('customize_register', 'kagumi_remove_customizer_options');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kagumi_customize_preview_js() {
	wp_enqueue_script( 'kagumi-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'kagumi_customize_preview_js' );
