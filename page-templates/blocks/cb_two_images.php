<?php
/**
 * Two Images Block Template
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="two_images">
    <img src="<?= esc_url( wp_get_attachment_image_url( get_field( 'image_left' ), 'full' ) ); ?>" alt="">
    <img src="<?= esc_url( wp_get_attachment_image_url( get_field( 'image_right' ), 'full' ) ); ?>" alt="">
</section>