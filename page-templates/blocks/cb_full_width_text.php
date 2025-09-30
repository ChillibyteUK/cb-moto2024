<?php
/**
 * Full width text block template.
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
<section class="full_width_text <?= esc_attr( $pt ); ?> <?= esc_attr( $pb ); ?> <?= esc_attr( $bg ); ?>">
    <div class="container-xl">
        <?php
        if ( get_field( 'title' ) ?? null ) {
            ?>
        <h2 class="mb-4"><?= esc_html( get_field( 'title' ) ); ?></h2>
            <?php
        }
        ?>
        <?= wp_kses_post( get_field( 'content' ) ); ?>
    </div>
</section>