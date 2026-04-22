<?php
/**
 * The7 Child theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue parent and child theme styles.
 */
function the7_child_enqueue_styles() {
    wp_enqueue_style(
        'dt-the7-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( 'dt-the7' )->get( 'Version' )
    );

    wp_enqueue_style(
        'the7-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'dt-the7-parent-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'the7_child_enqueue_styles' );

/**
 * Enqueue hero stylesheet.
 */
function wh_enqueue_hero_styles() {
    // Raleway + Inter from Google Fonts
    wp_enqueue_style(
        'wh-google-fonts',
        'https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&family=Inter:wght@300;400&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'wh-hero-style',
        get_stylesheet_directory_uri() . '/assets/css/hero.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'wh_enqueue_hero_styles' );

/**
 * Register navigation menus.
 */
function wh_register_menus() {
    register_nav_menus( array(
        'utility-nav' => __( 'Utility Navigation (top-right)', 'kero-creative' ),
        'primary-nav' => __( 'Primary Navigation (hero bar)',  'kero-creative' ),
    ) );
}
add_action( 'after_setup_theme', 'wh_register_menus' );

/**
 * Add Customizer controls for hero video / poster.
 */
function wh_hero_customizer( $wp_customize ) {

    $wp_customize->add_section( 'wh_hero_section', array(
        'title'    => __( 'Hero Video Header', 'kero-creative' ),
        'priority' => 30,
    ) );

    // MP4 video URL
    $wp_customize->add_setting( 'hero_video_mp4', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'hero_video_mp4', array(
        'label'   => __( 'Hero Video — MP4 URL', 'kero-creative' ),
        'section' => 'wh_hero_section',
        'type'    => 'url',
    ) );

    // WebM video URL
    $wp_customize->add_setting( 'hero_video_webm', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'hero_video_webm', array(
        'label'   => __( 'Hero Video — WebM URL', 'kero-creative' ),
        'section' => 'wh_hero_section',
        'type'    => 'url',
    ) );

    // Poster / fallback image
    $wp_customize->add_setting( 'hero_video_poster', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_video_poster', array(
        'label'   => __( 'Hero Video Poster / Fallback Image', 'kero-creative' ),
        'section' => 'wh_hero_section',
    ) ) );

    // Logo override
    $wp_customize->add_setting( 'hero_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_logo', array(
        'label'   => __( 'Hero Logo Image', 'kero-creative' ),
        'section' => 'wh_hero_section',
    ) ) );
}
add_action( 'customize_register', 'wh_hero_customizer' );
