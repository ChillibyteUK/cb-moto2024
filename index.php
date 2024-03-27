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
            <a class="category-item" href="#security">Security</a>
        </div>
    </section>
    <!-- LATEST POSTS -->
    <a id="all" class="anchor"></a>
    <section class="latest all pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2>Latest trending articles</h2>
            </div>
            <div class="latest_grid">
                <?php
            $q = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'ignore_sticky_posts' => 1
            ));
if ($q->have_posts()) {
    $n = 1;
    while ($q->have_posts()) {
        $q->the_post();
        $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
        $cat = get_the_category();
        ?>
                <a class="grid__card <?=$cat[0]->slug?>"
                    href="<?=get_the_permalink()?>">
                    <img class="card__image" src="<?=$ph?>">
                    <div class="card__inner">
                        <div
                            class="card__category cat--<?=$cat[0]->slug?>">
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
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                $n++;
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
                <h2>Technology</h2>
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
                            <div class="card__excerpt">
                                <?=wp_trim_words(get_the_content(null, false, get_the_ID()), 20)?>
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
                                <i class="fa-solid fa-arrow-right"></i>
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
                <h2>Hardware</h2>
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
                            <div class="card__excerpt">
                                <?=wp_trim_words(get_the_content(null, false, get_the_ID()), 20)?>
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
                                <i class="fa-solid fa-arrow-right"></i>
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
                <h2>Device Care</h2>
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
                                <i class="fa-solid fa-arrow-right"></i>
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
    <a id="security" class="anchor"></a>
    <section class="security pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2>Security</h2>
                <a
                    href="<?=get_term_link('security', 'category')?>">View
                    all</a>
            </div>
            <div class="latest_grid grid_3_3">
                <?php
$q = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
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
                                <i class="fa-solid fa-arrow-right"></i>
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