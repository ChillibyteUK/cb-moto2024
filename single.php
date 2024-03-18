<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
$cat = get_the_category();
?>
<main id="main" class="blog">
    <section class="post_hero mb-5"
        style="background-image: url(<?=$img?>)">
    </section>
    <section class="post_meta">
        <div class="container-xl">
            <div class="post_meta__left">
                <div class="post_meta__author">Motorola</div>
                <div class="post_meta__date">
                    <?=get_the_date('jS F Y')?>
                </div>
            </div>
            <div class="post_meta__right">
                <div class="post_meta__title">Categories</div>
                <div class="post_meta__category">
                    <?=$cat[0]->name?>
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