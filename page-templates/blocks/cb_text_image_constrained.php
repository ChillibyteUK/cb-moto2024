<?php
/**
 * Text Image Constrained Block Template
 *
 * Displays a section with text and image, supporting custom background, padding, and order.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$bg = get_field( 'colour' ) ?? null;

$image_order = 'Image/Text' === get_field( 'order' ) ? '' : 'order-md-2';
$text_order  = 'Image/Text' === get_field( 'order' ) ? '' : 'order-md-1';

$img = wp_get_attachment_image_url( get_field( 'image' ), 'full' ) ? wp_get_attachment_image_url( get_field( 'image' ), 'full' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';

$padding = get_field( 'padding' );
if ( ! is_array( $padding ) ) {
    $padding = array();  // Assign an empty array if not an array.
}
$pt = in_array( 'top', $padding, true ) ? 'pt-5' : null;
$pb = in_array( 'bottom', $padding, true ) ? 'pb-5' : null;
?>
<section class="text_image <?= esc_attr( $bg ); ?> <?= esc_attr( $pt ); ?> <?= esc_attr( $pb ); ?>">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-lg-6 text_image__image d-flex align-items-center <?= esc_attr( $image_order ); ?>">
                <img src="<?= esc_url( $img ); ?>" alt="">
            </div>
            <div class="col-lg-6 <?= esc_attr( $text_order ); ?>">
                <div class="ps-xl-3 d-flex flex-column justify-content-center h-100">
                    <h2 class="mb-4">
                        <?= esc_html( get_field( 'title' ) ); ?>
                    </h2>
                    <?= wp_kses_post( get_field( 'content' ) ); ?>
                </div>
            </div>
        </div>
    </div>
</section>