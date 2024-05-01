<?php
$categories = get_the_category();
if ( ! empty( $categories ) ) {
    // Get the slug of the first category
    $first_category_slug = $categories[0]->slug;
}

$q = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'category_name' => $first_category_slug,
    'post__not_in' => array(get_the_ID())
));
if ($q->have_posts()) {
    ?>
<section class="related_posts <?=$first_category_slug?> py-5">
    <div class="container-xl">
        <h2 class="text-center pb-4">From our blog</h2>
        <div class="related_grid grid_3_3">
        <?php
        while ($q->have_posts()) {
            $q->the_post();
            $ph = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
            ?>
            <a class="related__card"
                href="<?=get_the_permalink()?>">
                <img class="card__image" src="<?=$ph?>">
                <div class="card__inner">
                    <div class="card__date">
                        <?=get_the_date('F jS, Y')?>
                    </div>
                    <div class="card__title">
                        <?=get_the_title()?>
                    </div>
                    <div
                        class="card__link link--<?=$first_category_slug?>">
                        Continue Reading <i class="fa-solid fa-arrow-right-long"></i>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
        </div>
    </div>
</section>
    <?php
}
