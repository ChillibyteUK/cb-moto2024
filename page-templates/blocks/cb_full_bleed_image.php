<?php
/**
 * Full Bleed Image Block Template.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$img = wp_get_attachment_image_url( get_field( 'image' ), 'full' );
?>
<img class="full_bleed_image" src="<?= esc_url( $img ); ?>">