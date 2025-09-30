<?php
/**
 * Single post template for cb-moto2024 theme.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
if ( ! $img ) {
    $img = get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
}

$img = get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'post_hero__image' ) );
if ( empty( $img ) ) {
    $default_image_url = get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
    $img               = '<img src="' . esc_url( $default_image_url ) . '" alt="Default Image" class="post_hero__image">';
}

$post_cat = get_the_category();
?>
<main id="main" class="blog">
    <section class="post_hero mb-5">
        <?= wp_kses_post( $img ); ?>
    </section>
    <section class="post_meta">
        <div class="container-xl">
            <div class="row gx-5">
                <div class="col-md-6 d-flex">
                    <a class="post_meta__back" href="/"><?= esc_html__( 'Back', 'cb-moto2024' ); ?></a>
                    <div class="post_meta__date">
                        <?= esc_html( get_the_date( 'jS F Y' ) ) ?>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="post_meta__title"><?= esc_html__( 'Categories', 'cb-moto2024' ) ?></div>
                    <div class="post_meta__category">
                        <a href="<?= esc_url( get_category_link( $post_cat[0]->term_id ) ); ?>"><?= esc_html( __( $post_cat[0]->name, 'cb-moto2024' ) ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    the_post();
	the_content();
	?>
    </div>
</main>
<?php
get_footer();
?>