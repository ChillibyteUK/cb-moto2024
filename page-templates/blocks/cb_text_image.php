<?php
$bg = get_field('colour') ?? null;

$image_order = get_field('order') == 'Image/Text' ? '' : 'order-md-2';
$text_order = get_field('order') == 'Image/Text' ? '' : 'order-md-1';
$text_alignment = get_field('order') == 'Image/Text' ? 'text--right px-3' : 'text--left px-3';

$img = wp_get_attachment_image_url(get_field('image'), 'full') ?: get_stylesheet_directory_uri() . '/img/placeholder-800x450.png';

$padding = get_field('padding');
if (!is_array($padding)) {
    $padding = [];  // Assign an empty array if not an array
}
$pt = in_array("top", $padding) ? 'pt-5' : null;
$pb = in_array("bottom", $padding) ? 'pb-5' : null;
?>
<section class="text_image <?=$bg?>">
    <div class="container-fluid">
        <div class="row gx-5" style="min-height:400px">
            <div class="col-md-6 text_image__image <?=$image_order?>"
                style="background-image:url(<?=$img?>)">
            </div>
            <div
                class="col-md-6 <?=$text_order?> <?=$pt?> <?=$pb?>">
                <div class="ps-xl-3 <?=$text_alignment?>">
                    <h2 class="mb-4">
                        <?=get_field('title')?>
                    </h2>
                    <?=get_field('content')?>
                </div>
            </div>
        </div>
    </div>
</section>