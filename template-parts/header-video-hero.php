<?php
/**
 * Template Part: Full-Screen Video Hero Header
 * Usage: Include in header.php or a page template via:
 *   get_template_part( 'template-parts/header-video-hero' );
 */

// Video source — set via Theme Options or filter this URL
$video_mp4  = get_theme_mod( 'hero_video_mp4',  get_stylesheet_directory_uri() . '/assets/video/hero.mp4' );
$video_webm = get_theme_mod( 'hero_video_webm', get_stylesheet_directory_uri() . '/assets/video/hero.webm' );
$poster     = get_theme_mod( 'hero_video_poster', get_stylesheet_directory_uri() . '/assets/images/hero-poster.jpg' );

// Logo
$logo_url   = get_theme_mod( 'hero_logo', get_stylesheet_directory_uri() . '/assets/images/logo.png' );
$site_name  = get_bloginfo( 'name' );
$tagline    = get_bloginfo( 'description' );
?>

<header class="wh-hero" id="wh-hero" role="banner">

    <!-- ── Utility bar ─────────────────────────────────────── -->
    <div class="wh-hero__utility-bar">
        <nav class="wh-hero__utility-nav" aria-label="<?php esc_attr_e( 'Utility navigation', 'kero-creative' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'utility-nav',
                'menu_class'     => 'wh-hero__utility-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
        <a href="/login?redirect_to=/mywh/" class="wh-hero__login-btn">
            <?php esc_html_e( 'LOG IN', 'kero-creative' ); ?>
        </a>
    </div>

    <!-- ── Background image ─────────────────────────────────── -->
    <div class="wh-hero__video-wrap" aria-hidden="true">
        <img
            class="wh-hero__bg-image"
            src="<?php echo esc_url( $poster ); ?>"
            alt=""
            role="presentation"
            aria-hidden="true"
        >
        <div class="wh-hero__overlay" aria-hidden="true"></div>
    </div>

    <!-- ── Branding / centre content ───────────────────────── -->
    <div class="wh-hero__branding">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wh-hero__logo-link" aria-label="<?php echo esc_attr( $site_name ); ?>">
            <div class="wh-logo" role="img" aria-label="<?php echo esc_attr( $site_name ); ?> logo">
                <img
                    src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/logo-left.svg"
                    alt=""
                    class="wh-logo__shape wh-logo__shape--left"
                    aria-hidden="true"
                    width="110"
                    height="160"
                >
                <img
                    src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/logo-center.svg"
                    alt=""
                    class="wh-logo__shape wh-logo__shape--center"
                    aria-hidden="true"
                    width="110"
                    height="160"
                >
                <img
                    src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/logo-right.svg"
                    alt=""
                    class="wh-logo__shape wh-logo__shape--right"
                    aria-hidden="true"
                    width="110"
                    height="160"
                >
            </div>
        </a>

        <!-- Logo text -->
        <div class="wh-logo-text" aria-hidden="true">
            <span class="wh-logo-text__main">WILDERNESS</span>
            <span class="wh-logo-text__sub">HEALTH</span>
        </div>

        <?php if ( $tagline ) : ?>
            <p class="wh-tagline"><?php echo esc_html( $tagline ); ?></p>
        <?php endif; ?>
    </div>

    <!-- ── Primary navigation (desktop) ────────────────────── -->
    <nav class="wh-hero__primary-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'kero-creative' ); ?>">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary-nav',
            'menu_class'     => 'wh-hero__primary-menu',
            'container'      => false,
            'fallback_cb'    => false,
        ) );
        ?>
    </nav>

    <!-- ── Hamburger button (mobile only) ──────────────────── -->
    <button
        class="wh-mob-toggle"
        aria-label="<?php esc_attr_e( 'Open menu', 'kero-creative' ); ?>"
        aria-expanded="false"
        aria-controls="wh-mob-panel"
    >
        <span class="wh-mob-toggle__bar"></span>
        <span class="wh-mob-toggle__bar"></span>
        <span class="wh-mob-toggle__bar"></span>
    </button>

</header><!-- .wh-hero -->

<!-- ── Sticky header (appears after hero scrolls out of view) ── -->
<header id="wh-sticky" class="wh-sticky" aria-hidden="true">
    <div class="wh-sticky__inner">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wh-sticky__logo-link" aria-label="<?php echo esc_attr( $site_name ); ?>">
            <img
                src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/logo-horizontal.svg"
                alt="<?php echo esc_attr( $site_name ); ?>"
                class="wh-sticky__logo"
                width="200"
                height="48"
            >
        </a>

        <nav class="wh-sticky__nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'kero-creative' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary-nav',
                'menu_class'     => 'wh-sticky__menu',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <a href="/login?redirect_to=/mywh/" class="wh-sticky__login">
            <?php esc_html_e( 'LOG IN', 'kero-creative' ); ?>
        </a>

        <button
            class="wh-sticky__mob-toggle"
            aria-label="<?php esc_attr_e( 'Open menu', 'kero-creative' ); ?>"
            aria-expanded="false"
            aria-controls="wh-mob-panel"
        >
            <span class="wh-mob-toggle__bar"></span>
            <span class="wh-mob-toggle__bar"></span>
            <span class="wh-mob-toggle__bar"></span>
        </button>

    </div>
