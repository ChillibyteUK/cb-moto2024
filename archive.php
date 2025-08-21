<?php
/**
 * The template for displaying archive pages.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );

$img = wp_get_attachment_image_url( get_field( 'blog_index_hero_image', 'options' ), 'full' );

get_header();
$queried_object = get_queried_object();
if ( ! empty( $queried_object ) && isset( $queried_object->slug ) ) {
    $category_slug = $queried_object->slug;
}
?>
<section class="prenav">
	<div class="container text-center py-5">
		<?= wp_get_attachment_image( get_field( 'blog_index_hero_image', 'option' ), 'full', false, array( 'class' => 'img-fluid' ) ); ?>
	</div>
</section>
<nav id="blognav">
	<div class="container d-flex justify-content-between align-items-center flex-wrap gap-4">
		<div class="logo">
			<a href="/" class="navbar-brand logo-full" rel="home"><img src="<?= esc_url( get_stylesheet_directory_uri() ); ?>/img/c-rd-motorola@2x.png" width=118.5 height=24 alt="Motorola logo"></a>
		</div>
		<section class="index_filters">
			<div class="category-list">
				<a class="category-item" href="/">All</a>
				<?php
				$categories = get_categories(
					array(
						'hide_empty' => true,
					)
				);
				foreach ( $categories as $category ) {
					if ( 'uncategorized' === strtolower( $category->slug ) ) {
						continue;
					}
                    printf(
                        '<a class="category-item" href="%s">%s</a>',
                        esc_url( get_category_link( $category->term_id ) ),
                        esc_html( $category->name )
                    );
				}
				?>
			</div>
		</section>
	</div>
</nav>
<main id="main" class="archive <?= esc_attr( $category_slug ); ?>">
    <section class="latest pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800"><?= single_cat_title() ?> articles</h2>
            </div>
            <div class="latest_grid">
                <?php
                if (have_posts()) {
                    $c = 1;
                    while (have_posts()) {
                        the_post();
                        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $cat = get_the_category();
                ?>
                        <a class="grid__card"
                            href="<?= get_the_permalink() ?>">
                            <img class="card__image" src="<?= $ph ?>">
                            <div class="card__inner">
                                <div
                                    class="card__category cat--<?= $cat[0]->slug ?>">
                                </div>
                                <div class="card__title"><?= get_the_title() ?>
                                    <?php
                                    if ($c == 1) {
                                    ?>
                                        <div class="card__excerpt d-md-none">
                                            <?= wp_trim_words(get_the_content(null, false, get_the_ID()), 20) ?>
                                        </div>
                                        <div class="card__excerpt d-none d-md-block">
                                            <?= wp_trim_words(get_the_content(null, false, get_the_ID()), 50) ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="card__meta">
                                    <div class="card__meta_date">
                                        <?= get_the_date('j M, Y') ?>
                                    </div>
                                    <div class="card__meta_time">
                                        <?= estimate_reading_time_in_minutes(get_the_content(null, false, get_the_ID()), 200, true, true) ?>
                                    </div>
                                    <div
                                        class="card__meta_link link--<?= $cat[0]->slug ?>">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                            <i class="fa-solid fa-arrow-right-long fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                <?php
                        $c++;
                    }
                }
                ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>