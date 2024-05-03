<?php
$bg = get_field('colour') ?? null;

$image_order = get_field('order') == 'Image/Text' ? '' : 'order-md-2';
$text_order = get_field('order') == 'Image/Text' ? '' : 'order-md-1';

$img = wp_get_attachment_image_url(get_field('image'),'full') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';

$padding = get_field('padding');
if (!is_array($padding)) {
    $padding = [];  // Assign an empty array if not an array
}
$pt = in_array("top", $padding) ? 'pt-5' : null;
$pb = in_array("bottom", $padding) ? 'pb-5' : null;
?>
<section class="text_image <?=$bg?> <?=$pt?> <?=$pb?>">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-6 text_image__image d-flex align-items-center <?=$image_order?>">
                <img src="<?=$img?>" alt="">
            </div>
            <div class="col-md-6 <?=$text_order?>">
                <div class="ps-xl-3 d-flex flex-column justify-content-center h-100">
                    <h2>
                        <?=get_field('title')?>
                    </h2>
                    <?=get_field('content')?>
                </div>
            </div>
        </div>
    </div>
</section>