<?php
/**
 * FAQ Block Template
 *
 * Displays a FAQ section with schema.org markup.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$padding = get_field( 'padding' );
if ( ! is_array( $padding ) ) {
    $padding = array();  // Assign an empty array if not an array.
}
$pt = in_array( 'top', $padding, true ) ? 'pt-5' : null;
$pb = in_array( 'bottom', $padding, true ) ? 'pb-5' : null;
?>
<section class="faq <?= esc_attr( $pt ); ?> <?= esc_attr( $pb ); ?>">
    <div class="container-xl">
        <?php
        if ( get_field( 'faq_title' ) ?? null ) {
            ?>
        <h2 class="mb-4"><?= esc_html( get_field( 'faq_title' ) ); ?></h2>
            <?php
        }
        ?>
        <div itemscope="" itemtype="https://schema.org/FAQPage">
        <?php
        while ( have_rows( 'faq' ) ) {
            the_row();
            ?>
            <div class="faq__row" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="faq__question" itemprop="name">
                    <?= esc_html( get_sub_field( 'question' ) ); ?>
                </div>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div itemprop="text" class="faq__answer">
                        <?= esc_html( get_sub_field( 'answer' ) ); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</section>