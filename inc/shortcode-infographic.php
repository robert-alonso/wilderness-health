<?php
/**
 * Shortcode: [wh_infographic]
 *
 * Attributes:
 *   title  — Section heading (default: "Workforce Development Strategy")
 *
 * Items are defined in the $items array below. Each item has:
 *   headline    — Bold white text shown always inside the mountain
 *   label       — Small coloured tag shown only when item is active (hover → list)
 *   subheadline — Italic description shown only when item is active
 *   list        — Array of initiative strings revealed on hover of the label
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function wh_infographic_shortcode( $atts ) {

    $atts = shortcode_atts(
        array( 'title' => 'Workforce Development Strategy' ),
        $atts,
        'wh_infographic'
    );

    /* ── Item data ─────────────────────────────────────────────
     * Edit the arrays below to customise each mountain section.
     * Initial order: index 0 = left, 1 = center (active), 2 = right.
     * ─────────────────────────────────────────────────────── */
    $img_dir = get_stylesheet_directory_uri() . '/assets/images/';

    $items = array(

        array(
            'headline'    => 'Student<br>Career Pathway',
            'label'       => 'GOAL',
            'subheadline' => 'Recruit and retain a healthy, skilled, sustainable workforce',
            'list'        => array(
                'Research',
                'Career Pathways Development',
                'Membership Roundtables',
                'K–12 Schools and Post-Secondary Partnerships',
                'Workforce Agency Partnerships',
                'Career and Outreach Fairs & Events',
                'ARCHS Website',
            ),
        ),

        array(
            'headline'    => 'Recruitment<br>&amp; Retention',
            'label'       => 'GOAL',
            'subheadline' => 'Attract and keep skilled healthcare professionals in rural communities',
            'list'        => array(
                'Recruitment Campaigns',
                'Competitive Benefits Analysis',
                'Rural Incentive Programs',
                'Housing Support Initiatives',
                'Staff Wellness Programs',
                'Retention Recognition Awards',
            ),
        ),

        array(
            'headline'    => 'Education<br>&amp; Training',
            'label'       => 'GOAL',
            'subheadline' => 'Build workforce capacity through targeted education and training',
            'list'        => array(
                'Continuing Education',
                'Skills Development Workshops',
                'Leadership Training',
                'Preceptorship Programs',
                'Online Learning Modules',
                'Certification Support',
            ),
        ),

    );

    ob_start();
    ?>
    <section class="wh-infographic">
        <div class="wh-infographic__inner">

            <?php if ( $atts['title'] ) : ?>
            <h2 class="wh-infographic__title"><?php echo esc_html( $atts['title'] ); ?></h2>
            <?php endif; ?>

            <!-- ── Mountain stage ─────────────────────────────── -->
            <div class="wh-infographic__stage" role="group" aria-label="<?php esc_attr_e( 'Infographic', 'kero-creative' ); ?>">

                <?php foreach ( $items as $idx => $item ) :
                    $initial_pos = $idx; // 0=left, 1=center, 2=right
                    $tri_src     = ( $initial_pos === 1 )
                        ? esc_url( $img_dir . 'triangle-center.svg' )
                        : esc_url( $img_dir . 'triangle-left.svg' );
                ?>
                <div
                    class="wh-infographic__item"
                    data-index="<?php echo $idx; ?>"
                    data-pos="<?php echo $initial_pos; ?>"
                    data-src-side="<?php echo esc_url( $img_dir . 'triangle-left.svg' ); ?>"
                    data-src-center="<?php echo esc_url( $img_dir . 'triangle-center.svg' ); ?>"
                    role="button"
                    tabindex="0"
                    aria-label="<?php echo esc_attr( wp_strip_all_tags( $item['headline'] ) ); ?>"
                >
                    <!-- Triangle SVG image -->
                    <img
                        class="wh-infographic__tri-img"
                        src="<?php echo $tri_src; ?>"
                        alt=""
                        aria-hidden="true"
                    >

                    <!-- Hidden list data — read by JS to populate INITIATIVES panel -->
                    <ul class="wh-infographic__data-list" hidden aria-hidden="true">
                        <?php foreach ( $item['list'] as $list_item ) : ?>
                        <li><?php echo esc_html( $list_item ); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Text overlay (sits on top of SVG image) -->
                    <div class="wh-infographic__tri-text" aria-hidden="true">

                        <div class="wh-infographic__headline">
                            <?php echo wp_kses( $item['headline'], array( 'br' => array() ) ); ?>
                        </div>

                        <!-- Visible only when this item is active (data-pos="1") -->
                        <div class="wh-infographic__active-content">
                            <span class="wh-infographic__label">
                                <?php echo esc_html( $item['label'] ); ?>
                            </span>
                            <p class="wh-infographic__sub">
                                <?php echo esc_html( $item['subheadline'] ); ?>
                            </p>
                        </div>

                    </div><!-- /.tri-text -->

                </div><!-- /.item -->
                <?php endforeach; ?>

            </div><!-- /.stage -->

            <!-- ── Initiatives accordion ──────────────────────── -->
            <div class="wh-infographic__initiatives-bar">
                <button
                    class="wh-infographic__initiatives-toggle"
                    aria-expanded="false"
                >
                    <span class="wh-infographic__initiatives-arrow" aria-hidden="true"></span>
                    <?php esc_html_e( 'INITIATIVES', 'kero-creative' ); ?>
                </button>
                <div class="wh-infographic__initiatives-divider"></div>
                <div class="wh-infographic__initiatives-content" aria-hidden="true">
                    <!-- Populated by infographic.js from the active item's data-list -->
                </div>
            </div>

        </div><!-- /.inner -->
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'wh_infographic', 'wh_infographic_shortcode' );
