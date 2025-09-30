<?php
/**
 * Constrained Image Block Template
 *
 * Displays an image with optional padding and background color.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$img   = wp_get_attachment_image_url( get_field( 'image' ), 'full' );
$bg    = get_field( 'colour' ) ?? null;
$class = $block['className'] ?? null;

$padding = get_field( 'padding' );
if ( ! is_array( $padding ) ) {
    $padding = array();  // Assign an empty array if not an array.
}
$pt = in_array( 'top', $padding, true ) ? 'pt-5' : null;
$pb = in_array( 'bottom', $padding, true ) ? 'pb-5' : null;
?>
<section class="constrained_image <?= esc_attr( $pt ); ?> <?= esc_attr( $pb ); ?> <?= esc_attr( $bg ); ?> <?= esc_attr( $class ); ?>">
    <div class="container-xl">
        <img src="<?= esc_url( $img ); ?>" alt="">
    </div>
</section>