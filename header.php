<?php
/**
 * Child Theme Header — Full-Screen Video Hero
 * Overrides the parent (dt-the7) header.php entirely.
 *
 * @package WildernessHealth
 */

defined( 'ABSPATH' ) || exit;

$config = presscore_config();
?><!DOCTYPE html>
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( presscore_responsive() ) :
        $scalable      = of_get_option( 'general-user_scalable' ) ? '1' : '0';
        $maximum_scale = $scalable === '1' ? '5' : '1';
        $viewport = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=' . esc_attr( $maximum_scale ) . ', user-scalable=' . esc_attr( $scalable ) . '">';
        echo apply_filters( 'the7_meta_viewport', $viewport );
    endif; ?>
    <?php presscore_theme_color_meta(); ?>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body id="the7-body" <?php body_class(); ?>>
<?php
wp_body_open();
do_action( 'presscore_body_top' );

$page_class = '';
if ( 'boxed' === $config->get( 'template.layout' ) ) {
    $page_class = 'class="boxed"';
}
?>

<div id="page" <?php echo $page_class; ?>>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'the7mk2' ); ?></a>

    <?php
    // ── Full-screen video hero (replaces The7 header) ──────────────────
    get_template_part( 'template-parts/header-video-hero' );

    if ( presscore_is_content_visible() && $config->get( 'template.footer.background.slideout_mode' ) ) {
        echo '<div class="page-inner">';
    }
    ?>

    <?php do_action( 'presscore_before_main_container' ); ?>

    <?php if ( presscore_is_content_visible() ) : ?>
    <div id="main" <?php presscore_main_container_classes(); ?>>

        <?php do_action( 'presscore_main_container_begin' ); ?>

        <div class="main-gradient"></div>
        <div class="wf-wrap">
        <div class="wf-container-main">

        <?php do_action( 'presscore_before_content' ); ?>

    <?php endif; ?>
