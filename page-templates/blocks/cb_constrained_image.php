<?php
$img = wp_get_attachment_image_url(get_field('image'),'full');
$bg = get_field('colour') ?? null;
$class = $block['className'] ?? 'py-5';
?>
<section class="constrained_image <?=$class?> <?=$bg?>">
    <div class="container-xl">
        <img src="<?=$img?>" alt="">
    </div>
</section>