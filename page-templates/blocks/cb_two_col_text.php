<?php
$bg = get_field('colour') ?? null;
?>
<section class="two_col_text <?=$bg?> py-5">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            $l = get_field('level');
            ?>
            <h2 class="<?=$l?> pb-3"><?=get_field('title')?></h2>
            <?php
        }
        ?>
        <div class="two_col_text__content">
            <?=get_field('content')?>
        </div>
    </div>
</section>