<?php
$bg = get_field('colour') ?? null;

$image_order = get_field('order') == 'Image/Text' ? '' : 'order-md-2';
$text_order = get_field('order') == 'Image/Text' ? '' : 'order-md-1';

$img = wp_get_attachment_image_url(get_field('image'),'full') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
?>
<section class="text_image py-5 <?=$bg?>">
    <div class="container-xl">
        <div class="h3 d-md-none">
            <?=get_field('title')?>
        </div>
        <div class="row g-4">
            <div class="col-md-6 text_image__image d-flex align-items-center <?=$image_order?>">
                <img src="<?=$img?>" alt="">
            </div>
            <div class="col-md-6 <?=$text_order?>">
                <div class="ps-xl-3 d-flex flex-column justify-content-center h-100">
                    <h3 class="d-none d-md-block">
                        <?=get_field('title')?>
                    </h3>
                    <?=get_field('content')?>
                </div>
            </div>
        </div>
    </div>
</section>