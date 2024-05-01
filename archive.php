<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');

$img = wp_get_attachment_image_url(get_field('blog_index_hero_image', 'options'), 'full');

get_header();
$queried_object = get_queried_object();
if (! empty($queried_object) && isset($queried_object->slug)) {
    $category_slug = $queried_object->slug;
}
?>
<main id="main" class="archive <?=$category_slug?>">
    <section class="index_hero index_hero--short"
        style="background-image: url(<?=$img?>)">
        <h1 class="mb-3">Motoverse Blog</h1>
        <div class="text-center"><?=single_cat_title()?></div>
    </section>
    <section class="index_filters">
        <div class="category-list">
            <a class="category-item" href="/">All</a>
            <a class="category-item" href="/category/technology/">Technology</a>
            <a class="category-item" href="/category/hardware/">Hardware</a>
            <a class="category-item" href="/category/device-care/">Device Care</a>
            <a class="category-item" href="/category/security/">Security</a>
        </div>
    </section>
    <section class="latest pb-5 mb-5">
        <div class="container-xl">
            <div class="section_title">
                <h2 class="fs-800"><?=single_cat_title()?> articles</h2>
            </div>
            <div class="latest_grid">
                <?php
if (have_posts()) {
    $c = 1;
    while(have_posts()) {
        the_post();
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
</main>
<?php
get_footer();
?>