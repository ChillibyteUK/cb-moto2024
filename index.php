<?php
/**
 * Template for displaying the blog index
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );

get_header();
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
				<a class="category-item" href="#all">All</a>
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
						'<a class="category-item" href="#%s">%s</a>',
						esc_attr( $category->slug ),
						esc_html( $category->name )
					);
				}
				?>
			</div>
		</section>
	</div>
</nav>
<main id="main">
    <!-- LATEST POSTS -->
    <a id="all" class="anchor"></a>
    <section class="latest all pb-5 mb-5">
        <div class="container">
            <div class="latest_grid">
                <?php
				$first_class = 'span-all';
				$first_color = 'style="background-color: ' . esc_attr( get_field( 'country_colour', 'options' ) ) . ';"';
                $postcount   = 4;
                $pinned      = array();
                // first, any trending posts from Site-Wide Settings.
                if ( get_field( 'trending', 'options' ) ) {
                    foreach ( get_field( 'trending', 'options' ) as $p ) {
                        $pinned[] = $p;
                        $ph       = get_the_post_thumbnail_url( $p, 'large' ) ? get_the_post_thumbnail_url( $p, 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $post_cat = get_the_category( $p );
                        ?>
                        <a class="grid__card <?= esc_attr( $first_class ); ?>"
							<?= wp_kses_post( $first_color ); ?>
                            href="<?= esc_url( get_the_permalink( $p ) ); ?>">
                            <img class="card__image" src="<?= esc_url( $ph ); ?>">
                            <div class="card__inner">
                                <div class="card__category cat--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                    <!-- <?= esc_html( $post_cat[0]->name ); ?> -->
                                </div>
                                <div class="card__title">
                                    <?= esc_html( get_the_title( $p ) ); ?>
								<?php
								if ( $first_class ) {
									global $post;
									$old_post    = $post;
									$post        = get_post( $p );
									$raw_content = apply_filters( 'the_content', $post->post_content );
									$raw_content = preg_replace( '/<h1[^>]*>.*?<\/h1>/is', '', $raw_content, 1 );
									$post        = $old_post;
									$excerpt     = wp_trim_words( wp_strip_all_tags( $raw_content ), 50 );
									?>
									<div class="card__excerpt"><?= esc_html( $excerpt ); ?></div>
									<?php
								}
								?>
                                </div>
                                <div class="card__meta">
                                    <div class="card__meta_date">
                                        <?= esc_html( get_the_date( 'j M, Y', $p ) ); ?>
                                    </div>
                                    <div class="card__meta_time">
                                        <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content( null, false, $p ), 200, true, true ) ); ?>
                                    </div>
                                    <div
                                        class="card__meta_link link--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                            <i class="fa-solid fa-arrow-right-long fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                        --$postcount;
						$first = false;
                    }
                }

                // if any blanks, fill with latest.
                if ( $postcount > 0 ) {
                    $q = new WP_Query(
						array(
							'post_type'           => 'post',
							'posts_per_page'      => $postcount,
							'ignore_sticky_posts' => 1,
							'post__not_in'        => $pinned,
						)
					);
                    if ( $q->have_posts() ) {
                        while ( $q->have_posts() ) {
                            $q->the_post();
                            $ph       = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                            $post_cat = get_the_category();
                        	?>
                            <a class="grid__card"
                                href="<?= esc_url( get_the_permalink() ); ?>">
                                <img class="card__image" src="<?= esc_url( $ph ); ?>">
                                <div class="card__inner">
                                    <div class="card__category cat--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                        <?= esc_html( $post_cat[0]->name ); ?>
                                    </div>
                                    <div class="card__title"><?= esc_html( get_the_title() ); ?>
                                    </div>
                                    <div class="card__meta">
                                        <div class="card__meta_date">
                                            <?= esc_html( get_the_date( 'j M, Y' ) ); ?>
                                        </div>
                                        <div class="card__meta_time">
                                            <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content( null, false, get_the_ID() ), 200, true, true ) ); ?>
                                        </div>
                                        <div
                                            class="card__meta_link link--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                <i class="fa-solid fa-arrow-right-long fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                			<?php
							$first = false;
                        }
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- TECHNOLOGY -->
    <a id="technology" class="anchor"></a>
    <section class="technology pb-5 mb-5">
        <div class="container">
            <div class="section_title">
                <h2 class="fs-800">Technology</h2>
                <a
                    href="<?= esc_url( get_term_link( 'technology', 'category' ) ); ?>">View
                    all</a>
            </div>
            <div class="grid_4_1">
                <?php
                $q = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 5,
						'category_name'       => 'technology',
						'ignore_sticky_posts' => 1,
						'meta_query'          => array(
							'relation' => 'OR',
							array(
								'key'     => 'is_sticky',
								'value'   => '1',
								'compare' => '=',
							),
							array(
								'key'     => 'is_sticky',
								'compare' => 'NOT EXISTS',
							),
							array(
								'key'     => 'is_sticky',
								'value'   => '0',
								'compare' => '=',
							),
						),
						'orderby'             => array(
							'meta_value_num' => 'DESC',
							'date'           => 'DESC',
						),
						'meta_key'            => 'is_sticky',
						'meta_type'           => 'CHAR',
					)
				);

                $c = 1;
                if ( $q->have_posts() ) {
                    while ( $q->have_posts() ) {
                        $q->the_post();
                        $ph       = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $post_cat = get_the_category();
						?>
                        <a class="grid__card"
                            href="<?= esc_url( get_the_permalink() ); ?>">
                            <img class="card__image" src="<?= esc_url( $ph ); ?>">
                            <div class="card__inner">
                                <div
                                    class="card__category cat--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                </div>
                                <div class="card__title"><?= esc_html( get_the_title() ); ?>
                                    <?php
                                    if ( 1 === $c ) {
                                    	?>
                                        <div class="card__excerpt d-md-none">
                                            <?= wp_kses_post( wp_trim_words( get_the_content( null, false, get_the_ID() ), 20 ) ); ?>
                                        </div>
                                        <div class="card__excerpt d-none d-md-block">
                                            <?= wp_kses_post( wp_trim_words( get_the_content( null, false, get_the_ID() ), 50 ) ); ?>
                                        </div>
                                    	<?php
                                    }
                                    ?>
                                </div>
                                <div class="card__meta">
                                    <div class="card__meta_date">
                                        <?= esc_html( get_the_date( 'j M, Y' ) ); ?>
                                    </div>
                                    <div class="card__meta_time">
                                        <?= esc_html( estimate_reading_time_in_minutes( get_the_content( null, false, get_the_ID() ), 200, true, true ) ); ?>
                                    </div>
                                    <div
                                        class="card__meta_link link--<?= esc_attr( $post_cat[0]->slug ); ?>">
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
    <!-- HARDWARE -->
    <a id="hardware" class="anchor"></a>
    <section class="hardware pb-5 mb-5">
        <div class="container">
            <div class="section_title">
                <h2 class="fs-800">Hardware</h2>
                <a href="<?= esc_url( get_term_link( 'hardware', 'category' ) ); ?>">View all</a>
            </div>
            <div class="grid_2_3">
                <?php
                $q = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 5,
						'category_name'       => 'hardware',
						'ignore_sticky_posts' => 1,
						'meta_query'          => array(
							'relation' => 'OR',
							array(
								'key'     => 'is_sticky',
								'value'   => '1',
								'compare' => '=',
							),
							array(
								'key'     => 'is_sticky',
								'compare' => 'NOT EXISTS',
							),
							array(
								'key'     => 'is_sticky',
								'value'   => '0',
								'compare' => '=',
							),
						),
						'orderby'             => array(
							'meta_value_num' => 'DESC',
							'date'           => 'DESC',
						),
						'meta_key'            => 'is_sticky',
						'meta_type'           => 'CHAR',
					)
				);
                $c = 1;
                if ( $q->have_posts() ) {
                    while ( $q->have_posts() ) {
                        $q->the_post();
                        $ph       = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $post_cat = get_the_category();
                		?>
                        <a class="grid__card"
                            href="<?= esc_url( get_the_permalink() ); ?>">
                            <img class="card__image" src="<?= esc_url( $ph ); ?>">
                            <div class="card__inner">
                                <div
                                    class="card__category cat--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                </div>
                                <div class="card__title">
                                    <?= esc_html( get_the_title() ); ?>
                                    <?php
                                    if ( 1 === $c ) {
                                    	?>
                                        <div class="card__excerpt d-md-none">
                                            <?= wp_kses_post( wp_trim_words( get_the_content( null, false, get_the_ID() ), 20 ) ); ?>
                                        </div>
                                        <div class="card__excerpt d-none d-md-block">
                                            <?= wp_kses_post( wp_trim_words( get_the_content( null, false, get_the_ID() ), 50 ) ); ?>
                                        </div>
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
                                        class="card__meta_link link--<?= esc_attr( $post_cat[0]->slug ); ?>">
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
    <!-- DEVICE CARE -->
    <a id="device-care" class="anchor"></a>
    <section class="device-care pb-5 mb-5">
        <div class="container">
            <div class="section_title">
                <h2 class="fs-800">Device Care</h2>
                <a href="<?= esc_url( get_term_link( 'device-care', 'category' ) ); ?>">View all</a>
            </div>
            <div class="grid_3_2">
                <?php
                $q = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 5,
						'category_name'       => 'device-care',
						'ignore_sticky_posts' => 1,
						'meta_query'          => array(
							'relation' => 'OR',
							array(
								'key'     => 'is_sticky',
								'value'   => '1',
								'compare' => '=',
							),
							array(
								'key'     => 'is_sticky',
								'compare' => 'NOT EXISTS',
							),
							array(
								'key'     => 'is_sticky',
								'value'   => '0',
								'compare' => '=',
							),
						),
						'orderby'             => array(
							'meta_value_num' => 'DESC',
							'date'           => 'DESC',
						),
						'meta_key'            => 'is_sticky',
						'meta_type'           => 'CHAR',
					)
				);
                if ( $q->have_posts() ) {
                    while ( $q->have_posts() ) {
                        $q->the_post();
                        $ph       = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $post_cat = get_the_category();
                        ?>
                        <a class="grid__card"
                            href="<?= esc_url( get_the_permalink() ); ?>">
                            <img class="card__image" src="<?= esc_url( $ph ); ?>">
                            <div class="card__inner">
                                <div
                                    class="card__category cat--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                </div>
                                <div class="card__title">
                                    <?= esc_html( get_the_title() ); ?>
                                </div>
                                <div class="card__meta">
                                    <div class="card__meta_date">
                                        <?= esc_html( get_the_date( 'j M, Y' ) ); ?>
                                    </div>
                                    <div class="card__meta_time">
                                        <?= esc_html( estimate_reading_time_in_minutes( get_the_content( null, false, get_the_ID() ), 200, true, true ) ); ?>
                                    </div>
                                    <div
                                        class="card__meta_link link--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                            <i class="fa-solid fa-arrow-right-long fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
		                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- NEWS -->
    <a id="news" class="anchor"></a>
    <section class="news pb-5 mb-5">
        <div class="container">
            <div class="section_title">
                <h2 class="fs-800">News</h2>
                <a href="<?= esc_url( get_term_link( 'news', 'category' ) ); ?>">View all</a>
            </div>
            <div class="latest_grid grid_3_3">
                <?php
                $q = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 6,
						'category_name'       => 'news',
						'ignore_sticky_posts' => 1,
						'meta_query'          => array(
							'relation' => 'OR',
							array(
								'key'     => 'is_sticky',
								'value'   => '1',
								'compare' => '=',
							),
							array(
								'key'     => 'is_sticky',
								'compare' => 'NOT EXISTS',
							),
							array(
								'key'     => 'is_sticky',
								'value'   => '0',
								'compare' => '=',
							),
						),
						'orderby'             => array(
							'meta_value_num' => 'DESC',
							'date'           => 'DESC',
						),
						'meta_key'            => 'is_sticky',
						'meta_type'           => 'CHAR',
					)
				);
                if ( $q->have_posts() ) {
                    while ( $q->have_posts() ) {
                        $q->the_post();
                        $ph       = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
                        $post_cat = get_the_category();
                        ?>
                        <a class="grid__card"
                            href="<?= esc_url( get_the_permalink() ); ?>">
                            <img class="card__image" src="<?= esc_url( $ph ); ?>">
                            <div class="card__inner">
                                <div
                                    class="card__category cat--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                </div>
                                <div class="card__title">
                                    <?= esc_html( get_the_title() ); ?>
                                </div>
                                <div class="card__meta">
                                    <div class="card__meta_date">
                                        <?= esc_html( get_the_date( 'j M, Y' ) ); ?>
                                    </div>
                                    <div class="card__meta_time">
                                        <?= esc_html( estimate_reading_time_in_minutes( get_the_content( null, false, get_the_ID() ), 200, true, true ) ); ?>
                                    </div>
                                    <div
                                        class="card__meta_link link--<?= esc_attr( $post_cat[0]->slug ); ?>">
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                		<?php
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