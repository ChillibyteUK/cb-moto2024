<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');

$img = wp_get_attachment_image_url(get_field('blog_index_hero_image', 'options'), 'full');

get_header();
?>
<main id="main">
    <section class="index_hero"
        style="background-image: url(<?=$img?>)">
        <h1 class="mx-2">Motoverse Blog</h1>
    </section>
    <section class="index_filters">
        <div class="category-list">
            <a class="category-item" href="#all">All</a>
            <a class="category-item" href="#technology">Technology</a>
            <a class="category-item" href="#hardware">Hardware</a>
            <a class="category-item" href="#device-care">Device Care</a>
        </div>
    </section>
    <!-- LATEST POSTS -->
    <a id="all" class="anchor"></a>
    <section class="latest all pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800">Latest trending articles</h2>
            </div>
            <div class="latest_grid">
                <?php
$postcount = 3;
$pinned = array();
// first, any trending posts from Site-Wide Settings
if (get_field('trending', 'options')) {
    foreach (get_field('trending', 'options') as $p) {
        // var_dump($p);
        $pinned[] = $p;
        $ph = get_the_post_thumbnail_url($p, 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
        $cat = get_the_category($p);
        ?>
                <a class="grid__card"
                    href="<?=get_the_permalink($p)?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div class="card__category cat--hardware">
                            <?=$cat[0]->name?>
                        </div>
                        <div class="card__title">
                            <?=get_the_title($p)?>
                        </div>
                        <div class="card__meta">
                            <div class="card__meta_date">
                                <?=get_the_date('j M, Y', $p)?>
                            </div>
                            <div class="card__meta_time">
                                <?=estimate_reading_time_in_minutes(get_the_content(null, false, $p), 200, true, true)?>
                            </div>
                            <div
                                class="card__meta_link link--<?=$cat[0]->slug?>">
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
        $postcount--;
    }

}

// if any blanks, fill with latest
if ($postcount > 0) {
    $q = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => $postcount,
        'ignore_sticky_posts' => 1,
        'post__not_in' => $pinned
    ));
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
            $cat = get_the_category();
            ?>
                <a class="grid__card"
                    href="<?=get_the_permalink()?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div class="card__category cat--hardware">
                            <?=$cat[0]->name?>
                        </div>
                        <div class="card__title"><?=get_the_title()?>
                        </div>
                        <div class="card__meta">
                            <div class="card__meta_date">
                                <?=get_the_date('j M, Y')?>
                            </div>
                            <div class="card__meta_time">
                                <?=estimate_reading_time_in_minutes(get_the_content(null, false, get_the_ID()), 200, true, true)?>
                            </div>
                            <div
                                class="card__meta_link link--<?=$cat[0]->slug?>">
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
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
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800">Technology</h2>
                <a
                    href="<?=get_term_link('technology', 'category')?>">View
                    all</a>
            </div>
            <div class="grid_4_1">
                <?php
$q = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'category_name' => 'technology',
    'ignore_sticky_posts' => 1,
    'meta_query'     => array(
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
    'orderby' => array(
        'meta_value_num' => 'DESC',
        'date'             => 'DESC'
    ),
    'meta_key' => 'is_sticky',
    'meta_type' => 'CHAR',
));