</header><!-- .wh-sticky -->

<!-- ── Mobile nav panel (outside header so it's not clipped) ── -->
<div class="wh-mob-backdrop" aria-hidden="true"></div>

<nav id="wh-mob-panel" class="wh-mob-panel" aria-label="<?php esc_attr_e( 'Mobile navigation', 'kero-creative' ); ?>" aria-hidden="true">
    <button
        class="wh-mob-panel__close"
        aria-label="<?php esc_attr_e( 'Close menu', 'kero-creative' ); ?>"
    >&times;</button>

    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary-nav',
        'menu_class'     => 'wh-mob-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>

    <a href="<?php echo esc_url( wp_login_url() ); ?>" class="wh-mob-panel__login">
        <?php esc_html_e( 'LOG IN', 'kero-creative' ); ?>
    </a>
</nav>

<script>
(function () {
    var toggle       = document.querySelector('.wh-mob-toggle');
    var stickyToggle = document.querySelector('.wh-sticky__mob-toggle');
    var panel        = document.getElementById('wh-mob-panel');
    var backdrop     = document.querySelector('.wh-mob-backdrop');
    var closeBtn     = document.querySelector('.wh-mob-panel__close');

    function openMenu() {
        panel.classList.add('is-open');
        backdrop.classList.add('is-visible');
        if (toggle) { toggle.setAttribute('aria-expanded', 'true'); toggle.classList.add('is-active'); }
        if (stickyToggle) { stickyToggle.setAttribute('aria-expanded', 'true'); stickyToggle.classList.add('is-active'); }
        panel.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        panel.classList.remove('is-open');
        backdrop.classList.remove('is-visible');
        if (toggle) { toggle.setAttribute('aria-expanded', 'false'); toggle.classList.remove('is-active'); }
        if (stickyToggle) { stickyToggle.setAttribute('aria-expanded', 'false'); stickyToggle.classList.remove('is-active'); }
        panel.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    if (panel) {
        if (toggle) {
            toggle.addEventListener('click', function () {
                panel.classList.contains('is-open') ? closeMenu() : openMenu();
            });
        }
        if (stickyToggle) {
            stickyToggle.addEventListener('click', function () {
                panel.classList.contains('is-open') ? closeMenu() : openMenu();
            });
        }
        closeBtn && closeBtn.addEventListener('click', closeMenu);
        backdrop && backdrop.addEventListener('click', closeMenu);

        /* accordion sub-menus on mobile */
        panel.querySelectorAll('.wh-mob-menu .menu-item-has-children > a').forEach(function (link) {
            var arrow = document.createElement('button');
            arrow.className = 'wh-mob-submenu-toggle';
            arrow.setAttribute('aria-label', 'Toggle submenu');
            arrow.innerHTML = '<svg width="12" height="8" viewBox="0 0 12 8" fill="none"><path d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>';
            link.parentNode.insertBefore(arrow, link.nextSibling);
            arrow.addEventListener('click', function (e) {
                e.preventDefault();
                var li = arrow.closest('li');
                li.classList.toggle('is-expanded');
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
    }
})();
</script>

<script>
/* Scroll-driven reveal: primary nav, tagline + sticky header after hero */
(function () {
    var primaryNav = document.querySelector('.wh-hero__primary-nav');
    var hero       = document.getElementById('wh-hero');
    var sticky     = document.getElementById('wh-sticky');

    /* Each element reveals over a scroll window of RANGE px,
       staggered so tagline leads, then nav */
    var items = [
        { el: primaryNav, start: 40, end: 120 }
    ];

    function clamp(v, lo, hi) { return Math.min(Math.max(v, lo), hi); }

    function onScroll() {
        var y = window.scrollY || window.pageYOffset;

        items.forEach(function (item) {
            if ( ! item.el ) return;
            var p = clamp((y - item.start) / (item.end - item.start), 0, 1);

            if (item.el === primaryNav) {
                item.el.style.opacity   = p;
                item.el.style.transform = 'translateY(' + ((1 - p) * 24) + 'px)';
            }
        });

        /* Sticky header: slide in once hero bottom reaches top of viewport */
        if (sticky && hero) {
            var heroBottom = hero.getBoundingClientRect().bottom;
            /* Reveal over 60px after the hero bottom crosses viewport top */
            var p = clamp((0 - heroBottom) / 60, 0, 1);
            sticky.style.opacity   = p;
            sticky.style.transform = 'translateY(' + ((1 - p) * -100) + '%)';
            sticky.setAttribute('aria-hidden', p < 0.05 ? 'true' : 'false');
            sticky.classList.toggle('is-visible', p > 0.05);
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>
