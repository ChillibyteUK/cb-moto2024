<?php
$bg = get_field('colour') ?? null;
$padding = get_field('padding');
if (!is_array($padding)) {
    $padding = [];  // Assign an empty array if not an array
}
$pt = in_array("top", $padding) ? 'pt-5' : null;
$pb = in_array("bottom", $padding) ? 'pb-5' : null;
?>
<section class="two_col_text <?=$bg?> <?=$pt?> <?=$pb?>">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            if (get_field('style') == 'bold') {
                ?>
            <strong class="mb-4"><?=get_field('title')?></strong>
                <?php
            }
            else {
                ?>
            <h2 class="mb-4"><?=get_field('title')?></h2>
                <?php
            }
        }
        ?>
        <div class="two_col_text__content">
            <?=get_field('content')?>
        </div>
    </div>
</section>