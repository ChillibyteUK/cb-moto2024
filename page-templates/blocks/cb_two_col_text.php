<?php
/**
 * Two Column Text Block Template
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$bg      = get_field( 'colour' ) ?? null;
$padding = get_field( 'padding' );
if ( ! is_array( $padding ) ) {
    $padding = array();  // Assign an empty array if not an array.
}
$pt = in_array( 'top', $padding, true ) ? 'pt-5' : null;
$pb = in_array( 'bottom', $padding, true ) ? 'pb-5' : null;
?>
<section class="two_col_text <?= esc_attr( $bg ); ?> <?= esc_attr( $pt ); ?> <?= esc_attr( $pb ); ?>">
    <div class="container-xl">
        <?php
        if ( get_field( 'title' ) ?? null ) {
            if ( 'bold' === get_field( 'style' ) ) {
                ?>
            <strong class="mb-4"><?= esc_html( get_field( 'title' ) ); ?></strong>
                <?php
            } else {
                ?>
            <h2 class="mb-4"><?= esc_html( get_field( 'title' ) ); ?></h2>
                <?php
            }
        }
        ?>
        <div class="two_col_text__content">
            <?= wp_kses_post( get_field( 'content' ) ); ?>
        </div>
    </div>
</section>