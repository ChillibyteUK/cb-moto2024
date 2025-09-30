<?php
/**
 * Text and Image Block Template
 *
 * Displays a block with text and image, supporting custom order, alignment, and padding.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$bg = get_field( 'colour' ) ?? null;

$image_order    = 'Image/Text' === get_field( 'order' ) ? '' : 'order-md-2';
$text_order     = 'Image/Text' === get_field( 'order' ) ? '' : 'order-md-1';
$text_alignment = 'Image/Text' === get_field( 'order' ) ? 'text--right px-3' : 'text--left px-3';

$img = wp_get_attachment_image_url( get_field( 'image' ), 'full' ) ? wp_get_attachment_image_url( get_field( 'image' ), 'full' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';

$padding = get_field( 'padding' );
if ( ! is_array( $padding ) ) {
    $padding = array();  // Assign an empty array if not an array.
}
$pt = in_array( 'top', $padding, true ) ? 'pt-5' : null;
$pb = in_array( 'bottom', $padding, true ) ? 'pb-5' : null;
?>
<section class="text_image <?= esc_attr( $bg ); ?>">
    <div class="container-fluid">
        <div class="row gx-5" style="min-height:400px">
            <div class="col-md-6 text_image__image <?= esc_attr( $image_order ); ?>"
                style="background-image:url(<?= esc_url( $img ); ?>)">
            </div>
            <div
                class="col-md-6 <?= esc_attr( $text_order ); ?> <?= esc_attr( $pt ); ?> <?= esc_attr( $pb ); ?>">
                <div class="ps-xl-3 <?= esc_attr( $text_alignment ); ?>">
                    <h2 class="mb-4">
                        <?= esc_html( get_field( 'title' ) ); ?>
                    </h2>
                    <?= wp_kses_post( get_field( 'content' ) ); ?>
                </div>
            </div>
        </div>
    </div>
</section>