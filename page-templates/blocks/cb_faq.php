<?php

$padding = get_field('padding');
if (!is_array($padding)) {
    $padding = [];  // Assign an empty array if not an array
}
$pt = in_array("top", $padding) ? 'pt-5' : null;
$pb = in_array("bottom", $padding) ? 'pb-5' : null;
?>
<section class="faq <?=$pt?> <?=$pb?>">
    <div class="container-xl">
        <?php
        if (get_field('faq_title') ?? null) {
            ?>
        <h2 class="mb-4"><?=get_field('faq_title')?></h2>
            <?php
        }
        ?>
        <div itemscope="" itemtype="https://schema.org/FAQPage">
        <?php
        while(have_rows('faq')) {
            the_row();
            ?>
            <div class="faq__row" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="faq__question" itemprop="name">
                    <?=get_sub_field('question')?>
                </div>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div itemprop="text" class="faq__answer">
                        <?=get_sub_field('answer')?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</section>