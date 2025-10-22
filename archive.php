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
				<a class="category-item" href="/"><?= esc_html( __( 'All', 'cb-moto2024' ) ); ?></a>
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

										// Translate category names.
					$translated_name = $category->name;
					switch ( $category->name ) {
						case 'Technology':
							$translated_name = __( 'Technology', 'cb-moto2024' );
							break;
						case 'Hardware':
							$translated_name = __( 'Hardware', 'cb-moto2024' );
							break;
						case 'Device Care':
							$translated_name = __( 'Device Care', 'cb-moto2024' );
							break;
						case 'News':
							$translated_name = __( 'News', 'cb-moto2024' );
							break;
					}

                    $is_active = ( isset( $category_slug ) && $category_slug === $category->slug ) ? ' active' : '';
                    printf(
                        '<a class="category-item%s" href="%s">%s</a>',
                        esc_attr( $is_active ),
                        esc_url( get_category_link( $category->term_id ) ),
                        esc_html( $translated_name )
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
                <h2 class="fs-800"><?= esc_html( single_cat_title() ); ?> <?= esc_html( __( 'Articles', 'cb-moto2024' ) ); ?></h2>
            </div>
            <div class="latest_grid">
                <?php
                if ( have_posts() ) {
                    $c = 1;
                    while ( have_posts() ) {
                        the_post();
                        $ph              = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $post_categories = get_the_category();
                		?>
                        <a class="grid__card"
                            href="<?= esc_url( get_the_permalink() ); ?>">
                            <img class="card__image" src="<?= esc_url( $ph ); ?>">
                            <div class="card__inner">
                                <div
                                    class="card__category cat--<?= esc_attr( $post_categories[0]->slug ); ?>">
                                </div>
                                <div class="card__title"><?= esc_html( get_the_title() ); ?>
                                    <?php
                                    if ( 1 === $c ) {
										global $post;
										$old_post = $post;
										// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										$post        = get_post( $p );
										$raw_content = apply_filters( 'the_content', $post->post_content );
										$raw_content = preg_replace( '/<h1[^>]*>.*?<\/h1>/is', '', $raw_content, 1 );
										// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										$post    = $old_post;
										$excerpt = wp_trim_words( wp_strip_all_tags( $raw_content ), 50 );
										?>
										<div class="card__excerpt"><?= esc_html( $excerpt ); ?></div>
										<?php
                                    }
                                    ?>
                                </div>
                                <div class="card__meta">
                                    <div class="card__meta_date">
                                        <?= esc_html( get_the_date( 'j M, Y' ) ); ?>
                                    </div>
                                    <div class="card__meta_time">
                                        <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content( null, false, get_the_ID() ), 200, true, true ) ); ?>
                                    </div>
                                    <div
                                        class="card__meta_link link--<?= esc_attr( $post_categories[0]->slug ); ?>">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                            <i class="fa-solid fa-arrow-right-long fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                		<?php
                        ++$c;
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