$c = 1;
if ($q->have_posts()) {
    while ($q->have_posts()) {
        $q->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
        $cat = get_the_category();
        ?>
                <a class="grid__card"
                    href="<?=get_the_permalink()?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div
                            class="card__category cat--<?=$cat[0]->slug?>">
                        </div>
                        <div class="card__title"><?=get_the_title()?>
                            <?php
        if ($c == 1) {
            ?>
                            <div class="card__excerpt d-md-none">
                                <?=wp_trim_words(get_the_content(null, false, get_the_ID()), 20)?>
                            </div>
                            <div class="card__excerpt d-none d-md-block">
                                <?=wp_trim_words(get_the_content(null, false, get_the_ID()), 50)?>
                            </div>
                            <?php
        }
        ?>
                        </div>
                        <div class="card__meta">
                            <div class="card__meta_date">
                                <?=get_the_date('j M, Y')?>
                            </div>
                            <div class="card__meta_time">
                                <?=estimate_reading_time_in_minutes(get_the_content(null, false, get_the_ID()), 200, true, true)?>
                            </div>
                            <div
                                class="card__meta_link link--<?=$cat[0]->slug?>">
                                <i class="fa-solid fa-arrow-right-long"></i>
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
    <!-- HARDWARE -->
    <a id="hardware" class="anchor"></a>
    <section class="hardware pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800">Hardware</h2>
                <a
                    href="<?=get_term_link('hardware', 'category')?>">View
                    all</a>
            </div>
            <div class="grid_2_3">
                <?php
$q = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'category_name' => 'hardware',
    'ignore_sticky_posts' => 1,
    'meta_query'     => array(
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
    'orderby' => array(
        'meta_value_num' => 'DESC',
        'date'             => 'DESC'
    ),
    'meta_key' => 'is_sticky',
    'meta_type' => 'CHAR',
));
$c = 1;
if ($q->have_posts()) {
    while ($q->have_posts()) {
        $q->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
        $cat = get_the_category();
        ?>
                <a class="grid__card"
                    href="<?=get_the_permalink()?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div
                            class="card__category cat--<?=$cat[0]->slug?>">
                        </div>
                        <div class="card__title">
                            <?=get_the_title()?>
                            <?php
                        if ($c == 1) {
                            ?>
                            <div class="card__excerpt d-md-none">
                                <?=wp_trim_words(get_the_content(null, false, get_the_ID()), 20)?>
                            </div>
                            <div class="card__excerpt d-none d-md-block">
                                <?=wp_trim_words(get_the_content(null, false, get_the_ID()), 50)?>
                            </div>
                            <?php
                        }
        ?>
                        </div>
                        <div class="card__meta">
                            <div class="card__meta_date">
                                <?=get_the_date('j M, Y')?>
                            </div>
                            <div class="card__meta_time">
                                <?=estimate_reading_time_in_minutes(get_the_content(null, false, get_the_ID()), 200, true, true)?>
                            </div>
                            <div
                                class="card__meta_link link--<?=$cat[0]->slug?>">
                                <i class="fa-solid fa-arrow-right-long"></i>
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
    <!-- DEVICE CARE -->
    <a id="device-care" class="anchor"></a>
    <section class="device-care pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800">Device Care</h2>
                <a
                    href="<?=get_term_link('device-care', 'category')?>">View
                    all</a>
            </div>
            <div class="grid_3_2">
                <?php
$q = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'category_name' => 'device-care',
    'ignore_sticky_posts' => 1,
    'meta_query'     => array(
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
    'orderby' => array(
        'meta_value_num' => 'DESC',
        'date'             => 'DESC'
    ),
    'meta_key' => 'is_sticky',
    'meta_type' => 'CHAR',
));
if ($q->have_posts()) {
    while ($q->have_posts()) {
        $q->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
        $cat = get_the_category();
        ?>
                <a class="grid__card"
                    href="<?=get_the_permalink()?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div
                            class="card__category cat--<?=$cat[0]->slug?>">
                        </div>
                        <div class="card__title">
                            <?=get_the_title()?>
                        </div>
                        <div class="card__meta">
                            <div class="card__meta_date">
                                <?=get_the_date('j M, Y')?>
                            </div>
                            <div class="card__meta_time">
                                <?=estimate_reading_time_in_minutes(get_the_content(null, false, get_the_ID()), 200, true, true)?>
                            </div>
                            <div
                                class="card__meta_link link--<?=$cat[0]->slug?>">
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
    <!-- SECURITY -->
    <?php
    /*
    <a id="security" class="anchor"></a>
    <section class="security pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800">Security</h2>
                <a
                    href="<?=get_term_link('security', 'category')?>">View
                    all</a>
            </div>
            <div class="latest_grid grid_3_3">
                <?php
$q = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'category_name' => 'security',
    'ignore_sticky_posts' => 1,
    'meta_query'     => array(
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
    'orderby' => array(
        'meta_value_num' => 'DESC',
        'date'             => 'DESC'
    ),
    'meta_key' => 'is_sticky',
    'meta_type' => 'CHAR',
));
if ($q->have_posts()) {
    while ($q->have_posts()) {
        $q->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
        $cat = get_the_category();
        ?>
                <a class="grid__card"
                    href="<?=get_the_permalink()?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div
                            class="card__category cat--<?=$cat[0]->slug?>">
                        </div>
                        <div class="card__title">
                            <?=get_the_title()?>
                        </div>
                        <div class="card__meta">
                            <div class="card__meta_date">
                                <?=get_the_date('j M, Y')?>
                            </div>
                            <div class="card__meta_time">
                                <?=estimate_reading_time_in_minutes(get_the_content(null, false, get_the_ID()), 200, true, true)?>
                            </div>
                            <div
                                class="card__meta_link link--<?=$cat[0]->slug?>">
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
    */
?>
</main>
<?php

get_footer();
?>