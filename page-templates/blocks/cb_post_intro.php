<?php

$text = get_field('intro_content');
preg_match('/<p>(.*?)<\/p>/', $text, $matches);
$firstParagraph = $matches[1] ?? '';
$restOfContent = preg_replace('/<p>.*?<\/p>/', '', $text, 1);
?>

<section class="post_intro py-5">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-6">
                <h1><?=get_the_title()?></h1>
            </div>
            <div class="col-md-6"><?=$firstParagraph?></div>
        </div>
        <?php
        if ($restOfContent ?? null) {
            ?>
        <div class="pt-5"><?=$restOfContent?></div>
        <?php
        }
?>
    </div>
</section>