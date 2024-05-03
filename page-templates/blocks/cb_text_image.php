<?php
$bg = get_field('colour') ?? null;

$image_order = get_field('order') == 'Image/Text' ? '' : 'order-md-2';
$text_order = get_field('order') == 'Image/Text' ? '' : 'order-md-1';
$text_alignment = get_field('order') == 'Image/Text' ? 'text--right px-3' : 'text--left px-3';

$img = wp_get_attachment_image_url(get_field('image'),'full') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';
?>
<section class="text_image <?=$bg?>">
    <div class="container-fluid">
        <div class="row gx-5">
            <div class="col-md-6 text_image__image <?=$image_order?>"
                style="background-image:url(<?=$img?>)">
            </div>
            <div class="col-md-6 <?=$text_order?>">
                <div class="ps-xl-3 <?=$text_alignment?>">
                    <h2>
                        <?=get_field('title')?>
                    </h2>
                    <?=get_field('content')?>
                </div>
            </div>
        </div>
    </div>
</section>