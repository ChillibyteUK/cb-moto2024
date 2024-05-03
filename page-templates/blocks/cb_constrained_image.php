<?php
$img = wp_get_attachment_image_url(get_field('image'),'full');
$bg = get_field('colour') ?? null;
$class = $block['className'] ?? null;

$padding = get_field('padding');
if (!is_array($padding)) {
    $padding = [];  // Assign an empty array if not an array
}
$pt = in_array("top", $padding) ? 'pt-5' : null;
$pb = in_array("bottom", $padding) ? 'pb-5' : null;
?>
<section class="constrained_image <?=$pt?> <?=$pb?> <?=$bg?> <?=$class?>">
    <div class="container-xl">
        <img src="<?=$img?>" alt="">
    </div>
</section>