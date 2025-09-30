<?php
/**
 * Post Intro Block Template
 *
 * Displays the post introduction with the first paragraph highlighted.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$text = get_field( 'intro_content' );
preg_match( '/<p>(.*?)<\/p>/', $text, $matches );
$first_paragraph = $matches[1] ?? '';
$rest_of_content = preg_replace( '/<p>.*?<\/p>/', '', $text, 1 );
?>

<section class="post_intro py-5">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-6">
                <h1><?= esc_html( get_the_title() ); ?></h1>
            </div>
            <div class="col-md-6"><?= wp_kses_post( $first_paragraph ); ?></div>
        </div>
        <?php
        if ( $rest_of_content ?? null ) {
            ?>
        <div class="pt-4"><?= wp_kses_post( $rest_of_content ); ?></div>
        	<?php
        }
		?>
    </div>
</section>